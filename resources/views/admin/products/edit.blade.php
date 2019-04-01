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
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route ('product_update', $product ) }}" method="post">
                    <input type="hidden" name="paginate_product_page" value="{{ URL::previous () }}">
                    @csrf
                    <div class="row">
                        <div class="col-sm-9">
                            <div class="form-group label-floating">
                                <label class="control-label">Nombre del producto</label>
                                <input type="text" class="form-control" name="name"
                                       value="{{ old('name', $product->name) }}">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group label-floating">
                                <label class="control-label">Precio del producto</label>
                                <input type="number" step="0.01" class="form-control" name="price"
                                       value="{{ old('price', $product->price) }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-9">
                            <div class="form-group label-floating">
                                <label class="control-label">Descripción corta</label>
                                <input type="text" class="form-control" name="description"
                                       value="{{ old('description', $product->description) }}">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group label-floating">
                                <label class="control-label" for="select">Categoría</label>
                                <select name="category_id" id="select" class="form-control">
                                    <option value="0">General</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}"
                                                @if ($category->id == old('category_id', $product->category_id))
                                                selected
                                                @endif>
                                            {{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group label-floating">
                                <label class="control-label" for="textarea">Descripcion extensa del producto</label>
                                <textarea class="form-control" id="textarea" rows="5"
                                          name="long_description">{{ old('long_description', $product->long_description) }}</textarea>
                                <button class="btn btn-primary" type="submit">Guardar cambios</button>
                                <a href="{{ route('admin_products_index') }}" class="btn btn-default">Cancelar</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @include ('partials.footer')
@endsection

