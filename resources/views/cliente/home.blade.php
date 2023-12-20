@extends('cliente.cliente')
@section('content')
    <!-- SECTION -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <!-- shop -->
                <div class="col-md-4 col-xs-6">
                    <div class="shop">
                        <div class="shop-img">
                            <img src="" alt="">
                        </div>
                        <div class="shop-body">
                        </div>
                    </div>
                </div>
                <!-- /shop -->

                <!-- shop -->
                <div class="col-md-4 col-xs-6">
                    <div class="shop">
                        <div class="shop-img">
                            <img src="" alt="">
                        </div>
                        <div class="shop-body">
                        </div>
                    </div>
                </div>
                <!-- /shop -->

                <!-- shop -->
                <div class="col-md-4 col-xs-6">
                    <div class="shop">
                        <div class="shop-img">
                            <img src="" alt="">
                        </div>
                        <div class="shop-body">
                        </div>
                    </div>
                </div>
                <!-- /shop -->
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /SECTION -->

    <!-- SECTION -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">

                <!-- section title -->
                <div class="col-md-12">
                    <div class="section-title">
                        <h3 class="title">Productos</h3>
                        <div class="section-nav">
                            <ul class="section-tab-nav tab-nav">
                                <!--
                                <li class=""><a data-toggle="tab" href="#tab1">Laptops</a></li>
                                <li><a data-toggle="tab" href="#tab1">Smartphones</a></li>
                                <li><a data-toggle="tab" href="#tab1">Cameras</a></li>
                                <li><a data-toggle="tab" href="#tab1">Accessories</a></li>
                                -->
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /section title -->

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
                                                        <input type="number" id="cantidad" name="cantidad" min="1"
                                                            max="1000" value="1">
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
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /SECTION -->

    <!-- HOT DEAL SECTION -->
    <div id="hot-deal" class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-md-12">
                    <div class="hot-deal">
                        <ul class="hot-deal-countdown">
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /HOT DEAL SECTION -->

    <!-- SECTION -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">

                <!-- section title -->
                <div class="col-md-12">
                    <div class="section-title">
                        <h3 class="title">Top</h3>
                        <div class="section-nav">
                            <ul class="section-tab-nav tab-nav">
                                <!--
                                <li class=""><a data-toggle="tab" href="#tab2">Laptops</a></li>
                                <li><a data-toggle="tab" href="#tab2">Smartphones</a></li>
                                <li><a data-toggle="tab" href="#tab2">Cameras</a></li>
                                <li><a data-toggle="tab" href="#tab2">Accessories</a></li>
                                -->
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /section title -->

                <!-- Products tab & slick -->
                <div class="col-md-12">
                    <div class="row">
                        <div class="products-tabs">
                            <!-- tab -->
                            <div id="tab2" class="tab-pane fade in active">
                                <div class="products-slick" data-nav="#slick-nav-2">
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
                                                <h3 class="product-name"><a href="#">{{ $producto->nombre }}</a>
                                                </h3>
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
                                <div id="slick-nav-2" class="products-slick-nav"></div>
                            </div>
                            <!-- /tab -->
                        </div>
                    </div>
                </div>
                <!-- /Products tab & slick -->
            </div>
            <div class="fixed bottom-4 right-4 z-50">
                <div class="p-4 text-lg font-bold text-black rounded-lg bg-blue-500 dark:bg-gray-800 dark:text-gray-300" role="alert">
                    <span class="font-medium">Total de visitas para esta página: </span>{{ $pageVisitsCount }}
                </div>
            </div>  
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /SECTION -->
@endsection
