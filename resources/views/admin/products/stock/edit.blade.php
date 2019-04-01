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
                <h2 class="title">Editar stock</h2>
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route ('stock_update', $product ) }}" method="post">
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
                                <label class="control-label">Stock del producto</label>
                                <input type="number" step="1" class="form-control" name="stock"
                                       value="{{ old('stock', $product->stock) }}">
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                            <button class="btn btn-primary" type="submit">Guardar cambios</button>
                            <a href="{{ route('admin_products_index') }}" class="btn btn-default">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @include ('partials.footer')
@endsection

