@extends('adminlte::page')

@section('content')

<div class="row">
    <div class="col-md-2">
    </div>
    <div class="col-md-8">
        <div class="box box-primary" align="center">
            <div class="box-header">
                <h3 class="box-title" >Listado de usuarios</h3>
            </div>
            <div class="box-body table-responsive no-padding" > 
                <table class="table table-hover" style="text-align:center;">
                    <tbody>
                        <tr>
                            <th style="text-align:center;"><i class="fa fa-info-circle" aria-hidden="true"></i> ID</th>
                            <th style="text-align:center;"><i class="fa fa-user" aria-hidden="true"></i> Nick</th>
                            <th style="text-align:center;"><i class="fa fa-font" aria-hidden="true"></i> Nombre</th>
                            <th style="text-align:center;"><i class="fa fa-envelope" aria-hidden="true"></i> Email</th>
                            <th style="text-align:center;"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</th>
                            <th style="text-align:center;"><i class="fa fa-trash" aria-hidden="true"></i> Eliminar</th>
                        </tr>
                        @forelse($users as $user)
                            <tr>
                                <td>{{$user->id}}</td>
                                <td>{{$user->nick}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
           
                                <td><a class="btn btn-default btn-warning" data-toggle="modal" data-target="#edit_user{{$user->id}}">Editar</a></td>
  
                                <div class="modal modal-default fade" id="edit_user{{$user->id}}">
                                    <form method="POST" action="{{action('UsersController@edit')}}">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
                                        <input type="hidden" name="_method" value="PUT"></input>
                                        <input type="hidden" name="id" value="{{$user->id}}">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header" align="center">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                    <h4 class="modal-title">Editar perfil: {{$user->nick}}</h4>
                                                </div>
                                                <div class="modal-body" align="left">
                                                    <div class="row">
                                                        <div class="col-md-2">
                                                        </div>
                                                        <div class="col-md-8">
                                                            <div class="form-group">
                                                                <label>Nick</label></br>
                                                                <div class="input-group">
                                                                    <div class="input-group-addon">
                                                                        <i class="fa fa-user"></i>
                                                                    </div>
                                                                    <input id="nick" name="nick" type="text" class="form-control" placeholder="{{$user->nick}}">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Nombre</label></br>
                                                                <div class="input-group">
                                                                    <div class="input-group-addon">
                                                                        <i class="fa fa-font"></i>
                                                                    </div>
                                                                    <input id="name" name="name" type="text" class="form-control" placeholder="{{$user->name}}">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Email</label></br>
                                                                <div class="input-group">
                                                                    <div class="input-group-addon">
                                                                        <i class="fa fa-envelope"></i>
                                                                    </div>
                                                                    <input id="email" name="email" type="email" class="form-control" placeholder="{{$user->email}}">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Género</label></br>
                                                                <div class="input-group">
                                                                    <div class="input-group-addon">
                                                                        <i class="fa fa-transgender"></i>
                                                                    </div>
                                                                    <select class="form-control select2" id="gender" name="gender">
                                                                        @foreach($generos as $g)
                                                                            @if($user->gender == $g)
                                                                                <option selected="selected" value="{{$g}}">{{$g}}</option>
                                                                            @endif
                                                                        @endforeach
                                                                        @foreach($generos as $g)
                                                                            @if($user->gender != $g)
                                                                                <option value="{{$g}}">{{$g}}</option>
                                                                            @endif
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Estado civil</label></br>
                                                                <div class="input-group">
                                                                    <div class="input-group-addon">
                                                                        <i class="fa fa-info"></i>
                                                                    </div>
                                                                    <select class="form-control select2" id="status" name="status">
                                                                        @foreach($estados as $s)
                                                                            @if($user->status == $s)
                                                                                <option selected="selected" value="{{$s}}">{{$s}}</option>
                                                                            @endif
                                                                        @endforeach
                                                                        @foreach($estados as $s)
                                                                            @if($user->status != $s)
                                                                                <option value="{{$s}}">{{$s}}</option>
                                                                            @endif
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Preferencias</label></br>
                                                                <div class="input-group">
                                                                    <div class="input-group-addon">
                                                                        <i class="fa fa-thumbs-up"></i>
                                                                    </div>
                                                                    <input id="preferences" name="preferences" type="text" class="form-control" placeholder="{{$user->preferences}}">
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

                                @if (!(Auth::user()->id == $user->id))
                                    <td> 
                                        <a class="btn btn-default btn-danger" data-toggle="modal" data-target="#delete_user{{$user->id}}">Eliminar</a>
                                        <div class="modal modal-danger fade" id="delete_user{{$user->id}}">
                                            <form method="POST" action="{{action('UsersController@delete')}}" id="usuario">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
                                                <input type="hidden" name="_method" value="DELETE"></input>
                                                <input type="hidden" name="user" value="{{$user->id}}">
                                                <div class="modal-dialog" align="center">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">×</span>
                                                            </button>
                                                            <h4 class="modal-title">¿Estás seguro de borrar a cancion {{$user->name}}?</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>No podrás deshacer la acción</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cancelar</button>
                                                            <button type="submit" class="btn btn-outline">Si</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </td>
                                @else
                                    <td></td>
                                @endif
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

@endsection