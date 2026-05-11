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
                <h1 class="h3 mb-0 text-gray-800">Daftar Pelanggan</h1>
            </div>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Pelanggan</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" width="100%" cellspacing="0" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th>Nama</th>
                                            <th>Alamat</th>
                                            <th>Nomor Telepon</th>
                                            <th>Email</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
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
<div class="modal fade" id="modalDetail" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Detail Pelanggan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div id="formDetail"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>

@endsection



@section('scripts')
<script src="{{ url('vendors/select2/select2.min.js') }}"></script>
<script src="{{ url('assets/js/plugin/datatables/datatables.min.js') }}"></script>
<script src="{{ url('vendors/ladda/spin.min.js') }}"></script>
<script src="{{ url('vendors/ladda/ladda.min.js') }}"></script>
<script src="{{ url('vendors/ladda/ladda.jquery.min.js') }}"></script>
<script src="{{ url('vendors/jquery-confirm/jquery-confirm.js') }}"></script>
<script src="{{ url('vendors/bootstrap-5-toast-snackbar/src/toast.js') }}"></script>
    <script>
        $(document).ready(function() {
          const $modalCreate = $('#modalCreate');
          const $modalUpdate = $('#modalUpdate');
          const $formCreate = $('#formCreate');
          const $formUpdate = $('#formUpdate');
          const $formCreateSubmitBtn = $formCreate.find(`[type="submit"]`).ladda();
          const $formUpdateSubmitBtn = $formUpdate.find(`[type="submit"]`).ladda();

          $modalCreate.on('shown.bs.modal', function(){
            $modalCreate.find(`[name="customer_name"]`).focus();
          })

          $modalUpdate.on('shown.bs.modal', function(){
            $modalUpdate.find(`[name="customer_name"]`).focus();
          })

          $('#dataTable').DataTable({
                processing: true,
                serverSide: true,
                "bDestroy": true,
                autoWidth: false,
                ajax: {
                    url: "{{ route('admin.people') }}"
                },
                columnDefs: [{
                    "defaultContent": "-",
                    "targets": "_all",
                }],
                columns: [{
                        data: "customer_name",
                        name: "customer_name",
                    },
                    {
                        data: "address",
                        name: "address",
                    },
                    {
                        data: "phone_number",
                        name: "phone_number",
                    },
                    {
                        data: "take_packet",
                        name: "take_packet",
                    },
                    {
                        data: "type",
                        name: "type",
                    },
                    {
                        data: "action",
                        name: "action",
                        orderable: false,
                        searchable: false
                    }
                ],
                drawCallback: settings => {
                    renderedEvent();
                }


            })
          const reloadDT = () => {
            $('#dataTable').DataTable().ajax.reload();
          }

          const renderedEvent = () => {
            $('.approve').off('click')
			$('.approve').on('click', function(){
				let href = $(this).data('href')


				confirmation('Yakin ingin Disetujui?', () => {
					ajaxSetup();
					$.ajax({
						url: href,
						method: 'post',
						dataType: 'json',
					})
					.done(response => {
                        let {
                            message
                        } = response
                        $.snack('success', message, 3000);
						reloadDT();
					})
					.fail(error => {
						ajaxErrorHandling(error)
					})
				})
			})

			$('.reject').off('click')
			$('.reject').on('click', function(){

				let href = $(this).data('href')
				confirmation('Yakin ingin Ditolak?', () => {
					ajaxSetup();
					$.ajax({
						url: href,
						method: 'post',
						dataType: 'json',
					})
					.done(response => {
						ajaxSuccessHandling(response)
						reloadDT();
					})
					.fail(error => {
						ajaxErrorHandling(error)
					})
				})

			});

            $.each($('.detail'), (i, detailBtn) => {
                $(detailBtn).off('click')
                $(detailBtn).on('click', function() {
                    $('#modalDetail').modal('show');
                    let { getHref } = $(this).data();

                    $.get({
                        url: getHref,
                        dataType: 'json'
                    })
                    .done(response => {
                        let { customer } = response;
                        $('#formDetail').empty();
                        $('#formDetail').append(`
                            <table class="table table-bordered">
                                <tr><th>${customer.customer_name.key}</th><td>${customer.customer_name.value}</td></tr>
                                <tr><th>${customer.address.key}</th><td>${customer.address.value}</td></tr>
                                <tr><th>${customer.phone_number.key}</th><td>${customer.phone_number.value}</td></tr>
                                <tr><th>${customer.take_packet.key}</th><td>${customer.take_packet.value}</td></tr>
                                <tr><th>${customer.ktp.key}</th><td>${customer.ktp.value}</td></tr>
                                <tr><th>${customer.payment_file.key}</th><td>${customer.payment_file.value}</td></tr>
                            </table>
                        `);
                    })
                    .fail(error => {
                        ajaxErrorHandlingSnack(error);
                    });
                });
            });

          }
        })
    </script>
@endsection
