<x-simple-email-content>
    <h3>Comentario</h3>
    <p>
        El usuario <b>{{$question->user->name}}</b> ha hecho un comentario en el post 
        <b>{{$question->questionable->title}}</b> El día {{$question->created_at->format('d/m/Y')}}, 
        puedes verlo más abajo para responderlo.
    </p>

    <p>
       Comentario: 
    </p>
    <p style="padding:10px; background-color:rgb(251, 248, 248)">
        {{$question->body}}
    </p>
    <p>
       <a class="button button5" href="{{url('/' . 'blog/' . $question->questionable->slug)}}" target="_blank" rel="noopener noreferrer">
        Responder comentario
       </a>
    </p>
 </x-simple-email-content>