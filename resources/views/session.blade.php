@extends('master')

@section('title')
    Inicio Sesion
@stop


@section('container')
{{-- Error messages --}}
@if (count($errors) > 0)
    <ul>
    @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
    @endforeach
    </ul>
@endif
<form method="POST" action="{{action('UsersController@start')}}">
<input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
    Nick
    <input  type="text" name="nick" id="nick"></br>
    Contraseña
    <input  type="text" name="password" id="password"></br>

    </br>
    <button type="submit" class="button">Inicio Sesion</button>  <a href="/register" class="button">Registrarse</a>
</form>


@stop
