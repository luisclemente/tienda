@extends('layouts.app')
@section('title', 'Bienvenido a Tienda Luis')
@section('body-class', 'profile-page sidebar-collapse')
@section('content')
    <div class="page-header header-filter" data-parallax="true"
         style="background-image: url('{{ asset ('img/profile_city.jpg') }}')">
    </div>
    <div class="main main-raised">
        <div class="container">
            <div class="section text-center">
                <h2 class="title">Registrar nueva categoría</h2>
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ url('/admin/categories') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-sm-9">
                            <div class="form-group label-floating">
                                <label class="control-label">Nombre de la categoría</label>
                                <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <label class="control-label">Imagen de la categoría</label>
                            <input type="file" name="image">
                        </div>
                    </div>
                    <textarea class="form-control" placeholder="Descripción de la categoría"
                              rows="5" name="description">{{ old('description') }}</textarea>
                    <button class="btn btn-primary">Registrar categoría</button>
                    <a href="{{ url ('/admin/categories') }}" class="btn btn-default">Cancelar</a>
                </form>
            </div>
        </div>
    </div>
    @include ('partials.footer')
@endsection

