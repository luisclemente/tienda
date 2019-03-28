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
                        <a class="nav-link active" href="#" role="tab" data-toggle="tab">
                            <i class="material-icons">dashboard</i>
                            Carrito de compras
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" role="tab" data-toggle="tab">
                            <i class="material-icons">list</i>
                            Pedidos realizados
                        </a>
                    </li>
                </ul>
                <hr>
                <p>Tu carrito de compras presenta {{ auth()->user ()->cart->details->count() }} productos</p>
                <table class="table">
                    <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="col-md-2">Nombre</th>
                        <th class="text-right">Precio</th>
                        <th class="text-right">Cantidad</th>
                        <th class="text-right">Subtotal</th>
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
                                <a href="{{ url('/products/' . $detail->product->id) }}"
                                   target="_blank">{{ $detail->product->name }}</a>
                            </td>
                            <td class="text-right">&euro; {{ $detail->product->price }}</td>
                            <td class="text-right">{{ $detail->quantity }}</td>
                            <td class="text-right">&euro;{{ $detail->quantity * $detail->product->price}}</td>
                            <td class="td-actions text-right">
                                <form method="post"
                                      action="{{ url('/cart/' . $detail->id ) }}">
                                    @csrf
                                    @method('delete')
                                    <a href="{{ url('/products/' . $detail->product->id) }}"
                                       target="_blank" rel="tooltip" class="btn btn-info" title="Ver producto">
                                        <i class="fa fa-info"></i>
                                    </a>
                                    <button type="submit" rel="tooltip" class="btn btn-danger" title="Eliminar">
                                        <i class="material-icons">close</i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <form action="{{ url('/order') }}" method="post">
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


