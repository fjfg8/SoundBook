@extends('adminlte::page')

@section('content')

<div class="container" id="comentarios" align="center" >
       <div class="panel panel-default">
            <div class="panel-heading" style="background-color:#3c8dbc;color:#FFFFFF;">
                <div class="panel-title" >Tus grupos</div>
            </div>
            <div class="panel-body" align="center" style="background-color:#c4deff;">
                @forelse($lista as $list)
                    <div class="panel panel-default" >
                        <div class="panel-heading" style="background-color:#ef8300;color:#000000;"><strong>{{$list->name}}</strong></div>
                        <div class="panel-body" align="left" style="background-color:#ffe4c4;">
                            <label>{{$list->musicStyle}}</label><br/>
                            <text syle="text-align: right;">{{$list->description}}</text>
                            <a href="/groups/{{$list->id}}" class="btn btn-default pull-right" style="padding-top: 5px;">Acceder</a>
                            
                        </div> 
                        
                    </div>

                @empty
                    <div class="alert alert-info">
                        <strong>No estas subscrito a ningun grupo</strong>
                    </div>
                @endforelse
                {{ $lista->links() }}
       
        </div>
    </div>









@stop