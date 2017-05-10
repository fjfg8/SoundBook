@extends('adminlte::register')

@section('body')
    <div class="register-box">
        <div class="register-logo">
            <a href="{{ url(config('adminlte.dashboard_url', 'home')) }}"><b>Regístrate</b></a>
        </div>

        <div class="register-box-body">
            <p class="login-box-msg">Introduce tus datos para registrarte</p>
            <form action="{{ route('register') }}" method="post">{!! csrf_field() !!}
                <div class="form-group has-feedback {{ $errors->has('nick') ? 'has-error' : '' }}">
                    <input type="text" name="nick" class="form-control" value="{{ old('nick') }}"
                           placeholder="Nombre de usuario" required>
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    @if ($errors->has('nick'))
                        <span class="help-block">
                            <strong>{{ $errors->first('nick') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group has-feedback {{ $errors->has('name') ? 'has-error' : '' }}">
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}"
                           placeholder="Nombre completo" required>
                    <span class="glyphicon glyphicon-font form-control-feedback"></span>
                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group has-feedback {{ $errors->has('email') ? 'has-error' : '' }}">
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}"
                           placeholder="Email" required>
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group has-feedback {{ $errors->has('password') ? 'has-error' : '' }}">
                    <input id="password" type="password" name="password" class="form-control"
                           placeholder="Contraseña" required>
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group has-feedback {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
                    <input id="password-confirm" type="password" name="password_confirmation" class="form-control"
                           placeholder="Confirma de nuevo la contraseña" required>
                    <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
                    @if ($errors->has('password_confirmation'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                        </span>
                    @endif
                </div>

                <button type="submit" class="btn btn-primary btn-block btn-flat">Regístrate</button>

                <div class="auth-links">
                    <a href="/login" class="text-center">Ya me he registrado</a>
                </div>
            </form>
            
        </div>
        <!-- /.form-box -->
    </div><!-- /.register-box -->
@stop