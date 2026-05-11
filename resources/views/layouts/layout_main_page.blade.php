<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Ace Jaya Renewable Energy</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="{{ url('assets/img/img/icon.png') }}" />
        <!-- Bootstrap Icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Font Awesome icons (free version)-->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic" rel="stylesheet" type="text/css" />
        <!-- SimpleLightbox plugin CSS-->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.css" rel="stylesheet" />
        <!-- Bootstrap Icons-->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="{{ url('assets/css/styles.css') }}" rel="stylesheet" />

        <style>
            .whatsapp-button {
                position: fixed;
                bottom: 20px;
                right: 20px;
                width: 60px;
                height: 60px;
                background-color: #25D366;
                border-radius: 50%;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
                z-index: 9999;
                display: flex;
                align-items: center;
                justify-content: center;
                transition: background-color 0.3s ease;
            }

            .whatsapp-button:hover {
                background-color: #1DA851;
            }

            .whatsapp-button i {
                color: white;
                font-size: 32px;
            }

            .arrow-down {
                position: fixed;
                bottom: 90px; /* naikkan supaya tidak tumpang tindih tombol WhatsApp */
                right: 20px;
                font-size: 32px;
                color: #ff0000;
                cursor: pointer;
                z-index: 9999;
            }


        </style>

    </head>
<body>
    <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
            <div class="container px-1 px-lg-1">
                <img src="{{ url('assets/img/img/icon.png') }}" alt="Logo" width="200" height="100"><a class="navbar-brand" href="#page-top">Ace Jaya Renewable Energy</a>
                    <ul class="navbar-nav ms-auto my-2 my-lg-0">
                        <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Beranda</a></li>
                        {{-- <li class="nav-item"><a class="nav-link" href="{{ route('packet') }}">Paket</a></li> --}}
                        <li class="nav-item"><a class="nav-link" href="#">Promo</a></li>
                        <li class="nav-item"><a class="nav-link" href="#portfolio">Galeri</a></li>
                        <li class="nav-item"><a class="nav-link" href="#profile">Tentang Kami</a></li>
                        <li class="nav-item"><a class="nav-link" href="#contact">Kontak</a></li>
                        {{-- <li class="nav-item"><a class="btn btn-primary" href="{{ route('login') }}">Login</a></li> --}}
                        {{-- <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                        <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i> Logout
                        </a> --}}
                    </ul>
                </div>
            </div>
        </nav>

   @yield('content')

<div class="arrow-down">
    <i class="bi bi-arrow-down-circle-fill"></i>
</div>
<!-- Floating WhatsApp Button -->

<a href="https://wa.me/6281946978247?text=Halo,%20saya%20ingin%20bertanya"
   class="whatsapp-button"
   target="_blank"
   title="Bantuan Registrasi">
    <i class="bi bi-whatsapp"></i>
</a>


</body>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- SimpleLightbox plugin JS-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.js"></script>
        <!-- Core theme JS-->
        <script src="{{ url('assets/js/scripts.js') }}"></script>
        <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

@yield('scripts')
</html>
