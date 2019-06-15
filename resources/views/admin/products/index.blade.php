@extends('layouts.app')
@section('title', 'Listado de productos')
@section('body-class', 'profile-page sidebar-collapse')
@section('content')

    <!-------                             VISTA LISTADO-CRUD DE PRODUCTOS                              ----------->

    <div class="page-header header-filter" data-parallax="true"
         style="background-image: url('{{ asset ('img/profile_city.jpg') }}')">
    </div>
    <div class="main main-raised">
        <div class="container">
            <div class="section text-center">
                <h2 class="title">Listado de productos</h2>
                <div class="team">
                    <div class="row justify-content-center">

                        <!------         BUTTON 'NUEVO PRODUCTO'          ----------->
                        <a href="{{ route('product_create') }}" class="btn btn-primary btn-round mb-4">
                            Nuevo Producto
                        </a>

                        <!-------    TABLA-CRUD PRODUCTS    ----------->
                        <table class="table">
                            <thead>
                            <tr>
                                <th class="text-center">@sortablelink('id', 'ID')</th>
                                <th class="col-md-2">@sortablelink('name', 'Nombre')</th>
                                <th class="col-md-2">@sortablelink('description', 'Descripción')</th>
                                <th class="col-md-2">@sortablelink('category_id', 'Categoría')</th>
                                <th class="text-right">@sortablelink('price', 'Precio')</th>
                                <th class="text-right">@sortablelink('stock', 'Stock')</th>
                                <th class="text-right">Opciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <td class="text-center">{{ $product->id }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->description }}</td>
                                    <td>{{ $product->category_name }}</td>
                                    <td class="text-right">&euro; {{ $product->price }}</td>
                                    <td class="text-right">{{ $product->stock }}</td>
                                    <td class="td-actions text-right">

                                        <!-------  FORM | ELIMINAR PRODUCTO ( CONTIENE BOTONES CRUD DEL PRODUCTO ) --->
                                        <form method="post"
                                              action="{{ route('product_destroy', $product ) }}">
                                        @csrf
                                        @method('delete')

                                        <!-------    BUTTON MOSTRAR    ----------->
                                            <a href="{{ route('product_show', $product) }}"
                                               rel="tooltip" class="btn btn-info btn-sm" title="Ver producto"
                                               target="_blank">
                                                <i class="fa fa-info"></i>
                                            </a>

                                            <!-------    BUTTON | EDITAR STOCK  ----------->
                                            <a href="{{ route('stock_edit', $product) }}"
                                               rel="tooltip" class="btn btn-dark btn-sm" title="Stock">
                                                <i class="material-icons">storage</i>
                                            </a>

                                            <!-------    BUTTON | EDITAR  ----------->
                                            <a href="{{ route ('product_edit', $product->id ) }}"
                                               rel="tooltip" class="btn btn-success btn-sm" title="Editar producto">
                                                <i class="material-icons">edit</i>
                                            </a>

                                            <!-------    BUTTON | EDITAR IMÁGENES   ----------->
                                            <a href="{{ route ('product_images_index', $product ) }}"
                                               type="button" rel="tooltip" class="btn btn-warning btn-sm"
                                               title="Imagenes del producto">
                                                <i class="fa fa-image"></i>
                                            </a>

                                            <!-------    BUTTON | ELIMINAR   ----------->
                                            <button type="submit" rel="tooltip" class="btn btn-danger btn-sm"
                                                    title="Eliminar">
                                                <i class="material-icons">close</i>
                                            </button>

                                        </form>

                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{--{{ $products->appends(\Request::except('page'))->render() }}--}}
                        {{$products->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include ('partials.footer')
@endsection

