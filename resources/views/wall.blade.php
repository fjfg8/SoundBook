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
                        <img class="img-circle" src="{{url($users[$i]->image)}}" alt="User Image">
                        @if(Auth::user()->id == $users[$i]->id)
                            <span class="description"><a href="/home">{{$users[$i]->name}}</a></span>
                        @else
                            <span class="description"><a href="visit/{{$users[$i]->id}}">{{$users[$i]->name}}</a></span>
                        @endif
                        <span class="username"><a href="/song/{{$song->id}}">{{$song->title}}</a></span>
                    </div>
                    
                </div>
                <div class="box-body" style="background: #f4fcff;">
                    <div class="col-md-6" align="center">
                        <div class="embed-responsive embed-responsive-16by9">
                            <iframe class="embed-responsive-item" src="{{$song->url}}" allowfullscreen></iframe><br/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label>Título: </label><text> {{$song->title}}</text><br/>
                        <label>Artista: </label><text> {{$song->artist}} </text><br/>
                        <label>Género: </label>
                        @foreach($types as $t)
                            @if($t->id == $song->type_id)
                                <text> {{$t->type}} </text><br/>
                            @endif
                        @endforeach
                    </div>
                </div>
                <div class="box-footer" style="background: #f4fcff;">
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
        </div><p style="display: none">{{$i++}}</p>
    </div>

@empty
    <div class="alert alert-info">
        <strong>No tienes ninguna canción</strong>
        <span>&nbsp;</span>
        <span>&nbsp;</span>
        <a class="btn btn-primary" data-toggle="modal" data-target="#upload_song">¡Sube una ahora!</a>
    </div>
    <div class="modal modal-default fade" id="upload_song">
        <form method="POST" action="{{action('SongsController@create')}}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
            <input type="hidden" name="user" value="{{Auth::user()->id}}"></input>
            <input type="hidden" name="_method" value="PUT"></input>
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header" align="center">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title">Subir nueva canción</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-2">
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label>Título</label></br>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-font"></i>
                                        </div>
                                        <input id="title" name="title" type="text" class="form-control" placeholder="Título">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Artista</label></br>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-user"></i>
                                        </div>
                                        <input id="artist" name="artist" type="text" class="form-control" placeholder="Artista">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Url</label></br>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-globe"></i>
                                        </div>
                                        <input id="url" name="url" type="text" class="form-control" placeholder="http://www.youtube.com/...">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Género</label></br>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-music"></i>
                                        </div>
                                        <select class="form-control select2" id="gender" name="gender">
                                            @foreach($types as $t)
                                                <option>{{$t->type}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Álbum</label></br>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-book"></i>
                                        </div>
                                        <input id="album" name="album" type="text" class="form-control" placeholder="Álbum">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Fecha de salida</label><text> (YYYY/MM/DD)</text></br>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input id="date" name="date" type="date" class="form-control" data-inputmask="'alias': 'YYYY/MM/DD'" data-mask="" placeholder="YYYY/MM/DD">
                                    </div>
                                </div>
                            </div>
                        </div>      
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Subir</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endforelse

@endsection