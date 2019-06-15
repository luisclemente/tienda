@extends('layouts.app')
@section('title', 'Listado de usuarios')
@section('body-class', 'profile-page sidebar-collapse')
@section('content')

    <!-------                             VISTA LISTADO-CRUD DE USUARIOS                             ----------->

    <div class="page-header header-filter" data-parallax="true"
         style="background-image: url('{{ asset ('img/profile_city.jpg') }}')">
    </div>
    <div class="main main-raised">
        <div class="container">
            <div class="section text-center">
                <h2 class="title">Listado de usuarios</h2>
                <div class="team">
                    <div class="row justify-content-center">

                        <!------         BUTTON 'NUEVO USER'          ----------->
                        <a href="{{ route('user_create') }}" class="btn btn-primary btn-round mb-4">
                            Nuevo User
                        </a>

                        <!-------    TABLA-CRUD PRODUCTS    ----------->
                        <table class="table">
                            <thead>
                            <tr>
                                <th class="text-center">ID</th>
                                <th class="col-md-2">Name</th>
                                <th class="col-md-2">Email</th>
                                <th class="col-md-2">Phone</th>
                                <th class="text-right">Address</th>
                                <th class="text-right">UserName</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td class="text-center">{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->phone}}</td>
                                    <td class="text-right">{{ $user->address }}</td>
                                    <td class="text-right">{{ $user->user_name }}</td>
                                    <td class="td-actions text-right">

                                        <!-------  FORM | ELIMINAR USUARIO --->
                                        <form method="post"
                                              action="{{ route('user_destroy', $user ) }}">
                                        @csrf
                                        @method('delete')

                                        <!-------    BUTTON MOSTRAR    ----------->
                                            {{--<a href="{{ route(' user_show', $user) }}"
                                               rel="tooltip" class="btn btn-info btn-sm" title="Ver producto"
                                               target="_blank">
                                                <i class="fa fa-info"></i>
                                            </a>--}}

                                            <!-------    BUTTON | EDITAR  ----------->
                                            <a href="{{ route ('user_edit', $user ) }}"
                                               rel="tooltip" class="btn btn-success btn-sm" title="Editar producto">
                                                <i class="material-icons">edit</i>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include ('partials.footer')
@endsection

