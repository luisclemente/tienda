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
                                    {{-- <form method="post" action="{{ route('user_destroy', $user ) }}">
                                     @csrf
                                     @method('delete')--}}

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

                                            <button id="modificar"
                                                    rel="tooltip"
                                                    class="btn btn-danger btn-sm"
                                                    title="Eliminar"
                                                    data-toggle="modal"
                                                    data-target="#modalAddtoCart"
                                                    data-user="{{ $user->id }}"
                                                    data-username="{{ $user->name }}"
                                                    data-usercarts="{{ $user->carts->count() }}"
                                            >
                                                <i class="material-icons">close</i>
                                            </button>


                                           {{--   <button type="submit" class="btn btn-danger btn-sm">
                                                  <i class="material-icons">close</i>
                                              </button>--}}


                                        {{--</form>--}}

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

    <!-- Modal -->
    <div class="modal fade" id="modalAddtoCart" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title" id="exampleModalLabel">
                        Se eliminará el usuario y todos sus carritos
                    </span>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route ('user_destroy') }}" method="post">
                    @csrf
                    @method('DELETE')
                    <div class="modal-body">
                        <input type="hidden" name="user_id" value="">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Continuar</button>
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
            var user = $(this).attr('data-user');
            var username = $(this).attr('data-username');
            var usercarts = $(this).attr('data-usercarts');
            $('#exampleModalLabel').text('El usuario ' +  username + ' tiene '
                + usercarts + ' carritos activos o pendientes.' + '\n'
                + 'Se eliminará el usuario y todos sus carritos');
            $('#modalAddtoCart input[name=user_id]').val(user);
        });
    </script>




@endsection

