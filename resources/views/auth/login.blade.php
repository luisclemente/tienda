@extends('layouts.app')
@section('body-class', 'login-page sidebar-collapse')
@section('content')
    <div class="page-header header-filter"
         style="background-image: url('{{ asset ('img/bg7.jpg') }}'); background-size: cover; background-position: top center;">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 ml-auto mr-auto">
                    <div class="card card-login">
                        <form class="form" method="post" action="{{ route('home') }}">
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
                                    <input type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}"
                                           placeholder="Nombre de usuario"
                                           name="username" value="{{ old('username') }}" required autofocus
                                    >
                                </div>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                          <i class="material-icons">lock_outline</i>
                                        </span>
                                    </div>
                                    <input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                           placeholder="Password..."
                                           name="password" required
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
                                <button type="submit" class="btn btn-primary btn-link btn-wd btn-lg">Iniciar Sesión</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <footer class="footer">
            <div class="container">
                <nav class="float-left">
                    <ul>
                        <li>
                            <a href="https://www.creative-tim.com">
                                Creative Tim
                            </a>
                        </li>
                        <li>
                            <a href="https://creative-tim.com/presentation">
                                About Us
                            </a>
                        </li>
                        <li>
                            <a href="http://blog.creative-tim.com">
                                Blog
                            </a>
                        </li>
                        <li>
                            <a href="https://www.creative-tim.com/license">
                                Licenses
                            </a>
                        </li>
                    </ul>
                </nav>
                <div class="copyright float-right">
                    &copy;
                    <script>
                        document.write(new Date().getFullYear())
                    </script>
                    , made with <i class="material-icons">favorite</i> by
                    <a href="https://www.creative-tim.com" target="_blank">Creative Tim</a> for a better web.
                </div>
            </div>
        </footer>
    </div>

@endsection
