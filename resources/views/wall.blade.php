@extends('adminlte::page')

@section('content')

<div class="container" id="misCanciones" align="center">
    <div class="panel panel-default" >

        <div class="panel-body" style="background-color:#c4deff;" align="center">
    <br/>
    @forelse($publi as $song)
        <div class="panel panel-default">
            <div class="panel-heading" style="background-color:#ef8300;color:#000000;">{{$song->title}}</div>
            <div class="panel-body" align="left" style="background-color:#ffe4c4;">
                <iframe width="560" height="315" src = {{$song->url}} allowfullscreen></iframe>
                <br/>
                <a href="/song/{{$song->id}}" class="btn btn-default pull-right" style="padding-top: 5px;">Ver más</a>
            </div>  
        </div>
    @empty
        <div class="alert alert-info">
            <strong>No tienes ninguna canción</strong>
        </div>
    @endforelse

    </div>



@endsection