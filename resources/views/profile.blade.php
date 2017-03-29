@extends('master')

@section('session')
   <h5>Hola</h5>
@stop

@section('container')
<form method="POST" action="{{action('UsersController@edit')}}">
<input type="hidden" name="_token" value="{{ csrf_token() }}"></input>

    Nombre
    <input type="text" name="name" id="name" placeholder="{{$user->name}}"></br>
    Email
    <input type="text" name="email" id="email" placeholder="{{$user->email}}"></br>
    Genero
    <input type="text" name="gender" id="gender" placeholder="{{$user->gender}}"></br>
    Estado
    <input type="text" name="status" id="status" placeholder="{{$user->status}}"></br>
    Preferencias
    <input type="text" name="preferences" id="preferences" placeholder="{{$user->preferences}}"></br>


    
    <button type="submit">Guardar</button> 
</form>
<a href="/pass" class="button">Cambiar Contraseña</a>
@stop



<!-- $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('gender')->nullable();
            $table->string('status')->nullable();
            $table->string('preferences')->nullable();-->