@extends('master')

@section('content')
<div class="row">
    <div class="col-md-4" id="menuPerfil">Opciones<br/>
        <a href="/pass">Cambiar contraseña</a>
        <a>Cambiar imagen perfil</a>
    </div>
    <!-- -***************************** -->
    <div class="col-md-8" id="perfil">
    <form method="POST" action="{{action('UsersController@edit')}}">
    <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
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
        </div>    
        <div class="form-group">        
            <div class="col-md-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">Guardar</button> 
            </div>
        </div>
    </form>
    </div>
<div class="col-md-6">
        <div class="container" id="misCanciones" align="center">
        <label>Mis Canciones</label><br/>
        @forelse($songs as $song)
            <div class="panel panel-default">
                <div class="panel-heading">{{$song->title}}</div>
                <div class="panel-body" align="left">
                    <label>Artista: {{$song->artist}} </label>  
                    <label> | Album: {{$song->album}}</label><br/>
                    <label>Duracion: {{$song->duration}}</label>
                    <label> | Fecha: {{$song->date}}</label>
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
    </div>
</div>

<div class="row">
    
</div>
@stop