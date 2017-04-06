@extends('adminlte::page')


@section('content')
 <form method="POST" action="{{action('SongsController@edit')}}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
            <input type="hidden" name="_method" value="PUT"></input>
            <input type="hidden" name="id" value="{{$song}}">
            <div class="panel panel-default" style="width:50%;text-align:center;margin:0 auto;">
                <div class="panel-heading" style="background-color:#3c8dbc;color:#FFFFFF;">
                    <h3 class="panel-title" >Editar canción</h3>
                </div>
                <div class="panel-body" style="background-color:#c4deff;" align="left">
                    <div class="form-group">
                        <label class="control-label col-sm-2">Titulo</label>
                        <div class="col-md-10">
                            <input type="text" name="title">
                        </div>
                        <br/>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2">Artista</label>
                        <div class="col-md-10">
                            <input type="text" name="artist">
                        </div> <br/>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2">Duracion</label>
                        <div class="col-md-10">
                            <input type="text" name="duration">
                        </div> <br/>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2">Fecha de salida</label>
                        <div class="col-md-10">
                            <input type="text" name="date">
                        </div> <br/>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2">Genero</label>
                        <div class="col-md-10">
                            <input type="text" name="gender">
                        </div> <br/>
                    </div>
    
                    <div class="form-group">        
                        <div class="col-md-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-default">Guardar</button> 
                        </div>
                    </div>
                </div><!-- /.box-body -->
            </div>
        </form>




@stop