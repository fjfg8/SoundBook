@extends('adminlte::page')

@section('content')

<div class="row" id="admin">
    <div class="col-md-2"></div>
    <div class="col-md-8"align="center">
        <div class="row">
            <div class="col-md-8">
                <form  id="buscador" method="POST" action="{{action('SearchController@search')}}">
                    <div class="input-group">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
                        <input type="text" name="busqueda" class="form-control" placeholder="Introduzca la búsqueda"></input>
                        <div class="input-group-btn">
                            <button type="submit" class="btn btn-default">
                                <i class="glyphicon glyphicon-search"></i>
                            </button>
                        </div>
                    </div>
                </form>  
            </div>
            <div class="col-md-2">
                <select form="buscador" class="styled-select" name="filtro">
                    <option value="cancion">Canción</option> 
                    <option value="usuario">Usuario</option>  
                    <option value="album">Album</option>  
                    <option value="grupo">Grupo</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <div class"box box-primary">
                        @if(sizeof($busqueda)==0)
                        <div class="alert alert-info">
                                <strong>No se ha encontrado nada</strong>
                            </div>
                        @endif
                        @for($i=0;$i<sizeof($busqueda);$i++)

                            @if($filtro=="grupo")
                            <div class="box-body" style="background-color:#ffe4c4;">
                                <div class="col-md-4" align="center">
                                    <img class="img-circle" width="50" height="50" src="http://icon-icons.com/icons2/67/PNG/512/group_users_13234.png">
                                    <h3>{{$busqueda[$i]->name}} </h3>
                                </div>
                                <div class="col-md-6">
                                    <p>{{$busqueda[$i]->description}}</p></br>
                                    <label>{{$type[$i]->type}}</label>
                                     <a href="/groups/{{$busqueda[$i]->id}}" class="btn btn-primary pull-right" style="padding-top: 5px;">Ver más</a>
                                </div>
                                  
                            </div>
                            @endif
                            @if($filtro=="cancion" || $filtro=="album")
                            <div class="box-body" style="background-color:#ffe4c4;">
                        
                                <div class="col-md-2" align="center">
                                    <img src="{{$users[$i]->image}}" width="100" height="100"></img>
                                    <h3>{{$users[$i]->nick}}</h3>
                                </div>
                                <div class="col-md-8">
                                    <h2 class="box-title with-border">{{$busqueda[$i]->title}}</h2>
                                    <label>Artista: {{$busqueda[$i]->artist}} </label><br/>
                                    <label>Album: {{$busqueda[$i]->album}}</label></br>
                                    <label>Genero: {{$type[$i]->type}}</label>
                                </div>
                                <a href="/song/{{$busqueda[$i]->id}}" class="btn btn-primary pull-right" style="padding-top: 5px;">Ver más</a>
                            
                            </div>
                            @endif
                            @if($filtro=="usuario")
                            <div class="box-body" style="background-color:#ffe4c4;">
                                <div class="col-md-2" align="center">
                                    <img src="{{$busqueda[$i]->image}}" width="100" height="100"></img>
                                    <h3>{{$busqueda[$i]->nick}} </h3>
                                </div>
                                <div class="col-md-8">
                                    @if($followers[$i]==1)
                                        <form method="POST" action="{{action('UsersController@unfollow')}}">
                                        <input type="hidden" name="_method" value="DELETE"></input>
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
                                        <input type="hidden" name="user" value="{{ $busqueda[$i]->id }}"></input>
                                            <button class="btn btn-primary pull-right" type="submit">Unfollow</button>
                                        </form>
                                    @endif
                                    @if($followers[$i]==0)
                                        <form method="POST" action="{{action('UsersController@follow')}}">
                                        <input type="hidden" name="_method" value="PUT"></input>
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
                                        <input type="hidden" name="user" value="{{ $busqueda[$i]->id }}"></input>
                                            <button class="btn btn-primary pull-right" type="submit">Follow</button>
                                        </form>
                                    @endif
                                    <a href="/visit/{{$busqueda[$i]->id}}" class="btn btn-primary pull-right" style="padding-top: 5px;">Ver más</a>
                                </div>
                                  
                            </div>
                            @endif
                            
                        @endfor

                </div>
            </div>
        </div>
    </div>
</div>
@stop