<?php

namespace App\Policies;

use App\Models\Course;
use App\Models\Review;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CoursePolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function enrolled(User $user, Course $course):Response
    {   
        //si esta matriculado return true
        return $user->courses_enrolled->contains($course) ? 
        Response::allow() : Response::deny('No estas matriculado en este curso');
        //Response::allow() : Response::allow();

    }

    /**
     * El signo de interrogación antes de ?User indica que el user puede ser nulo, 
     * porque puede ser que el usuario no este logueado, por ejemplo desde
     * una ventana de incognito
     */
    public function published(?User $user, Course $course):Response
    {
        //dd($course->status->value);
        if($course->status->value == 3){
            return Response::allow();
        }else{
            return Response::deny('Este curso no esta publicado');
        }

    }

    /**
     * El administrador no podra aprobar un curso que se encuentre con status 1, 
     * es decir un curso en borrador no puede aprobarse
     */
    public function approved(User $user, Course $course):Response
    {
        if($course->status->value == 1){
            return Response::deny('Este curso no puede ser aprobado, aun esta en borrador');
        }else{
            return Response::allow();
        }
    }

    public function validateReview(User $user, Course $course)
    {
        
        if(Review::where('user_id', $user->id)->where('course_id', $course->id)->count()){
            return false;
        }else{
            return true;
        }

        //return Review::where('user_id', $user->id)->where('course_id', $course->id)->exists() ?
        //Response::deny('Ya has realizado una reseña en este curso') : Response::allow(

    }

    public function author(User $user, Course $course):Response
    {
        return $user->id == $course->user_id ?
        Response::allow() : Response::deny('No eres el autor de este curso');

    }

}
