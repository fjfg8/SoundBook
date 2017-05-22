@extends('adminlte::page')

@section('content')

<div class="box box-primary">
    <div class="box-header with-border" align="center">
        <a href="/listagrupos" class="btn btn-primary pull-right" style="margin:20px">Mis Grupos</a>
        <h3><strong>Grupos</strong></h3>
        <form method="POST" action="{{action('GroupsController@search')}}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
            <div class="input-group" style="width: 20%">
                <select class="form-control select2" name="filtro" >
                    @foreach($types as $t)
                        <option selected="selected" value="{{$t->id}}">{{$t->type}}</option>  
                    @endforeach  
                </select>
                <div class="input-group-btn">
                    <button type="submit" class="btn btn-primary">Filtrar</button>
                </div>
            </div>
        </form>
    </div>
    <div class="box-body">
         @forelse($all as $one)
            <div class="box-header with-border" >
                <h3 class="box-title with-border"><strong>{{$one->name}}</strong></h3>
                @if($groups->find($one->id))
                <a href="/groups/{{$one->id}}" class="btn btn-primary pull-right" style="margin:10px">Acceder</a> 
                @endif
                <div class="box-body" align="left">
                    @foreach($types as $t)
                        @if($one->type_id == $t->id)
                            <label>{{$t->type}}</label></br>
                        @endif
                    @endforeach
                    @if($groups->find($one->id))
                        @if($one->user_admin_id == $user->id)
                            <form method="POST" action="{{action('GroupsController@deleteGroup')}}">
                                <input type="hidden" name="_method" value="DELETE"></input>
                                <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
                                <input type="hidden" name="group" value="{{ $one->id }}"></input>
                                <button class="btn btn-danger pull-right" type="submit">Borrar Grupo</button>
                            </form>
                        @else
                            <form method="POST" action="{{action('GroupsController@CancelSubscribe')}}">
                                <input type="hidden" name="_method" value="DELETE"></input>
                                <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
                                <input type="hidden" name="group" value="{{ $one->id }}"></input>
                                <button class="btn btn-primary pull-right" type="submit">Cancelar Subscripción</button>
                            </form>
                        @endif
                    @else
                        <form method="POST" action="{{action('GroupsController@subscribe')}}">
                            <input type="hidden" name="_method" value="PUT"></input>
                            <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
                            <input type="hidden" name="group" value="{{ $one->id }}"></input>
                            <button class="btn btn-primary pull-right" type="submit">Subscribirse</button>
                        </form>
                    @endif  
                </div> 
                        
            </div>

            @empty
            <div class="alert alert-info">
                <strong>No hay grupos creados. Se el primero en crear un grupo</strong>
            </div>
        @endforelse
        <div class="box-footer with-border" align="center">
            {{ $all->links() }}
            <a class="btn btn-primary btn-lg pull-right" data-toggle="modal" data-target="#create_group" style="margin:10px">Crear Grupo</a>
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
                        <div class="col-md-6">
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
                    <button type="submit" class="btn btn-primary">Subir</button>
                </div>
            </div>
        </div>
    </form>
</div>







@stop