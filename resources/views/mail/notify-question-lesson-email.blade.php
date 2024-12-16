<x-simple-email-content>
    <h3>Comentario</h3>
    <p>
        El usuario <b>{{$question->user->name}}</b> ha hecho un comentario en la lección: 
        <b>{{$lesson->name}}</b> El día {{$question->created_at->format('d/m/Y')}}, 
        puedes verlo más abajo para responderlo.
    </p>

    <p>
       Comentario: 
    </p>
    <div style="padding:10px; background-color:rgb(251, 248, 248)">
        {!!$question->body!!}
    </div>
    <p>
       {{-- <a class="button button5" href="{{url('/')->current()}}" target="_blank" rel="noopener noreferrer">
        Responder comentario
       </a> --}}
       <a class="button button5" href="{{url('/') . '/courses-status/' . $lesson->section->course->slug . '/' . $lesson->slug}}" target="_blank" rel="noopener noreferrer">
        Responder comentario
       </a>
    </p>
 </x-simple-email-content>