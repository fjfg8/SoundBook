@extends('adminlte::page')

@section('content')

<div class="box box-success" >

    <div class="box-body" style="background-color:#c4deff;" align="center">
    @forelse($publi as $song)
        <div class="panel panel-default">
            <div class="panel-heading" style="background-color:#ef8300;">{{$song->title}}</div>
            <div class="panel-body" align="left" style="background-color:#ffe4c4;">
                <div class="col-md-6">
                    <iframe width="560" height="315" src = {{$song->url}} allowfullscreen></iframe>
                </div>
                <div class="col-md-2">
                <form method="POST" action="{{action('SongsController@like')}}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
                    <input type="hidden" name="id" value="{{ $song->id }}"></input>
                    <div class="info-box">
                        <span class="info-box-icon bg-blue"><i class="fa fa-star-o"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Likes</span>
                                <span class="info-box-number">{{$song->likes}}</span>
                            </div>
                            <button type="submit" id="botonL" class="btn btn-primary pull-right"><i class="glyphicon glyphicon-thumbs-up"></i></button>
                    </div>
                </form>
                </div>
                <a href="/song/{{$song->id}}" class="btn btn-primary pull-right" style="padding-top: 5px;">Ver más</a>
            </div>  
        </div>
    @empty
        <div class="alert alert-info">
            <strong>No tienes ninguna canción</strong>
        </div>
    @endforelse
</div>
@endsection