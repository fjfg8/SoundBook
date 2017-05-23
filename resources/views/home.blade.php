@extends('adminlte::page')

@section('content')

{{-- Error messages --}}
@if (count($errors) > 0)
    @foreach ($errors->all() as $error)
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <i class="icon fa fa-ban"></i>
            <strong>Error: </strong> {{$error}}
        </div>
    @endforeach
@endif
@if (Session::has('msg'))
    <div class="alert alert-danger"> {{ Session::get('msg') }}</div>
@endif
@if (Session::has('mess'))
    <div class="alert alert-danger">{{ Session::get('mess') }}</div>
@endif

<div class="row">
    <div class="col-md-2">
    </div>
    <div class="col-md-8">
        <div class="box box-widget widget-user">
            <div class="widget-user-header bg-aqua-active">
                <a class="btn btn-warning pull-right" data-toggle="modal" data-target="#edit_user">Editar perfil</a>  
                <h2 class="widget-user-desc">{{$user->nick}}</h2>
                <a href="#perfil" class="btn btn-primary pull-right" data-toggle="collapse">Mostrar detalles</a>
                <h4 class="widget-user-name">{{$user->name}} </h4>
                
            </div>
            <a href="/changeImage">
                <div class="widget-user-image">
                    <img class="img-circle" src="{{url($user->image)}}" alt="UserAvatar">
                </div>
            </a>
            <div class="box-footer">
                <div class="row" align="center">
                    <div class="col-md-4 border-right">
                        <div class="description-block">
                            <h5 class="description-header">{{sizeof($songs)}}</h5>
                            <span class="description-text">Canciones</span>
                        </div>
                    </div>
                    <div class="col-md-4 border-right">
                        <div class="description-block">
                            <h5 class="description-header">{{$followers}}</h5>
                            <span class="description-text"><a href="/home/followers">Seguidores</a></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="description-block">
                            <h5 class="description-header">{{$follow}}</h5>
                            <span class="description-text"><a href="/home/follow">Siguiendo</a></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box-footer collapse" id="perfil" align="center">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Nick:</label>
                        <text>{{$user->nick}}</text>
                    </div>
                    <div class="form-group">
                        <label>Estado:</label>
                        <text>{{$user->status}}</text>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Nombre:</label>
                        <text>{{$user->name}}</text>
                    </div>
                    <div class="form-group">
                        <label>Email:</label>
                        <text>{{$user->email}}</text>
                    </div>
                    
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Genero:</label>
                        <text>{{$user->gender}}</text>
                    </div>
                    <div class="form-group" >
                        <label>Preferencias:</label>
                        <text>{{$user->preferences}}</text>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
    </div>
</div>

<div class="row">
    <div class="col-md-2">
    </div>
    <div class="col-md-8">
        <div class="box box-primary">
            <div class="box-header with-border" align="center">
                <h2 class="box-title with-border">Mis canciones</h2>
                <a class="btn btn-success pull-right" data-toggle="modal" data-target="#upload_song">Subir canción</a>
            </div>
            <div class="box-body">
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
                        <div class="box-header with-border" style="background: #f4fcff;">
                        <span class="text-muted pull-right">{{$song->created_at}}</span>
                            <div class="user-block">
                                <img class="img-circle" src="http://icon-icons.com/icons2/663/PNG/512/note_icon-icons.com_60189.png" alt="Song Image">
                                <span class="description" color="blue"><a href="/song/{{$song->id}}">{{$song->title}}</a></span>
                                <span class="username">{{$song->artist}}</span>
                            </div>
                            
                        </div>
                        <div class="box-body" style="background: #f4fcff;">
                            <div class="col-md-6" align="center">
                                <div class="embed-responsive embed-responsive-16by9">
                                    <iframe class="embed-responsive-item" src="{{$song->url}}" allowfullscreen></iframe><br/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label>Artista: {{$song->artist}} </label><br/>
                                <label>Fecha: {{$song->date}}</label></br>
                                <label>Género: </label>
                                @foreach($types as $t)
                                    @if($t->id == $song->type_id)
                                        <label>{{$t->type}} </label><br/>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                        <div class="box-footer" style="background: #f4fcff;">
                            <a class="btn btn-warning btn-sm pull-left" data-toggle="modal" data-target="#edit_song{{$song->id}}">Editar</a>
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
                                                    <div class="col-md-2">
                                                    </div>
                                                    <div class="col-md-8">
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

                            <span class="pull-left">&nbsp;</span>

                            <a href="/song/{{$song->id}}" class="btn btn-primary pull-right" style="padding-top: 5px;">Ver más</a>
                            <a class="btn btn-danger btn-sm pull-left" data-toggle="modal" data-target="#delete_song{{$song->id}}">Eliminar</a>
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
                        <div class="col-md-2">
                        </div>
                        <div class="col-md-8">
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
                                <label>Estado civil</label></br>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-info"></i>
                                    </div>
                                    <select class="form-control select2" id="status" name="status">
                                        @foreach($estados as $s)
                                            @if($user->status == $s)
                                                <option selected="selected" value="{{$s}}">{{$s}}</option>
                                            @endif
                                        @endforeach
                                        @foreach($estados as $s)
                                            @if($user->status != $s)
                                                <option value="{{$s}}">{{$s}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Preferencias</label></br>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-thumbs-up"></i>
                                    </div>
                                    <input id="preferences" name="preferences" type="text" class="form-control" placeholder="{{$user->preferences}}">
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
                        <div class="col-md-2">
                        </div>
                        <div class="col-md-8">
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
