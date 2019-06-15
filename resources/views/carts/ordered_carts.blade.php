@extends('layouts.app')
@section('title', 'Tienda Luis | Dashboard')
@section('body-class', 'profile-page sidebar-collapse')
@section('content')

    <!-------        VISTA DASHBOARD/PEDIDOS REALIZADOS  |   MUESTRA LOS CARRITOS PENDIENTES               ----------->

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

                    <!-------   BUTTON 'CARRITO DE COMPRAS'   ----------->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route ('home') }}">
                            <i class="material-icons">dashboard</i>
                            Carrito de compras
                        </a>
                    </li>

                    <!-------   BUTTON 'PEDIDOS REALIZADOS'   ----------->
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route ('home') }}">
                            <i class="material-icons">list</i>
                            Pedidos realizados
                        </a>
                    </li>

                </ul>
                <hr>
                @foreach(auth()->user()->cart_pending as $cart_pending )

                <!-------   CART TEXT-INFO   ----------->
                    <p class="text-success display-4">
                        @if($cart_pending->details->count() == 1)
                            Carrito pendiente con 1 producto
                        @else
                            Carrito pendiente con {{ $cart_pending->details->count() }} productos
                        @endif
                    </p>

                    <!-------  PENDING-CARTS TABLE   ----------->
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

                                <!-------   NOMBRE-ENLACE AL PRODUCTO   ----------->
                                <td>
                                    <a href="{{ route ('product_show', $detail->product) }}"
                                       target="_blank">{{ $detail->product->name }}</a>
                                </td>

                                <td class="text-right">&euro; {{ $detail->price }}</td>
                                <td class="text-right">{{ $detail->quantity }}</td>
                                <td class="text-right">&euro;{{ $detail->subtotal}}</td>
                                <td class="td-actions text-right">

                                    <!-------   BUTTON INFO  ----------->
                                    <a href="{{ route ('product_show', $detail->product->id) }}"
                                       target="_blank" rel="tooltip" class="btn btn-info btn-sm"
                                       title="Ver producto">
                                        <i class="fa fa-info"></i>
                                    </a>

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


