@extends('adminlte::page')

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

        <form method="POST" action="{{action('SongsController@create')}}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
            <input type="hidden" name="user" value="{{session()->get('id')}}"></br>
            Titulo
            <input type="text" name="title" id="title"></br>
            Artista
            <input type="text" name="artist" id="artist"></br>
            Duración
            <input type="text" name="duration" id="duration"></br>
            Genero
            <input type="text" name="gender" id="gender"></br>
            Fecha de salida
            <input type="text" name="date" id="date"></br>

            </br>
            <button type="submit" id="botonL" class="btn btn-default pull-left">Subir</button>
        </form>


    </div>

</div>


@stop