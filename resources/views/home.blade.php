@extends('adminlte::page')

@section('content')
<div class="container" id="perfil" align="center">
    <form method="POST" action="{{action('UsersController@edit')}}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
        <input type="hidden" name="_method" value="PUT"></input>
        <div class="panel panel-default" style="width:30%;text-align:center;">
            <div class="panel-heading" style="background-color:#3c8dbc;color:#FFFFFF;">
                <h3 class="panel-title" >Perfil</h3>
            </div>
            <div class="panel-body" style="background-color:#c4deff;" align="left">
                <div class="form-group">
                    <label class="control-label col-sm-6">Nombre:</label>
                    <label class="control-label col-sm-3">{{$user->name}}</label>
                    <br/>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-6">Nick:</label>
                    <label class="control-label col-sm-3">{{$user->nick}}</label>
                    <br/>
                </div>
                @if(Session::has('error_nick'))
                    <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong>Error</strong> {{Session::get('error_nick')}}
                    </div>
                @endif
                <div class="form-group">
                    <label class="control-label col-sm-6">Email:</label>
                    <label class="control-label col-sm-3">{{$user->email}}</label>
                    <br/>
                </div>
                @if(Session::has('error_email'))
                    <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong>Error</strong> {{Session::get('error_email')}}
                    </div>
                @endif
                <div class="form-group">
                    <label class="control-label col-sm-6">Genero:</label>
                    <label class="control-label col-sm-3">{{$user->gender}}</label>
                    <br/>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-6">Estado:</label>
                    <label class="control-label col-sm-3">{{$user->status}}</label>
                    <br/>
                </div>
                <div class="form-group" >
                    <label class="control-label col-sm-6">Preferencias:</label>
                    <label class="control-label col-sm-3">{{$user->preferences}}</label>
                    <br/>
                </div>  
                <div class="form-group">
                    <label class="control-label col-sm-6"><a href="/home/follow">Seguidos:</a></label>
                    <label class="control-label col-sm-3">{{$follow}}</label>
                    <br/> 
                    <label class="control-label col-sm-6"><a href="/home/followers">Seguidores:</a></label>
                    <label class="control-label col-sm-3">{{$followers}}</label>
                </div>  
                <div class="form-group" align="center">        
                    <div class="col-sm-12">
                        <a class="btn btn-default" data-toggle="modal" data-target="#edit_user">Editar</a>
                    </div>
                </div>
            </div><!-- /.box-body -->
        </div>
        <br/>
        <div class="panel panel-default" style="width:50%;text-align:center;margin:0 auto;">
            <div class="panel-heading" style="background-color:#3c8dbc;color:#FFFFFF;">
                <h3 class="panel-title" >Subir una cancion</h3>
            </div>
            <div class="panel-body" style="background-color:#c4deff;" align="center">
                <div class="form-group" align="center">
                    <a href="/upload"><img width="30" height="30" src="http://icon-icons.com/icons2/1132/PNG/512/1486348532-music-play-pause-control-go-arrow_80458.png">Subir canción</img></a>
                </div>
            </div>
        </div>
        <br/>
    </form>
</div>
<div class="modal fade" id="edit_user">
    <br/>
    <form method="POST" action="{{action('UsersController@edit')}}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
        <input type="hidden" name="_method" value="PUT"></input>
        <input type="hidden" name="id" value="{{$user->id}}">
        <div class="panel panel-default" style="width:50%;text-align:center;margin:0 auto;">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <div class="panel-heading" style="background-color:#3c8dbc;color:#FFFFFF;">
                <h3 class="panel-title" >Perfil</h3>
            </div>
            <div class="panel-body" style="background-color:#c4deff;" align="center">
                <div class="form-group">
                    <label class="control-label col-sm-2">Nick</label>
                    <div class="col-md-10">
                        <input type="text" name="nick" id="nick" placeholder="{{$user->nick}}">
                    </div>
                    <br/>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2">Nombre</label>
                    <div class="col-md-10">
                        <input type="text" name="name" id="name" placeholder="{{$user->name}}">
                    </div>
                    <br/>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2">Email</label>
                    <div class="col-md-10">
                        <input type="text" name="email" id="email" placeholder="{{$user->email}}">
                    </div> <br/>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2">Genero</label>
                    <div class="col-md-10">
                        <input type="text" name="gender" id="gender" placeholder="{{$user->gender}}">
                    </div> <br/>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2">Estado</label>
                    <div class="col-md-10">
                        <input type="text" name="status" id="status" placeholder="{{$user->status}}">
                    </div> <br/>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2">Preferencias</label>
                    <div class="col-md-10">
                        <input type="text" name="preferences" id="preferences" placeholder="{{$user->preferences}}">
                    </div><br/>
                    <br/>
                </div>    
                <div class="form-group">        
                    <div class="col-md-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-default">Guardar</button> 
                    </div>
                </div>
            </div><!-- /.box-body -->
        </div>
        <br/>
    </form>
</div>
<div class="container" id="misCanciones" align="center">
    <div class="panel panel-default" >
        <div class="panel-heading" style="background-color:#3c8dbc;color:#000000;">
            <h3 class="panel-title" >Mis Canciones</h3>
            <br/>
            <div class="btn-group">
                <form method="POST" action="{{action('UsersController@search')}}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
                    <select name="filtro">
                        <option value="titulo">Titulo</option> 
                        <option value="fecha">Fecha</option> 
                        <option value="artista">Artista</option>    
                    </select>
                    <button class="btn btn-default" type="submit">Filtrar</button>
                </form>
            </div>
        </div>
        <div class="panel-body" style="background-color:#c4deff;" align="center">
    <br/>
    @forelse($songs as $song)
        <div class="panel panel-default">
            <div class="panel-heading" style="background-color:#ef8300;color:#000000;">{{$song->title}}</div>
            <div class="panel-body" align="left" style="background-color:#ffe4c4;">
                <label>Artista: {{$song->artist}} </label><br/>
                <label>Duracion: {{$song->duration}}</label>
                <label> | Fecha: {{$song->date}}</label>
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
                <a href="/song/{{$song->id}}" class="btn btn-default pull-right" style="padding-top: 5px;">Ver más</a>
            </div>
            <div class="modal fade" id="edit_song{{$song->id}}">
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
        </div>
    @empty
        <div class="alert alert-info">
            <strong>No tienes ninguna canción</strong>
        </div>
    @endforelse
    {{ $songs->links() }}
    </div>


@endsection
