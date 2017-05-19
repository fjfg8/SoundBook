@extends('adminlte::page')

@section('content')

<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title" >Listado de usuarios</h3>
            </div>
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                    <tbody>
                        <tr>
                            <th>ID</th><th>Nick</th><th>Nombre</th><th>Email</th><th>Eliminar</th><th>Editar</th>
                        </tr>
                        @forelse($users as $user)
                            <tr>
                                <td>{{$user->id}}</td>
                                <td>{{$user->nick}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>

                                @if (!(Auth::user()->id == $user->id))
                                    <td> 
                                        <a class="btn btn-default" data-toggle="modal" data-target="#delete_user{{$user->id}}">Eliminar</a>
                                        <div class="modal fade" id="delete_user{{$user->id}}">
                                            <form method="POST" action="{{action('UsersController@delete')}}" id="usuario">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
                                                <input type="hidden" name="_method" value="DELETE"></input>
                                                <input type="hidden" name="user" value="{{$user->id}}">
                                                <br/>
                                                <br/>
                                                <br/>
                                                <div class="panel panel-default" style="width:50%;text-align:center;margin:0 auto;">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <div class="panel-heading" style="background-color:#3c8dbc;color:#FFFFFF;">
                                                        <h3 class="panel-title" >¿Estás seguro de borrar a {{$user->name}}?</h3>
                                                    </div>
                                                    <div class="panel-body" style="background-color:#c4deff;" align="center">
                                                        <div class="form-group">        
                                                            <button type="submit" class="btn btn-default">Si</button> 
                                                            <button type="button" data-dismiss="modal" class="btn btn-default">Cancelar</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </td>
                                @else
                                    <td></td>
                                @endif
                                <td><a class="btn btn-default" data-toggle="modal" data-target="#edit_user{{$user->id}}">Editar</a></td>
                            
                            
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
                                                    <input type="text" name="nick" id="nick" placeholder="{{$user->nick}}">
                                                </div>
                                                <br/>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-sm-2">Nombre</label>
                                                <div class="col-md-10">
                                                    <input type="text" name="name" id="name" placeholder="{{$user->name}}">
                                                </div>
                                                <br/>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-sm-2">Email</label>
                                                <div class="col-md-10">
                                                    <input type="text" name="email" id="email" placeholder="{{$user->email}}">
                                                </div> <br/>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-sm-2">Genero</label>
                                                <div class="col-md-10">
                                                    <input type="text" name="gender" id="gender" placeholder="{{$user->gender}}">
                                                </div> <br/>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-sm-2">Estado</label>
                                                <div class="col-md-10">
                                                    <input type="text" name="status" id="status" placeholder="{{$user->status}}">
                                                </div> <br/>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-sm-2">Preferencias</label>
                                                <div class="col-md-10">
                                                    <input type="text" name="preferences" id="preferences" placeholder="{{$user->preferences}}">
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
                        </tr>
                        @empty
                            <div class="alert alert-info">
                                <strong>No existe ningun usuario</strong>
                            </div>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="box-footer pull-right no-padding" style="background-color: transparent;">
                {{ $users->links() }}
            </div>
        </div>
    </div>
</div>
@stop