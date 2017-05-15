@extends('adminlte::page')

@section('content')

<div class="raw" id="admin">
    <div class="container" id="usuarios" align="center">
        <div class="panel panel-default">
            <div class="panel-heading" style="background-color:#3c8dbc;color:#FFFFFF;">
                <div class="panel-title" >Listado de usuarios</div>
            </div>
            <div class="panel-body" align="center" style="background-color:#c4deff;">
                    @forelse($users as $user)
                        <div class="panel panel-default">
                            <div class="panel-heading" style="background-color:#ef8300;color:#FFFFFF;">{{$user->nick}}</div>
                            <div class="panel-body" style="background-color:#ffe4c4;" align="center">
                                <text syle="text-align: left;">Id:{{$user->id}}</text>
                                </br>
                                <text syle="text-align: left;">Nombre: {{$user->name}}</text>
                                </br>
                                <text syle="text-align: left;">Email: {{$user->email}}</text>
                                </br>
                                @if (!(Auth::user()->id == $user->id))
                                    <a class="btn btn-default pull-right" data-toggle="modal" data-target="#delete_user{{$user->id}}">Eliminar</a>
                                    <div class="modal fade" id="delete_user{{$user->id}}">
                                        <form method="POST" action="{{action('UsersController@delete')}}" id="usuario">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
                                            <input type="hidden" name="_method" value="DELETE"></input>
                                            <input type="hidden" name="user" value="{{$user->id}}">
                                            <br/>
                                            <div class="panel panel-default" style="width:50%;text-align:center;margin:0 auto;">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <div class="panel-heading" style="background-color:#3c8dbc;color:#FFFFFF;">
                                                    <h3 class="panel-title" >¿Estás seguro de borrar a {{$user->name}}?</h3>
                                                </div>
                                                <div class="panel-body" style="background-color:#c4deff;" align="center">
                                                    <div class="form-group">        
                                                        <div class="col-md-offset-2 col-sm-10">
                                                            <button type="submit" class="btn btn-default">Si</button> 
                                                        </div><br/>
                                                        <br/>
                                                    </div>
                                                    <div class="form-group">        
                                                        <div class="col-md-offset-2 col-sm-10">
                                                            <button type="button" data-dismiss="modal" class="btn btn-default">Cancelar</button> 
                                                        </div><br/>
                                                        <br/>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                @endif
                                <a class="btn btn-default pull-right" data-toggle="modal" data-target="#edit_user{{$user->id}}">Editar</a>
                            </div>
                        </div>
                        <div class="modal fade" id="edit_user{{$user->id}}">
                            <form method="POST" action="{{action('UsersController@edit')}}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
                                <input type="hidden" name="_method" value="PUT"></input>
                                <input type="hidden" name="id" value="{{$user->id}}">
                                <br/>
                                <div class="panel panel-default" style="width:50%;text-align:center;margin:0 auto;">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <div class="panel-heading" style="background-color:#3c8dbc;color:#FFFFFF;">
                                        <h3 class="panel-title" >Perfil</h3>
                                    </div>
                                    <div class="panel-body" style="background-color:#c4deff;" align="center">
                                        <div class="form-group">
                                            <label class="control-label col-sm-2">Nick</label>
                                            <div class="col-md-10">
                                                <input type="text" name="nick" id="nick" value="{{$user->nick}}">
                                            </div>
                                            <br/>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-2">Nombre</label>
                                            <div class="col-md-10">
                                                <input type="text" name="name" id="name" value="{{$user->name}}">
                                            </div>
                                            <br/>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-2">Email</label>
                                            <div class="col-md-10">
                                                <input type="text" name="email" id="email" value="{{$user->email}}">
                                            </div> <br/>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-2">Genero</label>
                                            <div class="col-md-10">
                                                <input type="text" name="gender" id="gender" value="{{$user->gender}}">
                                            </div> <br/>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-2">Estado</label>
                                            <div class="col-md-10">
                                                <input type="text" name="status" id="status" value="{{$user->status}}">
                                            </div> <br/>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-2">Preferencias</label>
                                            <div class="col-md-10">
                                                <input type="text" name="preferences" id="preferences" value="{{$user->preferences}}">
                                            </div><br/>
                                            <br/>
                                        </div>    
                                        <div class="form-group">        
                                            <div class="col-md-offset-2 col-sm-10">
                                                <button type="submit" class="btn btn-default">Guardar</button> 
                                            </div><br/>
                                            <br/>
                                        </div>
                                    </div><!-- /.box-body -->
                                </div>
                            <br/>
                         </form>
                    </div>
                    @empty
                        <div class="alert alert-info">
                            <strong>No existe ningun usuario</strong>
                        </div>
                    @endforelse

                    {{ $users->links() }}
            </div>
        </div>
    </div>
</div>
@stop