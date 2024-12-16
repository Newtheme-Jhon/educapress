<?php

namespace App\Listeners;

use App\Events\AnswerCreated;
use App\Mail\NotifyAnswerLessonEmail;
use App\Mail\NotifyAnswerPostEmail;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class NotifyAuthorAnswer
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
     * Para obtener el modelo del objeto que se está preguntando
     * $event->answer->question->questionable_type
     * 
     * Para obtener info de la pregunta que estamos respondiendo:
     * $question = $event->answer->question;
     * 
     * Para obtener info de la respuesta que estamos respondiendo:
     * $answer = $event->answer;
     * 
     * Para obtener el objeto del modelo post donde estamos interactuando:
     * $question = $event->answer->question;
     * $post = $question->questionable;
     * 
     * Para obtener el objeto del modelo lesson donde estamos interactuando:
     * $question = $event->answer->question;
     * $lesson = $question->questionable;
     * 
     * Para  obtener la info del usuario que hace la pregunta:
     * $question = $event->answer->question;
     * $user_question = $question->user;
     * 
     * Para obtener la info del usuario que responde a la pregunta:
     * $answer = $event->answer;
     * $user_answer = $answer->user;
     * 
     */
    public function handle(AnswerCreated $event): void
    {
        $model = $event->answer->question->questionable_type;

        switch($model){
            case 'App\Models\Post':

                $question = $event->answer->question;
                $user_question = $question->user;

                $answer = $event->answer;
                //$user_answer = $answer->user;

                Mail::to($user_question->email)->queue(new NotifyAnswerPostEmail($question, $answer));
                
                break;

            case 'App\Models\Lesson':

                $question = $event->answer->question;
                $user_question = $question->user;
                
                $answer = $event->answer;
                //$user_answer = $answer->user;

                Mail::to($user_question->email)->queue(new NotifyAnswerLessonEmail($question, $answer));
                
                break;
            default:
                Log::info('No se puede notificar al author');
                break;
        }
        
    }
}
