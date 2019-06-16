@extends('layouts.app')
@section('title', 'Listado de usuarios')
@section('body-class', 'profile-page sidebar-collapse')
@section('content')

    <!-------                             VISTA LISTADO-CRUD DE CLIENTES                             ----------->

    <div class="page-header header-filter" data-parallax="true"
         style="background-image: url('{{ asset ('img/profile_city.jpg') }}')">
    </div>
    <div class="main main-raised">
        <div class="container">
            <div class="section text-center">
                <h2 class="title">Listado de usuarios</h2>
                <div class="team">
                    <div class="row justify-content-center">


                        <!-------    TABLA-CRUD CLIENTES    ----------->
                        <table class="table">
                            <thead>
                            <tr>
                                <th class="text-center">Nombre del cliente</th>
                                <th class="col-md-2">Número Pedidos</th>
                                <th class="col-md-2">Total Pedidos</th>
                                <th class="col-md-2">Detalle Pedidos</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->number_orders }}</td>
                                    <td>{{ $user->total_amount }}</td>
                                   {{-- <td>{{ $user->email }}</td>
                                    <td>{{ $user->phone}}</td>
                                    <td class="text-right">{{ $user->address }}</td>--}}
                                    <td>
                                        <!-------    DETALLES PEDIDOS  ----------->
                                        <a href="{{ route ('ordered_client_carts', $user ) }}"
                                           rel="tooltip" class="btn btn-success btn-sm" title="Editar producto">
                                            <i class="material-icons">Mostrar pedidos</i>
                                        </a>

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

