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
                <div class="form-group">
                    <label class="control-label col-sm-6">Email:</label>
                    <label class="control-label col-sm-3">{{$user->email}}</label>
                    <br/>
                </div>

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
                    <label class="control-label col-sm-6">Seguidos:</label>
                    <label class="control-label col-sm-3">{{$follow}}</label>
                    <br/> 
                    <label class="control-label col-sm-6">Seguidores:</label>
                    <label class="control-label col-sm-3">{{$followers}}</label>
                </div>  
                <div class="form-group" align="center">        
                    <div class="col-sm-12">
                        <a href="/user/{{$user->id}}/edit" class="btn btn-default">Editar</a>
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
                <form method="POST" action="{{action('SongsController@delete')}}" id="comentarioN">
                    <input type="hidden" name="_method" value="DELETE"></input>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
                    <input type="hidden" name="song" value="{{$song->id}}">
                    <button type="submit" id="botonL" class="btn btn-default pull-right">Eliminar</button>
                </form>
                <a href="/song/{{$song->id}}/change" class="btn btn-default pull-right">Editar</a>
                <a href="/song/{{$song->id}}" class="btn btn-default pull-right" style="padding-top: 5px;">Ver más</a>
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
