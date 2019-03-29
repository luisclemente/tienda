@extends('layouts.app')

@section('title', $product->name)

@section('body-class', 'profile-page sidebar-collapse')

@section('content')
    <div class="page-header header-filter" data-parallax="true"
         style="background-image: url('{{ asset('img/city-profile.jpg') }}');"></div>
    <div class="main main-raised">
        <div class="profile-content">
            <div class="container">
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
                <div class="name text-center">
                    <h3 class="title">{{ $product->name }}</h3>
                    <h6>{{ $product->category->name }}</h6>
                </div>
                <div class="description text-center">
                    <p>{{ $product->long_description }}</p>
                </div>
                @foreach(auth()->user()->cart->details as $detail )
                    @if ($detail->product_id == $product->id)
                        {{ $contador++ }}
                    @endif
                @endforeach
                @if($contador == 0)
                    <div class="text-center">
                        <button class="btn btn-primary btn-round" data-toggle="modal" data-target="#modalAddtoCart">
                            <i class="material-icons">add</i> Añadir al carrito de compras
                        </button>
                    </div>
                @else
                    <div class="text-center text-danger">
                        <p>Este producto está añadido a tu carrito</p>
                    </div>
                @endif
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
                    <h5 class="modal-title" id="exampleModalLabel">Seleccione una cantidad</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route ('cartDetail_store') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <input type="number" name="quantity" value="1" class="form-control">
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
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