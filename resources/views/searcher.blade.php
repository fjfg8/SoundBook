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
                        <div class="input-group" style="width: 70%">
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

                @if(sizeof($busqueda)==0 || (sizeof($busqueda)==1 && $filtro=="Usuario" && $busqueda[0]->id == Auth::user()->id))
                    <div class="alert alert-info">
                        <strong>No se ha encontrado nada</strong>
                    </div>
                @endif
                
                @for($i=0;$i<sizeof($busqueda);$i++)
                    @if($filtro == "Grupo")
                        <div class="box box-primary" >
                            <div class="box-header with-border" style="background: #f4fcff;">
                                <div class="user-block">
                                    <img class="img-circle" src="http://icon-icons.com/icons2/67/PNG/512/group_users_13234.png" alt="Group Image">
                                    <span class="username" color="blue"><a href="/groups/{{$busqueda[$i]->id}}">{{$busqueda[$i]->name}}</a></span>
                                </div>
                            </div>
                            <div class="box-body" style="background: #f4fcff;">
                                <label>Género:</label> 
                                <text>{{$type[$i]->type}}</text>
                                </br>
                                </br>
                                <text>{{$busqueda[$i]->description}}</text>
                            </div>
                            <div class="box-footer" style="background: #f4fcff;">
                                <a href="/groups/{{$busqueda[$i]->id}}" class="btn btn-primary pull-right" style="padding-top: 5px;">Ver más</a>
                            </div>
                        </div>
                    @endif
                    @if($filtro=="Cancion" || $filtro=="Album")
                        <div class="box box-primary">
                            <div class="box-header with-border" style="background: #f4fcff;">
                                <span class="text-muted pull-right">{{$busqueda[$i]->created_at}}</span>
                                <div class="user-block">
                                    <img class="img-circle" src="{{$users[$i]->image}}" alt="User Image">
                                    @if(Auth::user()->id == $users[$i]->id)
                                        <span class="description"><a href="/home">{{$users[$i]->name}}</a></span>
                                    @else
                                        <span class="description"><a href="visit/{{$users[$i]->id}}">{{$users[$i]->name}}</a></span>
                                    @endif
                                    <span class="username"><a href="/song/{{$busqueda[$i]->id}}">{{$busqueda[$i]->title}}</span>
                                </div>
                            </div>
                            <div class="box-body" style="background: #f4fcff;">
                                <div class="col-md-6" align="center">
                                    <div class="embed-responsive embed-responsive-16by9">
                                        <iframe class="embed-responsive-item" src="{{$busqueda[$i]->url}}" allowfullscreen></iframe><br/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label>Título: {{$busqueda[$i]->title}} </label><br/>
                                    <label>Artista: {{$busqueda[$i]->artist}} </label><br/>
                                    <label>Género: {{$type[$i]->type}}</label>
                                </div>
                            </div>
                            <div class="box-footer" style="background: #f4fcff;">
                                <a href="/song/{{$busqueda[$i]->id}}" class="btn btn-primary pull-right" style="padding-top: 5px;">Ver más</a>
                            </div>
                        </div>
                    @endif
                    @if($filtro=="Usuario")
                        @if($busqueda[$i]->id != Auth::user()->id)
                            <div class="box box-primary">
                                <div class="box-header with-border" style="background: #f4fcff;">
                                    <div class="user-block">
                                        <img class="img-circle" src="http://www.icon2s.com/img128/128x128-black-white-android-user.png" alt="User Image">
                                        <span class="username" color="blue"><a href="/visit/{{$busqueda[$i]->id}}">{{$busqueda[$i]->name}}</a></span>
                                    </div>
                                </div>
                                <div class="box-body" style="background: #f4fcff;">
                                    <div class="col-md-6">
                                        <img src="{{$busqueda[$i]->image}}" width="200" height="200"></img>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Nombre: </label>
                                        <text> {{$busqueda[$i]->name}}</text></br>
                                        <label>Nick: </label>
                                        <text> {{$busqueda[$i]->nick}}</text></br>
                                        <label>Género: </label>
                                        <text>{{$busqueda[$i]->gender}}</text></br>
                                        <label>Preferencias: </label>
                                        <text> {{$busqueda[$i]->preferences}}</text>
                                    </div>
                                </div>
                                <div class="box-footer" style="background: #f4fcff;">
                                    <a href="/visit/{{$busqueda[$i]->id}}" class="btn btn-primary pull-right">Ver más</a>
                                </div>
                            </div> 
                        @endif
                    @endif
                @endfor
            </div>
        </div>
    </div>
</div>
@stop