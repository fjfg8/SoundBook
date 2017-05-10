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
            @if(Auth::user()->id == $song->user_id || Auth::user()->isAdmin)
                <button type="submit" id="botonL" class="btn btn-default pull-right">Eliminar</button>
                <a href="/song/{{$song->id}}/change" class="btn btn-default pull-right">Editar</a>
            @endif
        </div>  
        </div>
</div>

<div class="container" id="comentarios" align="center">
    <div class="panel panel-default">
        <div class="panel-heading" style="background-color:#3c8dbc;color:#FFFFFF;">
            <div class="panel-title" >Comentarios</div>
        </div>
        <div class="panel-body" align="center" style="background-color:#c4deff;">

                @if(sizeof($comments)==0)
                    <div class="alert alert-info">
                        <strong>No tienes ningun comentario</strong>
                    </div>
                @endif
                @for($i=0;$i<sizeof($comments);$i++)
                    <div class="panel panel-default">
                        <div class="panel-heading" style="background-color:#ef8300;color:#FFFFFF;">{{$nicks[$i]}}</div>
                        <div class="panel-body" style="background-color:#ffe4c4;" align="left">
                            <label>{{$comments[$i]->comment}}</label><br/>
                            <text syle="text-align: right;">Likes->{{$comments[$i]->likes}}</text>
                            <form method="POST" action="{{action('CommentController@like')}}" id="comentarioN">
                                <input type="hidden" name="_method" value="PUT"></input>
                                <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
                                <input type="hidden" name="comment" value="{{ $comments[$i]->id }}"></input>
                                <input type="hidden" name="song" value="{{ $song->id }}"></input>
                                <button type="submit" id="botonL" class="btn btn-default pull-right">Like</button>
                            </form>     

                            @if(Auth::user()->id == $comments[$i]->user_id || Auth::user()->isAdmin)

                                <form method="POST" action="{{action('CommentController@delete')}}" id="comentarioN">
                                    <input type="hidden" name="_method" value="DELETE"></input>
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
                                    <input type="hidden" name="comment" value="{{$comments[$i]->id}}">
                                    <button type="submit" id="botonL" class="btn btn-default pull-right">Eliminar</button>
                                </form>
                                
                                <a href="/song/{{$song->id}}/edit/{{$comments[$i]->id}}" class="btn btn-default pull-right">Editar</a>
                            @endif
                        </div> 
                        
                    </div>

                @endfor
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