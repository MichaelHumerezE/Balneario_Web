<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <title>Balneario - Playa Caribe</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->

    <!-- <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">-->

    <!--  Links de template -->

    <!-- <link rel="preconnect" href="https://fonts.gstatic.com"> -->
    <link rel="shortcut icon"
        href="{{ url('https://bucket-balneario-playa-caribe.s3.amazonaws.com/utils/Logo.jpg') }}" />

    <link rel="canonical" href="https://demo-basic.adminkit.io/" />
    <!--
        <title>AdminKit Demo - Bootstrap 5 Admin Template</title>

        <link href="{{ asset('admin/static/css/app.css ') }}" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">-->

    <!-- *************************************************************************************************************   -->

    <!-- Google font -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">

    <!-- Bootstrap -->
    <link type="text/css" rel="stylesheet" href="{{ asset('cliente/css/bootstrap.min.css') }}" />

    <!-- Slick -->
    <link type="text/css" rel="stylesheet" href="{{ asset('cliente/css/slick.css') }}" />
    <link type="text/css" rel="stylesheet" href="{{ asset('cliente/css/slick-theme.css') }}" />

    <!-- nouislider -->
    <link type="text/css" rel="stylesheet" href="{{ asset('cliente/css/nouislider.min.css') }}" />

    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="{{ asset('cliente/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('cliente/css/font-awesome.min.css') }}">

    <!-- Custom stlylesheet -->
    <link id="estilos-tema" type="text/css" rel="stylesheet" href="{{ asset('cliente/css/style.css') }}" />

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    <style>
        .boton-tema {
            position: fixed;
            bottom: 20px;
            left: 20px;
            z-index: 999;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
            display: flex;
            justify-content: center;
            align-items: center;
            transition: background-color 0.3s ease;
        }

        .boton-tema:hover {
            background-color: #0056b3;
            /* Color de fondo al pasar el mouse */
        }

        /* Estilo del ícono */
        .boton-tema i {
            font-size: 24px;
        }
    </style>

</head>

<body>

    <!-- **************************************************************************************************************************************************************    -->
    <button id="botonTema" class="boton-tema">
        <i id="iconoTema" class="fa fa-sun-o"></i>
    </button>
    <!-- HEADER -->
    <header>
        <!-- TOP HEADER -->
        <div id="top-header">
            <div class="container">
                <ul class="header-links pull-right">
                    <!-- Authentication Links -->
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @endif
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle"
                                href="{{ route('perfil.edit', auth()->user()->id) }}">
                                {{ Auth::user()->email }} <i class="fa fa-user-o"></i>
                                <a class="dropdown-item" href="{{ route('logout') }}">
                                    {{ __('Logout') }} <i class="fa fa-arrow-right"></i>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
        <!-- /TOP HEADER -->

        <!-- MAIN HEADER -->
        <div id="header">
            <!-- container -->
            <div class="container">
                <!-- row -->
                <div class="row">
                    <!-- LOGO -->
                    <div class="col-md-3">
                        <div class="header-logo">
                            <a href="{{ route('home') }}" class="logo">
                                <img src="{{ url('https://bucket-balneario-playa-caribe.s3.amazonaws.com/utils/Logo.jpg') }}"
                                    width=190px>
                            </a>
                        </div>
                    </div>
                    <!-- /LOGO -->
                    <!-- SEARCH BAR -->
                    <div class="col-md-6">
                        <div class="header-search">
                            <form action="{{ route('buscar.cliente') }}" method="GET">
                                <input class="input" name="query" placeholder="Buscar">
                                <button type="submit" class="search-btn">Search</button>
                            </form>
                        </div>
                    </div>
                    <!-- /SEARCH BAR -->

                    <!-- ACCOUNT -->
                    <div class="col-md-3 clearfix">
                        <div class="header-ctn">

                            <!-- Cart -->
                            <div class="dropdown">
                                <?php
                                $c = 0;
                                $total = 0;
                                ?>
                                @guest
                                    <div class="cart-dropdown">
                                        <div class="cart-list">
                                            <h4>Carrito Vacío</h4>
                                        </div>
                                    </div>
                                @else
                                    <div class="cart-dropdown">
                                        <div class="cart-list">
                                            @foreach ($detallesCarrito as $detalleCarrito)
                                                @if ($detalleCarrito->carrito_id == $carrito->id)
                                                    @foreach ($productos as $producto)
                                                        @if ($detalleCarrito->producto_id == $producto->id)
                                                            <?php
                                                            $c = $c + 1;
                                                            $total += $detalleCarrito->precio * $detalleCarrito->cantidad;
                                                            ?>
                                                            <div class="product-widget">
                                                                <div class="product-img">
                                                                    <img src="{{ url($producto->url) }}" alt="">
                                                                </div>
                                                                <div class="product-body">
                                                                    <h3 class="product-name"><a href="#">
                                                                            {{ $producto->nombre }}</a></h3>
                                                                    <h4 class="product-price"><span
                                                                            class="qty">{{ $detalleCarrito->cantidad }}x</span>Bs
                                                                        {{ $detalleCarrito->precio }}
                                                                    </h4>
                                                                </div>
                                                                <button class="delete" type="submit"
                                                                    form="delete_{{ $detalleCarrito->id }}"
                                                                    onclick="return confirm('¿Estás seguro de eliminar el registro?')"><i
                                                                        class="fa fa-close"></i></button>
                                                                <form
                                                                    action="{{ route('detalleCarrito.destroy', $detalleCarrito->id) }}"
                                                                    id="delete_{{ $detalleCarrito->id }}" method="POST"
                                                                    enctype="multipart/form-data" hidden>
                                                                    @csrf
                                                                    @method('DELETE')
                                                                </form>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            @endforeach
                                            @if ($c == 0)
                                                <h4>Carrito Vacío</h4>
                                            @endif
                                        </div>
                                        <div class="cart-summary">
                                            <small>{{ $c }} Item(s) selected</small>
                                            <h5>SUBTOTAL: Bs {{ $total }}</h5>
                                        </div>
                                        <div class="cart-btns">
                                            <a href="{{ route('detalleCarrito.cliente.index') }}">View Cart</a>
                                            @if ($c == 0)
                                                <a href="#">Sin productos <i
                                                        class="fa fa-arrow-circle-right"></i></a>
                                            @else
                                                <a href="{{ route('pagos.index') }}">Checkout <i
                                                        class="fa fa-arrow-circle-right"></i></a>
                                            @endif

                                        </div>
                                    </div>
                                @endguest
                                <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                    <i class="fa fa-shopping-cart"></i>
                                    <span>Your Cart</span>
                                    <div class="qty">{{ $c }}</div>
                                </a>
                            </div>
                            <!-- /Cart -->

                            <!-- Menu Toogle -->
                            <div class="menu-toggle">
                                <a href="#">
                                    <i class="fa fa-bars"></i>
                                    <span>Menu</span>
                                </a>
                            </div>
                            <!-- /Menu Toogle -->
                        </div>
                    </div>
                    <!-- /ACCOUNT -->
                </div>
                <!-- row -->
            </div>
            <!-- container -->
        </div>
        <!-- /MAIN HEADER -->
    </header>
    <!-- /HEADER -->

    <!-- NAVIGATION -->
    <nav id="navigation">
        <!-- container -->
        <div class="container">
            <!-- responsive-nav -->
            <div id="responsive-nav">
                <!-- NAV -->
                <ul class="main-nav nav navbar-nav">
                    <li class="{{ 'home' == Request::is('home*') ? 'active' : '' }}"><a
                            href="{{ route('home') }}">Home</a></li>
                    <li class="{{ 'cliente/catalogo' == Request::is('cliente/catalogo*') ? 'active' : '' }}"><a
                            href="{{ route('catalogo.cliente.index') }}">Catálogo</a></li>
                    <li
                        class="{{ 'cliente/categoriaShow' == Request::is('cliente/categoriaShow*') ? 'active' : '' }}">
                        <a href="{{ route('categoria.cliente.index') }}">Subcategorías</a>
                    </li>
                    @auth
                        <li
                            class="{{ 'cliente/notaVentasCliente' == Request::is('cliente/notaVentasCliente*') ? 'active' : '' }}">
                            <a href="{{ route('notaVentasCliente.index') }}">Nota Ventas</a>
                        </li>
                        <li class="{{ 'cliente/pagosCliente' == Request::is('cliente/pagosCliente*') ? 'active' : '' }}">
                            <a href="{{ url('/cliente/pagosCliente') }}">Pagos</a>
                        </li>
                    @endAuth
                </ul>
                <!-- /NAV -->
            </div>
            <!-- /responsive-nav -->
        </div>
        <!-- /container -->
    </nav>
    <!-- /NAVIGATION -->
    <!-- SECTION -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <div id="store" class="col-md-12">
                    @include('layouts.mensajes')
                    @yield('content')
                </div>
            </div>
        </div>
    </div>

    <!--*************************************************************************************************************************************** -->

    <!-- FOOTER -->
    <footer id="footer">
        <!-- top footer -->
        <div class="section">
            <!-- container -->
            <div class="container">
                <!-- row -->
                <div class="row">
                    <div class="col-md-3 col-xs-6">
                        <div class="footer">
                            <h3 class="footer-title">Acerca de Nosotros</h3>
                            <p>
                                Descubre la serenidad en Playa Caribe, un refugio de bienestar en medio de la
                                naturaleza. Disfruta de piscinas relajantes, tratamientos rejuvenecedores y momentos de
                                tranquilidad. ¡Bienvenido a tu escape perfecto!</p>
                            <ul class="footer-links">
                                <li><a href="#"><i class="fa fa-map-marker"></i>_Cuadras de UE. Honorato Mejia
                                        Cuellar, 9no anillo 6, Santa Cruz de la Sierra</a></li>
                                <li><a href="#"><i class="fa fa-phone"></i>+591 70933211</a></li>
                                <li><a href="#"><i class="fa fa-envelope-o"></i>PlayaCaribe@gmail.com</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-md-3 col-xs-6">
                        <div class="footer">
                            <h3 class="footer-title">Subcategorias</h3>
                            <ul class="footer-links">
                                @foreach ($subcategorias as $subcategoria)
                                    <li><a
                                            href="{{ route('categoriaShow.show', $subcategoria->id) }}">{{ $subcategoria->nombre }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <div class="clearfix visible-xs"></div>

                    <div class="col-md-3 col-xs-6">
                        <div class="footer">
                            <h3 class="footer-title">Information</h3>
                            <ul class="footer-links">
                                <li><a href="#">About Us</a></li>
                                <li><a href="#">Contact Us</a></li>
                                <li><a href="#">Privacy Policy</a></li>
                                <li><a href="#">Orders and Returns</a></li>
                                <li><a href="#">Terms & Conditions</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-md-3 col-xs-6">
                        <div class="footer">
                            <h3 class="footer-title">Service</h3>
                            <ul class="footer-links">
                                @if (auth()->user())
                                    <li><a href="{{ route('perfil.edit', auth()->user()->id) }}">My Account</a></li>
                                    <li><a href="{{ route('password.edit', auth()->user()->id) }}">Set Password</a>
                                    </li>
                                @else
                                    <li><a href="{{ url('/login') }}">My Account</a></li>
                                    <li><a href="{{ url('/login') }}">Set Password</a></li>
                                @endif
                                <li><a href="{{ url('/cliente/pagosCliente') }}">Pagos</a></li>
                                <li><a href="{{ route('detalleCarrito.cliente.index') }}">Ver Carrito</a></li>
                                <li><a href="{{ route('notaVentasCliente.index') }}">Nota Ventas</a></li>
                                <li><a href="#">Help</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /row -->
            </div>
            <!-- /container -->
        </div>
        <!-- /top footer -->

        <!-- bottom footer -->
        <div id="bottom-footer" class="section">
            <div class="container">
                <!-- row -->
                <div class="row">
                    <div class="col-md-12 text-center">
                        <ul class="footer-payments">
                            <li><a href="#"><i class="fa fa-cc-visa"></i></a></li>
                            <li><a href="#"><i class="fa fa-credit-card"></i></a></li>
                            <li><a href="#"><i class="fa fa-cc-paypal"></i></a></li>
                            <li><a href="#"><i class="fa fa-cc-mastercard"></i></a></li>
                            <li><a href="#"><i class="fa fa-cc-discover"></i></a></li>
                            <li><a href="#"><i class="fa fa-cc-amex"></i></a></li>
                        </ul>
                        <span class="copyright">
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            Copyright &copy;
                            <script>
                                document.write(new Date().getFullYear());
                            </script> All rights reserved | This template is made with <i
                                class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com"
                                target="_blank"></a>
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        </span>
                    </div>
                </div>
                <!-- /row -->
            </div>
            <!-- /container -->
        </div>
        <!-- /bottom footer -->
    </footer>
    <!-- /FOOTER -->


    <!-- jQuery Plugins -->
    <script src="{{ asset('cliente/js/jquery.min.js') }}"></script>
    <script src="{{ asset('cliente/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('cliente/js/slick.min.js') }}"></script>
    <script src="{{ asset('cliente/js/nouislider.min.js') }}"></script>
    <script src="{{ asset('cliente/js/jquery.zoom.min.js') }}"></script>
    <script src="{{ asset('cliente/js/main.js') }}"></script>
    <script src="{{ asset('admin/static/js/app.js') }}"></script>
</body>
<script>
    const botonTema = document.getElementById('botonTema');
    const iconoTema = document.getElementById('iconoTema');
    var botmanWidget = {
        title: "Ecomerce",
        aboutText: "Ecomerce",
        introMessage: "Hola!",
        placeholderText: "Escribe un mensaje",
        mainColor: "#CC0000",
        bubbleBackground: "#CC0000",
        aboutLink: '/home'
    };

    botonTema.addEventListener('click', function() {
        const estilos = document.getElementById('estilos-tema');
        // Si los estilos actuales son los estilos claros, cambiar a estilos oscuros
        if (estilos.getAttribute('href') === "{{ asset('cliente/css/style.css') }}") {
            estilos.setAttribute('href', "{{ asset('cliente/css/styleBlack.css') }}");
            iconoTema.classList.remove('fa', 'fa-moon-o'); // Cambiar el ícono
            iconoTema.classList.add('fa', 'fa-sun-o'); // Nuevo ícono para tema claro
        } else { // Si los estilos actuales son los estilos oscuros, cambiar a estilos claros
            estilos.setAttribute('href', "{{ asset('cliente/css/style.css') }}");
            iconoTema.classList.remove('fa', 'fa-sun-o'); // Cambiar el ícono
            iconoTema.classList.add('fa', 'fa-moon-o'); // Nuevo ícono para tema oscuro
        }
    });
</script>
<script src='https://cdn.jsdelivr.net/npm/botman-web-widget@0/build/js/widget.js'></script>

</html>
