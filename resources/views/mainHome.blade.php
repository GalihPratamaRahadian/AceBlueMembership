@extends('layouts.layout_main_page')


@section('content')

<!-- Header Section -->
<header class="masthead">
    <div class="container px-4 px-lg-5 h-100">
        <div class="row gx-4 gx-lg-5 h-100 align-items-center justify-content-center text-center">
            <div class="col-lg-8 align-self-end">
                <h1 class="text-white font-weight-bold">Welcome</h1>
                <hr class="divider" />
            </div>
            <div class="col-lg-8 align-self-baseline">
                <p class="text-white-75 mb-5">Satu Panel Seribu Harapan</p>
            </div>
        </div>
    </div>
</header>

<!-- Paket Section -->
    <div class="container px-4 px-lg-5" id="services">
        <h2 class="text-center mt-5">Pilihan Paket</h2>
        <hr class="divider" />
        <div class="row gx-4 gx-lg-5">
            @php
                $packets = App\Models\Packet::all();
            @endphp
            @foreach($packets as $packet)
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="mt-5">
                        <div class="card" style="min-width: 300px; max-width: 300px; flex: 0 0 auto;">
                            <div class="card-header">
                                <div class="mb-2"><i class="bi bi-lightbulb fs-1"></i>
                                    <h3 class="h4 mb-2">{{ $packet->packet_name }}</h3>
                                </div>
                                <br>Pilihan {{ $packet->type }}
                            </div>
                            <div class="card-body d-flex flex-column" style="white-space: normal;">
                                <h6>{{ $packet->kwh_total }} Kwh</h6>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            <a href="{{ route('agreement') }}" class="btn btn-primary mt-3">Mulai Berlangganan</a>
        </div>

        {{-- <div class="text-center mt-5">
            <a class="btn btn-light btn-xl" href="{{ route('packet') }}">Klik Disini Untuk Info Selengkapnya<i class="bi bi-arrow-right mr-1"></i></a>
        </div> --}}
    </div>

<!-- Galeri Section -->
<section class="page-section portfolio" id="portfolio">
<div id="portfolio">
    <div class="container-fluid p-0">
        <h3 class="text-center mt-0 mb-4">Galeri</h3>
        <hr class="divider" />
        <div class="row g-0">
            @php
                use App\Models\Gallery;
                $galleries = Gallery::orderBy('created_at', 'desc')->take(6)->get();
            @endphp
            @foreach($galleries as $gallery)
                @if($gallery->isImageHasPhoto())
                    <div class="col-lg-4 col-sm-6">
                        <a class="portfolio-box" href="{{ $gallery->imageLink() }}" title="{{ $gallery->title }}">
                            <img class="img-fluid" src="{{ $gallery->imageLink() }}" alt="{{ $gallery->title }}" />
                            <div class="portfolio-box-caption p-3">
                                <div class="project-category text-white-50">Galeri</div>
                                <div class="project-name">{{ $gallery->title }}</div>
                            </div>
                        </a>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</div>
</section>

<section class="page-section profile" id="profile">
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-lg-8 col-xl-6 text-center">
                <h2 class="mt-0">Tentang Kami</h2>
                <hr class="divider">
                <p class="text-muted mb-5">Didirikan pada 2025, Ace Jaya Renewable Energy menghadirkan solusi tenaga surya inovatif dengan penyimpanan energi berbasis ...</p>
                <a href="{{ route('profile')}}" class="btn btn-secondary btn-md">Lihat Selangkapnya</a>
            </div>
        </div>
    </div>
</section>

<!-- Kontak -->
<section class="page-section" id="contact" style="background-color:yellow;">
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-lg-8 col-xl-6 text-center">
                <h2 class="mt-0">Hubungi Kami</h2>
                <hr class="divider" />
                <p class="text-muted mb-5">Silahkan Hubungi Kami Untuk Informasi Lebih Lanjut.</p>
            </div>
        </div>
        <div class="row gx-4 gx-lg-5 justify-content-center mb-5">
            <div class="col-lg-6 text-center">
                <div class="mb-4">
                    <i class="bi bi-geo-alt fs-2 text-primary mb-2"></i>
                    <h4 class="mb-2">Kantor Kami</h4>
                    <p class="text-muted">Jalan Ahmad Yani No 56, Larangan, Kecamatan Lemahwungkuk, Kota Cirebon Jawa Barat</p>
                </div>
                <div class="mb-4">
                    <i class="bi bi-envelope fs-2 text-primary mb-2"></i>
                    <h4 class="mb-2">Email</h4>
                    <p class="text-muted">info@example.com</p>
                </div>
                <div class="mb-4">
                    <i class="bi bi-telephone fs-2 text-primary mb-2"></i>
                    <h4 class="mb-2">Nomor Telepon</h4>
                    <p class="text-muted">+62 812 3456 7890</p>
                </div>
            </div>
        </div>
    </div>
</section>

<div id="map" style="width: 100%; height: 400px; margin: auto;"></div>

<!-- Footer -->
<footer class="bg-light py-5">
    <div class="container px-4 px-lg-5">
        <div class="small text-center text-muted">
            Copyright &copy; 2025 - PT Ace Jaya Corporation
        </div>
    </div>
</footer>

@endsection

   @section('scripts')

<script>
    // Inisialisasi map
    var map = L.map('map').setView([-6.742446,108.576064], 13); // Lokasi Cirebon

    // Tambahkan tile peta dari OpenStreetMap
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    // Tambahkan marker
    L.marker([-6.742446,108.576064]).addTo(map)
        .bindPopup("<b>PT Ace Jaya Corporation</b><br>Cirebon")
        .openPopup();
</script>

    @endsection
