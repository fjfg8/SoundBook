@extends('adminlte::page')

@section('content')

<div class="raw" id="admin">
    <div class="container" id="misCanciones" align="center">
        <div class="panel panel-default">
            <div class="panel-body" align="center" style="background-color:#c4deff;">
                  <form method="POST" action="{{action('SearchController@search')}}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
                    <div class="input-group">
                        <input type="text" name="busqueda" class="form-control" placeholder="Introduzca la búsqueda"></input>
                        <div class="input-group-btn">
                            <button type="submit" class="btn btn-primary">Buscar</button>
                        </div>
                        <select name="filtro">
                            <option value="cancion">Cancion</option> 
                            <option value="usuario">Usuario</option>    
                        </select>
                    </div>   
                </form>  
            </div>
        </div>

        <div class"panel panel-default">

                @if(sizeof($busqueda)==0)
                <div class="alert alert-info">
                        <strong>No se ha encontrado nada</strong>
                    </div>
                @endif
                @for($i=0;$i<sizeof($busqueda);$i++)

                    @if($filtro=="cancion")
                    <div class="panel panel-default">
                        <div class="panel-heading" style="background-color:#ef8300;color:#000000;">{{$busqueda[$i]->title}}</div>
                        <div class="panel-body" align="left" style="background-color:#ffe4c4;">
                            <label>Artista: {{$busqueda[$i]->artist}} </label><br/>
                            <label>Duracion: {{$busqueda[$i]->duration}}</label>
                            <label> | Fecha: {{$busqueda[$i]->date}}</label>
                            <a href="/song/{{$s->id}}" class="btn btn-default pull-right" style="padding-top: 5px;">Ver más</a>
                        </div>  
                    </div>
                    @endif
                    @if($filtro=="usuario")
                    <div class="panel panel-default">
                        <div class="panel-body" align="left" style="background-color:#ffe4c4;">
                            <label>Nick: {{$busqueda[$i]->nick}} </label><br/>
                            @if($followers[$i]==1)
                            <form method="POST" action="{{action('UsersController@unfollow')}}">
                            <input type="hidden" name="_method" value="DELETE"></input>
                            <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
                            <input type="hidden" name="user" value="{{ $busqueda[$i]->id }}"></input>
                                <button class="btn btn-default pull-right" type="submit">Unfollow</button>
                            </form>
                            @endif
                            @if($followers[$i]==0)
                            <form method="POST" action="{{action('UsersController@follow')}}">
                            <input type="hidden" name="_method" value="PUT"></input>
                            <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
                            <input type="hidden" name="user" value="{{ $busqueda[$i]->id }}"></input>
                                <button class="btn btn-default pull-right" type="submit">Follow</button>
                            </form>
                            @endif
                            
                        </div>  
                    </div>
                    @endif
                    
                @endfor

        </div>
    </div>
</div>
@stop