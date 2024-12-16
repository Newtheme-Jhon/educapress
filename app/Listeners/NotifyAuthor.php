<?php

namespace App\Listeners;

use App\Events\QuestionCreated;
use App\Mail\NotifyQuestionPostEmail;
use App\Mail\NotifyQuestionLessonEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class NotifyAuthor
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     * imprimir evento
     * Log::info('Notificando al author: ' . $event->question->user->name);
     */
    public function handle(QuestionCreated $event): void
    {
        switch($event->question->questionable_type){
            case 'App\Models\Post':
                
                $post = $event->question->questionable;
                $author = $post->user->email;
                Mail::to($author)->queue(new NotifyQuestionPostEmail($event->question));
                
                break;
            case 'App\Models\Lesson':
                $lesson = $event->question->questionable;
                $teacher = $lesson->section->course->teacher;
                // Log::info('Notificando al tutor: ' . $teacher->email);
                // Log::info('nombre de la leccion: ' . $lesson->name);

                Mail::to($teacher->email)->queue(new NotifyQuestionLessonEmail($event->question, $lesson));
                break;
            default:
                Log::info('No se puede notificar al author');
                break;
        }

    }
}
