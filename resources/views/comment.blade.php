@extends('adminlte::page')


@section('content')

<div class="row">

    <div class="col-md-4"></div>

    <div class="col-md-4" id="comment">
        <label><strong>Editar comentario</song></label>
       <form method="POST" action="{{action('CommentController@edit')}}" id="comentarioN">
                <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="song" value="{{ $song }}"></input>
                 <input type="hidden" name="comment" value="{{ $comment }}"></input>
                <button type="submit" id="botonL" class="btn btn-default pull-left">Editar</button>
        </form><br/>
        <textarea form="comentarioN" name="descripcion" rows="5" cols="40"></textarea>

    </div>

</div>
@stop