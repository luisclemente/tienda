@extends('layouts.app')
@section('title', 'Registrar nuevo producto')
@section('body-class', 'profile-page sidebar-collapse')
@section('content')

    <!-------                               VISTA FORM CREATE PRODUCT                                     ----------->
    <div class="page-header header-filter" data-parallax="true"
         style="background-image: url('{{ asset ('img/profile_city.jpg') }}')">
    </div>
    <div class="main main-raised">
        <div class="container">
            <div class="section text-center">
                <h2 class="title">Registrar nuevo producto</h2>
               @include('partials.errors')

            <!-------    FORM  |  CREAR NUEVO PRODUCTO    ----------->
                <form action="{{ route('product_store') }}" method="post">
                    @csrf
                    <div class="row">

                        <!-------    NOMBRE    ----------->
                        <div class="col-sm-9">
                            <div class="form-group label-floating">
                                <label class="control-label">Nombre del producto</label>
                                <input type="text" class="form-control" name="name"
                                       value="{{ old('name') }}">
                            </div>
                        </div>

                        <!-------   PRECIO   ----------->
                        <div class="col-sm-3">
                            <div class="form-group label-floating">
                                <label class="control-label">Precio del producto</label>
                                <input type="number" class="form-control" name="price"
                                       value="{{ old('description') }}">
                            </div>
                        </div>

                    </div>
                    <div class="row">

                        <!-------  DESCRIPCIÓN    ----------->
                        <div class="col-sm-9">
                            <div class="form-group label-floating">
                                <label class="control-label">Descripción corta</label>
                                <input type="text" class="form-control" name="description"
                                       value="{{ old('description') }}"
                                >
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="form-group label-floating">
                                <label class="control-label">Stock</label>
                                <input type="number" class="form-control" name="stock"
                                       value="{{ old('stock') }}"
                                >
                            </div>
                        </div>

                        <!-------   CATEGORY   ----------->
                        <div class="col-sm-3">
                            <div class="form-group label-floating">
                                <label class="control-label" for="select">Categoría</label>
                                <select name="category_id" id="select" class="form-control">
                                    {{--<option value="1">General</option>--}}
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-------   DESCRIPCIÓN LARGA   ----------->
                        <div class="col-sm-12">
                            <div class="form-group label-floating">
                                <label class="control-label" for="textarea">Descripcion extensa del producto</label>
                                <textarea class="form-control" rows="5" id="textarea"
                                          name="long_description">{{ old('long_description') }}</textarea>

                                <!--------   'REGISTRAR PRODUCTO' | 'CANCELAR'   -------->
                                <button class="btn btn-primary">Registrar producto</button>
                                <a href="{{ route ('admin_products_index') }}" class="btn btn-default">Cancelar</a>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
    @include ('partials.footer')
@endsection

