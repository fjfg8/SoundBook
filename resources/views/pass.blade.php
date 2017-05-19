@extends('adminlte::page')

@section('content')

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
<div class="container" id="contraseña" align="center">
    <form method="POST" action="{{action('UsersController@changePass')}}" align="center">
            <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
            <div class="panel panel-default" style="width:40%;">
                <div class="panel-heading" style="background-color:#3c8dbc;color:#FFFFFF;">
                    <h3 class="panel-title" >Cambia la contraseña</h3>
                </div>
                <div class="panel-body" style="background-color:#c4deff;">
                    <div class="form-group">
                        <label class="control-label col-sm-5">Contraseña antigua</label>
                        <input type="password" name="old" id="old">
                        <br/>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-5">Contraseña nueva</label>
                        <input type="password" name="new" id="new">
                        <br/>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-5">Repite la contraseña</label>
                        <input type="password" name="copy" id="copy">
                        <br/>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-default">Cambiar</button>
                    </div>
                </div>  
            </div>
    </form>
</div>
@stop