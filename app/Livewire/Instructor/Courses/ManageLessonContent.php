<?php

namespace App\Livewire\Instructor\Courses;

use App\Events\VideoUploaded;
use App\Models\Lesson;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;

//para la subida de archivos
use Livewire\Attributes\Validate;
use Livewire\WithFileUploads;

/**
 * Esta clase es para gestionar el contenido de las lecciones
 * de los cursos, es decir para actualizar el video, la descripcion
 * y el estado de la leccion, en el metodo saveVideo.
 * 
 * para eliminar un video anterior en esta clase buscamos el metodo:
 * saveVideo() y eliminamos el video anterior
 *
 * @property Lesson $lesson
 */
class ManageLessonContent extends Component
{

    use WithFileUploads;

    public $lesson;
    public $editVideo = false;

    public $platform = 1, $video, $url;

    public $editDescription = false;
    public $description;
    public $is_published, $is_preview;

    public $course;

    public function mount($lesson)
    {
        $this->description = $lesson->description;
        $this->is_published = $lesson->is_published;
        $this->is_preview = $lesson->is_preview;
        $this->course = $lesson->section->course;
    }

    /**
     * aqui solo recibo el contenido del ckeditor que se 
     * envia desde el archivo ckeditor.js
     * Livewire.dispatch('updatedValueLessonEdit', [valor]);
     */
    #[On('updatedValueLessonEdit')]
    public function updatedValueLessonEdit($value){
        $this->description = $value;
    }

    /**
     * Este metodo updated() recivira dos parametros $property y $value
     * $property recibira bien sea is_published o is_preview
     * $value recibira el valor actualizado
     * 
     * por ultimo en el javascript donde recuperamos el valor de la propiedad 
     * deveremos añadir .live: @entangle($attributes->wire('model')).live
     * 
     * @param string $property
     * @param string $value
     * @return void
     */
    public function updated($property, $value)
    {
        if($property == 'is_published' || $property == 'is_preview')
        {
            $this->lesson->$property = $value;
            $this->lesson->save();
        }
    }

    /**
     * Aqui entraremos cuando vayamos a actualizar el video de una leccion
     * para eliminar el video si esta en el disco publico seria asi:
     * Storage::delete($this->lesson->video_path);
     * Storage::delete($this->lesson->video_original_name);
     * 
     * Para eliminar el video anterior del s3 seria asi:
     * Storage::disk('s3')->delete($this->lesson->video_path);
     */
    public function saveVideo()
    {
        $rules = [
            'platform' => 'required',
        ];

        if($this->platform == 1)
        {
            $rules['video'] = 'required|mimes:mp4,mov,avi,wmv,flv,3gp';
        }else{
            //expresión regular validate url youtube
            $rules['url'] = [
                'required', 
                'regex:/^(?:https?:\/\/)?(?:www\.)?(youtu\.be\/|youtube\.com\/(?:embed\/|v\/|watch\?v=))([\w-]{10,12})/'
            ];
        }

        $this->validate($rules);

        if($this->lesson->platform == 1)
        {
            //elimino el video del disco s3
            Storage::disk('s3')->delete($this->lesson->video_path);
            //elimino la imagen del disco s3
            Storage::disk('s3')->delete($this->lesson->image_path);
        }

        $this->lesson->platform = $this->platform;
        $this->lesson->is_processed = false;

        if($this->platform == 1)
        {
            //almacenamos el nombre del nuevo video y disparamos el evento: uploadVideoFile
            $this->lesson->video_original_name = $this->video->getClientOriginalName();
            $this->lesson->save();

            $this->dispatch('uploadVideoFile', $this->lesson->id)->self();
        }else{
            $this->lesson->video_original_name = $this->url;
            $this->lesson->save();

            VideoUploaded::dispatch($this->lesson);
        }

        $this->reset('platform', 'editVideo', 'url');
    }

    public function saveDescription()
    {
        $this->validate([
            'description' => 'required'
        ]);

        $this->lesson->description = $this->description;
        $this->lesson->save();

        $this->reset('editDescription');
    }

    /**
     * si queremos almacenar el video en el disco publico seria asi:
     * $lesson->video_path = $this->video->store('courses/lessons');
     * $lesson->save();
     * 
     * Despues de actualizar el video en la base de datos, disparamos el evento:
     * VideoUploaded::dispatch($lesson);
     * esto nos lleva al archivo ProcessLessonVideo.php
     *
     * @param int $lessonId
     * @return void
     */
    #[On('uploadVideoFile')]
    public function uploadVideoFile( $lessonId )
    {
        $lesson = Lesson::find($lessonId);

        //almacenamos en el buket del s3
        $file = $this->video;
        $path = Storage::disk('s3')->put('courses/' . $this->course->id . '/lessons', $file);
        $lesson->video_path = $path;
        $lesson->save();

        VideoUploaded::dispatch($lesson);
        $this->reset('video');
    }
    
    public function render()
    {
        return view('livewire.instructor.courses.manage-lesson-content');
    }

}
