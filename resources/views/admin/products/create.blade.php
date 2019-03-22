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
                <h2 class="title">Registrar nuevo producto</h2>
                <form action="{{ url('admin/products') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-sm-9">
                            <div class="form-group label-floating">
                                <label class="control-label">Nombre del producto</label>
                                <input type="text" class="form-control" name="name">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group label-floating">
                                <label class="control-label">Precio del producto</label>
                                <input type="number" class="form-control" name="price">
                            </div>
                        </div>
                    </div>
                    <div class="form-group label-floating">
                        <label class="control-label">Descripción corta</label>
                        <input type="text" class="form-control" name="description">
                    </div>
                    <textarea class="form-control" placeholder="Descripcion extensa del producto"
                              rows="5" name="long_description"></textarea>
            </div>
            <button class="btn btn-primary">Registrar producto</button>
            </form>
        </div>
    </div>
    @include ('partials.footer')
@endsection

