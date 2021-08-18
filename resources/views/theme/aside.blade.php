<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center"
        href="{{ route('dashboard') }}">
        <div class="sidebar-brand-icon">
            <img src="{{ asset('favicon.png') }}">
        </div>
        <div class="sidebar-brand-text mx-3">RedLinks</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Mantenimiento
    </div>

    @if (Auth::user()->role_id == 1)
        <!-- Nav Item - Usuarios -->
        <li class="{{ Request::path() === 'dashboard' ? 'nav-item active' : 'nav-item' }}">
            <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fas fa-id-badge"></i>
            <span>Usuarios</span>
            </a>
        </li>
        <!-- Nav Item - Categorias -->
        <li class="{{ Request::path() === 'categories' ? 'nav-item active' : 'nav-item' }}">
            <a class="nav-link" href="{{ route('categories.index') }}">
                <i class="fab fa-cuttlefish"></i>
                <span>Categorias</span>
            </a>
        </li>
        <!-- Nav Item - Empresas -->
        <li class="{{ Request::path() === 'enterprises' ? 'nav-item active' : 'nav-item' }}">
            <a class="nav-link" href="{{ route('enterprises.index') }}">
                <i class="fas fa-building"></i>
                <span>Empresas</span>
            </a>
        </li>
        <!-- Nav Item - Publicidades -->
        <li class="{{ Request::path() === 'publicities' ? 'nav-item active' : 'nav-item' }}">
            <a class="nav-link" href="{{ route('publicities.index') }}">
                <i class="fas fa-bullhorn"></i>
                <span>Publicidades</span>
            </a>
        </li>
        <!-- Nav Item - Cupones -->
        <li class="{{ Request::path() === 'coupons' ? 'nav-item active' : 'nav-item' }}">
            <a class="nav-link" href="{{ route('coupons.index') }}">
                <i class="fas fa-gift"></i>
                <span>Cupones</span>
            </a>
        </li>
    @endif
    @if (Auth::user()->role_id == 2)
        <!-- Nav Item - Empresas -->
        <li class="{{ Request::path() === 'enterprises' ? 'nav-item active' : 'nav-item' }}">
            <a class="nav-link" href="{{ route('enterprises.index') }}">
                <i class="fas fa-building"></i>
                <span>Empresas</span>
            </a>
        </li>
    @endif
</ul>
