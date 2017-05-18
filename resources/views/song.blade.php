@extends('adminlte::page')

@section('content')


<div class="box box-widget">
    <div class="box-header with-border">
        <div class="user-block">
            @if(Auth::user()->id == $song->user_id || Auth::user()->isAdmin)
                <a class="btn btn-danger btn-sm pull-right" data-toggle="modal" data-target="#delete_song">Eliminar</a>
                <a class="btn btn-primary btn-sm pull-right" data-toggle="modal" data-target="#edit_song">Editar</a>
            @endif
            <img class="img-circle" src="http://xacatolicos.com/app/images/icon-user.png" alt="User Image">
            <span class="username"><a href="#">{{$user->name}}</a></span>
            <span class="description">{{$song->artist}} - {{$song->title}}</span>
        </div> <!-- /.user-block -->   
    </div> <!-- /.box-header -->
    
    <div class="box-body"> <!-- post text -->
        <div class="row">
            <div class="col-md-4" >
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe class="embed-responsive-item" src="{{$song->url}}" allowfullscreen></iframe>
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
                <label>Album: {{$song->album}}</label><br/>
                <label>Fecha: {{$song->date}}</label></br>
                <label>Url: </label> <a href="{{$song->url}}">{{$song->url}}</a>
            </div>
        </div>
        </br>
        <form method="POST" action="{{action('SongsController@like')}}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
            <input type="hidden" name="id" value="{{ $song->id }}"></input>
            <button type="submit" class="btn btn-primary btn-xs">
                <i class="fa fa-thumbs-o-up"></i> Me gusta
            </button>
            <span class="pull-right text-muted">{{$song->likes}} me gustas - {{$count}} comentarios</span>
        </form>
    </div>
    <div class="box-footer box-comments">
        @forelse($comments as $comment)
            <div class="box-comment">
                <img class="img-circle img-sm" src="https://maxcdn.icons8.com/Share/icon/Users//user_female_circle_filled1600.png" alt="User Image">
                <div class="comment-text">
                    <span class="username">{{$user->nick}}
                        <span class="text-muted pull-center"> · {{$comment->created_at}}</span>
                        @if(Auth::user()->id == $comment->user_id || Auth::user()->isAdmin)
                             <span class="text-muted"> ·  </span>
                            <a href="/song/{{$song->id}}/edit/{{$comment->id}}" class="btn btn-primary btn-xs">Editar</a>
                            <button data-toggle="modal" data-target="#delete_comment{{$comment->id}}" class="btn btn-danger btn-xs" >
                                Eliminar
                            </button>
                            <div class="modal modal-danger fade" id="delete_comment{{$comment->id}}">
                                <form method="POST" action="{{action('CommentController@delete')}}">
                                    <input type="hidden" name="_method" value="DELETE"></input>
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
                                    <input type="hidden" name="comment" value="{{$comment->id}}">
                                    <div class="modal-dialog" align="center">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                                <h4 class="modal-title">¿Estás seguro de borrar el comentario?</h4>
                                                <p>{{$comment->comment}}</p>
                                            </div>
                                            <div class="modal-body">
                                                <p>No podrás deshacer la acción</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cancelar</button>
                                                <button type="submit" class="btn btn-outline">Si</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>                            
                            </div>
                        @endif
                    </span>
                    {{$comment->comment}}
                </div>
                <form method="POST" action="{{action('CommentController@like')}}">
                    <input type="hidden" name="_method" value="PUT"></input>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
                    <input type="hidden" name="comment" value="{{ $comment->id }}"></input>
                    <input type="hidden" name="song" value="{{ $song->id }}"></input>
                    <button type="submit" class="btn btn-xs" style="color:#3a7cff;background:none;">
                        Me gusta
                    </button>
                    
                    <text class="pull-right" style="color:#3a7cff">{{$comment->likes}}
                        <i class="fa fa-thumbs-o-up " aria-hidden="true" style="color:#3a7cff"></i>
                    </text>  
                </form>
            </div>
        @empty
            <div class="alert alert-info">
                <strong>No hay comentarios</strong>
            </div>
        @endforelse
        {{ $comments->links() }}
    </div>   
    <div class="box-footer">
        <form action="{{action('CommentController@create')}}" method="post">
            <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
            <input type="hidden" name="song" value="{{ $song->id }}"></input>
            <img class="img-responsive img-circle img-sm" src="http://xacatolicos.com/app/images/icon-user.png" alt="Alt Text">
            <!-- .img-push is used to add margin to elements next to floating images -->
            <div class="img-push">
                <input type="text" name="descripcion" class="form-control input-sm" placeholder="Presiona enter para comentar">
            </div>
        </form>
    </div>
</div>

<div class="modal modal-danger fade" id="delete_song">
    <form method="POST" action="{{action('SongsController@delete')}}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
        <input type="hidden" name="_method" value="DELETE"></input>
        <input type="hidden" name="song" value="{{$song->id}}">
        <div class="modal-dialog" align="center">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title">¿Estás seguro de borrar la cancion {{$song->title}}?</h4>
                </div>
                <div class="modal-body">
                    <p>No podrás deshacer la acción</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-outline">Si</button>
                </div>
            </div>
        </div>
    </form>                            
</div>

<div class="modal modal-default fade" id="edit_song">
    <form method="POST" action="{{action('SongsController@edit')}}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
        <input type="hidden" name="_method" value="PUT"></input>
        <input type="hidden" name="id" value="{{$song->id}}">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" align="center">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title">Editar canción: {{$song->title}}</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Título</label></br>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-font"></i>
                                    </div>
                                    <input id="title" name="title" type="text" class="form-control" placeholder="{{$song->title}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Artista</label></br>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-user"></i>
                                    </div>
                                    <input id="artist" name="artist" type="text" class="form-control" placeholder="{{$song->artist}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Url</label></br>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-globe"></i>
                                    </div>
                                    <input id="url" name="url" type="text" class="form-control" placeholder="{{$song->url}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Género</label></br>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-music"></i>
                                    </div>
                                    <select class="form-control select2" id="type_id" name="type_id">
                                        @foreach($types as $t)
                                            @if($t->id == $song->type_id)
                                                <option selected="selected" value="{{$t->id}}">{{$t->type}}</option>
                                            @endif
                                        @endforeach
                                        @foreach($types as $t)
                                            @if($t->id != $song->type_id)
                                                <option value="{{$t->id}}">{{$t->type}}</option>
                                            @endif
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
                                    <input id="album" name="album" type="text" class="form-control" placeholder="{{$song->album}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Fecha de salida</label> <text>(YYYY/MM/DD)</text></br>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input id="date" name="date" type="date" class="form-control" data-inputmask="'alias': 'YYYY/MM/DD'" data-mask="" placeholder="{{$song->date}}">
                                </div>
                            </div>
                        </div>
                    </div>      
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar cambios</button>
                </div>
            </div>
        </div>
    </form>
</div>


@stop