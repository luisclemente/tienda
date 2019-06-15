@extends('layouts.app')
@section('title', $category->name)
@section('body-class', 'profile-page sidebar-collapse')

<!-------                   VISTA DE UNA CATEGORÍA  |  LISTADO DE SUS PRODUCTOS                           ----------->

@section('content')
    <div class="page-header header-filter" data-parallax="true" style="background-image: url('{{ asset('img/city-profile.jpg') }}');">
    </div>
    <div class="main main-raised">
        <div class="profile-content">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 ml-auto mr-auto text-center">

                        <!-------  IMAGEN  ----------->
                        <div class="profile">
                            <div class="avatar">
                                <img src="{{ $category->featured_image_url }}"
                                     alt="Imagen representativa de la categoría {{ $category->name }}"
                                     class="img-raised rounded-circle img-fluid"
                                >
                            </div>
                        </div>

                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                    </div>
                </div>

            <!-------  NOMBRE DE LA CATEGORÍA  ----------->
                <div class="name text-center">
                    <h3 class="title">{{ $category->name }}</h3>
                </div>

            <!-------  DESCRIPCIÓN DE LA CATEGORÍA  ----------->
                <div class="description text-center">
                    <p>{{ $category->description }}</p>
                </div>

            <!-------  LISTADO DE PRODUCTOS DE LA CATEGORÍA  ----------->
                <div class="team text-center">
                    <div class="row">
                        @foreach($products as $product)
                            <div class="col-md-4">
                                <div class="team-player">
                                    <div class="card card-plain">

                                        <!-------  IMAGEN  ----------->
                                        <div class="col-md-6 ml-auto mr-auto">
                                            <img src="{{ $product->featured_image_url }}"
                                                 alt="Thumbnail Image"
                                                 class="img-raised rounded-circle img-fluid"
                                            >
                                        </div>

                                        <!-------  NOMBRE-ENLACE  ----------->
                                        <h4 class="card-title">
                                            <a href="{{ route ('product_show', $product->id) }}">
                                                {{ $product->name }}
                                            </a>
                                            <br>
                                        </h4>

                                        <!-------  DESCRIPCIÓN  ----------->
                                        <div class="card-body">
                                            <p class="card-description">{{ $product->description }}</p>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="row justify-content-center">
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('partials.footer')
@endsection