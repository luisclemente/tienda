@extends('layouts.app')
@section('title', 'Imágenes de productos')
@section('body-class', 'profile-page sidebar-collapse')
@section('content')

    <!-------                         LISTADO DE IMÁGENES DE UN PRODUCTO                                  ----------->

    <div class="page-header header-filter" data-parallax="true"
         style="background-image: url('{{ asset ('img/profile_city.jpg') }}')">
    </div>
    <div class="main main-raised">
        <div class="container">
            <div class="section text-center">
                <h2 class="title">Imágenes del producto "{{ $product->name }}"</h2>
                {{-- El action no necesita ruta ya que cuando estamos en esta vista la ruta es identica a la ruta
                    update, solo que ésta tiene el verbo post --}}

            <!-------  FORM   /   SUBIR UNA NUEVA IMÁGEN AL PRODUCTO ----------->
                <form action="" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="photo" required>

                    <!-------  BUTTONS 'SUBIR NUEVA IMAGEN' Y 'VOLVER AL LISTADO DE PRODUCTOS'   ----------->
                    <button type="submit" class="btn btn-primary btn-round">Subir nueva imágen</button>
                    <a href="{{ route ('admin_products_index') }}" class="btn btn-default btn-round">
                        Volver al listado de productos
                    </a>
                </form>

                <hr>
                <div class="row">
                    @foreach( $images as $image )
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <img src="{{ $image->url }}" alt="">

                                    <!-------  FORM    /   ELIMINAR IMAGEN  ----------->
                                    <form action="" method="post">
                                        @csrf
                                        @method('delete')
                                        <input type="hidden" name="image_id" value="{{ $image->id }}">
                                        <button type="submit" class="btn btn-danger btn-round">Eliminar imagen</button>

                                        @if($image->featured)
                                            <button type="button"
                                                    class="btn btn-info btn-fab btn-fab-mini btn-round"
                                                    rel="tooltip" title="Imagen destacada de este producto">
                                                <i class="material-icons">favorite</i>
                                            </button>
                                        @else
                                            <a href="{{ route ('product_image_featured', [ $product, $image ]) }}"
                                               class="btn btn-primary btn-fab btn-fab-mini btn-round"
                                               rel="tooltip" title="Destaca esta imágen">
                                                <i class="material-icons">favorite</i>
                                            </a>
                                        @endif
                                    </form>

                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    @include ('partials.footer')
@endsection

