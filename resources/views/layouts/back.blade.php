<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="_token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin - Dashboard</title>


    <!-- Custom fonts for this template-->
    <link rel="icon" type="image/x-icon" href="{{ url('assets/img/img/aceblue.ico') }}" />
    <link href="{{ url('vendors/bootstrap-5.2.3-dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ url('vendors/fontawesome/all.css') }}">
    <link rel="stylesheet" href="{{ url('vendors/select2/select2.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/select2-atlantis.css') }}">
    <link rel="stylesheet" href="{{ url('vendors/ladda/ladda-themeless.min.css') }}">
    <link rel="stylesheet" href="{{ url('vendors/jquery-confirm/jquery-confirm.css') }}">
    <link rel="stylesheet" href="{{ url('vendors/datatables/datatables.min.css') }}">

    <!-- Custom styles for this template-->
    <link href="{{ url('css/sb-admin-2.min.css') }}" rel="stylesheet">
    <style>
        .bg-gradient-primary {
            background: linear-gradient(to bottom, #004c9c, #ffffff) !important;
        }

        .bg-primary {
            background: linear-gradient(to right, #004c9c, #ffffff) !important;
        }

        .sidebar-brand-text {
            font-size: 14px;
            font-weight: 700;
            line-height: 1.1;
            text-align: center;
            text-transform: uppercase;
            color: #fff;
        }
    </style>
</head>

<body>
    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <div class="sidebar-brand d-flex align-items-center justify-content-center">
                <div class="sidebar-brand-icon">
                    <img src="{{ url('assets/img/img/acebluewhite.png') }}" alt="Logo" width="100"
                        height="30">
                </div>
            </div>
            <div class="sidebar-brand-text">AceBlue</div>

            <!-- Divider -->
            <hr class="sidebar-divider mb-4">

            <!-- Heading -->
            <div class="sidebar-heading">
                Hi {{ auth()->user()->name }} !
            </div>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Nav Item - Dashboard -->
            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('admin') }}">
                    <i class="fas fa-fw fa-home"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Loyalti
            </div>

            <!-- Kode QR -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.promotion') }}">
                    <i class="fas fa-fw fa-qrcode"></i>
                    <span>Kode QR</span>
                </a>
            </li>

            <!-- Hadiah -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.prize_pool') }}">
                    <i class="fas fa-fw fa-gift"></i>
                    <span>Hadiah</span>
                </a>
            </li>

            <!-- Penukaran -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.gift') }}">
                    <i class="fas fa-fw fa-exchange-alt"></i>
                    <span>Penukaran</span>
                </a>
            </li>

            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Pengguna
            </div>

            <!-- User -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.user') }}">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Pengguna</span>
                </a>
            </li>

            <!-- Pelanggan -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.people') }}">
                    <i class="fas fa-fw fa-user"></i>
                    <span>Pelanggan</span>
                </a>
            </li>

            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Sistem
            </div>

            <!-- Promosi -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.promotion') }}">
                    <i class="fas fa-fw fa-bullhorn"></i>
                    <span>Promosi</span>
                </a>
            </li>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-primary topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>


                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span
                                    class="mr-2 d-none d-lg-inline text-gray-600 medium">{{ auth()->user()->name }}</span>
                                <img class="img-profile rounded-circle" src="{{ url('assets/img/picture.jpg') }}">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                        @csrf
                                    </form>
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->
                @yield('konten')
                <!-- Footer -->
                <footer class="sticky-footer bg-white">
                    <div class="container my-auto">
                        <div class="copyright text-center my-auto">
                            <span>Copyright &copy; PT Ace Jaya Corporation 2025</span>
                        </div>
                    </div>
                </footer>
                <!-- End of Footer -->

            </div>
            <!-- End of Content Wrapper -->

        </div>
        <!-- End of Page Wrapper -->

        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>
        @yield('modal')
        <script src="{{ url('vendors/bootstrap-5.2.3-dist/js/bootstrap.bundle.min.js') }}"></script>

        <script src="{{ url('vendors/jquery/jquery.min.js') }}"></script>

        <script src="{{ url('vendors/fontawesome/all.js') }}"></script>
        <script src="{{ url('vendors/select2/select2.min.js') }}"></script>
        <script src="{{ url('assets/js/plugin/datatables/datatables.min.js') }}"></script>
        <script src="{{ url('vendors/ladda/spin.min.js') }}"></script>
        <script src="{{ url('vendors/ladda/ladda.min.js') }}"></script>
        <script src="{{ url('vendors/ladda/ladda.jquery.min.js') }}"></script>
        <script src="{{ url('vendors/jquery-confirm/jquery-confirm.js') }}"></script>
        <script src="{{ url('vendors/bootstrap-5-toast-snackbar/src/toast.js') }}"></script>


        <!-- Custom scripts for all pages-->
        <script src="{{ url('assets/js/sb-admin-2.min.js') }}"></script>

        <!-- Bootstrap core JavaScript-->
        <script src="{{ url('vendors/jquery/jquery.min.js') }}"></script>
        <script src="{{ url('vendors/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

        <!-- Core plugin JavaScript-->
        <script src="{{ url('vendors/jquery-easing/jquery.easing.min.js') }}"></script>
        <!-- Custom scripts for all pages-->
        {{-- <script src="{{ url('assets/js/sb-admin-2.min.js')}}"></script> --}}

        <!-- Page level plugins -->
        {{-- <script src="{{ url('assets/js/chart.js/Chart.min.js')}}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ url('assets/js/demo/chart-area-demo.js')}}"></script>
    <script src="{{ url ('assets/js/demo/chart-pie-demo.js')}}"></script> --}}


        <script src="{{ url('assets/js/myJs.js') }}"></script>
        @yield('scripts')
</body>

</html>
