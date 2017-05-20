@extends('adminlte::page')

@section('content')

<div class="box box-primary">
    <div class="box-header with-border" align="center">
        <h3 class="box-title with-border"><strong>Grupos</strong></h3>
        <a href="/listagrupos" class="btn btn-primary pull-right">Mis Grupos</a>
    </div>
    <div class="box-body">
         @forelse($all as $one)
            <div class="box-header with-border" >
                <div class="box-title with-border"><strong>{{$one->name}}</strong></div>
                <div class="box-body" align="left">
                    <label>{{$one->musicStyle}}</label><br/>
                    <text style="text-align: right;">{{$one->description}}</text>
                    <a href="/groups/{{$one->id}}" class="btn btn-primary pull-right">Subscribirse</a>
                            
                </div> 
                        
            </div>

            @empty
            <div class="alert alert-info">
                <strong>No hay grupos creados. Se el primero en crear un grupo</strong>
            </div>
        @endforelse
        <div class="box-header with-border" >
            {{ $all->links() }}
            <a class="btn btn-primary btn-lg pull-right" data-toggle="modal" data-target="#create_group" style="margin:15px">Crear Grupo</a>
        </div>
    </div>
</div>
  








@stop