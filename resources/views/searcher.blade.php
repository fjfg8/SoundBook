@extends('adminlte::page')

@section('content')

<div class="raw" id="admin">
    <div class="container" id="misCanciones" align="center">
        <div class="panel panel-default">
            <div class="panel-body" align="center" style="background-color:#c4deff;">
                  <form method="POST" action="{{action('SearchController@search')}}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
                    <input type="text" name="busqueda" placeholder="Introduce lo que quieras buscar"></input>
                    <select name="filtro">
                        <option value="cancion">Cancion</option> 
                        <option value="usuario">Usuario</option>    
                    </select>
                    <button class="btn btn-default" type="submit">Buscar</button>
                </form>  
            </div>
        </div>

        <div class"panel panel-default">
                @forelse($busqueda as $s)
                    @if($filtro=="cancion")
                    <div class="panel panel-default">
                        <div class="panel-heading" style="background-color:#ef8300;color:#000000;">{{$s->title}}</div>
                        <div class="panel-body" align="left" style="background-color:#ffe4c4;">
                            <label>Artista: {{$s->artist}} </label><br/>
                            <label>Duracion: {{$s->duration}}</label>
                            <label> | Fecha: {{$s->date}}</label>
                            <a href="/song/{{$s->id}}" class="btn btn-default pull-right" style="padding-top: 5px;">Ver más</a>
                        </div>  
                    </div>
                    @endif
                    @if($filtro=="usuario")
                    <div class="panel panel-default">
                        <div class="panel-body" align="left" style="background-color:#ffe4c4;">
                            <label>Nick: {{$s->nick}} </label><br/>
                            <form method="POST" action="{{action('UsersController@follow')}}">
                             <input type="hidden" name="_method" value="PUT"></input>
                            <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
                            <input type="hidden" name="user" value="{{ $s->id }}"></input>
                                <button class="btn btn-default" type="submit">Seguir</button>
                            </form>
                        </div>  
                    </div>
                    @endif
                @empty
                    <div class="alert alert-info">
                        <strong>No se ha encontrado nada</strong>
                    </div>
                @endforelse

        </div>
    </div>
</div>
@stop