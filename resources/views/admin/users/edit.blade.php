@extends('layouts.app')
@section('title', 'Editar user')
@section('body-class', 'profile-page sidebar-collapse')
@section('content')

    <!-------                               VISTA FORM EDIT USER                                     ----------->

    <div class="page-header header-filter" data-parallax="true"
         style="background-image: url('{{ asset ('img/profile_city.jpg') }}')">
    </div>
    <div class="main main-raised">
        <div class="container">
            <div class="section text-center">
                <h2 class="title">Editar user</h2>
                @include('partials.errors')

            <!-------   FORM  |  EDIT USER  ----------->
                <form action="{{ route ('user_update', $user ) }}" method="post">
                    @csrf
                    <input type="hidden" name="previous_url" value="{{ URL::previous () }}">
                    <div class="row">
                        <div class="col-sm-9">

                            <!--------- NOMBRE ----------->
                            <div class="form-group label-floating">
                                <label class="control-label">Nombre del producto</label>
                                <input type="text" class="form-control" name="name"
                                       value="{{ old('name', $user->name) }}">
                            </div>
                        </div>

                        <!-------   EMAIL   ----------->
                        <div class="col-sm-3">
                            <div class="form-group label-floating">
                                <label class="control-label">Email</label>
                                <input type="email" step="0.01" class="form-control" name="email"
                                       value="{{ old('email', $user->email) }}"
                                >
                            </div>
                        </div>

                        <!-------   PHONE   ----------->
                        <div class="col-sm-3">
                            <div class="form-group label-floating">
                                <label class="control-label">Phone</label>
                                <input type="text" step="0.01" class="form-control" name="phone"
                                       value="{{ old('phone', $user->phone) }}"
                                >
                            </div>
                        </div>

                        <!-------   ADDRESS   ----------->
                        <div class="col-sm-3">
                            <div class="form-group label-floating">
                                <label class="control-label">Address</label>
                                <input type="text" step="0.01" class="form-control" name="address"
                                       value="{{ old('address', $user->address) }}"
                                >
                            </div>
                        </div>

                        <!-------   USERNAME   ----------->
                        <div class="col-sm-3">
                            <div class="form-group label-floating">
                                <label class="control-label">UserName</label>
                                <input type="text" step="0.01" class="form-control" name="user_name"
                                       value="{{ old('user_name', $user->user_name) }}"
                                >
                            </div>
                        </div>

                    </div>
                    <div class="row">

                        <button class="btn btn-primary" type="submit">Actualizar usuario</button>

                    </div>
                </form>


            </div>
        </div>
    </div>
    @include ('partials.footer')
@endsection

