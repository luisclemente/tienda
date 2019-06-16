@extends('layouts.app')
@section('title', 'Listado de usuarios')
@section('body-class', 'profile-page sidebar-collapse')
@section('content')

    <div class="main main-raised">
        <div class="container">
            <div class="section text-center">
                <h2 class="title">Detalles del pedido</h2>
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                @foreach ($cart->details as $detail)

                <!-------  PENDING-CARTS TABLE   ----------->
                    <table class="table">
                        <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="col-md-2">Name</th>
                            <th class="text-right">Precio</th>
                            <th class="text-right">Cantidad</th>
                            <th class="text-right">Subtotal</th>
                            <th class="text-right">Opciones</th>
                        </tr>
                        </thead>
                        <tbody>
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
                        </tbody>
                    </table>
                    <hr>
                @endforeach
            </div>
        </div>
    </div>

    @include ('partials.footer')
@endsection

