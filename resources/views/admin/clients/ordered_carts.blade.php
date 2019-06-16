@extends('layouts.app')
@section('title', 'Listado de usuarios')
@section('body-class', 'profile-page sidebar-collapse')
@section('content')

    <div class="main main-raised">
        <div class="container">
            <div class="section text-center">
                <h2 class="title">Pedidos Realizados</h2>
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                @foreach($user->cart_pending as $cart_pending )

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
                            <th class="text-center">ID</th>
                            <th class="col-md-2">Order Date</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-center">
                                    {{ $cart_pending->id}}
                                </td>

                                <!-------   NOMBRE-ENLACE AL PRODUCTO   ----------->
                                <td>
                                    {{ $cart_pending->order_date }}
                                </td>
                                <td class="td-actions text-right">

                                    <!-------   BUTTON INFO  ----------->
                                    <a href="{{ route ('cart_show', $cart_pending) }}"
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

