<x-simple-email-content>
    <h3>Comentario</h3>
    <p>
        Hola <b>{{$question->user->name}},</b> el usuario <b>{{$answer->user->name}}</b> ha respondido a un comentario en el post 
        <b>{{$post->title}}</b> El día {{$question->created_at->format('d/m/Y')}}, 
        a continuación verás la pregunta: 
    </p>

    <p style="padding:10px; background-color:rgb(251, 248, 248)">
        {{$question->body}}
    </p>

    <p>
       El usuario <b>{{$answer->user->name}}</b> respondió: 
    </p>
    <p style="padding:10px; background-color:rgb(251, 248, 248)">
        {{$answer->body}}
    </p>
    <p>
       <a class="button button5" href="{{url('/' . 'blog/' . $post->slug)}}" target="_blank" rel="noopener noreferrer">
        Responder
       </a>
    </p>
 </x-simple-email-content>