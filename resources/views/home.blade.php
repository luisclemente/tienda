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
                        <a class="nav-link active" href="{{ route ('home') }}">
                            <i class="material-icons">dashboard</i>
                            Carrito de compras
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route ('pending_cart') }}">
                            <i class="material-icons">list</i>
                            Pedidos realizados
                        </a>
                    </li>
                </ul>
                <hr>
                @if(auth()->user ()->cart->details->count() == 1)
                    <p>Tu carrito de compras presenta {{ auth()->user ()->cart->details->count() }} producto</p>
                @else
                    <p>Tu carrito de compras presenta {{ auth()->user ()->cart->details->count() }} productos</p>
                @endif
                <table class="table">
                    <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="col-md-2">Nombre</th>
                        <th class="text-right">Precio</th>
                        <th class="text-right">Cantidad</th>
                        <th class="text-right">Subtotal</th>
                        <th class="text-right">Modificar</th>
                        <th class="text-right">Opciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach(auth()->user()->cart->details as $detail )
                        <tr>
                            <td class="text-center">
                                <img src="{{ $detail->product->featured_image_url }}" height="50">
                            </td>
                            <td>
                                <a href="{{ route ('product_show', $detail->product->id) }}"
                                   target="_blank">{{ $detail->product->name }}</a>
                            </td>
                            <td class="text-right">&euro; {{ $detail->product->price }}</td>
                            <td class="text-right">{{ $detail->quantity }}</td>
                            <td class="text-right">&euro;{{ $detail->quantity * $detail->product->price}}</td>
                            <td class="td-actions text-right">
                                <form action="{{ route ('cartDetail_update', $detail) }}" method="post"
                                      class="">
                                    @csrf
                                    <div class="btn-group-vertical">
                                        <button type="submit" name="anadir"
                                                rel="tooltip" class="btn btn-success btn-sm" title="Añadir unidad">
                                            <i class="material-icons">add</i>
                                        </button>
                                        <button type="submit" name="quitar"
                                                rel="tooltip" class="btn btn-warning btn-sm" title="Quitar unidad">
                                            <i class="material-icons">remove</i>
                                        </button>
                                    </div>
                                </form>
                            </td>
                            <td class="td-actions text-right">
                                <form method="post" class=""
                                      action="{{ route ('cart_destroy', $detail->id ) }}">
                                    @csrf
                                    @method('delete')
                                    <a href="{{ route ('product_show', $detail->product->id) }}"
                                       target="_blank" rel="tooltip" class="btn btn-info btn-sm" title="Ver producto">
                                        <i class="fa fa-info"></i>
                                    </a>
                                    <button type="submit" rel="tooltip" class="btn btn-danger btn-sm" title="Eliminar">
                                        <i class="material-icons">delete_forever</i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <form action="{{ route ('place_order') }}" method="post">
                    @csrf
                    <button class="btn btn-primary btn-round">
                        <i class="material-icons">done</i>Realizar pedido
                    </button>
                </form>
            </div>
        </div>
    </div>
    @include ('partials.footer')
@endsection


