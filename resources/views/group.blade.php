@extends('adminlte::page')

@section('content')

<div class="box box-primary">
    <div class="box-header with-border" align="center">
        <h3><strong>{{$group->name}}</strong></h3>
    </div>
    <div class="box-body">
        <div class="col-md-4 border-right">
            <div class="description-block">
                <h5 class="description-header">Descripción:</h5></br>
                <span class="description-text">"{{$group->description}}"</span>
            </div>
        </div>
        <div class="col-md-4 border-right">
            <div class="description-block">
                <h5 class="description-header">Estilo Musical:</h5></br>
                <span class="description-text">{{$type->type}}</span>
            </div>
        </div>
        <div class="col-md-4 border-right">
            <div class="description-block">
                <h5 class="description-header"></h5>{{$members}}</br>
                <span class="description-text"><a href="/home/follow">Miembros</a></span>
            </div>
        </div>
    </div>
</div>

    <div class="box box-primary">
        <div class="box-header with-border" align="center">
            <h6 class="box-title with-border"><strong>PUBLICACIONES</strong></h6>
        </div>
        <div class="box-body">

        </div>
    </div>







@stop