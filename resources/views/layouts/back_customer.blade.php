<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="_token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pelanggan - Dashboard</title>


    <!-- Custom fonts for this template-->
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="{{ url('assets/img/img/icon.png') }}" />
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
                    <img src="{{ url('assets/img/img/acebluewhite.png') }}" alt="Logo" width="100" height="30">
                </div>
            </div>
            <div class="sidebar-brand-text mt-2">Ace Blue</div>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Hi {{ auth()->user()->name }} !
            </div>

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('customer') }}">
                    <i class="fas fa-fw fa-home"></i>
                    <span>Dasboard</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('customer.gift') }}">
                    <i class="fas fa-fw fa-info"></i>
                    <span>Lihat Penukaran Hadiah</span></a>
            </li>

            {{-- <!-- Nav Item  -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('customer.payment') }}">
                    <i class="fas fa-fw fa-money-bill"></i>
                    <span>Pembayaran</span></a>
            </li> --}}

            {{-- <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.people') }}">
                    <i class="fas fa-fw fa-money-bill"></i>
                    <span>Cek Bukti Pembayaran</span></a>
            </li> --}}

            {{-- <li class="nav-item">
                <a class="nav-link" href="{{ route('customer.call_center') }}">
                    <i class="fas fa-fw fa-phone"></i>
                    <span>Hubungi Kami</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('customer.faq') }}">
                    <i class="fas fa-fw fa-question"></i>
                    <span>FAQ</span></a>
            </li> --}}
            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

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


        @yield('scripts')
</body>

</html>
