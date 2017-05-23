@extends('adminlte::page')

@section('content')


<div class="row">
    <div class="col-md-2">
    </div>
    <div class="col-md-8">
        <div class="box box-primary">
            <div class="box-header with-border" align="center">
                <a href="/listagrupos" class="btn btn-primary pull-right" style="margin:20px">Mis Grupos</a>
                <h3><strong>Grupos</strong></h3>
                <form method="POST" action="{{action('GroupsController@search')}}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
                    <div class="input-group" style="width: 40%">
                        <select class="form-control select2" name="filtro" >
                            <option selected="selected" value="-1">--Todos--</value>
                            @foreach($types as $t)
                                <option value="{{$t->id}}">{{$t->type}}</option>  
                            @endforeach  
                        </select>
                        <div class="input-group-btn">
                            <button type="submit" class="btn btn-primary btn-search">Filtrar</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="box-body">
                @forelse($all as $one)
                    <div class="box box-primary" >
                        <div class="box-header with-border" style="background: #f4fcff;">
                            <div class="user-block pull-left">
                                <img class="img-circle" src="http://icon-icons.com/icons2/67/PNG/512/group_users_13234.png" alt="Group Image">
                                <span class="username" color="blue"><a href="/groups/{{$one->id}}">{{$one->name}}</a></span>
                            </div>
                            @if(Auth::user()->isAdmin && Auth::user()->id != $one->user_admin_id)
                                <form method="POST" action="{{action('GroupsController@deleteGroup')}}">
                                    <input type="hidden" name="_method" value="DELETE"></input>
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
                                    <input type="hidden" name="group" value="{{ $one->id }}"></input>
                                    <button class="btn btn-danger pull-right" type="submit">Borrar Grupo</button>
                                </form>
                                <span class="pull-right">&nbsp;</span>

                                <a class="btn btn-success pull-right" data-toggle="modal" data-target="#edit_group{{$one->id}}">Editar grupo</a>  
                                <div class="modal modal-default fade" id="edit_group{{$one->id}}">
                                    <form method="POST" action="{{action('GroupsController@edit')}}">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
                                        <input type="hidden" name="_method" value="PUT"></input>
                                        <input type="hidden" name="id" value="{{$one->id}}">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header" align="center">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                    <h4 class="modal-title">Editar grupo: {{$one->name}}</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-2">
                                                        </div>
                                                        <div class="col-md-8">
                                                            <div class="form-group">
                                                                <label>Nombre</label></br>
                                                                <div class="input-group">
                                                                    <div class="input-group-addon">
                                                                        <i class="fa fa-font"></i>
                                                                    </div>
                                                                    <input id="name" name="name" type="text" class="form-control" placeholder="{{$one->name}}">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Estilo</label></br>
                                                                <div class="input-group">
                                                                    <div class="input-group-addon">
                                                                        <i class="fa fa-music"></i>
                                                                    </div>
                                                                    <select class="form-control select2" id="musicStyle" name="musicStyle">
                                                                        @foreach($types as $t)
                                                                            @if($t->id == $one->type_id)
                                                                                <option selected="selected" value="{{$t->id}}">{{$t->type}}</option>
                                                                            @endif
                                                                        @endforeach
                                                                        @foreach($types as $t)
                                                                            @if($t->id != $one->type_id)
                                                                                <option value="{{$t->id}}">{{$t->type}}</option>
                                                                            @endif
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Descripción</label></br>
                                                                <div class="input-group">
                                                                    <div class="input-group-addon">
                                                                        <i class="fa fa-book"></i>
                                                                    </div>
                                                                    <input id="description" name="description" type="text" class="form-control" placeholder="{{$one->description}}">
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
                            @endif
                            @if($groups->find($one->id))
                                @if(Auth::user()->id == $one->user_admin_id)
                                    <form method="POST" action="{{action('GroupsController@deleteGroup')}}">
                                        <input type="hidden" name="_method" value="DELETE"></input>
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
                                        <input type="hidden" name="group" value="{{ $one->id }}"></input>
                                        <button class="btn btn-danger pull-right" type="submit">Borrar Grupo</button>
                                    </form>

                                    <span class="pull-right">&nbsp;</span>

                                    <a class="btn btn-success pull-right" data-toggle="modal" data-target="#edit_group{{$one->id}}">Editar grupo</a>  

                                    <div class="modal modal-default fade" id="edit_group{{$one->id}}">
                                        <form method="POST" action="{{action('GroupsController@edit')}}">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
                                            <input type="hidden" name="_method" value="PUT"></input>
                                            <input type="hidden" name="id" value="{{$one->id}}">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header" align="center">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                        <h4 class="modal-title">Editar grupo: {{$one->name}}</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-2">
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="form-group">
                                                                    <label>Nombre</label></br>
                                                                    <div class="input-group">
                                                                        <div class="input-group-addon">
                                                                            <i class="fa fa-font"></i>
                                                                        </div>
                                                                        <input id="name" name="name" type="text" class="form-control" placeholder="{{$one->name}}">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Estilo</label></br>
                                                                    <div class="input-group">
                                                                        <div class="input-group-addon">
                                                                            <i class="fa fa-music"></i>
                                                                        </div>
                                                                        <select class="form-control select2" id="musicStyle" name="musicStyle">
                                                                            @foreach($types as $t)
                                                                                @if($t->id == $one->type_id)
                                                                                    <option selected="selected" value="{{$t->id}}">{{$t->type}}</option>
                                                                                @endif
                                                                            @endforeach
                                                                            @foreach($types as $t)
                                                                                @if($t->id != $one->type_id)
                                                                                    <option value="{{$t->id}}">{{$t->type}}</option>
                                                                                @endif
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Descripción</label></br>
                                                                    <div class="input-group">
                                                                        <div class="input-group-addon">
                                                                            <i class="fa fa-book"></i>
                                                                        </div>
                                                                        <input id="description" name="description" type="text" class="form-control" placeholder="{{$one->description}}">
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
                                @else
                                    <span class="pull-right">&nbsp;</span>
                                    <form method="POST" action="{{action('GroupsController@CancelSubscribe')}}">
                                        <input type="hidden" name="_method" value="DELETE"></input>
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
                                        <input type="hidden" name="group" value="{{ $one->id }}"></input>
                                        <button class="btn btn-warning pull-right" type="submit">Cancelar Suscripción</button>
                                    </form>
                                @endif
                            @else
                                <span class="pull-right">&nbsp;</span>
                                <form method="POST" action="{{action('GroupsController@subscribe')}}">
                                    <input type="hidden" name="_method" value="PUT"></input>
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
                                    <input type="hidden" name="group" value="{{ $one->id }}"></input>
                                    <button class="btn btn-info pull-right" type="submit">Suscribirse</button>
                                </form>
                            @endif
                            
                        </div>
                        <div class="box-body" style="background: #f4fcff;">
                            @foreach($types as $t)
                                @if($one->type_id == $t->id)
                                    <label>Género: </label>
                                    <text>{{$t->type}}</text></br>
                                @endif
                            @endforeach
                            </br>
                            </br>
                            <text>{{$one->description}}</text>
                        </div>
                        <div class="box-footer" style="background: #f4fcff;">
                            <a href="/groups/{{$one->id}}" class="btn btn-primary pull-right" style="padding: 5px;">Ver más</a>
                        </div>
                    </div>
                @empty
                    <div class="alert alert-info">
                        <strong>No hay grupos creados. Se el primero en crear un grupo</strong>
                    </div>
                @endforelse
            
            <div class="box-footer with-border" align="center">
                {{ $all->links() }}
                <a class="btn btn-success btn-lg pull-right" data-toggle="modal" data-target="#create_group" style="margin:10px">Crear Grupo</a>
            </div>
        </div>
    </div>
</div>

<div class="modal modal-default fade" id="create_group">
    <form method="POST" action="{{action('GroupsController@create')}}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
        <input type="hidden" name="_method" value="PUT"></input>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" align="center">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title">Crear Grupo</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-2">
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label>Nombre</label></br>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-font"></i>
                                    </div>
                                    <input id="name" name="name" type="text" class="form-control" placeholder="Nombre">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Estilo</label></br>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-music"></i>
                                    </div>
                                    <select class="form-control select2" id="musicStyle" name="musicStyle">
                                        @foreach($types as $t)
                                            <option>{{$t->type}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Descripción</label></br>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-book"></i>
                                    </div>
                                    <input id="description" name="description" type="text" class="form-control" placeholder="Descripción">
                                </div>
                            </div>
                        </div>
                    </div>      
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success">Crear</button>
                </div>
            </div>
        </div>
    </form>
</div>


@endsection