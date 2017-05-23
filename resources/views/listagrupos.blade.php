@extends('adminlte::page')

@section('content')

<div class="row">
    <div class="col-md-2">
    </div>
    <div class="col-md-8">
    <div class="box box-primary">
        <div class="box-header with-border" align="center">
            <a href="/allGroups" class="btn btn-primary pull-right" style="margin:20px">Ver todos</a>
            <h3><strong>Mis Grupos</strong></h3>
        </div>
        <div class="box-body">
            @forelse($lista as $group)
                <div class="box box-primary" >
                    <div class="box-header with-border" style="background: #f4fcff;">
                        <div class="user-block pull-left">
                            <img class="img-circle" src="http://icon-icons.com/icons2/67/PNG/512/group_users_13234.png" alt="Group Image">
                            <span class="username" color="blue"><a href="/groups/{{$group->id}}">{{$group->name}}</a></span>
                        </div>
                    
                        @if(Auth::user()->isAdmin && Auth::user()->id != $group->user_admin_id)
                            <form method="POST" action="{{action('GroupsController@deleteGroup')}}">
                                <input type="hidden" name="_method" value="DELETE"></input>
                                <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
                                <input type="hidden" name="group" value="{{ $group->id }}"></input>
                                <button class="btn btn-danger pull-right" type="submit">Borrar Grupo</button>
                            </form>
                            <span class="pull-right">&nbsp;</span>

                            <a class="btn btn-success pull-right" data-toggle="modal" data-target="#edit_group{{$group->id}}">Editar grupo</a>  
                            <div class="modal modal-default fade" id="edit_group{{$group->id}}">
                                <form method="POST" action="{{action('GroupsController@edit')}}">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
                                    <input type="hidden" name="_method" value="PUT"></input>
                                    <input type="hidden" name="id" value="{{$group->id}}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header" align="center">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                                <h4 class="modal-title">Editar grupo: {{$group->name}}</h4>
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
                                                                <input id="name" name="name" type="text" class="form-control" placeholder="{{$group->name}}">
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
                                                                        @if($t->id == $group->type_id)
                                                                            <option selected="selected" value="{{$t->id}}">{{$t->type}}</option>
                                                                        @endif
                                                                    @endforeach
                                                                    @foreach($types as $t)
                                                                        @if($t->id != $group->type_id)
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
                                                                <input id="description" name="description" type="text" class="form-control" placeholder="{{$group->description}}">
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
                        @if(Auth::user()->id == $group->user_admin_id)
                            <form method="POST" action="{{action('GroupsController@deleteGroup')}}">
                                <input type="hidden" name="_method" value="DELETE"></input>
                                <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
                                <input type="hidden" name="group" value="{{ $group->id }}"></input>
                                <button class="btn btn-danger pull-right" type="submit">Borrar Grupo</button>
                            </form>
                            <span class="pull-right">&nbsp;</span>

                            <a class="btn btn-success pull-right" data-toggle="modal" data-target="#edit_group{{$group->id}}">Editar grupo</a>  
                            <div class="modal modal-default fade" id="edit_group{{$group->id}}">
                                <form method="POST" action="{{action('GroupsController@edit')}}">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
                                    <input type="hidden" name="_method" value="PUT"></input>
                                    <input type="hidden" name="id" value="{{$group->id}}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header" align="center">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                                <h4 class="modal-title">Editar grupo: {{$group->name}}</h4>
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
                                                                <input id="name" name="name" type="text" class="form-control" placeholder="{{$group->name}}">
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
                                                                        @if($t->id == $group->type_id)
                                                                            <option selected="selected" value="{{$t->id}}">{{$t->type}}</option>
                                                                        @endif
                                                                    @endforeach
                                                                    @foreach($types as $t)
                                                                        @if($t->id != $group->type_id)
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
                                                                <input id="description" name="description" type="text" class="form-control" placeholder="{{$group->description}}">
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
                                <input type="hidden" name="group" value="{{ $group->id }}"></input>
                                <button class="btn btn-warning pull-right" type="submit">Cancelar Suscripción</button>
                            </form>
                        @endif
                    </div>

                    <div class="box-body" style="background: #f4fcff;">
                        @foreach($types as $t)
                            @if($group->type_id == $t->id)
                                <label>Género: </label>
                                <text>{{$t->type}}</text></br>
                            @endif
                        @endforeach
                        </br>
                        </br>
                        <text>{{$group->description}}</text>
                    </div>
                    <div class="box-footer" style="background: #f4fcff;">
                        <a href="/groups/{{$group->id}}" class="btn btn-primary pull-right" style="padding: 5px;">Ver más</a>
                    </div>
                </div>

                @empty
                <div class="alert alert-info">
                    <strong>No estas suscrito a ningun grupo</strong>
                </div>
            @endforelse
            <div class="box-footer with-border" align="center">
                {{ $lista->links() }}
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