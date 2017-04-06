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
                            </div>
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