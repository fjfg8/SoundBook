@extends('master')

@section('title')
    Comentar
@stop

@section('content')

<div class="row">

    <div class="col-md-4"></div>

    <div class="col-md-4" id="comment">
       <form method="POST" action="{{action('CommentController@create')}}" id="comentarioN">
                <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
                <input type="hidden" name="song" value="{{ $song }}"></input>
                <button type="submit" id="botonL" class="btn btn-default pull-left">Comentar</button>
        </form><br/>
        <textarea form="comentarioN" name="descripcion" rows="5" cols="40"></textarea>

    </div>

</div>
@stop