@extends('adminlte::page')

@section('content')

<div class="row">
    <div class="col-md-3">
    </div>
    <div class="col-md-6">
        <div class="box box-widget widget-user">
            <div class="widget-user-header bg-aqua-active"> 
                @if($bool == true)
                    <form method="POST" action="{{action('UsersController@unfollow')}}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
                        <input type="hidden" name="_method" value="DELETE"></input>
                        <input type="hidden" name="user" value="{{ $user->id }}"></input>
                        <button type="submit" class="btn btn-primary pull-right">Unfollow</button>
                    </form>
                @else
                    <form method="POST" action="{{action('UsersController@follow')}}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
                        <input type="hidden" name="_method" value="PUT"></input>
                        <input type="hidden" name="user" value="{{ $user->id }}"></input>
                        <button type="submit" class="btn btn-primary pull-right">Follow</button>
                    </form>
                @endif
                <h2 class="widget-user-desc">{{$user->nick}}</h2>
                <a href="#perfil" class="btn btn-warning pull-right" data-toggle="collapse">Mostrar detalles</a>
                <h4 class="widget-user-name">{{$user->name}} </h4>
                
            </div>
            
            <div class="widget-user-image">
                <img class="img-circle" src="{{$user->image}}" alt="UserAvatar">
            </div>
            
            <div class="box-footer">
                <div class="row" align="center">
                    <div class="col-md-4 border-right">
                        <div class="description-block">
                            <h5 class="description-header">{{sizeof($songs)}}</h5>
                            <span class="description-text">Canciones</span>
                        </div>
                    </div>
                    <div class="col-md-4 border-right">
                        <div class="description-block">
                            <h5 class="description-header">{{$followers}}</h5>
                            <span class="description-text"><a href="/home/follow">Seguidores</a></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="description-block">
                            <h5 class="description-header">{{$follow}}</h5>
                            <span class="description-text"><a href="/home/follow">Siguiendo</a></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box-footer collapse" id="perfil" align="center">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Nick:</label>
                        <text>{{$user->nick}}</text>
                    </div>
                    <div class="form-group">
                        <label>Estado:</label>
                        <text>{{$user->status}}</text>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Nombre:</label>
                        <text>{{$user->name}}</text>
                    </div>
                    <div class="form-group">
                        <label>Email:</label>
                        <text>{{$user->email}}</text>
                    </div>
                    
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Genero:</label>
                        <text>{{$user->gender}}</text>
                    </div>
                    <div class="form-group" >
                        <label>Preferencias:</label>
                        <text>{{$user->preferences}}</text>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
    </div>
</div>

<div class="row">
    <div class="col-md-2">
    </div>
    <div class="col-md-8">
        <div class="box box-primary">
            <div class="box-header with-border" align="center">
                <h2 class="box-title with-border">Mis canciones</h2>
                <a class="btn btn-success pull-right" data-toggle="modal" data-target="#upload_song">Subir canción</a>
            </div>
            <div class="box-body">
                @forelse($songs as $song)
                    <div class="box box-primary">
                        <div class="box-header with-border" style="background: #f4fcff;">
                        <span class="text-muted pull-right">{{$song->created_at}}</span>
                            <div class="user-block">
                                <img class="img-circle" src="http://icon-icons.com/icons2/663/PNG/512/note_icon-icons.com_60189.png" alt="Song Image">
                                <span class="description" color="blue"><a href="/song/{{$song->id}}">{{$song->title}}</a></span>
                                <span class="username">{{$song->artist}}</span>
                            </div>
                            
                        </div>
                        <div class="box-body" style="background: #f4fcff;">
                            <div class="col-md-6" align="center">
                                <div class="embed-responsive embed-responsive-16by9">
                                    <iframe class="embed-responsive-item" src="{{$song->url}}" allowfullscreen></iframe><br/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label>Artista: {{$song->artist}} </label><br/>
                                <label>Fecha: {{$song->date}}</label></br>
                            </div>
                        </div>
                        <div class="box-footer" style="background: #f4fcff;">
                            <span class="pull-left">&nbsp;</span>

                            <a href="/song/{{$song->id}}" class="btn btn-primary pull-right" style="padding-top: 5px;">Ver más</a>
                        </div>
                    </div>
                @empty
                    <div class="alert alert-info">
                        <strong>No tiene ninguna canción</strong>
                    </div>
                @endforelse
                {{ $songs->links() }}
            </div>
            <div class="box-footer">

            </div>
        </div>
    </div>
</div>

@endsection

