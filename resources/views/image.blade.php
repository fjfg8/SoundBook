@extends('adminlte::page')

@section('content')
<div class="row">
    <div class="col-md-4">
        
    </div>
    <div class="col-md-4">
            <form class="form-horizontal" method="POST" action="{{action('UsersController@changeImage')}}" align="center">
                <h3>Cambiar imagen de perfil</h3>
                <img src="{{Auth::user()->image}}" height="200" width="200" align="middle"></img>
            
                <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
                <label class="control-label">URL</label>
                <input class="form-control" type="text" name="new">
                <button type="submit" class="btn btn-app pull-right"><i class="fa fa-save"></i></button>
            </form>
        </div>
    </div>
</div>
@stop

