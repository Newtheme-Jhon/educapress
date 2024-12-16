<x-simple-email-content>
    <h3>Comentario</h3>
    <p>
        Hola <b>{{$question->user->name}},</b> el usuario <b>{{$answer->user->name}}</b> ha respondido a un comentario en la lección: 
        <b>{{$lesson->name}}</b> El día {{$question->created_at->format('d/m/Y')}}, 
        a continuación verás la pregunta.
    </p>

    <div style="padding:10px; background-color:rgb(251, 248, 248)">
        {!!$question->body!!}
    </div>

    <p>
       El usuario <b>{{$answer->user->name}}</b> respondió:
    </p>
    <div style="padding:10px; background-color:rgb(251, 248, 248)">
        {!!$answer->body!!}
    </div>
    <p>
       {{-- <a class="button button5" href="{{url('/')->current()}}" target="_blank" rel="noopener noreferrer">
        Responder comentario
       </a> --}}
       <a class="button button5" href="{{url('/') . '/courses-status/' . $lesson->section->course->slug . '/' . $lesson->slug}}" target="_blank" rel="noopener noreferrer">
        Responder
       </a>
    </p>
 </x-simple-email-content>