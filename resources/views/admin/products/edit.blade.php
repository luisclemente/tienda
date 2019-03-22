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
                <h2 class="title">Editar producto</h2>
                <form action="{{ url ('admin/products/' . $product->id . '/update') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-sm-9">
                            <div class="form-group label-floating">
                                <label class="control-label">Nombre del producto</label>
                                <input type="text" class="form-control" name="name" value="{{ $product->name }}">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group label-floating">
                                <label class="control-label">Precio del producto</label>
                                <input type="number" step="0.01" class="form-control" name="price" value="{{ $product->price }}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group label-floating">
                        <label class="control-label">Descripción corta</label>
                        <input type="text" class="form-control" name="description" value="{{ $product->description }}">
                    </div>
                    <textarea class="form-control" placeholder="Descripcion extensa del producto"
                              rows="5" name="long_description">{{ $product->long_description }}</textarea>
                    <button class="btn btn-primary">Guardar cambios</button>
                    <a href="{{ url('admin/products') }}" class="btn btn-default">Cancelar</a>
                </form>
            </div>
        </div>
    </div>
    @include ('partials.footer')
@endsection

