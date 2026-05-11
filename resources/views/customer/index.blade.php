    @extends('layouts.back_customer')

    @section('konten')
        <title>Pelanggan - Dashboard</title>

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
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        Poin Anda Saat Ini</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">10</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
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

        {{-- <div class="col-6">
                <div class="text-center">
                    <i class="fas fa-users text-primary text-center"></i>
                </div>
                <h4 class="text-primary text-center">Total Penggunaan Listrik Per Bulan</h4>
                <hr>
                <div class="card">
                    <div class="card-body">
                        <table class="table table-sm table-borderless table-hover">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th class="text-center">Penggunaan</th>
                                </tr>
                            </thead>
                            <thead>
                                <tr>
                                    <td>12 Juni 2025</td>
                                    <td class="text-center text-warning">500 Kwh</td>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div> --}}
    </div>
</div>
    @endsection
