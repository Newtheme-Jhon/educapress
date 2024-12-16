<?php

namespace App\Livewire\Instructor\Courses;

use App\Events\VideoUploaded;
use App\Models\Lesson;
use App\Rules\UniqueLessonCourse;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;

/**
 * Con FFmpeg instalado en windows, se puede convertir cualquier video a mp4
 * Para convertir el video a mp4 se necesita FFmpeg
 * Para obtener informacion del video descargaremos el paquete para Laravel: 
 * https://github.com/protonemedia/laravel-ffmpeg?tab=readme-ov-file
 * 
 * descargar FFmpeg para windows: https://www.ffmpeg.org/download.html
 * No instalar, descomprimir y poner dentro de la carpeta c://
 * 
 * s3 video: https://www.youtube.com/watch?v=WR_lXwwN4nY
 */

class ManageLessons extends Component
{
    use WithFileUploads;

    public $section;
    public $lessons;
    public $orderLessons;

    public $video, $url;
    
    public $lessonCreate = [
        'open'      => false,
        'name'      => '',
        'platform'  => 1,
        'video_original_name' => null
    ];

    public $lessonEdit = [
        'id'      => null,
        'name'      => '',
    ];

    public $course;

    public function mount()
    {
        $this->getLessons();
        $this->course = $this->section->course;
        //dd($this->course);
    }

    public function getLessons()
    {
        $this->lessons = Lesson::where('section_id', $this->section->id)
        ->orderBy('order', 'asc')
        ->get();
    }

    public function rules()
    {
        $rules = [
            'lessonCreate.name' => ['required', new UniqueLessonCourse($this->section->course_id)],
            'lessonCreate.platform' => 'required',
        ];

        if ($this->lessonCreate['platform'] == 1) {
            $rules['video'] = 'required|mimes:mp4,mov,avi,wmv,flv,3gp';
        }else{
            //expresión regular validate url youtube
            $rules['url'] = [
                'required', 
                'regex:/^(?:https?:\/\/)?(?:www\.)?(youtu\.be\/|youtube\.com\/(?:embed\/|v\/|watch\?v=))([\w-]{10,12})/'
            ];
        }

        return $rules;
    }

    public function store()
    {
        //este metodo automaticamente buscara el metodo rules()
        $this->validate();
        
        //trim() quita los espacios en blanco al inicio y al final de la cadena de texto
        $this->lessonCreate['name'] = trim($this->lessonCreate['name']);

        if($this->lessonCreate['platform'] == 1){

            $this->lessonCreate['video_original_name'] = $this->video->getClientOriginalName();
            $lesson = $this->section->lessons()->create($this->lessonCreate);

            $this->dispatch('uploadVideoFile', $lesson->id)->self();
            
        }elseif($this->lessonCreate['platform'] == 2){

            $this->lessonCreate['video_original_name'] = $this->url;
            $lesson = $this->section->lessons()->create($this->lessonCreate);

            VideoUploaded::dispatch($lesson);
        }

        $this->reset(['url', 'lessonCreate']);
        $this->getLessons();
        $this->dispatch('refreshOrderLessons');
    }

    public function edit($lessonId)
    {
        $lesson = Lesson::find($lessonId);
        $this->lessonEdit = [
            'id' => $lesson->id,
            'name' => $lesson->name,
        ];
    }

    /**
     * Al ejecutarse ese metodo no se actualiza los cambios, debemos refrescar la pagina 
     * Para que se actualice la pagna automaticamente debemos de crear el metodo getLessons() 
     * y pasarlo justo despues de actualizar el registro
     * @return void
     */
    public function update()
    {
        $this->validate([
            'lessonEdit.name' => ['required'],
        ]);

        $lesson = Lesson::find($this->lessonEdit['id'])->update($this->lessonEdit);
        $this->reset('lessonEdit');
        $this->getLessons();
    }

    /**
     * con esto el video se almacenara en el disco publico, en la carpeta storage/app/public/courses/lessons
     * $lesson->video_path = $this->video->store('courses/lessons');
     * aqui entrara la primera ves que se crea una leccion, pero cuando se actualice
     * no entrara porque el video ya existe
     *
    */
        
    #[On('uploadVideoFile')]
    public function uploadVideoFile( $lessonId )
    {

        $lesson = Lesson::find($lessonId);

        //ahora lo almacenaremos en s3
        $file = $this->video;
        $path = Storage::disk('s3')->put('courses/' . $this->course->id . '/lessons', $file);
        $lesson->video_path = $path;
        $lesson->save();

        VideoUploaded::dispatch($lesson);
        $this->reset('video');
    }

    public function destroy($lessonId)
    {
        //dd($lessonId);
        $lesson = Lesson::find($lessonId);
        $lesson->delete();
        $this->getLessons();
        $this->dispatch('refreshOrderLessons');
        
    }

    public function render()
    {
        return view('livewire.instructor.courses.manage-lessons');
    }
}
