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
            <span class="description">{{$song->title}}</span>
        </div> <!-- /.user-block -->   
    </div> <!-- /.box-header -->
    
    <div class="box-body"> <!-- post text -->
        <div class="row">
            <div class="col-md-6">
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
            <span class="pull-right text-muted">{{$song->likes}} me gustas - {{sizeof($comments)}} comentarios</span>
        </form>
    </div>
    <div class="box-footer box-comments">
        @forelse($comments as $comment)
            <div class="box-comment">
                @if(Auth::user()->id == $comment->user_id || Auth::user()->isAdmin)
                    <form method="POST" action="{{action('CommentController@delete')}}">
                        <input type="hidden" name="_method" value="DELETE"></input>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
                        <input type="hidden" name="comment" value="{{$comment->id}}">
                        <button type="submit" class="btn btn-xs pull-right" style="color:#3a7cff;background:none;">
                            Eliminar
                        </button>
                        <a href="/song/{{$song->id}}/edit/{{$comment->id}}" class="btn btn-xs pull-right" style="color:#3a7cff;background:none;">Editar</a>
                    </form>
                @endif
                <img class="img-circle img-sm" src="https://maxcdn.icons8.com/Share/icon/Users//user_female_circle_filled1600.png" alt="User Image">
                <div class="comment-text">
                    <span class="username">{{$user->nick}}
                        <span class="text-muted pull-right">{{$comment->created_at}}</span>
                    </span>
                    
                    {{$comment->comment}}
                </div>
                <form method="POST" action="{{action('CommentController@like')}}" id="megusta">
                    <input type="hidden" name="_method" value="PUT"></input>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
                    <input type="hidden" name="comment" value="{{ $comment->id }}"></input>
                    <input type="hidden" name="song" value="{{ $song->id }}"></input>
                    <button type="submit" form="megusta" class="btn btn-xs" style="color:#3a7cff;background:none;">
                        Me gusta
                    </button>
                    
                    <text class="pull-right" style="color:#3a7cff">{{$comment->likes}}
                    <i class="fa fa-thumbs-o-up " aria-hidden="true" style="color:#3a7cff"></i>
                    </text>  
                </form>
            </div>
        @empty
            <div class="alert alert-info">
                <strong>La canción no tiene ningun comentario</strong>
            </div>
        @endforelse
        {{ $comments->links() }}
    </div>   
    <div class="box-footer">
        <form action="#" method="post">
            <img class="img-responsive img-circle img-sm" src="http://xacatolicos.com/app/images/icon-user.png" alt="Alt Text">
            <!-- .img-push is used to add margin to elements next to floating images -->
            <div class="img-push">
                <input type="text" class="form-control input-sm" placeholder="Presiona enter para comentar">
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

<div class="box box-primary">
    <div class="box-header with-border" style="background: #e0ecff;" align="center">
            <h2 class="box-title with-border pull-left">{{$song->title}}</h2>
            @if(Auth::user()->id == $song->user_id || Auth::user()->isAdmin)
                <a class="btn btn-primary pull-right" data-toggle="modal" data-target="#delete_song{{$song->id}}">Eliminar</a>
                <div class="modal fade" id="delete_song{{$song->id}}">
                    <form method="POST" action="{{action('SongsController@delete')}}" id="comentarioN">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
                        <input type="hidden" name="_method" value="DELETE"></input>
                        <input type="hidden" name="song" value="{{$song->id}}">
                        <br/>
                        <br/>
                        <br/>
                        <div class="panel panel-default" style="width:50%;text-align:center;margin:0 auto;">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <div class="panel-heading" style="background-color:#3c8dbc;color:#FFFFFF;">
                                <h3 class="panel-title" >¿Estás seguro de borrar la cancion {{$song->title}}?</h3>
                            </div>
                            <div class="panel-body" style="background-color:#c4deff;" align="center">
                                <div class="form-group">        
                                    <button type="submit" class="btn btn-default">Si</button> 
                                    <button type="button" data-dismiss="modal" class="btn btn-default">Cancelar</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <a class="btn btn-primary pull-right" data-toggle="modal" data-target="#edit_song{{$song->id}}">Editar</a>
                <div class="modal fade" align="center" id="edit_song{{$song->id}}">
                    <br/>
                    <form method="POST" action="{{action('SongsController@edit')}}" align="center">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
                        <input type="hidden" name="_method" value="PUT"></input>
                        <input type="hidden" name="id" value="{{$song->id}}">
                        <div class="panel panel-default" style="width:40%;">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <div class="panel-heading" style="background-color:#3c8dbc;color:#FFFFFF;">
                                <h3 class="panel-title" >Editar canción</h3>
                            </div>
                            <div class="panel-body" style="background-color:#c4deff;" >
                                <div class="form-group">
                                    <label class="control-label col-sm-4">Titulo</label>
                                    <input type="text" name="title" placeholder="{{$song->title}}">
                                    <br/>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-4">Artista</label>
                                    <input type="text" name="artist" placeholder="{{$song->artist}}">
                                    <br/>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-4">Url</label>
                                    <input type="text" name="url" placeholder="{{$song->url}}">
                                    <br/>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-4">Fecha de salida</label>
                                    <input type="text" name="date" placeholder="{{$song->date}}">
                                    <br/>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-4">Genero</label>
                                    <input type="text" name="gender" placeholder="{{$song->gender}}">
                                    <br/>
                                </div>
                                <div class="form-group">        
                                    <button type="submit" class="btn btn-default">Guardar</button> 
                                </div>
                            </div><!-- /.box-body -->
                        </div>
                    </form>
                </div>
            @endif
    </div>
    <div class="box-body" style="background: #e0ecff;">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-6">
                <iframe width="560" height="315" align="center" src={{$song->url}}  allowfullscreen></iframe>
            </div>
            <div class="col-md-2">
                <form method="POST" action="{{action('SongsController@like')}}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
                    <input type="hidden" name="id" value="{{ $song->id }}"></input>
                    <div class="info-box">
                        <span class="info-box-icon bg-blue"><i class="fa fa-star-o"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Likes</span>
                                <span class="info-box-number">{{$song->likes}}</span>
                            </div>
                            <button type="submit" id="botonL" class="btn btn-primary pull-right"><i class="glyphicon glyphicon-thumbs-up"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="box-footer" style="background: #e0ecff;">
        <div class="row">
            <div class="col-md-4">
                <label>Artista: {{$song->artist}} </label><br/>
                <label>Album: {{$song->album}}</label>
                <label> | Fecha: {{$song->date}}</label>
            </div>
        </div>
    </div>

</div>

<div class="box box-success" id="comentarios" align="center">

    <div class="box-header with-border" style="background-color:#3c8dbc;color:#FFFFFF;">
        <h2 class="box-title" >Comentarios</h2>
    </div>
    <div class="box-body" align="center" style="background-color:#c4deff;">

            @if(sizeof($comments)==0)
                <div class="alert alert-info">
                    <strong>No tienes ningun comentario</strong>
                </div>
            @endif
            @for($i=0;$i<sizeof($comments);$i++)
                <div class="panel panel-default">
                    <div class="panel-heading" style="background-color:#ef8300;">
                        <h4 align="left"></h4>
                    </div>
                    <div class="panel-body" style="background-color:#ffe4c4;" align="left">
                        <p>{{$comments[$i]->comment}}</p>
                        <form method="POST" action="{{action('CommentController@like')}}" id="comentarioN">
                            <input type="hidden" name="_method" value="PUT"></input>
                            <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
                            <input type="hidden" name="comment" value="{{ $comments[$i]->id }}"></input>
                            <input type="hidden" name="song" value="{{ $song->id }}"></input>
                            <button type="submit" id="botonL" class="btn btn-app pull-right">
                                <span class="badge bg-red">{{$comments[$i]->likes}}</span>
                                <i class="fa fa-heart-o"></i>Like
                            </button>
                        </form>     

                        @if(Auth::user()->id == $comments[$i]->user_id || Auth::user()->isAdmin)

                            <form method="POST" action="{{action('CommentController@delete')}}" id="comentarioN">
                                <input type="hidden" name="_method" value="DELETE"></input>
                                <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
                                <input type="hidden" name="comment" value="{{$comments[$i]->id}}">
                                <button type="submit" id="botonL" class="btn btn-primary pull-right">Eliminar</button>
                            </form>
                            
                            <a href="/song/{{$song->id}}/edit/{{$comments[$i]->id}}" class="btn btn-default pull-right">Editar</a>
                        @endif
                    </div> 
                    
                </div>

            @endfor
            {{ $comments->links() }}
            <form method="POST" action="{{action('CommentController@create')}}" id="otro">
                <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
                <input type="hidden" name="song" value="{{ $song->id }}"></input>
                    <div class="form-group">
                        <textarea form="otro" name="descripcion" rows="5" cols="40"></textarea><br/>
                    </div>

                    <div class="form-group">        
                            <button type="submit" id="botonL" class="btn btn-primary">Comentar</button>
                    </div>
            </form>
    </div>

</div>


@stop