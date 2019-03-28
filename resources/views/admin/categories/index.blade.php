@extends('layouts.app')
@section('title', 'Listado de categorías')
@section('body-class', 'profile-page sidebar-collapse')
@section('content')
    <div class="page-header header-filter" data-parallax="true"
         style="background-image: url('{{ asset ('img/profile_city.jpg') }}')">
    </div>
    <div class="main main-raised">
        <div class="container">
            <div class="section text-center">
                <h2 class="title">Listado de categorías</h2>
                <div class="team">
                    <div class="row justify-content-center">
                            <a href="{{ url('/admin/categories/create') }}"
                               class="btn btn-primary btn-round">Nueva categoría</a>
                        <table class="table mt-4">
                            <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="col-md-2">Nombre</th>
                                <th class="col-md-4">Descripción</th>
                                <th>Images</th>
                                <th class="text-right">Opciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($categories as $key => $category)
                                <tr>
                                    <td class="text-center">{{ $key + 1 }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->description }}</td>
                                    <td>
                                        <img src="{{ $category->featured_image_url }}"
                                             alt="Imagen de la categoría" height="50">
                                    </td>
                                    <td class="td-actions text-right">
                                        <form method="post"
                                              action="{{ url('admin/categories/' . $category->id ) }}">
                                            @csrf
                                            @method('delete')
                                            <a type="button" rel="tooltip" class="btn btn-info">
                                                <i class="fa fa-info" title="Ver categoría"></i>
                                            </a>
                                            <a href="{{ url ('admin/categories/' . $category->id . '/edit') }}"
                                               rel="tooltip"
                                               class="btn btn-success" title="Editar categoría">
                                                <i class="material-icons">edit</i>
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
                        {{ $categories->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include ('partials.footer')
@endsection

