@extends('adminlte::page')


@section('content')

<form method="POST" action="{{action('UsersController@edit')}}">
    <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
    <input type="hidden" name="_method" value="PUT"></input>
    <input type="hidden" name="id" value="{{$user->id}}">
    <div class="panel panel-default" style="width:50%;text-align:center;margin:0 auto;">
        <div class="panel-heading" style="background-color:#3c8dbc;color:#FFFFFF;">
            <h3 class="panel-title" >Perfil</h3>
        </div>
        <div class="panel-body" style="background-color:#c4deff;" align="center">
            <div class="form-group">
                <label class="control-label col-sm-2">Nick</label>
                <div class="col-md-10">
                    <input type="text" name="nick" id="nick" value="{{$user->nick}}">
                </div>
                <br/>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2">Nombre</label>
                <div class="col-md-10">
                    <input type="text" name="name" id="name" value="{{$user->name}}">
                </div>
                <br/>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2">Email</label>
                <div class="col-md-10">
                    <input type="text" name="email" id="email" value="{{$user->email}}">
                </div> <br/>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-2">Genero</label>
                <div class="col-md-10">
                    <input type="text" name="gender" id="gender" value="{{$user->gender}}">
                </div> <br/>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2">Estado</label>
                <div class="col-md-10">
                    <input type="text" name="status" id="status" value="{{$user->status}}">
                </div> <br/>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2">Preferencias</label>
                <div class="col-md-10">
                    <input type="text" name="preferences" id="preferences" value="{{$user->preferences}}">
                </div><br/>
                <br/>
            </div>    
            <div class="form-group">        
                <div class="col-md-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-default">Guardar</button> 
                </div>
            </div>
        </div><!-- /.box-body -->
    </div>
    <br/>
</form>



@stop