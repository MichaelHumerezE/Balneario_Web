@extends('cliente.cliente')
@section('content')
    <!-- BREADCRUMB -->
    <div id="breadcrumb" class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-md-12">
                    <h3 class="breadcrumb-header">Carrito De Compras</h3>
                    <ul class="breadcrumb-tree">
                        <li><a href="#">Home</a></li>
                        <li class="active">Carrito De Compras</li>
                    </ul>
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /BREADCRUMB -->
    
    <!-- store products -->
    <div class="pagination justify-content-end">
        {!! $detallesCarrito->links() !!}
    </div>
    <div class="row">
        <?php
        $c = 0;
        $a = 0;
        $total = 0;
        ?>
        @foreach ($productos as $producto)
            @foreach ($detallesCarrito as $detalleCarrito)
                @if ($detalleCarrito->producto_id == $producto->id)
                    <?php
                    $c = $c + 1;
                    $a = $a + 1;
                    $total += $detalleCarrito->precio * $detalleCarrito->cantidad;
                    ?>
                    <!-- product -->
                    <div class="col-md-4 col-xs-6">
                        <div class="product">
                            <div class="product-img">
                                <img src="{{ url($producto->url) }}" alt="...">
                                <div class="product-label">
                                    <!--<span class="new">NEW</span>-->
                                </div>
                            </div>
                            <div class="product-body">
                                        <p class="product-category">{{ $producto->subcategoria->nombre }}</p>
                                <h3 class="product-name"><a href="#">{{ $producto->nombre }}</a></h3>
                                <h4 class="product-price">Bs {{ $detalleCarrito->precio }}
                                    @if ($detalleCarrito->precio != $producto->precio)
                                        <del class="product-old-price">Bs {{ $producto->precio }}</del>
                                    @endif
                                </h4>
                                <div class="product-rating">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                                <div class="product-btns">
                                    <button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">add
                                            to
                                            wishlist</span></button>
                                    <button class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">add
                                            to
                                            compare</span></button>
                                    <button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">quick
                                            view</span></button>
                                    <form action="{{ route('detalleCarrito.destroy', $detalleCarrito->id) }}"
                                        id="delete_{{ $detalleCarrito->id }}" method="POST" enctype="multipart/form-data"
                                        hidden>
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                    <button type="submit" class="quick-view" form="delete_{{ $detalleCarrito->id }}"
                                        onclick="return confirm('¿Estás seguro de eliminar el registro?')"><i
                                            class="fa fa-trash"></i><span class="tooltipp">delete</span></button>
                                    <form action="{{ route('detalleCarrito.update', $detalleCarrito->id) }}" method="POST"
                                        enctype="multipart/form-data" id="update{{ $a }}">
                                        @method('PUT')
                                        @csrf
                                        <input type="number" id="cantidad" name="cantidad" min="1" max="1000"
                                            value="{{ $detalleCarrito->cantidad }}">
                                        <input type="hidden" name="precio" id="precio"
                                            value="{{ $producto->precio }}">
                                        <input type="hidden" name="producto_id" id="producto_id"
                                            value="{{ $producto->id }}">
                                        <input type="hidden" name="carrito_id" id="carrito_id" value="{{ $carrito->id }}">
                                    </form>
                                </div>
                            </div>
                            <div class="add-to-cart">
                                <button class="add-to-cart-btn" form="update{{ $a }}"><i
                                        class="fa fa-shopping-cart"></i> Editar</button>
                            </div>
                        </div>
                    </div>
                    @if ($c == 3)
                        <div class="col-md-12 col-xs-6">
                            <div class="product">
                            </div>
                        </div>
                        <?php
                        $c = 0;
                        ?>
                    @endif
                @endif
            @endforeach
        @endforeach
        <div class="col-md-12 col-xs-6">
            <div class="product">
            </div>
        </div>
    </div>
    <div class="pagination justify-content-end">
        {!! $detallesCarrito->links() !!}
    </div>
    <center>
        <h1>TOTAL: {{ $total }} Bs</h1>
    </center>
@endsection
