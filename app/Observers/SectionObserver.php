<?php

namespace App\Observers;

use App\Models\Section;
use Illuminate\Support\Facades\Storage;

class SectionObserver
{
    public function creating(Section $section)
    {
        if(!$section->order){
            $section->order = Section::where('course_id', $section->course_id)->max('order') + 1;
        }
    }

    /** 
     * Solo eliminamos el archivo resourse, el registro ya se limina automaticamente al eliminar una sección, 
     * pues hay una relacion en la tabla resource donde si eliminalmos la sección se 
     * eliminara el registro de la base de datos
     * @param Section $section
     */
    public function deleting(Section $section)
    {
        foreach($section->lessons as $lesson){

            //eliminar el archivo resource de la lección
            if($lesson->resource){
                Storage::delete($lesson->resource->url);
            }

        }
    }
}
