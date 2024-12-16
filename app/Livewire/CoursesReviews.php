<?php

namespace App\Livewire;

use App\Models\Course;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class CoursesReviews extends Component
{
    public $course_id;
    public $promedioReviews;

    public function mount(Course $course)
    {
        $this->course_id = $course->id;
    }

    //Calcular el promedio de las calificaciones
    public function calcularPromedio($course)
    {
        $reviews = $course->reviews->pluck('rating');
        $totalReviews = $course->reviews->count();
        if($totalReviews > 0)
        {
            $this->promedioReviews = $reviews->sum() / $totalReviews;
        }else
        {
            $this->promedioReviews = 5;
        }

        //devolver solo dos decimales
        $this->promedioReviews = number_format($this->promedioReviews, 2);
        return $this->promedioReviews;

    }

    public function render()
    {
        $course = Course::find($this->course_id);
        $reviews = $course->reviews()->orderBy('created_at', 'desc')->get();

        $total_reviews = $course->reviews()->count();
        $total_reviews = $total_reviews > 0 ? $total_reviews : 1;

        $this->promedioReviews = $this->calcularPromedio($course);

        return view('livewire.courses-reviews', compact('course', 'reviews', 'total_reviews'));
    }


    
}
