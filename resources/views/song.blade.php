@extends('adminlte::page')

@section('content')

<div class="container" >
    <div class="panel panel-default">
        <div class="panel-heading" style="background-color:#3c8dbc;color:#FFFFFF;">
            <div class="panel-title" >{{$song->title}}</div>
        </div>
        <div class="panel-body" align="left" style="background-color:#c4deff;">
            <iframe width="560" height="315" 
            src = {{$song->url}}  
            allowfullscreen></iframe><br/>
            <label>Artista: {{$song->artist}} </label><br/>
            <label>Album: {{$song->album}}</label>
            <label> | Fecha: {{$song->date}}</label>
            <a href="/song/{{$song->id}}/change" class="btn btn-default pull-right">Editar</a>
        </div>  
        </div>
</div>

<div class="container" id="comentarios" align="center">
    <div class="panel panel-default">
        <div class="panel-heading" style="background-color:#3c8dbc;color:#FFFFFF;">
            <div class="panel-title" >Comentarios</div>
        </div>
        <div class="panel-body" align="center" style="background-color:#c4deff;">
                @forelse($comments as $comment)
                    <div class="panel panel-default">
                        <div class="panel-heading" style="background-color:#ef8300;color:#FFFFFF;">{{$comment->nick}}</div>
                        <div class="panel-body" style="background-color:#ffe4c4;" align="left">
                            <label>{{$comment->comment}}</label><br/>
                            <text syle="text-align: right;">Likes->{{$comment->likes}}</text>
                            <form method="POST" action="{{action('CommentController@like')}}" id="comentarioN">
                                <input type="hidden" name="_method" value="PUT"></input>
                                <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
                                <input type="hidden" name="comment" value="{{ $comment->id }}"></input>
                                <input type="hidden" name="song" value="{{ $song->id }}"></input>
                                <button type="submit" id="botonL" class="btn btn-default pull-right">Like</button>
                            </form>
                            @if(session()->get('id') == $comment->user_id)
                                <form method="POST" action="{{action('CommentController@delete')}}" id="comentarioN">
                                    <input type="hidden" name="_method" value="DELETE"></input>
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
                                    <input type="hidden" name="comment" value="{{$comment->id}}">
                                    <button type="submit" id="botonL" class="btn btn-default pull-right">Eliminar</button>
                                </form>
                                
                                <a href="/song/{{$song->id}}/edit/{{$comment->id}}" class="btn btn-default pull-right">Editar</a>
                            @endif
                        </div> 
                        
                    </div>

                @empty
                    <div class="alert alert-info">
                        <strong>No tienes ningun comentario</strong>
                    </div>
                @endforelse
                {{ $comments->links() }}
                <form method="POST" action="{{action('CommentController@create')}}" id="otro">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
                    <input type="hidden" name="song" value="{{ $song->id }}"></input>
                        <div class="form-group">
                            <textarea form="otro" name="descripcion" rows="5" cols="40"></textarea><br/>
                        </div>

                        <div class="form-group">        
                                <button type="submit" id="botonL" class="btn btn-default">Comentar</button>
                        </div>
                </form>
        </div>
    </div>
</div>
@stop