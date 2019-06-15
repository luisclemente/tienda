@extends('layouts.app')
@section('title', 'Bienvenido a Tienda Luis')
@section('body-class', 'landing-page sidebar-collapse')
@section('styles')
    <style>
        .tt-query {
            -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
            -moz-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
            box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
        }

        .tt-hint {
            color: #999
        }

        .tt-menu { /* used to be tt-dropdown-menu in older versions */
            width: 200px;
            margin-top: 4px;
            padding: 4px 0;
            background-color: #fff;
            border: 1px solid #ccc;
            border: 1px solid rgba(0, 0, 0, 0.2);
            -webkit-border-radius: 4px;
            -moz-border-radius: 4px;
            border-radius: 4px;
            -webkit-box-shadow: 0 5px 10px rgba(0, 0, 0, .2);
            -moz-box-shadow: 0 5px 10px rgba(0, 0, 0, .2);
            box-shadow: 0 5px 10px rgba(0, 0, 0, .2);
        }

        .tt-suggestion {
            padding: 3px 20px;
            line-height: 24px;
        }

        .tt-suggestion.tt-cursor, .tt-suggestion:hover {
            color: #fff;
            background-color: #0097cf;
        }

        .tt-suggestion p {
            margin: 0;
        }
    </style>
@endsection
@section('content')


    <!---------  ENCABEZADO: TEXTO "TU TIENDA COMIENZA AQUÍ", BOTÓN ¿COMO FUNCIONA?    ---------->
    <div class="page-header header-filter" data-parallax="true"
         style="background-image: url('{{ asset ('img/profile_city.jpg') }}')">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h1 class="title">{{__('Tu tienda comienza aquí') }}</h1>
                    <h4>{{__('Realiza pedidos en línea') }}</h4>
                    <br>
                    <a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ" target="_blank"
                       class="btn btn-danger btn-raised btn-lg">
                        <i class="fa fa-play"></i> {{__('¿Cómo funciona?') }}
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!---  CUERPO: INFORMACIÓN DE LA TIENDA, BUSCADOR DE PRODUCTOS, LISTADO DE CATEGORÍAS Y FORMULARIO RÁPIDO   ----->
    <div class="main main-raised">
        <div class="container">
            <div class="section text-center">
                <div class="row">
                    <div class="col-md-8 ml-auto mr-auto">
                        <h2 class="title">¿Por qué Tienda Luis?</h2>
                        <h5 class="description">Puedes revisar nuestra relación completa de productos, comparar precios
                            y realizar tus pedidos cuando estés seguro.</h5>
                    </div>
                </div>
                <div class="features">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="info">
                                <div class="icon icon-info">
                                    <i class="material-icons">chat</i>
                                </div>
                                <h4 class="info-title">Atendemos tus dudas</h4>
                                <p>Atendemos rápidamente cualquier duda que tengas vía chat. No estás sólo, sino que
                                    siempre estamos atentos a tus inquietudes.</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="info">
                                <div class="icon icon-success">
                                    <i class="material-icons">verified_user</i>
                                </div>
                                <h4 class="info-title">Pago seguro</h4>
                                <p>Todo pedido que realices será confirmado a través de una llamada. Si no confías en
                                    los pagos en líea puedes pagar contra entrega el valor acordado.</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="info">
                                <div class="icon icon-danger">
                                    <i class="material-icons">fingerprint</i>
                                </div>
                                <h4 class="info-title">Información privada</h4>
                                <p>Los pedidos que realices sólo los conocerás tú a través de tu panel de usuario.
                                    Nadie más tiene acceso a esta información.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!---         BUSCADOR DE PRODUCTOS              ----->
            <div class="section text-center">
                <h2 class="title">Busca un produccto</h2>
                <form action="{{ route ('search_product') }}">
                    <input type="text" placeholder="¿Qúe producto buscas?" name="query" id="search">
                    <button type="submit" class="btn btn-primary btn-just-icon">
                        <i class="material-icons">search</i>
                    </button>
                </form>
            </div>

            <!---        LISTADO DE CATEGORÍAS         ----->
            <div class="section text-center">
                <h2 class="title">Categorias</h2>
                <div class="team">
                    <div class="row">
                        @foreach($categories as $category)
                            <div class="col-md-4">
                                <div class="team-player">
                                    <div class="card card-plain">

                                        <!---   IMAGEN  ----->
                                        <div class="col-md-6 ml-auto mr-auto">
                                            <img src="{{ $category->featured_image_url }}"
                                                 alt="Thumbnail Image"
                                                 class="img-raised rounded-circle img-fluid"
                                            >
                                        </div>

                                        <!---   NOMBRE-ENLACE  ----->
                                        <h4 class="card-title">
                                            <a href="{{ route ('category_show', $category->id) }}">
                                                {{ $category->name }}
                                            </a>
                                            <br>
                                        </h4>

                                        <!---   DESCRIPCIÓN  ----->
                                        <div class="card-body">
                                            <p class="card-description">{{ $category->description }}</p>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!---   FORMULARIO RÁPIDO DE REGISTRO ( SOLO NOMBRE Y CORREO )  ----->
            <div class="section section-contacts">
                <div class="row">
                    <div class="col-md-8 ml-auto mr-auto">
                        <h2 class="text-center title">¿Aún no te has registrado?</h2>
                        <h4 class="text-center description">Regístrate ingresando tus datos básicos, y prodrás realizar
                            tus pedidos a través de nuestro carrito de compras. Si aún no te decides, de todas formas,
                            con tu cuenta de usuario podrás hacer todas tus consultas sin compromiso.</h4>
                        <form class="contact-form" method="get" action="{{ url('/register') }}">
                            <div class="row">

                                <!--------   NOMBRE   -------->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Nombre</label>
                                        <input type="text" class="form-control" name="name">
                                    </div>
                                </div>

                                <!--------   EMAIL   -------->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Correo electrónico</label>
                                        <input type="email" class="form-control" name="email">
                                    </div>
                                </div>

                            </div>
                            <div class="row">

                                <!--------   'REGISTRAR'   -------->
                                <div class="col-md-4 ml-auto mr-auto text-center">
                                    <button class="btn btn-primary btn-raised">
                                        Registrar
                                    </button>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

    @include ('partials.footer')
@endsection
@section('scripts')
    <script src="{{ asset ('js/typeahead.bundle.min.js') }}" type="text/javascript"></script>
    <script>
        $( function () {
            var products = new Bloodhound( {
                datumTokenizer : Bloodhound.tokenizers.whitespace,
                queryTokenizer : Bloodhound.tokenizers.whitespace,
                prefetch : '{{ url("/products/json") }}'
            } );
            $( '#search' ).typeahead( {
                    hint : true,
                    highlight : true,
                    minLength : 1
                },
                {
                    name : 'products',
                    source : products // objeto bloodhound
                } );
        } );
    </script>
@endsection

