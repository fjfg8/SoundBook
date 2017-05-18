@extends('adminlte::page')

@section('content')

    @if(sizeof($songs)<1)
        <div class="alert alert-info">
            <strong>No tienes ninguna canción</strong>
        </div>
    @endif

    @for($i=0;$i<sizeof($songs);$i++)
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="box box-primary">
                <div class="box-header with-border" style="background: #f4fcff;">
                <span class="text-muted pull-right">{{$songs[$i]->date}}</span>
                    <div class="user-block">
                        <img class="img-circle" src="http://xacatolicos.com/app/images/icon-user.png" alt="User Image">
                        @if(Auth::user()->id == $users[$i]->id)
                            <span class="description"><a href="/home">{{$users[$i]->name}}</a></span>
                        @else
                            <span class="description"><a href="visit/{{$users[$i]->id}}">{{$users[$i]->name}}</a></span>
                        @endif
                        <span class="username">{{$songs[$i]->title}}</span>
                    </div>
                    
                </div>
                <div class="box-body" style="background: #f4fcff;" align="center">
                    
                        <iframe width="600" height="350" align="center" src={{$songs[$i]->url}}  allowfullscreen></iframe><br/>
                    
                </div>
                <div class="box-footer">
                    <a href="/song/{{$songs[$i]->id}}" class="btn btn-primary pull-right" style="padding-top: 5px;">Ver más</a>
                    <form method="POST" action="{{action('SongsController@like')}}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
                        <input type="hidden" name="id" value="{{ $songs[$i]->id }}"></input>
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-thumbs-o-up"></i> Me gusta
                        </button>
                        <span class="text-muted">{{$songs[$i]->likes}} me gustas</span>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
    @endfor
    

@endsection