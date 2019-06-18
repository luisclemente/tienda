@extends('layouts.app')
@section('title', 'Listado de productos los proveedores')
@section('body-class', 'profile-page sidebar-collapse')
@section('content')

    <!-------                             VISTA LISTADO-COMPRAR DE PRODUCTOS DE LOS PROVEEDORES                              ----------->

    <div class="page-header header-filter" data-parallax="true"
         style="background-image: url('{{ asset ('img/profile_city.jpg') }}')">
    </div>
    <div class="main main-raised">
        <div class="container">
            <div class="section text-center">
                <h2 class="title">Listado de productos de los proveedores</h2>
                <div class="team">
                    <div class="row justify-content-center">

                        <!-------    TABLA-CRUD PRODUCTS    ----------->
                        @foreach($products as $product)
                            <table class="table">
                                <thead>
                                <tr>
                                    <th class="col-md-2 text-success">Nombre</th>
                                    <th class="col-md-2 text-success">Proveedor</th>
                                    <th class="text-right text-success">Precio</th>
                                    <th class="text-right text-success">Descuento</th>
                                    <th class="text-right text-success">Total</th>
                                    <th class="text-right text-success">Opciones</th>
                                </tr>
                                </thead>
                                <h2 class="text-muted">{{ $product->name }}</h2>
                                @foreach($product->providers as $provider)

                                    <tbody>
                                    <tr>
                                        <td class="text-center">{{ $product->name }}</td>
                                        <td>{{ $provider->name }}</td>
                                        <td>&euro; {{ $provider->pivot->price }}</td>
                                        <td>{{ $provider->pivot->discount }}</td>
                                        <td class="text-right">&euro;
                                            {{ $provider->pivot->price -
                                            $provider->pivot->discount * $provider->pivot->price / 100 }}

                                        </td>
                                        <td class="td-actions text-right">

                                            <!-------   'COMPRAR'   ----------->
                                            <button id="modificar"
                                                    class="btn btn-primary btn-round"
                                                    data-toggle="modal"
                                                    data-target="#modalAddtoCart"
                                                    data-productid="{{ $product->id }}">
                                                <i class="material-icons">shopping_cart</i>
                                            </button>

                                        </td>
                                    </tr>
                                    </tbody>
                                @endforeach
                            </table>
                        @endforeach
                        {{$products->links()}}
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
                <form action="{{ route ('product_purchase') }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <input type="hidden" name="productid" value="">
                        <input type="number" name="quantity" class="form-control" min="0" value="0">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Añadir al stock</button>
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
            $('#modalAddtoCart input[name=productid]').val(product_id);
        });
    </script>




@endsection

