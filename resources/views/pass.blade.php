@extends('adminlte::page')

@section('content')

<div class="row" id="perfil">

        {{-- Error messages --}}
        @if (count($errors) > 0)
            <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
            </ul>
        @endif
        @if (Session::has('msg'))
        <div class="alert alert-info">{{ Session::get('msg') }}</div>
        @endif
        @if (Session::has('mess'))
        <div class="alert alert-info">{{ Session::get('mess') }}</div>
        @endif
        <div class="container" >
            <div class="panel panel-default">
                <div class="panel-heading" style="background-color:#3c8dbc;color:#FFFFFF;"><h3>Cambia la contraseña</h3></div>
                <div class="panel-body" align="left">
                    <form method="POST" action="{{action('UsersController@change')}}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
                        Contraseña antigua
                        <input type="password" name="old" id="old"></br>
                        Contraseña nueva
                        <input type="password" name="new" id="new"></br>
                        Repite la contraseña
                        <input type="password" name="copy" id="copy"></br>

                        </br>
                        <button type="submit" class="btn btn-default">Cambiar</button>
                    </form>
                </div>  
            </div>
        </div>
</div>

@stop