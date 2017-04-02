@extends('master')

@section('title')
    Cambio de contraseña
@stop

@section('content')

<div class="row">

    <div class="col-md-4"></div>

    <div class="col-md-4" id="perfil">

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


@stop