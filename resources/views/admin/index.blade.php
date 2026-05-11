    @extends('layouts.back')

    @section('konten')
        <title>Admin - Dashboard</title>

        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            </div>

            <!-- Content Row -->
            <div class="row">

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Jumlah Membership Pelanggan</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalCustomer }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-check fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Content Row -->

                <div class="row">

                    <!-- Area Chart -->
                    <div class="col-xl-8 col-lg-7">
                    </div>

                </div>
            </div>

        </div>
        <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <div class="content">
    <div class="page-inner">
        <div class="row">
            {{-- total pasien --}}
            <div class="col-6">
            </div>
            {{-- <div id="map" style="width:50%;"></div> --}}
        </div>
    </div>
</div>
    @endsection

    @section('scripts')

    <!-- Tambahkan Leaflet -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
    // Inisialisasi map
    var map = L.map('map').setView([-6.7320, 108.5523], 13); // Lokasi Cirebon

    // Tambahkan tile peta dari OpenStreetMap
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    // Tambahkan marker
    L.marker([-6.7320, 108.5523]).addTo(map)
        .bindPopup("<b>PT Ace Jaya Corporation</b><br>Cirebon")
        .openPopup();
</script>

    @endsection
