@extends('layouts.app')
@section('title', 'Registrar nuevo producto')
@section('body-class', 'profile-page sidebar-collapse')
@section('content')

    <!-------                               VISTA FORM CREATE USER                                     ----------->
    <div class="page-header header-filter" data-parallax="true"
         style="background-image: url('{{ asset ('img/profile_city.jpg') }}')">
    </div>
    <div class="main main-raised">
        <div class="container">
            <div class="section text-center">
                <h2 class="title">Registrar nuevo producto</h2>
               @include('partials.errors')

            <!-------    FORM  |  CREAR NUEVO user    ----------->
                <form action="{{ route('user_store') }}" method="post">
                    @csrf
                    <input type="hidden" name="previous_url" value="{{ URL::previous () }}">
                    <div class="row">

                        <!-------    NOMBRE    ----------->
                        <div class="col-sm-9">
                            <div class="form-group label-floating">
                                <label class="control-label">Nombre</label>
                                <input type="text" class="form-control" name="name"
                                       value="{{ old('name') }}">
                            </div>
                        </div>

                        <!-------    EMAIL    ----------->
                        <div class="col-sm-9">
                            <div class="form-group label-floating">
                                <label class="control-label">Email</label>
                                <input type="text" class="form-control" name="email"
                                       value="{{ old('email') }}">
                            </div>
                        </div>

                        <!-------    PHONE    ----------->
                        <div class="col-sm-9">
                            <div class="form-group label-floating">
                                <label class="control-label">Phone</label>
                                <input type="text" class="form-control" name="phone"
                                       value="{{ old('phone') }}">
                            </div>
                        </div>

                        <!-------    ADDRESS    ----------->
                        <div class="col-sm-9">
                            <div class="form-group label-floating">
                                <label class="control-label">Address</label>
                                <input type="text" class="form-control" name="address"
                                       value="{{ old('addres') }}">
                            </div>
                        </div>

                        <!-------    USERNAME    ----------->
                        <div class="col-sm-9">
                            <div class="form-group label-floating">
                                <label class="control-label">UserName</label>
                                <input type="text" class="form-control" name="user_name"
                                       value="{{ old('user_name') }}">
                            </div>
                        </div>


                    </div>
                    <div class="row">

                        <button class="btn btn-primary" type="submit">Registrar usuario</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @include ('partials.footer')
@endsection

