@extends('adminlte::page')

@section('content')

<div class="row">
    <div class="col-md-2">
    </div>
    <div class="col-md-8">
        <div class="box box-primary">
            <div class="box-header with-border" align="center">
                <h2 class="box-title with-border">Miembros del grupo: {{$group->name}}</h2>
            </div>
            <div class="box-body">
                @forelse($users as $user)
                    <div class="box box-primary">
                        <div class="box-header with-border" style="background: #f4fcff;">
                            <div class="user-block">
                                <img class="img-circle" src="http://www.icon2s.com/img128/128x128-black-white-android-user.png" alt="User Image">
                                <span class="username" color="blue"><a href="/visit/{{$user->id}}">{{$user->name}}</a></span>
                            </div>
                        </div>
                        <div class="box-body" style="background: #f4fcff;">
                            <div class="col-md-6">
                                <img src="{{url($user->image)}}" width="100" height="100"></img>
                            </div>
                            <div class="col-md-6">
                                <label>Nombre: </label>
                                <text> {{$user->name}}</text></br>
                                <label>Nick: </label>
                                <text> {{$user->nick}}</text></br>
                                <label>Género: </label>
                                <text>{{$user->gender}}</text></br>
                                <label>Preferencias: </label>
                                <text> {{$user->preferences}}</text>
                            </div>
                        </div>
                        <div class="box-footer" style="background: #f4fcff;">
                            <a href="/visit/{{$user->id}}" class="btn btn-primary pull-right">Ver más</a>
                        </div>
                    </div>
                @empty
                    <div class="alert alert-info">
                        <strong>Este grupo no tiene miembros</strong>
                    </div>
                @endforelse 
            </div>
        </div>
    </div>
</div>

@endsection