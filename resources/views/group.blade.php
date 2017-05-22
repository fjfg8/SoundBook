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
    <div class="box-footer box-comments">
            @forelse($publications as $publi)
                <div class="box-comment">
                    @foreach($users as $u)
                        @if($publi->user_id == $u->id)
                            <img class="img-circle img-sm" src="{{$u->image}}" alt="User Image">
                        
                            <div class="comment-text">
                                <span class="username">{{$u->nick}}
                                    <span class="text-muted pull-center"> · {{$publi->created_at}}</span>
                                    @if(Auth::user()->id == $publi->user_id || Auth::user()->isAdmin)                                        
                                        <a class="btn btn-danger btn-xs pull-right" data-toggle="modal" data-target="#delete_publi{{$publi->id}}" >Eliminar</a>
                                        <div class="modal modal-danger fade" id="delete_publi{{$publi->id}}">
                                            <form method="POST" action="{{action('PublicationController@delete')}}">
                                                <input type="hidden" name="_method" value="DELETE"></input>
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
                                                <input type="hidden" name="publication_id" value="{{$publi->id}}">
                                                <div class="modal-dialog" align="center">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">×</span>
                                                            </button>
                                                            <h4 class="modal-title">¿Estás seguro de borrar la publicación?</h4>
                                                            <p>{{$publi->title}}</p>
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

                                        <span class="pull-right">&nbsp;</span>

                                        <a class="btn btn-warning btn-xs pull-right" data-toggle="modal" data-target="#edit_publi{{$publi->id}}">Editar</a>
                                        <div class="modal modal-default fade" id="edit_publi{{$publi->id}}">
                                            <form method="POST" action="{{action('PublicationController@edit')}}">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
                                                <input type="hidden" name="_method" value="PUT">
                                                <input type="hidden" name="group" value="{{ $publi->group_id }}"></input>
                                                <input type="hidden" name="publication_id" value="{{ $publi->id }}"></input>
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header" align="center">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">×</span>
                                                            </button>
                                                            <h4 class="modal-title">Editar publicacion</h4>
                                                        </div>
                                                        <div class="modal-body" align="center">
                                                            <textarea class="formcontrol" id="titulo" name="titulo" rows="5" cols="40">{{$publi->title}}</textarea><br/>
                                                            <textarea class="formcontrol" id="publicacion" name="publicacion" rows="5" cols="40">{{$publi->description}}</textarea><br/>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
                                                            <button type="submit" class="btn btn-primary">Guardar cambios</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    @endif
                                </span>
                                <div class="box-title with-border"><strong>{{$publi->title}}</strong></div>
                                <div class="box-header" align="left">{{$publi->description}}</div>
                                </br>
                            </div>
                        @endif
                    @endforeach
                </div>   
            @empty
                <div class="alert alert-info">
                    <strong>Este grupo no contiene ninguna publicación</strong>
                </div>
            @endforelse
            {{ $publications->links() }}
        </div> 
        <div class="box-footer">
            <form action="{{action('PublicationController@create')}}" method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
                <input type="hidden" name="group" value="{{ $publi->group_id }}"></input>
                <img class="img-responsive img-circle img-sm" src="{{Auth::user()->image}}" alt="Alt Text">
                <!-- .img-push is used to add margin to elements next to floating images -->
                <div class="img-push">
                    <!-- <input type="text" id="titulo" name="titulo" class="form-control input-sm" placeholder="Presiona enter para comentar"> -->
                    <input class="form-control" placeholder="Título " id="titulo" name="titulo" rows="5" cols="40"><br/>
                    <textarea class="form-control" placeholder="Descripción de la publicación" id="publicacion" name="publicacion" rows="5" cols="40"></textarea><br/>
                    <button type="submit" class="btn btn-primary">Guardar Publicacion</button>
                    
                </div>
            </form>
        </div>
</div>







@stop