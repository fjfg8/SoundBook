@extends('adminlte::page')

@section('content')

<div class="box box-primary">
    <div class="box-header with-border" align="center">
        <a href="/listagrupos" class="btn btn-primary pull-right" style="margin:20px">Participar</a>
        <a href="/listagrupos" class="btn btn-primary pull-right" style="margin:20px">Rechazar</a>
        <h3><strong>{{$publi->title}}</strong></h3>
    </div>
    <div class="box-body">
       <div class="col-md-4 border-right">
            <div class="description-block">
                <h5 class="description-header">Descripción:</h5></br>
                <span class="description-text">"{{$publi->description}}"</span>
            </div>
        </div>
    </div>
</div>

@endsection