<?php

namespace App\Livewire\Instructor\Courses;

use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

use Livewire\WithFileUploads;

class LessonResource extends Component
{

    use WithFileUploads;

    public $lesson, $file, $course_id;

    public function mount(Lesson $lesson)
    {
        $this->lesson = $lesson;
        $this->course_id = $this->lesson->section->course_id;
    }

    public function render()
    {
        return view('livewire.instructor.courses.lesson-resource');
    }

    public function save()
    {

        $this->validate([
            'file' => 'required|mimes:pdf,doc,docx,txt,jpg,jpeg,webp,png|max:2048',
        ]);

        $url = $this->file->storeAs('lessons/courses/' . $this->course_id , $this->file->getClientOriginalName(), 'public');

        $this->lesson->resource()->create([
            'name' => $this->file->getClientOriginalName(),
            'url' => $url,
            'section_id' => $this->lesson->section_id,
            'lesson_id' => $this->lesson->id
        ]);

        //Rrefrescamos la leccion
        $this->lesson->fresh();
    }

    public function destroy($id)
    {
        //Definimos la lección
        $resource = $this->lesson->resource()->find($id);

        //Eliminamos el archivo fisico
        Storage::delete($resource->url);

        //eliminamos el registro de la tabla
        $resource->delete();

        //Rrefrescamos la leccion
        $this->lesson->fresh();
    }

    public function download($id)
    {
        $resource = $this->lesson->resource()->find($id);
        return response()->download(storage_path('app/public/' . $resource->url));
    }
}
