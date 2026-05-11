<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login</title>



    <!-- Custom fonts for this template-->
    <link rel="icon" type="image/x-icon" href="{{ url('assets/img/img/icon.png') }}" />
    <link href="vendors/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <style>
        body {
            margin: auto;
            font-family: -apple-system, BlinkMacSystemFont, sans-serif;
            overflow: auto;
            background-size: 400% 400%;
            background-attachment: fixed;
        }

        .button {
            display: inline-block;
            position: relative;
            z-index: 1;
            overflow: hidden;
            text-decoration: none;
            transition: 4s;
        }
        .button:before, .button:after {
            content: "";
            position: absolute;
            top: -1.5em;
            z-index: -1;
            width: 200%;
            aspect-ratio: 1;
            transition: 4s;
        }
        .button:before {
            left: -80%;
            transform: translate3d(0, 5em, 0) rotate(-340deg);
        }
        .button:after {
            right: -80%;
            transform: translate3d(0, 5em, 0) rotate(390deg);
        }
        .button:hover, .button:focus {
            color: #0D6EFD;
        }
        .button:hover:before, .button:focus:before, .button:hover:after, .button:focus:after {
            transform: none;
            background-color: #ffffff;
        }

        @keyframes gradient {
            0% {
                background-position: 0% 0%;
            }
            50% {
                background-position: 100% 100%;
            }
            100% {
                background-position: 0% 0%;
            }
        }

        .wave {
            background: rgb(255 255 255 / 25%);
            border-radius: 1000% 1000% 0 0;
            position: fixed;
            width: 200%;
            height: 12em;
            animation: wave 10s -3s linear infinite;
            transform: translate3d(0, 0, 0);
            opacity: 0.8;
            bottom: 0;
            left: 0;
            z-index: -1;
        }

        .wave:nth-of-type(2) {
            bottom: -1.25em;
            animation: wave 18s linear reverse infinite;
            opacity: 0.8;
        }

        .wave:nth-of-type(3) {
            bottom: -2.5em;
            animation: wave 20s -1s reverse infinite;
            opacity: 0.9;
        }

        @keyframes wave {
            2% {
                transform: translateX(1);
            }

            25% {
                transform: translateX(-25%);
            }

            50% {
                transform: translateX(-50%);
            }

            75% {
                transform: translateX(-25%);
            }

            100% {
                transform: translateX(1);
            }
        }

    </style>
</head>

<body class="bg-primary">
    @yield('content')
</body>


<!-- javascript -->

    <!-- Bootstrap core JavaScript-->
    <script src="vendors/jquery/jquery.min.js"></script>
    <script src="vendors/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendors/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="assets/js/sb-admin-2.min.js"></script>


@yield('scripts')

</html>
