@extends('layouts.app')
@section('title', $product->name)
@section('body-class', 'profile-page sidebar-collapse')


<!------------------------  VISTA DE UN PRODUCTO CON BOTÓN PARA AÑADIRLO AL CART  ----------------------------------->

@section('content')
    <div class="page-header header-filter" data-parallax="true"
         style="background-image: url('{{ asset('img/city-profile.jpg') }}');"></div>
    <div class="main main-raised">
        <div class="profile-content">
            <div class="container">

                <!---------  IMAGEN DEL PRODUCTO ----------->
                <div class="row">
                    <div class="col-md-6 ml-auto mr-auto text-center">
                        <div class="profile">
                            <div class="avatar">
                                <img src="{{ $product->featured_image_url }}" alt="Circle Image"
                                     class="img-raised rounded-circle img-fluid">
                            </div>
                        </div>
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                    </div>
                </div>

                <!---------  INFO: NOMBRE, CATEGORÍA Y DESCRIPCIÓN DEL PRODUCTO  ----------->
                <div class="name text-center">
                    <h3 class="title">{{ $product->name }}</h3>
                    <h6>{{ $product->category->name }}</h6>
                    <div class="description text-center">
                        <p>{{ $product->long_description }}</p>
                    </div>
                </div>

                <!--------- LÓGICA DEL BOTÓN: AÑADIR AL CARRITO // IR AL CARRITO  // NO QUEDAN UNIDADES ----------->
                @auth
                    @if( ! $productInCart )
                        <div class="text-center">
                            @if($product->stock == 0)
                                <button class="btn btn-primary btn-round">
                                    <i class="material-icons"></i>
                                    No quedan unidades
                                </button>
                            @else
                                <button class="btn btn-primary btn-round" data-toggle="modal"
                                        data-target="#modalAddtoCart">
                                    <i class="material-icons">add</i>
                                    Añadir al carrito de compras
                                </button>
                            @endif
                        </div>
                    @else
                        <div class="text-center">
                            <a class="btn btn-primary btn-round" href="{{ route ('home') }}">
                                <i class="material-icons">add</i>
                                Este producto ya está en tu carrito. Pulsa para modificar la cantidad
                            </a>
                        </div>
                    @endif
                @else
                    <div class="text-center">
                        <a class="btn btn-primary btn-round" href="{{ route ('login') }}">
                            <i class="material-icons">add</i>
                            Añadir al carrito de compras
                        </a>
                    </div>
                @endauth

            <!--------- IMAǴENES DEL PRODUCTO ----------->
                <div class="text-center gallery">
                    <div class="row">
                        <div class="col-md-3 ml-auto">
                            @foreach($imagesLeft as $image)
                                <img src="{{ $image->url }}" class="rounded">
                            @endforeach
                        </div>
                        <div class="col-md-3 mr-auto">
                            @foreach($imagesRight as $image)
                                <img src="{{ $image->url }}" class="rounded">
                            @endforeach
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalAddtoCart" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        Seleccione una cantidad | Stock: {{ $product->stock }}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route ('cartDetail_store') }}" method="post">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="hidden" name="price" value="{{ $product->price }}">
                    <input type="hidden" name="product_stock" value="{{ $product->stock }}">
                    @auth
                        <input type="hidden" name="cart_id" value="{{ auth ()->user ()->cart->id }}">
                    @endauth

                    <div class="modal-body">
                        <input type="number" name="quantity" value="1" class="form-control">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Añadir al carrito</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @include('partials.footer')
@endsection