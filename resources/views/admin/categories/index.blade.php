@extends('layouts.app')
@section('title', 'Listado de categorías')
@section('body-class', 'profile-page sidebar-collapse')
@section('content')

    <!-------                              VISTA LISTADO CRUD DE CATEGORÍAS                                ----------->

    <div class="page-header header-filter" data-parallax="true"
         style="background-image: url('{{ asset ('img/profile_city.jpg') }}')">
    </div>
    <div class="main main-raised">
        <div class="container">
            <div class="section text-center">
                <h2 class="title">Listado de categorías</h2>
                <div class="team">
                    <div class="row justify-content-center">

                        <!---------   BOTÓN 'NUEVA CATEGORÍA'  ----------->
                        <a href="{{ route ('category_create') }}" class="btn btn-primary btn-round">Nueva categoría</a>

                        <!---------   TABLA CRUD CATEGORIES   ----------->
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

                                        <!---------  FORM   ----------->
                                        <form method="post"
                                              action="{{ route ('category_destroy', $category->id ) }}">
                                            @csrf
                                            @method('delete')

                                                <!---------   BUTTON INFO   ----------->
                                            <a href="{{ route ('category_show', $category->id ) }}"
                                               rel="tooltip" title="Ver categoría" class="btn btn-info">
                                                <i class="fa fa-info" title="Ver categoría"></i>
                                            </a>

                                                <!---------   BUTTON EDIT   ----------->
                                            <a href="{{ route ('category_edit', $category->id ) }}"
                                               rel="tooltip"
                                               class="btn btn-success" title="Editar categoría">
                                                <i class="material-icons">edit</i>
                                            </a>

                                                <!---------   BUTTON DELETE   ----------->
                                            <button type="submit" rel="tooltip" class="btn btn-danger"
                                                    title="Eliminar categoría">
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

