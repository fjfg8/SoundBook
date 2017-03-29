@extends('master')

@section('title')
    Registro
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
<form method="POST" action="{{action('UsersController@create')}}">
<input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
    Email
    <input value="{{ old('title') }}" type="text" name="email" id="email"></br>
    Nick
    <input value="{{ old('title') }}" type="text" name="nick" id="nick"></br>
    Contraseña
    <input type="text" name="password" id="password"></br>
    Nombre
    <input value="{{ old('title') }}" type="text" name="name" id="name"></br>

    
    <button type="submit">Registrar</button>
</form>




@stop