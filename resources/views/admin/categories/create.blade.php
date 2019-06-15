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
                @include('partials.errors')

            <!---------   FORM   ----------->
                <form action="{{ route ('category_store') }}" method="post" class="form" enctype="multipart/form-data">
                    @csrf
                    <div class="row">

                        <!--------- NOMBRE ----------->
                        <div class="col-sm-9">
                            <div class="form-group label-floating">
                                <label class="control-label">Nombre de la categoría</label>
                                <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                            </div>
                        </div>

                        <!--------- IMAGEN ----------->
                        <div class="col-sm-3">
                            <label class="control-label">Imagen de la categoría</label>
                            <input type="file" name="image">
                        </div>

                        <!--------- DESCRIPCIÓN ----------->
                        <div class="col-sm-12">
                            <div class="form-group label-floating">
                                <label class="control-label" for="textarea">Descripción de la categoría</label>
                                <textarea class="form-control" rows="5" name="description">
                                    {{ old('description') }}
                                </textarea>

                                <!---------   BUTTONS   ----------->
                                <button class="btn btn-primary">Registrar categoría</button>
                                <a href="{{ route ('admin_categories_index') }}" class="btn btn-default">Cancelar</a>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
    @include ('partials.footer')
@endsection

