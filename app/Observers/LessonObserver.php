<?php

namespace App\Observers;

use App\Models\Lesson;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class LessonObserver
{

    public function creating(Lesson $lesson)
    {
        $lesson->order = Lesson::where('section_id', $lesson->section_id)->max('order') + 1;
        $lesson->slug = Str::slug($lesson->name);
    }

    /**
     * Aquí solo debemos eliminar el recurso si existe, es decir el archivo
     * @param Lesson $lesson
     * No hace falta eliminar el registro de la base de datos, pues hay una relación de uno a uno
     * entre la lección y el recurso (on delete cascade)
     */
    public function deleting(Lesson $lesson)
    {
        if($lesson->resource){
            Storage::delete($lesson->resource->url);
        }
    }

}
