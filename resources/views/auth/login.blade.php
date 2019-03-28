@extends('layouts.app')
@section('body-class', 'login-page sidebar-collapse')
@section('content')
    <div class="page-header header-filter"
         style="background-image: url('{{ asset ('img/bg7.jpg') }}'); background-size: cover; background-position: top center;">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 ml-auto mr-auto">
                    <div class="card card-login">
                        <form class="form" method="post" action="{{ route('login') }}">
                            @csrf
                            <div class="card-header card-header-primary text-center">
                                <h4 class="card-title">Login</h4>
                            </div>
                            <p class="description text-center">Escribe tus datos</p>
                            <div class="card-body">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="material-icons">fingerprint</i>
                                        </span>
                                    </div>
                                    <input id="user_name" type="text" class="form-control{{ $errors->has('user_name')
                                    ? ' is-invalid'
                                    : '' }}"
                                           name="user_name"
                                           value="{{ old('user_name') }}" placeholder="User_name" autofocus>
                                </div>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                          <i class="material-icons">lock_outline</i>
                                        </span>
                                    </div>
                                    <input type="password"
                                           class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                           placeholder="Password..."
                                           name="password"
                                    >
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input"
                                               name="remember" id="remember"
                                                {{ old('remember') ? 'checked' : '' }}
                                        > Recordar Sesión
                                        <span class="form-check-sign">
                                            <span class="check"></span>
                                        </span>
                                    </label>
                                </div>
                            </div>
                            <div class="footer text-center">
                                <button type="submit" class="btn btn-primary btn-link btn-wd btn-lg">Iniciar Sesión
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @include ('partials.footer')
    </div>

@endsection
