@extends('adminlte::page')

@section('content')

{{-- Error messages --}}
@if (count($errors) > 0)
    @foreach ($errors->all() as $error)
        <div class="alert alert-danger">{{ $error }}</div>
    @endforeach
@endif

<div class="row">
    <div class="col-md-2">
    </div>
    <div class="col-md-8">
        <div class="box box-primary" id="contraseña">
            <div class="box-header with-border" align="center">
                <h2 class="box-title with-border">Cambia la contraseña</h2>
            </div>
            <div class="box-body">
                <form method="POST" action="{{action('UsersController@changePass')}}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
                    <div class="row">
                        <div class="col-md-2">
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label>Contraseña antigua</label></br>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-repeat"></i>
                                    </div>
                                    <input id="old" name="old" type="password" class="form-control" placeholder="Introduzca la actual contraseña">
                                </div>
                            </div>
                            @if (Session::has('msg'))
                                <div class="alert alert-danger">{{ Session::get('msg') }}</div>
                            @endif
                            <div class="form-group">
                                <label>Contraseña nueva</label></br>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-lock"></i>
                                    </div>
                                    <input id="new" name="new" type="password" class="form-control" placeholder="Introduzca la nueva contraseña">
                                </div>
                            </div>
                            @if (Session::has('mess'))
                                <div class="alert alert-danger">{{ Session::get('mess') }}</div>
                            @endif
                            <div class="form-group">
                                <label>Confirmación contraseña</label></br>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-lock"></i>
                                    </div>
                                    <input id="copy" name="copy" type="password" class="form-control" placeholder="Repita la nueva contraseña">
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Cambiar</button>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="box-footer">
            </div>
        </div>
    </div>
</div>

@stop