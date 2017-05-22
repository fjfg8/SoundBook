@extends('adminlte::page')

@section('content')


<div class="row">
    <div class="col-md-2">
    </div>
    <div class="col-md-8">
        <div class="box box-primary">
            <div class="box-header with-border" align="center">
                <h2 class="box-title with-border">Buscador</h2>
            </div>
            <div class="box-body">
                <div class="row" align="center">
                    <form id="buscador" method="POST" action="{{action('SearchController@search')}}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
                        <div class="input-group" style="width: 50%">
                            <input type="text" name="busqueda" class="form-control" placeholder="Introduzca la búsqueda"></input>
                            <div class="input-group-btn">
                                <select class="form-control select2" style="width: 300%" name="filtro" >
                                    @foreach($filters as $filter)
                                        @if($filter == Session::get('filtroBusqueda'))
                                            <option selected="selected" value="{{$filter}}">{{$filter}}</option>
                                        @endif
                                    @endforeach
                                    @foreach($filters as $filter)
                                        @if($filter != Session::get('filtroBusqueda'))
                                            <option value="{{$filter}}">{{$filter}}</option>
                                        @endif
                                    @endforeach  
                                </select>
                                <button type="submit" class="btn btn-default">
                                    <i class="glyphicon glyphicon-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                </br>
            
                <div class="row" align="center">
                    <div class="col-md-8">
                        <div class"box box-primary">
                            @if(sizeof($busqueda)==0)
                                <div class="alert alert-info">
                                    <strong>No se ha encontrado nada</strong>
                                </div>
                            @endif
                            @for($i=0;$i<sizeof($busqueda);$i++)
                                @if($filtro=="Grupo")
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
                                @if($filtro=="Cancion" || $filtro=="Album")
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
                                @if($filtro=="Usuario")
                                    @if($busqueda[$i]->id != Auth::user()->id)
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
                                @endif
                            @endfor
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop