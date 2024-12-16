<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Computed;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Attributes\On;

class CourseStatus extends Component
{
    use AuthorizesRequests;

    public Course $course;
    public $lesson;

    public $current;
    public $lessonNumber;
    public $open = false;

    public $comment;
    public $rating;
    public $errorReview;
    public $currentUrl = null;

    #[Computed]
    public function lessonUrl(): string
    {
        return route('courses.status', [$this->course, $this->lesson->slug]);
        
    }

    /**
     * $this->currentUrl = url()->current();
     * con esto recuperamos la url del navegador al cargarse el componente
     * de la pagina course-status
     * 
     * Si la leccion no ha sido completada y no hay una leccion asignada a current 
     * asignar la leccion actual a current
     * if(!$this->current && !$lesson->lessonCompleted){
     * $this->current = $lesson;
     * break;
     * }
     * 
     */
    public function mount(Course $course)
    {
        $this->course = $course;

        $this->currentUrl = url()->current();
        
        foreach($this->course->lessons as $lesson){

            if($this->currentUrl == route('courses.status', [$this->course, $lesson->slug])){
                $this->current = $lesson;
                break;
            }
        }

        if(!$this->current){
            if(session()->has('lesson_progress')){
                $this->current = session()->get('lesson_progress');
            }else{
                $this->current = $this->course->lessons->first();
            }
        }

        $this->lesson = Lesson::find($this->current->id);
        $this->authorize('enrolled', $this->course);
        $this->dispatch('lesson-changed-url', $this->lessonUrl);

        
    }

    public function changeLesson(Lesson $lesson)
    {
        $this->current = $lesson;
        $this->lesson = $lesson;

        //al hacer change cambio el valor de esta variable
        $this->currentUrl = null;

        //Guardar el estado del usuario (opcional)
        session()->put('lesson_progress', $this->lesson);

        $this->dispatch('lesson-changed-url', $this->lessonUrl);

    }

    /**
     * lessonCompleted servira para validar si existe algun registro 
     * donde se haya guardado una leccion completada, si hay un registro de la leccion completada
     * el valor sera 1, si hay un registro de la leccion no completada el valor sera 0
     * si no hay registro de la leccion el valor sera false por defecto
     */
    public function buttonCompletedLesson()
    {
        if ($this->current->lessonCompleted) {
            //añadir a la tabla lesson_user 0 al campo is_completed
            $data = DB::table('lesson_user')
                ->where('user_id', Auth::user()->id)
                ->where('lesson_id', $this->current->id)
                ->update(['is_completed' => 0]);

        } else {
            //Añadir a la tabla lesson_users 1 al campo is_completed
            if($this->current->lessonCompleted !== false){
                $data = DB::table('lesson_user')
                    ->where('user_id', Auth::user()->id)
                    ->where('lesson_id', $this->current->id)
                    ->update(['is_completed' => 1]);
                    
            }else{
                $data = DB::table('lesson_user')
                    ->insert([
                        'user_id' => Auth::user()->id,
                        'lesson_id' => $this->current->id,
                        'is_completed' => 1,
                        'created_at' => now(),
                        'updated_at' => now()
                    ]);
                    
            }
            
        }
        
    }

    /**
     * Events
     * Este evento se ejecuta cuando se termina la reproduccion del video
     * @On('video-ended')
     * @param $lesson
     */
    #[On('video-ended')]
    public function videoEnded($lesson){
        $lesson = Lesson::find($lesson['id']);
        
        if(!$this->lesson->lessonCompleted){
            $this->buttonCompletedLesson();
        }

        $this->changeLesson($lesson);
    }

    /**
     * Propiedades computadas $index, $previous, $next
     */

    #[Computed()]
    public function index()
    {
        return $this->course->lessons->pluck('id')->search($this->current->id);
    }

    #[Computed()]
    public function previous()
    {
        if($this->index == 0){
            return null;
        }else{
            return $this->course->lessons[$this->index - 1];
        }
    }

    #[Computed()]
    public function next()
    {
        if($this->index == $this->course->lessons->count() - 1){
            return null;
        }else{
            return $this->course->lessons[$this->index + 1];
        }
    }

    #[Computed()]
    public function advanced()
    {
        $i = 0;
        foreach($this->course->lessons as $lesson){
            if($lesson->lessonCompleted){
                $i++;
            }
        }

        $advanced = ($i * 100) / $this->course->lessons->count();
        return round($advanced, 2);
    }

    public function render()
    {
        $course = $this->course;

        //total duracion del curso
        $duration = $course->lessons->where('is_published', '=', 1)->sum('duration');
        $horas = floor($duration / 3600);
        $minutos = floor(($duration - ($horas * 3600)) / 60);
        $segundos = $duration - ($horas * 3600) - ($minutos * 60);
        $totalTime = sprintf('%2dh %02dm', $horas, $minutos);

        return view('livewire.course-status', compact('course', 'totalTime'));
    }

    public function save(){

        if(!$this->rating){
            return $this->errorReview = 'La calificación es obligatoria';
        }elseif(!$this->comment){
            return $this->errorReview = 'El comentario es obligatorio';
        }else{
            //Validar que el usuario no haya realizado una reseña
            $review = $this->course->reviews()->where('user_id', Auth::user()->id)->first();

            if($review){
                return $this->errorReview = 'Ya has realizado una reseña de este curso';
            }

            $this->course->reviews()->create([
                'user_id' => Auth::user()->id,
                'course_id' => $this->course->id,
                'review' => $this->comment,
                'rating' => $this->rating
            ]);

            return redirect()->route('courses.status', $this->course);

        }
    }

    public function download()
    {
        $resource = $this->current->resource->url;
        return response()->download(storage_path('app/public/' . $resource));
    }

    public function contentBlocked($user, $course)
    {
        dd(1);
    }
}
