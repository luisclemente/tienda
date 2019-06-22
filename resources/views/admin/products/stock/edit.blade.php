@extends('layouts.app')
@section('title', 'Bienvenido a Tienda Luis')
@section('body-class', 'profile-page sidebar-collapse')
@section('content')

    <!-------                           VISTA FORM EDITAR STOCK                                 ----------->

    <div class="page-header header-filter" data-parallax="true"
         style="background-image: url('{{ asset ('img/profile_city.jpg') }}')">
    </div>
    <div class="main main-raised">
        <div class="container">
            <div class="section text-center">
                <h2 class="title text-danger" >Editar stock para el producto: </h2>
                <h2 class="title" > {{ $product->name }}</h2>
               @include('partials.errors')

            <!-------    FORM   /   EDITAR STOCK      ----------->
                <form action="{{ route ('stock_update', $product ) }}" method="post">
                    @csrf
                    <input type="hidden" name="previous_url" value="{{ URL::previous () }}">
                    <div class="row">

                        <!--------   STOCK   -------->
                        <div class="col-sm-4 mx-auto">
                            <div class="form-group label-floating">
                                <label class="control-label">Stock del producto</label>
                                <input type="number" step="1" class="form-control" name="stock"
                                       value="{{ old('stock', $product->stock) }}"
                                >
                            </div>
                        </div>
                    </div>

                    <!-------    BUTTONS 'GUARDAR CAMBIOS' Y 'CANCELAR'    ----------->
                    <div class="row justify-content-center">
                            <button type="submit" class="btn btn-primary">Guardar cambios</button>
                            <a href="{{ URL::previous () }}" class="btn btn-default">Cancelar</a>
                    </div>

                </form>

            </div>
        </div>
    </div>
    @include ('partials.footer')
@endsection

