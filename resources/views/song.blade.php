@extends('master')

@section('content')
<div class="row">

    <div class="col-md-4"></div>

    <div class="col-md-4" id="song">

         <div class="panel panel-default">
                <div class="panel-heading">{{$song->title}}</div>
                <div class="panel-body" align="left">
                    <label>Artista: {{$song->artist}} </label>  
                    <label> | Album: {{$song->album}}</label><br/>
                    <label>Duracion: {{$song->duration}}</label>
                    <label> | Fecha: {{$song->date}}</label>
                </div>  

        </div>

        <div class="container" id="comentarios" align="center">
        <label>Comentarios</label><br/>
        @forelse($comments as $comment)
            <div class="panel panel-default">
                <div class="panel-heading">{{$comment->nick}}</div>
                <div class="panel-body" align="left">
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
                    @endif
                </div> 
                
            </div>

        @empty
            <div class="alert alert-info">
                <strong>No tienes ningun comentario</strong>
            </div>
        @endforelse
        {{ $comments->links() }}
       
        </div>

  

       <form method="POST" action="{{action('CommentController@create')}}" id="comentarioN">
                <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
                <input type="hidden" name="song" value="{{ $song->id }}"></input>
                <button type="submit" id="botonL" class="btn btn-default pull-left">Comentar</button>
       
        <input type="text" name="descripcion" rows="5" cols="40">
        </form><br/>


    </div>




</div>


@stop