@extends('adminlte::page')

@section('content')

{{-- Error messages --}}
        @if (count($errors) > 0)
            <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
            </ul>
        @endif
        @if (Session::has('msg'))
        <div class="alert alert-info">{{ Session::get('msg') }}</div>
        @endif
        @if (Session::has('mess'))
        <div class="alert alert-info">{{ Session::get('mess') }}</div>
        @endif

<div class="box box-primary">
    <div class="box-header with-border" align="center">
        <h2 class="box-title with-border">Mi perfil</h2>
        <a class="btn btn-default pull-right" data-toggle="modal" data-target="#edit_user">Editar perfil</a>
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Nick:</label>
                    <text>{{$user->nick}}</text>
                </div>
                @if(Session::has('error_nick'))
                    <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong>Error</strong> {{Session::get('error_nick')}}
                    </div>
                @endif
                <div class="form-group">
                    <label>Nombre:</label>
                    <text>{{$user->name}}</text>
                </div>
                <div class="form-group">
                    <label>Email:</label>
                    <text>{{$user->email}}</text>
                </div>
                @if(Session::has('error_email'))
                    <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong>Error</strong> {{Session::get('error_email')}}
                    </div>
                @endif
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Genero:</label>
                    <text>{{$user->gender}}</text>
                </div>
                <div class="form-group">
                    <label>Estado:</label>
                    <text>{{$user->status}}</text>
                </div>
                <div class="form-group" >
                    <label>Preferencias:</label>
                    <text>{{$user->preferences}}</text>
                </div>
            </div>
        </div>
    </div>
    <div class="box-footer">
        <div class="col-md-6">
            <div class="form-group">
                <label><a href="/home/follow">Seguidos:</a></label>
                <text>{{$follow}}</text>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label><a href="/home/followers">Seguidores:</a></label>
                <text>{{$followers}}</text>
            </div>
        </div>
    </div>
</div>

<div class="box box-success">
    <div class="box-header with-border" align="center">
        <h2 class="box-title with-border">Mis canciones</h2>
        <a class="btn btn-default pull-right" data-toggle="modal" data-target="#upload_song">Subir canción</a>
    </div>
    <div class="box-body">
        @if(sizeof($songs)>0)
            <div class="row" align="center">
                <form method="POST" action="{{action('UsersController@search')}}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
                    <select name="filtro">
                        <option value="titulo">Titulo</option> 
                        <option value="fecha">Fecha</option> 
                        <option value="artista">Artista</option>    
                    </select>
                    <button class="btn btn-default" type="submit">Filtrar</button>
                    <br/>
                    <br/>
                </form>
            </div>
        @endif
        @forelse($songs as $song)
            <div class="box box-primary">
                <div class="box-header with-border" align="center">
                    <h2 class="box-title with-border">{{$song->title}}</h2>
                </div>
                <div class="box-body">
                    <div class="col-md-5">
                        <iframe width="250" height="200" align="center" src = {{$song->url}}  allowfullscreen></iframe><br/>
                    </div>
                    <div class="col-md-5">
                        <label>Artista: </label><text> {{$song->artist}} </text><br/>
                        <label>Fecha: </label><text> {{$song->date}}</text><br/><br/>
                        <a href="/song/{{$song->id}}" class="btn btn-primary" style="padding-top: 5px;">Ver más</a>
                    </div>
                </div>
                <div class="box-footer">
                    <a class="btn btn-default pull-right" data-toggle="modal" data-target="#delete_song{{$song->id}}">Eliminar</a>
                    <div class="modal modal-danger fade" id="delete_song{{$song->id}}">
                        <form method="POST" action="{{action('SongsController@delete')}}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
                            <input type="hidden" name="_method" value="DELETE"></input>
                            <input type="hidden" name="song" value="{{$song->id}}">
                            <div class="modal-dialog" align="center">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                        <h4 class="modal-title">¿Estás seguro de borrar la cancion {{$song->title}}?</h4>
                                    </div>
                                    <div class="modal-body">
                                        <p>No podrás deshacer la acción</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cancelar</button>
                                        <button type="submit" class="btn btn-outline">Si</button>
                                    </div>
                                </div>
                            </div>
                        </form>                            
                    </div>

                    <a class="btn btn-default pull-right" data-toggle="modal" data-target="#edit_song{{$song->id}}">Editar</a>
                    <div class="modal modal-default fade" id="edit_song{{$song->id}}">
                        <form method="POST" action="{{action('SongsController@edit')}}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
                            <input type="hidden" name="_method" value="PUT"></input>
                            <input type="hidden" name="id" value="{{$song->id}}">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header" align="center">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                        <h4 class="modal-title">Editar canción: {{$song->title}}</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Título</label></br>
                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-font"></i>
                                                        </div>
                                                        <input id="title" name="title" type="text" class="form-control" placeholder="{{$song->title}}">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Artista</label></br>
                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-user"></i>
                                                        </div>
                                                        <input id="artist" name="artist" type="text" class="form-control" placeholder="{{$song->artist}}">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Url</label></br>
                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-globe"></i>
                                                        </div>
                                                        <input id="url" name="url" type="text" class="form-control" placeholder="{{$song->url}}">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Género</label></br>
                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-music"></i>
                                                        </div>
                                                        <input id="gender" name="gender" type="text" class="form-control" placeholder="{{$song->gender}}">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Álbum</label></br>
                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-book"></i>
                                                        </div>
                                                        <input id="album" name="album" type="text" class="form-control" placeholder="{{$song->album}}">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Fecha de salida</label></br>
                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-calendar"></i>
                                                        </div>
                                                        <input id="date" name="date" type="date" class="form-control" data-inputmask="'alias': 'YYYY/MM/DD'" data-mask="" placeholder="YYYY/MM/DD">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>      
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
                                        <button type="submit" class="btn btn-primary">Guardar cambios</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="alert alert-info">
                <strong>No tienes ninguna canción</strong>
            </div>
        @endforelse
        {{ $songs->links() }}
    </div>
    <div class="box-footer">

    </div>
</div>

<div class="modal modal-default fade" id="edit_user">
    <form method="POST" action="{{action('UsersController@edit')}}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
        <input type="hidden" name="_method" value="PUT"></input>
        <input type="hidden" name="id" value="{{$user->id}}">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" align="center">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title">Editar perfil: {{$user->nick}}</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nick</label></br>
                                <input type="text" id="nick" name="nick" placeholder="{{$user->nick}}" size="50">
                            </div>
                            <div class="form-group">
                                <label>Nombre</label></br>
                                <input type="text" id="name" name="name" placeholder="{{$user->name}}" size="50">
                            </div>
                            <div class="form-group">
                                <label>Email</label></br>
                                <input type="text" id="email" name="email" placeholder="{{$user->email}}" size="50">
                            </div>
                            <div class="form-group">
                                <label>Género</label></br>
                                <select id="gender" name="gender">
                                    <option value="chico">Chico</option> 
                                    <option value="chica">Chica</option>   
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Estado</label></br>
                                <input type="text" id="status" name="status" placeholder="{{$user->status}}" size="50">
                            </div>
                            <div class="form-group">
                                <label>Preferencias</label></br>
                                <input type="text" id="preferences" name="preferences" placeholder="{{$user->preferences}}" size="50">
                            </div>
                        </div>
                    </div>      
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar cambios</button>
                </div>
            </div>
        </div>
    </form>
</div>

<div class="modal modal-default fade" id="upload_song">
    <form method="POST" action="{{action('SongsController@create')}}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
        <input type="hidden" name="user" value="{{$user->id}}"></input>
        <input type="hidden" name="_method" value="PUT"></input>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" align="center">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title">Subir nueva canción</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Título</label></br>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-font"></i>
                                    </div>
                                    <input id="title" name="title" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Artista</label></br>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-user"></i>
                                    </div>
                                    <input id="artist" name="artist" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Url</label></br>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-globe"></i>
                                    </div>
                                    <input id="url" name="url" type="text" class="form-control" placeholder="http://www.youtube.com/...">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Género</label></br>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-music"></i>
                                    </div>
                                    <input id="gender" name="gender" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Álbum</label></br>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-book"></i>
                                    </div>
                                    <input id="album" name="album" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Fecha de salida</label></br>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input id="date" name="date" type="date" class="form-control" data-inputmask="'alias': 'YYYY/MM/DD'" data-mask="" placeholder="YYYY/MM/DD">
                                </div>
                            </div>
                        </div>
                    </div>      
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Subir</button>
                </div>
            </div>
        </div>
    </form>
</div>

@endsection
