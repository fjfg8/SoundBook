@extends('adminlte::login')

@section('body')

    <div class="login-box">
        <div class="login-logo">
            <p href="{{ url(config('adminlte.dashboard_url', 'home')) }}">{!! config('adminlte.logo', '<b>Sound</b>Book') !!}</a>
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body">
            <p class="login-box-msg">Introduce tus datos para iniciar sesion</p>
            <form action="{{ route('login') }}" method="post">{!! csrf_field() !!}
                <div class="form-group has-feedback {{ $errors->has('email') ? 'has-error' : '' }}">
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}"
                           placeholder="Email">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group has-feedback {{ $errors->has('password') ? 'has-error' : '' }}">
                    <input type="password" name="password" class="form-control"
                           placeholder="Contraseña">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
                <!-- <div class="row">
                     <div class="col-xs-8">
                        <div class="checkbox icheck">
                            <label>
                                <input type="checkbox" name="remember"> Recuerdame
                            </label>
                        </div>
                    </div> -->
                <button type="submit" class="btn btn-primary btn-block btn-flat">Iniciar Sesión</button>
                    <!--<div class="col-xs-5">
                        <button type="submit"class="btn btn-primary btn-block btn-flat">Iniciar Sesión</button>
                    </div> 
                </div>-->
            </form>
            <div class="auth-links">
                <br>
                    <a href="/register" class="text-center">Si aun no tienes una cuenta registrate aquí</a>
            </div>
        </div>
        <!-- /.login-box-body -->
    </div><!-- /.login-box -->
@stop