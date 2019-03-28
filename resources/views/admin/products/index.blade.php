@extends('layouts.app')
@section('title', 'Listado de productos')
@section('body-class', 'profile-page sidebar-collapse')
@section('content')
    <div class="page-header header-filter" data-parallax="true"
         style="background-image: url('{{ asset ('img/profile_city.jpg') }}')">
    </div>
    <div class="main main-raised">
        <div class="container">
            <div class="section text-center">
                <h2 class="title">Listado de productos</h2>
                <div class="team text-center">
                    <div class="row text-center">
                        <a href="{{ url('admin/products/create') }}"
                           class="btn btn-primary btn-round">Nuevo Producto</a>
                        <table class="table">
                            <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="col-md-2">Nombre</th>
                                <th class="col-md-4">Descripción</th>
                                <th>Categoría</th>
                                <th class="text-right">Precio</th>
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
                                    <td class="td-actions text-right">
                                        <form method="post"
                                              action="{{ url('admin/products/' . $product->id ) }}">
                                            @csrf
                                            @method('delete')
                                            <a href="{{ url('/products/' . $product->id) }}"
                                               rel="tooltip" class="btn btn-info" title="Ver producto" target="_blank">
                                                <i class="fa fa-info"></i>
                                            </a>
                                            <a href="{{ url ('admin/products/' . $product->id . '/edit') }}" rel="tooltip"
                                               class="btn btn-success" title="Editar producto">
                                                <i class="material-icons">edit</i>
                                            </a>
                                            <a href="{{ url ('admin/products/' . $product->id . '/images') }}"
                                               type="button" rel="tooltip" class="btn btn-warning"
                                               title="Imagenes del producto">
                                                <i class="fa fa-image"></i>
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
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include ('partials.footer')
@endsection

