@extends('adminlte::page')

@section('content')
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

 <div class="modal modal-default fade" id="upload_song">
    <form method="POST" action="{{action('SongsController@create')}}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
        <input type="hidden" name="user" value="{{$user->id}}"></input>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" align="center">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title">Subir nueva canción</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Titulo</label></br>
                                <input type="text" name="title" size="50">
                            </div>
                            <div class="form-group">
                                <label>Artista</label></br>
                                <input type="text" name="artist" size="50">
                            </div>
                            <div class="form-group">
                                <label>Url</label></br>
                                <input type="text" name="url" placeholder="http://www.youtube.com/..." size="50">
                            </div>
                            <div class="form-group">
                                <label>Género</label></br>
                                <input type="text" name="gender" size="50">
                            </div>
                            <div class="form-group">
                                <label>Fecha de salida</label></br>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input id="date" name="date" type="text" size="50" class="form-control" data-inputmask="'alias': 'YYYY/MM/DD'" data-mask="">
                                </div>
                            </div>
                        </div>
                    </div>      
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar cambios</button>
                </div>
            </div>
        </div>
    </form>
</div>






@stop