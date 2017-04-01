@extends('master')

@section('title')
    Comentar
@stop

@section('container')

<form method="POST" action="{{action('CommentController@create')}}">
<input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
    Comentario
    <textarea  type="text" name="comment" id="comment">
    </textarea></input>
    
    <button type="submit">Comentar</button>
</form>



@stop