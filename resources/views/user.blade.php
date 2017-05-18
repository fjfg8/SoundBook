@extends('adminlte::page')

@section('content')

<div class="box box-primary">
    <div class="box-header with-border" align="center">
        <h2 class="box-title with-border">Mi perfil</h2>
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
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Nick:</label>
                    <text>{{$user->nick}}</text>
                </div>
                <div class="form-group">
                    <label>Nombre:</label>
                    <text>{{$user->name}}</text>
                </div>
                <div class="form-group">
                    <label>Email:</label>
                    <text>{{$user->email}}</text>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Genero:</label>
                    <text>{{$user->gender}}</text>
                </div>
                <div class="form-group">
                    <label>Estado:</label>
                    <text>{{$user->status}}</text>
                </div>
                <div class="form-group" >
                    <label>Preferencias:</label>
                    <text>{{$user->preferences}}</text>
                </div>
            </div>
        </div>
    </div>
    <div class="box-footer">
        <div class="col-md-6">
            <div class="form-group">
                <label>Seguidos:</label>
                <text>{{$follow}}</text>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Seguidores:</label>
                <text>{{$followers}}</text>
            </div>
        </div>
    </div>
</div>

<div class="box box-primary">
    <div class="box-header with-border" align="center">
        <h2 class="box-title with-border">Mis canciones</h2>
    </div>
    <div class="box-body">
        @forelse($songs as $song)
            <div class="box box-primary">
                <div class="box-header with-border" style="background: #f4fcff;" align="center">
                    <h2 class="box-title with-border">{{$song->title}}</h2>
                </div>
                <div class="box-body" style="background: #f4fcff;">
                    <div class="col-md-5">
                        <iframe width="250" height="200" align="center" src = {{$song->url}}  allowfullscreen></iframe><br/>
                    </div>
                    <div class="col-md-5">
                        <label>Artista: </label><text> {{$song->artist}} </text><br/>
                        <label>Fecha: </label><text> {{$song->date}}</text><br/><br/>
                        <a href="/song/{{$song->id}}" class="btn btn-primary" style="padding-top: 5px;">Ver más</a>
                    </div>
                </div>
                <div class="box-footer" style="background: #f4fcff;">
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

@endsection
