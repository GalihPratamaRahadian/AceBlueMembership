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
            <h1 class="h3 mb-0 text-gray-800">Rekap Laporan</h1>
        </div>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Rekap Laporan</h6>
            </div>
            <div class="card-body">
                <div class="col-lg-12">
							<div class="form-group">
								<label> Tanggal Awal</label>
								<input type="date" name="start_date" class="form-control" required>
							</div>
						</div>

						<div class="col-lg-12">
							<div class="form-group">
								<label> Tanggal Akhir</label>
								<input type="date" name="end_date" class="form-control" required>
							</div>
						</div>

                        <div class="col-lg-12">
                            <div class="form-group">
                                <label> Bentuk Laporan</label>
                                <select name="laporan" class="form-control" required>
                                    <option value="excel">Excel</option>
                                    <option value="pdf">PDF</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="form-group">
                                <label> Status Pembayaran </label>
                                <select name="laporan" class="form-control" required>
                                    <option value="lunas">Lunas</option>
                                    <option value="pending">Pending</option>
                                </select>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Cetak</button>
                        </div>

            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->
@endsection
