@extends('layouts.app')
@section('title', 'Tienda Luis | Dashboard')
@section('body-class', 'profile-page sidebar-collapse')
@section('content')
    <div class="page-header header-filter" data-parallax="true"
         style="background-image: url('{{ asset ('img/profile_city.jpg') }}')">
    </div>
    <div class="main main-raised">
        <div class="container">
            <div class="section text-center">
                <h2 class="title">Dashboard</h2>
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <ul class="nav nav-pills nav-pills-icons" role="tablist">
                    <!--
                        color-classes: "nav-pills-primary", "nav-pills-info", "nav-pills-success", "nav-pills-warning","nav-pills-danger"
                    -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route ('home') }}">
                            <i class="material-icons">dashboard</i>
                            Carrito de compras
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route ('home') }}">
                            <i class="material-icons">list</i>
                            Pedidos realizados
                        </a>
                    </li>
                </ul>
                <hr>
                @foreach(auth()->user()->cart_pending as $cart_pending )
                    @if($cart_pending->details->count() == 1)
                        <p class="text-success display-4">Carrito pendiente con {{ $cart_pending->details->count() }}
                            producto</p>
                    @else
                        <p class="text-success display-4">Carrito pendiente con {{ $cart_pending->details->count() }}
                            productos</p>
                    @endif

                    <table class="table">
                        <thead>
                        <tr>
                            <th class="text-center">Carrito</th>
                            <th class="col-md-2">Nombre</th>
                            <th class="text-right">Precio</th>
                            <th class="text-right">Cantidad</th>
                            <th class="text-right">Subtotal</th>
                            <th class="text-right">Opciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($cart_pending->details as $detail )
                            <tr>
                                <td class="text-center">
                                    <img src="{{ $detail->product->featured_image_url }}" height="50">
                                </td>
                                <td>
                                    <a href="{{ route ('product_show', $detail->product->id) }}"
                                       target="_blank">{{ $detail->product->name }}</a>
                                </td>
                                <td class="text-right">&euro; {{ $detail->price }}</td>
                                <td class="text-right">{{ $detail->quantity }}</td>
                                <td class="text-right">&euro;{{ $detail->subtotal}}</td>
                                <td class="td-actions text-right">
                                    <form method="post" class=""
                                          action="{{ route ('cart_destroy', $detail->id ) }}">
                                        @csrf
                                        @method('delete')
                                        <a href="{{ route ('product_show', $detail->product->id) }}"
                                           target="_blank" rel="tooltip" class="btn btn-info btn-sm"
                                           title="Ver producto">
                                            <i class="fa fa-info"></i>
                                        </a>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <hr>
                @endforeach
            </div>
        </div>
    </div>
    @include ('partials.footer')
@endsection


