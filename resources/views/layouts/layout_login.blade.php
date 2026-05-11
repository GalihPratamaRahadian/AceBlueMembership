<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login</title>

    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="{{ url('assets/img/img/aceblue.ico') }}" />
    <!-- Custom fonts for this template-->
    <link href="{{ url('vendors/bootstrap-5.2.3-dist/css/bootstrap.min.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="{{ url('vendors/fontawesome/all.css') }}">
    <link rel="stylesheet" href="{{ url('vendors/select2/select2.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/select2-atlantis.css') }}">
    <link rel="stylesheet" href="{{ url('vendors/ladda/ladda-themeless.min.css') }}">
    <link rel="stylesheet" href="{{ url('vendors/jquery-confirm/jquery-confirm.css') }}">

    <link rel="stylesheet" href="{{ url('vendors/datatables/datatables.min.css') }}">
    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

<style>
    .bg-login-custom {
        background: linear-gradient(to right, #004c9c, #ffffff);
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }
</style>
</head>

<body class="bg-login-custom">
    @yield('content')
</body>

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

    <script src="{{ url('assets/js/myJs.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


@yield('scripts')

</html>
