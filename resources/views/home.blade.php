@extends('layouts.app')
@section('title', 'Tienda Luis | Dashboard')
@section('body-class', 'profile-page sidebar-collapse')

@section('content')

    <!---------------------                  DASHBOARD  |  CART                           ----------------->

    <div class="page-header header-filter" data-parallax="true"
         style="background-image: url('{{ asset ('img/profile_city.jpg') }}')">
    </div>
    <div class="main main-raised">
        <div class="container">
            <div class="section text-center">
                <h2 class="title">{{ __('Dashboard') }}</h2>

                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-success" role="alert">
                        {{ session('error')[1] }}
                    </div>
                @endif

                @if (session('message'))
                    <div class="alert alert-success" role="alert">
                        {{ session('message')[1] }}
                    </div>
                @endif

                <ul class="nav nav-pills nav-pills-icons" role="tablist">

                    <!---------   BOTÓN 'CARRITO DE COMPRAS'   --------->
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route ('home') }}">
                            <i class="material-icons">dashboard</i>
                            Carrito de compras
                        </a>
                    </li>

                    <!---------   BOTÓN 'PEDIDOS REALIZADOS'   --------->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route ('ordered_carts') }}">
                            <i class="material-icons">list</i>
                            Pedidos realizados
                        </a>
                    </li>

                </ul>

                <hr>
                <!---------   TEXT-INFO NÚMERO DE PRODUCTOS   ----------->
                @if(auth()->user ()->cart->details->count() == 1)
                    <p>Tu carrito de compras presenta {{ auth()->user ()->cart->details->count() }} producto</p>
                @else
                    <p>Tu carrito de compras presenta {{ auth()->user ()->cart->details->count() }} productos</p>
                @endif

            <!---------   TABLA-CRUD LISTADO DE DETALLES DEL CARRITO   ----------->
                <table class="table">
                    <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="col-md-2">Nombre</th>
                        <th class="text-right">Precio</th>
                        <th class="text-right">Cantidad</th>
                        <th class="text-right">Subtotal</th>
                        <th class="text-right">Modificar</th>
                        <th class="text-right">Modificar con modal</th>
                        <th class="text-right">Opciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach(auth()->user()->cart->details as $detail )
                        <tr>

                            <!---------   IMAGEN   ---------->
                            <td class="text-center">
                                <img src="{{ $detail->product->featured_image_url }}" height="50">
                            </td>

                            <!---------   NOMBRE-ENLACE   ---------->
                            <td>
                                <a href="{{ route ('product_show', $detail->product->id) }}"
                                   target="_blank">{{ $detail->product->name }}
                                </a>
                            </td>

                            <!---------   PRECIO, CANTIDAD, SUBTOTAL   ---------->
                            <td class="text-right">&euro;{{ $detail->price }}</td>
                            <td class="text-right">{{ $detail->quantity }}</td>
                            <td class="text-right">&euro;{{ $detail->subtotal }}</td>

                            <!---------   BOTÓN DOBLE 'MODIFICAR'   ---------->
                            <td class="td-actions text-right">
                                <form action="{{ route ('cartDetail_update', $detail->id) }}" method="post"
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

                            <!---------   BOTÓN 'MODIFICAR CON MODAL'   ---------->
                            <td>
                                <button class="btn btn-primary btn-sm"
                                        id="modificar"
                                        data-toggle="modal"
                                        data-target="#modalAddtoCart"
                                        data-
                                        data-productid="{{ $detail->product->id }}"
                                        data-detailid="{{ $detail->id }}"
                                        data-stock="{{ $detail->product->stock }}"
                                        data-quantity="{{ $detail->quantity }}">
                                    <i class="material-icons">add</i>
                                    Modificar
                                </button>
                            </td>

                            <!---------   FORM  |  BORRAR DETALLE  ---------->
                            <td class="td-actions text-right">
                                <form method="post" class=""
                                      action="{{ route ('cartDetail_destroy', $detail ) }}">
                                    @csrf
                                    @method('delete')

                                    <!---------   BOTÓN INFO   ---------->
                                    <a href="{{ route ('product_show', $detail->product) }}"
                                       target="_blank" rel="tooltip" class="btn btn-info btn-sm" title="Ver producto">
                                        <i class="fa fa-info"></i>
                                    </a>

                                        <!---------   BOTÓN ELIMINAR   ---------->
                                    <button type="submit" rel="tooltip" class="btn btn-danger btn-sm" title="Eliminar">
                                        <i class="material-icons">delete_forever</i>
                                    </button>

                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                <div class="text-center">
                    <p>
                        <strong>Importe a pagar:</strong> {{ auth()->user()->cart->total }}€
                    </p>
                </div>

                <!---------   'REALIZAR PEDIDO'   ---------->
                <form action="{{ route ('place_order') }}" method="post">
                    @csrf
                    <button class="btn btn-primary btn-round">
                        <i class="material-icons">done</i>
                        Realizar pedido
                    </button>
                </form>

                <!--------   'PAGAR CON PAYPAL'   -------->
                <a href="{{route ('payment')}}" class="btn btn-warning btn-round">
                    Pagar con <i class="fa fa-cc-paypal"></i>
                </a>

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
                <form action="{{ route ('cartDetail_updateWithModal') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="product_id" value="">
                        <input type="hidden" name="detail_id" value="">
                        <input type="hidden" name="product_stock" value="">
                        <input type="number" name="quantity" class="form-control" min="0" value="">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Añadir al carrito</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @include ('partials.footer')
@endsection
@section('scripts')
    <script>
        $(document).on('click', '#modificar', function () {

            var product_id = $(this).attr('data-productid');
            var detail_id = $(this).attr('data-detailid');
            var stock = $(this).attr('data-stock');
            var quantity = $(this).attr('data-quantity');

            $('#modalAddtoCart input[name=product_id]').val(product_id);
            $('#modalAddtoCart input[name=detail_id]').val(detail_id);
            $('#modalAddtoCart input[name=product_stock]').val(stock);
            $('#modalAddtoCart input[name=quantity]').val(quantity);

            //$('#modalAddtoCart').showModal();

        });
    </script>




@endsection
