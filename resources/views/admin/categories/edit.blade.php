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
                <h2 class="title">Editar categoría</h2>
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ url ('admin/categories/' . $category->id . '/update') }}"
                      method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-sm-7">
                            <div class="form-group label-floating">
                                <label class="control-label">Nombre de la categoría</label>
                                <input type="text" class="form-control" name="name"
                                       value="{{ old('name', $category->name) }}">
                            </div>
                        </div>
                        <div class="col-sm-5">
                            <label class="control-label">Imagen de la categoría</label>
                            <input type="file" name="image">

                            @if ($category->image)
                                <p class="help-block">Subir sólo si desea reemplazar la
                                    <a href="{{ asset ('/images/categories/'. $category->image) }}">imagen actual</a>
                                </p>
                            @endif
                        </div>
                    </div>
                    <textarea class="form-control" placeholder="Descripcion de la categoría"
                              rows="5" name="description">{{ old('description', $category->description) }}</textarea>
                    <button class="btn btn-primary">Guardar cambios</button>
                    <a href="{{ url('admin/categories') }}" class="btn btn-default">Cancelar</a>
                </form>
            </div>
        </div>
    </div>
    @include ('partials.footer')
@endsection

