@extends('adminlte::page')

@section('content')

{{-- Error messages --}}
        @if (count($errors) > 0)
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <i class="icon fa fa-ban"></i>
                    <strong>Error:    </strong> {{$error}}
                </div>
            @endforeach
        @endif
        @if (Session::has('msg'))
        <div class="alert alert-danger"> {{ Session::get('msg') }}</div>
        @endif
        @if (Session::has('mess'))
        <div class="alert alert-danger">{{ Session::get('mess') }}</div>
        @endif

<div class="box box-primary">
    <div class="box-header with-border" style="background: #e0ecff;" align="center">
        <h2 class="box-title with-border">Mi perfil</h2>
        <a class="btn btn-primary pull-right" data-toggle="modal" data-target="#edit_user">Editar perfil</a>
    </div>
    <div class="box-body" style="background: #e0ecff;">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Nick:</label>
                    <text>{{$user->nick}}</text>
                </div>
                @if(Session::has('error_nick'))
                    <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <i class="icon fa fa-ban"></i>
                        <strong>Error:    </strong> {{Session::get('error_nick')}}
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
                        <i class="icon fa fa-ban"></i>
                        <strong>Error:    </strong> {{Session::get('error_email')}}
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
    <div class="box-footer" style="background: #e0ecff;">
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
    <div class="box-header with-border" align="center" style="background: #e0ffe5;">
        <h2 class="box-title with-border">Mis canciones</h2>
        <a class="btn btn-primary pull-right" data-toggle="modal" data-target="#upload_song">Subir canción</a>
    </div>
    <div class="box-body" style="background: #e0ffe5;">
        @if(sizeof($songs)>0)
            <div class="row" align="center">
                <form method="POST" action="{{action('UsersController@search')}}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
                    <div class="input-group" style="width: 30%">
                        <select class="form-control select2" name="filtro" >
                            @foreach($filters as $filter)
                                @if($filter == Session::get('filtro'))
                                    <option selected="selected" value="{{$filter}}">{{$filter}}</option>
                                @endif
                            @endforeach
                            @foreach($filters as $filter)
                                @if($filter != Session::get('filtro'))
                                    <option value="{{$filter}}">{{$filter}}</option>
                                @endif
                            @endforeach  
                        </select>
                        <div class="input-group-btn">
                            <button type="submit" class="btn btn-primary">Filtrar</button>
                        </div>
                    </div> 
                    <br/>
                    <br/>
                </form>
            </div>
        @endif
        @forelse($songs as $song)
            <div class="box box-primary">
                <div class="box-header with-border" style="background: #e0ecff;" align="center">
                    <h2 class="box-title with-border">{{$song->title}}</h2>
                </div>
                <div class="box-body" style="background: #e0ecff;">
                    <div class="col-md-5">
                        <iframe width="250" height="200" align="center" src = {{$song->url}}  allowfullscreen></iframe><br/>
                    </div>
                    <div class="col-md-5">
                        <label>Artista: </label><text> {{$song->artist}} </text><br/>
                        <label>Fecha: </label><text> {{$song->date}}</text><br/><br/>
                        <a href="/song/{{$song->id}}" class="btn btn-primary" style="padding-top: 5px;">Ver más</a>
                    </div>
                </div>
                <div class="box-footer" style="background: #e0ecff;">
                    <a class="btn btn-primary pull-right" data-toggle="modal" data-target="#delete_song{{$song->id}}">Eliminar</a>
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

                    <a class="btn btn-primary pull-right" data-toggle="modal" data-target="#edit_song{{$song->id}}">Editar</a>
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
                                                        <select class="form-control select2" id="type_id" name="type_id">
                                                            @foreach($types as $t)
                                                                @if($t->id == $song->type_id)
                                                                    <option selected="selected" value="{{$t->id}}">{{$t->type}}</option>
                                                                @endif
                                                            @endforeach
                                                            @foreach($types as $t)
                                                                @if($t->id != $song->type_id)
                                                                    <option value="{{$t->id}}">{{$t->type}}</option>
                                                                @endif
                                                            @endforeach
                                                        </select>
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
                                                    <label>Fecha de salida</label> <text>(YYYY/MM/DD)</text></br>
                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-calendar"></i>
                                                        </div>
                                                        <input id="date" name="date" type="date" class="form-control" data-inputmask="'alias': 'YYYY/MM/DD'" data-mask="" placeholder="{{$song->date}}">
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
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-user"></i>
                                    </div>
                                    <input id="nick" name="nick" type="text" class="form-control" placeholder="{{$user->nick}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Nombre</label></br>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-font"></i>
                                    </div>
                                    <input id="name" name="name" type="text" class="form-control" placeholder="{{$user->name}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Email</label></br>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-envelope"></i>
                                    </div>
                                    <input id="email" name="email" type="email" class="form-control" placeholder="{{$user->email}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Género</label></br>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-transgender"></i>
                                    </div>
                                    <select class="form-control select2" id="gender" name="gender">
                                        @foreach($generos as $g)
                                            @if($user->gender == $g)
                                                <option selected="selected" value="{{$g}}">{{$g}}</option>
                                            @endif
                                        @endforeach
                                        @foreach($generos as $g)
                                            @if($user->gender != $g)
                                                <option value="{{$g}}">{{$g}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Estado</label></br>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-info"></i>
                                    </div>
                                    <input id="status" name="status" type="text" class="form-control" placeholder="{{$user->status}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Preferencias</label></br>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-thumbs-up"></i>
                                    </div>
                                    <input id="preferences" name="preferences" type="text" class="form-control" placeholder="{{$user->status}}">
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
                                    <input id="title" name="title" type="text" class="form-control" placeholder="Título">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Artista</label></br>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-user"></i>
                                    </div>
                                    <input id="artist" name="artist" type="text" class="form-control" placeholder="Artista">
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
                                    <select class="form-control select2" id="gender" name="gender">
                                        @foreach($types as $t)
                                            <option>{{$t->type}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Álbum</label></br>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-book"></i>
                                    </div>
                                    <input id="album" name="album" type="text" class="form-control" placeholder="Álbum">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Fecha de salida</label><text> (YYYY/MM/DD)</text></br>
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
