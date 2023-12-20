@extends('cliente.cliente')
@section('content')
    <!-- BREADCRUMB -->
    <div id="breadcrumb" class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-md-12">
                    <h3 class="breadcrumb-header">{{ $producto->nombre }}</h3>
                    <ul class="breadcrumb-tree">
                        <li><a href="{{ url('/home') }}">Home</a></li>
                        <li class="">Producto</li>
                        <li class="active">{{ $producto->nombre }}</li>
                    </ul>
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /BREADCRUMB -->

    <!-- SECTION -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <!-- Product main img -->
                <div class="col-md-5 col-md-push-2">
                    <div id="product-main-img">
                        <div class="product-preview">
                            <img src="{{ url($producto->url) }}" alt="">
                        </div>
                    </div>
                </div>
                <!-- /Product main img -->

                <!-- Product thumb imgs -->
                <div class="col-md-2  col-md-pull-5">
                    <div id="product-imgs">
                        <div class="product-preview">
                            <img src="{{ url($producto->url) }}" alt="">
                        </div>
                    </div>
                </div>
                <!-- /Product thumb imgs -->

                <!-- Product details -->
                <div class="col-md-5">
                    <div class="product-details">
                        <h2 class="product-name">{{ $producto->nombre }}</h2>
                        <div>
                            <h3 class="product-price">Bs {{ $producto->precio }}
                                @if ($producto->stock != 0)
                                    <span class="product-available">In Stock</span>
                                @else
                                    <span class="product-available">Not Stock</span>
                                @endif
                        </div>
                        <p>{{ $producto->descripcion }}</p>

                        <div class="add-to-cart">
                            <form action="{{ route('detalleCarrito.store') }}" method="POST" enctype="multipart/form-data"
                                id="add">
                                @csrf
                                <input type="hidden" name="precio" id="precio" value="{{ $producto->precio }}">
                                <input type="hidden" name="producto_id" id="producto_id" value="{{ $producto->id }}">
                                @auth
                                    <input type="hidden" name="carrito_id" id="carrito_id" value="{{ $carrito->id }}">
                                @endauth
                                <div class="qty-label">
                                    Qty
                                    <div class="input-number">
                                        <input type="number" id="cantidad" name="cantidad" min="1" max="1000"
                                            value="1">
                                        <span class="qty-up">+</span>
                                        <span class="qty-down">-</span>
                                    </div>
                                </div>
                                <button class="add-to-cart-btn" form="add"><i class="fa fa-shopping-cart"></i> add to
                                    cart</button>
                            </form>
                        </div>
                        <ul class="product-btns">
                            <li><a href="#"><i class="fa fa-heart-o"></i> add to wishlist</a></li>
                            <li><a href="#"><i class="fa fa-exchange"></i> add to compare</a></li>
                        </ul>

                        <ul class="product-links">
                            <li>Subcategoría:</li>
                            <li><a
                                    href="{{ route('categoriaShow.show', $producto->subcategoria->id) }}">{{ $producto->subcategoria->nombre }}</a>
                            </li>
                            <li>Categoría:</li>
                            <li>{{ $producto->subcategoria->categoria->nombre }}</li>
                        </ul>

                        <ul class="product-links">
                            <li>Share:</li>
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                            <li><a href="#"><i class="fa fa-envelope"></i></a></li>
                        </ul>

                    </div>
                </div>
                <!-- /Product details -->
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /SECTION -->

    <!-- Section -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">

                <div class="col-md-12">
                    <div class="section-title text-center">
                        <h3 class="title">Others Products</h3>
                    </div>
                </div>
                <!-- Products tab & slick -->
                <div class="col-md-12">
                    <div class="row">
                        <div class="products-tabs">
                            <!-- tab -->
                            <div id="tab1" class="tab-pane active">
                                <div class="products-slick" data-nav="#slick-nav-1">
                                    <?php $a = 0; ?>
                                    @foreach ($productos as $producto)
                                        <?php $a = $a + 1; ?>
                                        <!-- product -->
                                        <div class="product">
                                            <div class="product-img">
                                                <img src="{{ url($producto->url) }}" alt="">
                                                <div class="product-label">
                                                    @if ($producto->stock == 0)
                                                        <span class="new">Sin Stock</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="product-body">
                                                <p class="product-category">{{ $producto->subcategoria->nombre }}</p>
                                                <h3 class="product-name"><a href="#">{{ $producto->nombre }}</a></h3>
                                                <h4 class="product-price">Bs {{ $producto->precio }}
                                                </h4>
                                                <div class="product-rating">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                </div>
                                                <div class="product-btns">
                                                    <button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span
                                                            class="tooltipp">add to wishlist</span></button>
                                                    <button class="add-to-compare"><i class="fa fa-exchange"></i><span
                                                            class="tooltipp">add to compare</span></button>
                                                    <button class="quick-view"><i class="fa fa-eye"></i><span
                                                            class="tooltipp">
                                                            <a href="{{ route('catalogo.show', $producto->id) }}"
                                                                style="color: white">
                                                                quick view</a> </span></button>
                                                    <form action="{{ route('detalleCarrito.store') }}" method="POST"
                                                        enctype="multipart/form-data" id="create{{ $a }}">
                                                        @csrf
                                                        <input type="number" id="cantidad" name="cantidad"
                                                            min="1" max="1000" value="1">
                                                        <input type="hidden" name="precio" id="precio"
                                                            value="{{ $producto->precio }}">
                                                        <input type="hidden" name="producto_id" id="producto_id"
                                                            value="{{ $producto->id }}">
                                                        @auth
                                                            <input type="hidden" name="carrito_id" id="carrito_id"
                                                                value="{{ $carrito->id }}">
                                                        @endauth
                                                    </form>
                                                </div>
                                            </div>
                                            <div class="add-to-cart">
                                                <button class="add-to-cart-btn" form="create{{ $a }}"><i
                                                        class="fa fa-shopping-cart"></i> add to
                                                    cart</button>
                                            </div>
                                        </div>
                                        <!-- /product -->
                                    @endforeach
                                </div>
                                <div id="slick-nav-1" class="products-slick-nav"></div>
                            </div>
                            <!-- /tab -->
                        </div>
                    </div>
                </div>
                <!-- Products tab & slick -->
                <div class="fixed bottom-4 right-4 z-50">
                    <div class="fixed bottom-4 right-4 z-50">
                        <div class="p-4 text-lg font-bold text-black rounded-lg bg-blue-500 dark:bg-gray-800 dark:text-gray-300" role="alert">
                            <span class="font-medium">Total de visitas para esta página: </span>{{ $pageVisitsCount }}
                        </div>
                    </div>  
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /Section -->
@endsection
