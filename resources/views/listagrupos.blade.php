@extends('adminlte::page')

@section('content')

<div class="box box-primary">
    <div class="box-header with-border" align="center">
        <h3 class="box-title with-border"><strong>Mis Grupos</strong></h3>
        <a href="/allGroups" class="btn btn-primary pull-right">Ver todos</a>
    </div>
    <div class="box-body">
         @forelse($lista as $list)
            <div class="box-header with-border" >
                <div class="box-title with-border"><strong>{{$list->name}}</strong></div>
                <div class="box-body" align="left">
                    <label>{{$list->musicStyle}}</label><br/>
                    <text style="text-align: right;">{{$list->description}}</text>
                    <a href="/groups/{{$list->id}}" class="btn btn-primary pull-right">Acceder</a>
                            
                </div> 
                        
            </div>

            @empty
            <div class="alert alert-info">
                <strong>No estas subscrito a ningun grupo</strong>
            </div>
        @endforelse
        <div class="box-header with-border" >
            {{ $lista->links() }}
            <a class="btn btn-primary btn-lg pull-right" data-toggle="modal" data-target="#create_group" style="margin:15px">Crear Grupo</a>
        </div>
    </div>
</div>

<div class="modal modal-default fade" id="create_group">
    <form method="POST" action="{{action('GroupsController@create')}}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
        <input type="hidden" name="user" value="{{$user->id}}"></input>
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

@endsection