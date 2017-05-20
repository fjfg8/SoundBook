@extends('adminlte::page')

@section('content')


@forelse($songs as $song)
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="box box-primary">
                <div class="box-header with-border" style="background: #f4fcff;">
                <span class="text-muted pull-right">{{$song->created_at}}</span>
                    <div class="user-block">
                        <img class="img-circle" src="{{$users[$i]->image}}" alt="User Image">
                        @if(Auth::user()->id == $users[$i]->id)
                            <span class="description"><a href="/home">{{$users[$i]->name}}</a></span>
                        @else
                            <span class="description"><a href="visit/{{$users[$i]->id}}">{{$users[$i]->name}}</a></span>
                        @endif
                        <span class="username">{{$song->title}}</span>
                    </div>
                    
                </div>
                <div class="box-body" style="background: #f4fcff;">
                    <div class="col-md-6" align="center">
                        <div class="embed-responsive embed-responsive-16by9">
                            <iframe class="embed-responsive-item" src="{{$song->url}}" allowfullscreen></iframe><br/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label>Título: {{$song->title}} </label><br/>
                        <label>Artista: {{$song->artist}} </label><br/>
                        <label>Género: </label>
                        @foreach($types as $t)
                            @if($t->id == $song->type_id)
                                <label>{{$t->type}} </label><br/>
                            @endif
                        @endforeach
                    </div>
                </div>
                <div class="box-footer">
                    <a href="/song/{{$song->id}}" class="btn btn-primary pull-right" style="padding-top: 5px;">Ver más</a>
                    <form method="POST" action="{{action('SongsController@like')}}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
                        <input type="hidden" name="id" value="{{ $song->id }}"></input>
                        @if($liked[$i] == false)
                            <button type="submit" class="btn btn-primary btn-xs">
                                <i class="fa fa-thumbs-o-up"></i> Me gusta
                            </button>
                        @else
                            <label>Ya te gusta</label>
                        @endif
                        <span class="text-muted">&nbsp&nbsp{{$likes[$i]}} me gustas</span>
                    </form>
                    
                </div>
            </div>
        </div><p style="color: #f4fcff; align: right">{{$i++}}</p>
    </div>

@empty
    <div class="alert alert-info">
        <strong>No tienes ninguna canción</strong>
    </div>
@endforelse

@endsection