@extends('adminlte::page')

@section('content')

<div class="container" >
    <div class="panel panel-default">
        <div class="panel-heading" style="background-color:#3c8dbc;color:#FFFFFF;">
            <div class="panel-title" >{{$song->title}}</div>
        </div>
        <div class="panel-body" align="left" style="background-color:#c4deff;">
            <iframe width="560" height="315" align="center" src = {{$song->url}}  allowfullscreen></iframe><br/>
            <label>Artista: {{$song->artist}} </label><br/>
            <label>Album: {{$song->album}}</label>
            <label> | Fecha: {{$song->date}}</label>
            @if(Auth::user()->id == $song->user_id || Auth::user()->isAdmin)
                <a class="btn btn-default pull-right" data-toggle="modal" data-target="#delete_song{{$song->id}}">Eliminar</a>
                <div class="modal fade" id="delete_song{{$song->id}}">
                    <form method="POST" action="{{action('SongsController@delete')}}" id="comentarioN">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
                        <input type="hidden" name="_method" value="DELETE"></input>
                        <input type="hidden" name="song" value="{{$song->id}}">
                        <br/>
                        <br/>
                        <br/>
                        <div class="panel panel-default" style="width:50%;text-align:center;margin:0 auto;">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <div class="panel-heading" style="background-color:#3c8dbc;color:#FFFFFF;">
                                <h3 class="panel-title" >¿Estás seguro de borrar la cancion {{$song->title}}?</h3>
                            </div>
                            <div class="panel-body" style="background-color:#c4deff;" align="center">
                                <div class="form-group">        
                                    <button type="submit" class="btn btn-default">Si</button> 
                                    <button type="button" data-dismiss="modal" class="btn btn-default">Cancelar</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <a class="btn btn-default pull-right" data-toggle="modal" data-target="#edit_song{{$song->id}}">Editar</a>
                <div class="modal fade" align="center" id="edit_song{{$song->id}}">
                    <br/>
                    <form method="POST" action="{{action('SongsController@edit')}}" align="center">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
                        <input type="hidden" name="_method" value="PUT"></input>
                        <input type="hidden" name="id" value="{{$song->id}}">
                        <div class="panel panel-default" style="width:40%;">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <div class="panel-heading" style="background-color:#3c8dbc;color:#FFFFFF;">
                                <h3 class="panel-title" >Editar canción</h3>
                            </div>
                            <div class="panel-body" style="background-color:#c4deff;" >
                                <div class="form-group">
                                    <label class="control-label col-sm-4">Titulo</label>
                                    <input type="text" name="title" placeholder="{{$song->title}}">
                                    <br/>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-4">Artista</label>
                                    <input type="text" name="artist" placeholder="{{$song->artist}}">
                                    <br/>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-4">Duracion</label>
                                    <input type="text" name="duration" placeholder="{{$song->duration}}">
                                    <br/>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-4">Url</label>
                                    <input type="text" name="url" placeholder="{{$song->url}}">
                                    <br/>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-4">Fecha de salida</label>
                                    <input type="text" name="date" placeholder="{{$song->date}}">
                                    <br/>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-4">Genero</label>
                                    <input type="text" name="gender" placeholder="{{$song->gender}}">
                                    <br/>
                                </div>
                                <div class="form-group">        
                                    <button type="submit" class="btn btn-default">Guardar</button> 
                                </div>
                            </div><!-- /.box-body -->
                        </div>
                    </form>
                </div>
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