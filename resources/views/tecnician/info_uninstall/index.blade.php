@extends('layouts.back_tecnician')

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
            <h1 class="h3 mb-0 text-gray-800">Status Pencabutan</h1>
        </div>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Status Pencabutan</h6>
            </div>
            <div class="card-body">
                <div class="form">
                    <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0" id="dataTable">
                        <thead>
                            <tr>
                                <th>Nama Pelanggan</th>
                                <th>Tanggal Order</th>
                                <th>Alamat</th>
                                <th>Jumlah Hari Penunggakan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Galih</td>
                                <td>2025/05/23</td>
                                <td>jalan ceria raya b2</td>
                                <td class="text-danger">60</td>
                                <td>
                                    <button type="button" id="btnDetail" data-toggle="modal" data-target="#modalDetail" class="btn btn-success mr-1">Detail</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->
@endsection

@section('modal')
    <div class="modal fade" id="modalDetail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detail Pencabutan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form">
                        <div class="form-group">
                            <label>Nama Pelanggan</label>
                            <input type="text" class="form-control" value="Galih" readonly>
                        </div>
                        <div class="form-group">
                            <label>Tanggal Order</label>
                            <input type="text" class="form-control" value="2025/05/23" readonly>
                        </div>
                        <div class="form-group">
                            <label>Alamat</label>
                            <input type="text" class="form-control" value="jalan ceria raya b2" readonly>
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <input type="text" class="form-control" value="Sudah Dikerjakan" readonly>
                        </div>
                        <div class="form-group">
                            <label>Baterai Yang Digunakan</label>
                            <input type="text" class="form-control" value="3" readonly>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Submit ke admin</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection
