@extends('adminlte::page')


@section('content')

<button data-toggle="collapse" data-target="#comentario">Collapsible</button>

<form method="POST" action="{{action('CommentController@edit')}}" id="comentario">
    <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
    <input type="hidden" name="_method" value="PUT">
    <input type="hidden" name="song" value="{{ $song }}"></input>
    <input type="hidden" name="comment" value="{{ $comment }}"></input>
    <div class="panel panel-default" style="width:30%;text-align:center;margin:0 auto;" align="center">
        <div class="panel-heading" style="background-color:#3c8dbc;color:#FFFFFF;">
            <h3 class="panel-title" >Editar comentario</h3>
        </div>
        <div class="panel-body" style="background-color:#c4deff;">
            <div class="form-group">
                <textarea form="comentarioN" id="comentario" name="comentario" rows="5" cols="40"></textarea><br/>
            </div>

            <div class="form-group">        
                    <button type="submit" class="btn btn-default">Editar</button> 
            </div>
        </div><!-- /.box-body -->
    </div>
</form>


@stop