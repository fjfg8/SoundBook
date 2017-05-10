@extends('adminlte::page')

@section('content')

<div class="row">

    <div class="col-md-8" id="perfil" align="center">

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

            <div class="panel panel-default" style="width:40%;">
                    <div class="panel-heading" style="background-color:#3c8dbc;color:#FFFFFF;">
                        <h3 class="panel-title" >Sube una canción</h3>
                    </div>
                    <div class="panel-body" style="background-color:#c4deff;" align="left">
                        <div class="form-group">
                            <label class="control-label col-sm-5">Título</label>
                                <input type="text" name="title" id="title">
                            <br/>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-5">Artista</label>
                            <input type="text" name="artist" id="artist">
                            <br/>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-5">Album</label>
                            <input type="text" name="album" id="album">
                            <br/>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-5">Género</label>
                            <input type="text" name="gender" id="gender">
                            <br/>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-5">Fecha de salida</label>
                            <input type="text" name="date" id="date" placeholder="AAAA-MM-DD">
                            <br/>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-5">URL</label>
                            <input type="text" name="url" id="url">
                            <br/>
                        </div>
                        <div class="form-group">
                            <button type="submit" id="botonL" class="btn btn-default">Subir</button>
                        </div>
                    </div>  
            </div>
        </form>


    </div>

</div>


@stop