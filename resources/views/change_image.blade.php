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
                <h2 class="box-title with-border">Cambia la imagen de perfil</h2>
            </div>
            <div class="box-body">
                <div class="col-md-6" align="center">
                        <img src="{{Auth::user()->image}}" height="200" width="200"></img><br/>
                </div>
                <div class="col-md-6">
                    <form class="form-horizontal" method="POST" action="{{action('UsersController@changeImage')}}" align="center">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
                        <div class="form-group">
                            <label>URL</label></br>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-globe"></i>
                                </div>
                                <input type="text" name="Imagen" class="form-control" placeholder="Introduzca la url de la imagen">
                            </div>
                        </div>
                         <div class="form-group">
                            <button type="submit" class="btn btn-primary">Cambiar</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="box-footer">
            </div>
        </div>
    </div>
</div>

@stop

