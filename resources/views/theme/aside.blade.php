<aside class="main-sidebar sidebar-dark-purple elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('dashboard')}}" class="brand-link">
        {{-- <img src="{{ asset('assets/img/24691611025869019.png') }}" alt="CAFSI Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8"> --}}
        <span class="brand-text font-weight-light">RedLinks</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="info">
                <a href="{{ route('dashboard')}}" class="d-block">
                    Usuario: {{ $user->name }}
                </a>
            </div>
        </div>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}"
                        class="{{ Request::path() === 'dashboard' ? 'nav-link active' : 'nav-link' }}">
                        <i class="nav-icon fas fa-id-badge"></i>
                        <p>
                            Usuarios
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('categories.index') }}"
                        class="{{ Request::path() === 'categories' ? 'nav-link active' : 'nav-link' }}">
                        <i class="nav-icon fab fa-cuttlefish"></i>
                        <p>
                            Categorias
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('enterprises.index') }}"
                        class="{{ Request::path() === 'enterprises' ? 'nav-link active' : 'nav-link' }}">
                        <i class="nav-icon fas fa-building"></i>
                        <p>
                            Empresas
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('publicities.index') }}"
                        class="{{ Request::path() === 'publicities' ? 'nav-link active' : 'nav-link' }}">
                        <i class="nav-icon fas fa-bullhorn"></i>
                        <p>
                            Publicidades
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('coupons.index') }}"
                        class="{{ Request::path() === 'coupons' ? 'nav-link active' : 'nav-link' }}">
                        <i class="nav-icon fas fa-gift"></i>
                        <p>
                            Cupones
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
