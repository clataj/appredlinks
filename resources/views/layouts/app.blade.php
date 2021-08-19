<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Administrador | Redlinks</title>

    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ asset('favicon.png') }}" type="image/x-icon">
    <!-- Font awesome -->
    <link rel="stylesheet" href="{{ asset('/assets/lte/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('/assets/lte/dist/css/sb-admin-2.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('/assets/lte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Google Font: Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('/assets/css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/css/app.css') }}">

    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('/assets/lte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/lte/plugins/datatables-autofill/css/autoFill.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/lte/plugins/datatables-select/css/select.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/lte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/lte/plugins/datatables-select/css/select.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/lte/plugins/datatables-checkboxes/css/dataTables.checkboxes.css') }}">
    <!-- Bootstrap Date-Picker Plugin -->
    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css" />
    @stack('css')
</head>

<body id="page-top">
    <div id="wrapper">
        <!-- Navbar -->
        @include('theme.aside')
        <!-- /.navbar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <div
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                    </div>
                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Nav Item - User Information -->
                        <!-- <div class="d-flex align-items-center">
                        </div> -->
                        <li class="nav-item dropdown no-arrow">

                            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img class="ui-avatar" src="https://ui-avatars.com/api/?background=0D8ABC&color=fff&name={{ $user->name }}&size=32" alt="Avatar usuario.">
                                <span class="ml-2 d-none d-lg-inline text-gray-600 small">{{ $user->name }}</span>
                            </a>

                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <div class="dropdown-divider"></div>
                                <a
                                    class="dropdown-item"
                                    href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Cerrar sesión
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
                <!-- End of Topbar -->
                <!-- Begin Page Content -->
                <div id="app" class="container-fluid">
                    @yield('content')
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->
            @include('theme.footer')
        </div>
        <!-- End of Content Wrapper -->
        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>
    </div>
    <!-- End of Page Wrapper -->
    <!-- jQuery -->
    <script src="{{ asset('/assets/lte/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('/assets/lte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- Core plugin JavaScript-->
    <script src="{{ asset('assets/lte/plugins/jquery-easing/jquery.easing.min.js') }}"></script>
    <!-- DataTables -->
    <script src="{{ asset('/assets/lte/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('/assets/lte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{ asset('/assets/lte/plugins/datatables-autofill/js/dataTables.autoFill.min.js')}}"></script>
    <script src="{{ asset('/assets/lte/plugins/datatables-select/js/dataTables.select.min.js')}}"></script>
    <script src="{{ asset('/assets/lte/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{ asset('/assets/lte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{ asset('/assets/lte/plugins/datatables-select/js/select.bootstrap4.min.js')}}"></script>
    <script src="{{ asset('assets/lte/plugins/datatables-checkboxes/js/dataTables.checkboxes.min.js')}}"></script>
    <!-- Custom scripts for all pages -->
    <script src="{{ asset('/assets/lte/dist/js/sb-admin-2.js') }}"></script>
    {{-- App --}}
    <script src="{{ asset('js/app.js') }}"></script>
    <!-- My script -->
    <script type="text/javascript">
        window.CSRF_TOKEN = '{{ csrf_token() }}'
    </script>
    @stack('scripts')
</body>
</html>
