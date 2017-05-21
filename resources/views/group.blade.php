@extends('adminlte::page')

@section('content')

<div class="box box-primary">
    <div class="box-header with-border" align="center">
        <a href="/listagrupos" class="btn btn-primary pull-right" style="margin:20px">Mis Grupos</a>
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
                <span class="description-text"><a href="/members/{{$group->id}}">Miembros</a></span>
            </div>
        </div>
    </div>
</div>

<div class="box box-primary">
    <div class="box-header with-border" align="center">
        <h6 class="box-title with-border"><strong>PUBLICACIONES</strong></h6>
    </div>
    <div class="box-body">
        @forelse($publications as $publi)
            <div class="box-header with-border" >
                <div class="box-title with-border"><strong>{{$publi->title}}</strong></div>
                <div class="box-header" align="left">{{$publi->description}}</div>
                
            </div>
            @empty
            <div class="alert alert-info">
                <strong>Este grupo no contiene ninguna publicacion</strong>
            </div>
        @endforelse
        {{ $publications->links() }}
    </div>
</div>







@stop