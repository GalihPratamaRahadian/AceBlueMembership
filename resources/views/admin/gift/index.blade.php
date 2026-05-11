@extends('layouts.back')
@section('style')
    <link rel="stylesheet" href="{{ url('vendors/select2/select2.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/select2-atlantis.css') }}">
    <link rel="stylesheet" href="{{ url('vendors/ladda/ladda-themeless.min.css') }}">
    <link rel="stylesheet" href="{{ url('vendors/jquery-confirm/jquery-confirm.css') }}">
    <link rel="stylesheet" href="{{ url('vendors/datatables/datatables.min.css') }}">
@endsection

@section('konten')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Halaman Hadiah</h1>
            <button class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-bs-toggle="modal"
                data-bs-target="#modalCreate">
                <i class="fas fa-circle-plus fa-sm text-white-50"></i> Tambah</button>
        </div>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Daftar nama</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0" id="dataTable">
                        <thead>
                            <tr>
                                <th>Nama Hadiah</th>
                                <th>Poin Dibutuhkan</th>
                                <th>Stok</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td>Voucher Alfamart 50K</td>
                                <td>500</td>
                                <td>10</td>
                                <td>
                                    <button class="btn btn-sm btn-success btn-tukar" data-point="500">
                                        Tukar
                                    </button>
                                </td>
                            </tr>

                            <tr>
                                <td>Voucher Indomaret 100K</td>
                                <td>1000</td>
                                <td>5</td>
                                <td>
                                    <button class="btn btn-sm btn-success btn-tukar" data-point="1000">
                                        Tukar
                                    </button>
                                </td>
                            </tr>

                            <tr>
                                <td>Merchandise Exclusive</td>
                                <td>1500</td>
                                <td>3</td>
                                <td>
                                    <button class="btn btn-sm btn-success btn-tukar" data-point="1500">
                                        Tukar
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->
@endsection

@section('modal')
    <!-- MODAL KONFIRMASI -->
    <div class="modal fade" id="modalTukar" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi Penukaran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <p>Apakah kamu yakin ingin menukar hadiah ini?</p>
                    <p>Poin akan dikurangi sesuai kebutuhan.</p>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button class="btn btn-primary">Ya, Tukar</button>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {

            let userPoint = 1500; // nanti bisa dari backend

            // INIT DATATABLE
            let table = $('#dataTable').DataTable();

            // SEARCH
            $('#customSearch').on('focus', function() {
                $('#dataTable').removeClass('d-none');
            });

            $('#customSearch').on('keyup', function() {
                let value = $(this).val();

                if (value.length > 0) {
                    $('#dataTable').removeClass('d-none');
                }

                table.search(value).draw();
            });

            // TOMBOL TUKAR
            $('.btn-tukar').on('click', function() {
                let needPoint = parseInt($(this).data('point'));

                if (userPoint < needPoint) {
                    alert('Poin tidak cukup!');
                    return;
                }

                $('#modalTukar').modal('show');
            });

        });
    </script>
@endsection
