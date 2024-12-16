<?php

namespace App\Rules;

use App\Models\Lesson;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Str;

class UniqueLessonCourse implements ValidationRule
{
    public $course_id;

    public function __construct($course_id)
    {
        $this->course_id = $course_id;
    }


    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // En la variable $value, se almacena el name, ese name viene desde el metodo rules()
        $name = $value;
        $slug = Str::slug($name);

        $lesson = Lesson::where('slug', $slug)
        ->whereHas('section', function($query){
            $query->where('course_id', $this->course_id);
        })
        ->first();

        if($lesson){
            $fail('Ya existe una lección con ese nombre');
        }
    }
}
