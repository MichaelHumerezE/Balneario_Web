<!-- ********************************SIDEBAR-PANEL************************************************************** -->
<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="{{ url('/home') }}">
            <span class="align-middle"><img src="{{ url('https://bucket-balneario-playa-caribe.s3.amazonaws.com/utils/Logo.jpg') }}" width=200px></span>
        </a>
        <!-- *******************************USUARIOS*********************************************** -->
        <ul class="sidebar-nav">
            <li class="sidebar-header">
                USUARIOS
            </li>

            <li class="sidebar-item ">
                <a class="sidebar-link" href="{{ url('administrador/empleados') }}">
                    <i class="fa fa-user-tie"></i> <span class="align-middle">Gestionar Empleados</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ url('administrador/clientes') }}">
                    <i class="fa fa-user"></i> <span class="align-middle">Gestionar Clientes</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ url('administrador/roles') }}">
                    <i class="fa fa-user-lock"></i> <span class="align-middle">Roles</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ url('administrador/bitacoras') }}">
                    <i class="fa fa-clipboard"></i> <span class="align-middle">Bitácora</span>
                </a>
            </li>
            <!-- *******************************USUARIOS*********************************************** -->
            <li class="sidebar-header">
                INSUMOS
            </li>

            <li class="sidebar-item ">
                <a class="sidebar-link" href="{{ url('administrador/producto') }}">
                    <i class="align-middle" data-feather="grid"></i> <span class="align-middle">Productos</span>
                </a>
            </li>
            <li class="sidebar-item ">
                <a class="sidebar-link" href="{{ route('categoria.index') }}">
                    <i class="align-middle" data-feather="grid"></i> <span class="align-middle">Categorias</span>
                </a>
            </li>
            <li class="sidebar-item ">
                <a class="sidebar-link" href="{{ route('subcategorias.index') }}">
                    <i class="align-middle" data-feather="grid"></i> <span class="align-middle">Subcategorias</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ url('administrador/menbresias') }}">
                    <i class="align-middle" data-feather="grid"></i> <span class="align-middle">Menbresias</span>
                </a>
            </li>
            <!-- ***********************************ASISTENCIAS****************************************************************************** -->
            <li class="sidebar-header">
                VENTAS
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ url('administrador/notaVentas') }}">
                    <i class="align-middle" data-feather="shopping-bag"></i> <span class="align-middle">Nota Ventas</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ url('administrador/carritosClientes') }}">
                    <i class="align-middle" data-feather="shopping-cart"></i> <span class="align-middle">Carritos</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ url('administrador/pagos') }}">
                    <i class="align-middle" data-feather="dollar-sign"></i> <span class="align-middle">
                        Pagos</span>
                </a>
            </li>
        </ul>
    </div>
</nav>
