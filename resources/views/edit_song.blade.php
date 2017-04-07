@extends('adminlte::page')


@section('content')
<div class="container" id="misCanciones" align="center">
 <form method="POST" action="{{action('SongsController@edit')}}" align="center">
            <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
            <input type="hidden" name="_method" value="PUT"></input>
            <input type="hidden" name="id" value="{{$song}}">
            <div class="panel panel-default" style="width:40%;">
                <div class="panel-heading" style="background-color:#3c8dbc;color:#FFFFFF;">
                    <h3 class="panel-title" >Editar canción</h3>
                </div>
                <div class="panel-body" style="background-color:#c4deff;" >
                    <div class="form-group">
                        <label class="control-label col-sm-4">Titulo</label>
                        <input type="text" name="title">
                        <br/>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4">Artista</label>
                        <input type="text" name="artist">
                        <br/>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4">Duracion</label>
                        <input type="text" name="duration">
                        <br/>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4">Fecha de salida</label>
                        <input type="text" name="date">
                        <br/>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4">Genero</label>
                        <input type="text" name="gender">
                        <br/>
                    </div>
                    <div class="form-group">        
                        <button type="submit" class="btn btn-default">Guardar</button> 
                    </div>
                </div><!-- /.box-body -->
            </div>
        </form>
</div>



@stop