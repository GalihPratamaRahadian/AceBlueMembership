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
                    <button class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#modalCreate">
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
                                            <th>Gambar Hadiah</th>
                                            <th>Deskripsi</th>
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
<div class="modal fade" id="modalCreate" tabindex="-1" aria-labelledby="modalCreateLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalCreateLabel">Tambah</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="alert alert-info">Kolom bertanda <span class="text-danger">*</span> wajib diIsi</div>
          <form id="formCreate" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
              <label for="name" class="col-form-label">Nama Hadiah:<span class="text-danger">*</span></label>
              <input type="text" class="form-control" name="name" id="name" required>
            </div>
            <div class="mb-3">
              <label for="picture" class="col-form-label">Gambar Hadiah:<span class="text-danger">*</span></label>
              <input type="file" class="form-control" name="picture" id="picture" required>
            </div>
            <div class="mb-3">
              <label for="description" class="col-form-label">Deskripsi:<span class="text-danger">*</span></label>
              <textarea type="text" class="form-control" name="description" id="description" required></textarea>
            </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Tambah</button>
              </div>
            </div>
          </form>
        </div>
    </div>
  </div>

  <div class="modal fade" id="modalUpdate" tabindex="-1" aria-labelledby="modalUpdateLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalUpdateLabel">Update</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="alert alert-info">Kolom bertanda <span class="text-danger">*</span> wajib diIsi</div>
          <form id="formUpdate" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
              <label for="name" class="col-form-label">Nama Hadiah:<span class="text-danger">*</span></label>
              <input type="text" class="form-control" name="name" id="name" required>
            </div>
            <div class="mb-3">
              <label for="picture" class="col-form-label">Gambar Hadiah:<span class="text-danger">*</span></label>
              <input type="file" class="form-control" name="picture" id="picture" required>
            </div>
            <div class="mb-3">
              <label for="description" class="col-form-label">Deskripsi:<span class="text-danger">*</span></label>
              <input type="text" class="form-control" name="description" id="description" required>
            </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
              <button type="submit" class="btn btn-primary">Update</button>
            </div>
          </form>
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
        const ajaxSetup = () => {
        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        }
          const $modalCreate = $('#modalCreate');
          const $modalUpdate = $('#modalUpdate');
          const $formCreate = $('#formCreate');
          const $formUpdate = $('#formUpdate');
          const $formCreateSubmitBtn = $formCreate.find(`[type="submit"]`).ladda();
          const $formUpdateSubmitBtn = $formUpdate.find(`[type="submit"]`).ladda();

          $modalCreate.on('shown.bs.modal', function(){
            $modalCreate.find(`[name="name"]`).focus();
          })

          $modalUpdate.on('shown.bs.modal', function(){
            $modalUpdate.find(`[name="name"]`).focus();
          })
          $('#dataTable').DataTable({
                processing: true,
                serverSide: true,
                "bDestroy": true,
                autoWidth: false,
                ajax: {
                    url: "{{ route('admin.prize_pool') }}"
                },
                columnDefs: [{
                    "defaultContent": "-",
                    "targets": "_all",
                }],
                columns: [{
                        data: "name",
                        name: "name",
                    },
                    {
                        data: "picture",
                        name:"picture",
                    },
                    {
                        data: "description",
                        name: "description",
                    },
                    {
                        data: "action",
                        name: "action",
                        orderable: false,
                        searchable: false,
                    },
                ],
                drawCallback: settings => {
                    renderedEvent();
                }


            })
          const reloadDT = () => {
            $('#dataTable').DataTable().ajax.reload();
          }

          const renderedEvent = () => {
            $.each($('.delete'), (i, deleteBtn) => {
              $(deleteBtn).off('click')
              $(deleteBtn).on('click', function(){
                let{
                  deleteMessage,
                  deleteHref
                } = $(this).data();
                confirmation(deleteMessage, function() {
                  ajaxSetup()
                    $.ajax({
                      url: deleteHref,
                      method: 'delete',
                      dataType: 'json'
                    })

                    .done(response => {
                      let{
                        message
                      } = response
                      $.snack('success', message, 3000);
                      reloadDT();
                    })
                    .fail(error => {
                      ajaxErrorHandlingSnack(error);
                    })
                })
              })
            })

            $.each($('.edit'), (i, editBtn) => {
              $(editBtn).off('click')
              $(editBtn).on('click', function() {
                let{
                  editHref,
                  getHref

                } = $(this).data();
                $.get({

                  url: getHref,
                  dataType: 'json'
                })

                .done(response => {
                  let{
                    prizePool
                  } = response;
                  clearInvalid();
                  $modalUpdate.modal('show')
                  $formUpdate.attr('action', editHref)
                  $formUpdate.find(`[name="name"]`).val(prizePool
                  .name);
                  $formUpdate.find(`[name="picture"]`).val(prizePool
                  .picture);
                  $formUpdate.find(`[name="description"]`).val(user.description);

                  formSubmit(
                    $modalCreate,
                    $formUpdate,
                    $formCreateSubmitBtn,
                    editHref,
                    'put'

                  );
                })
                .fail(error => {
                  ajaxErrorHandlingSnack(error);

                })
              })
            })
          }

          const clearFormCreate = () => {
            $formCreate[0].reset();
          }


          const formSubmit = ($modal, $form, $submit, $href, $method, $addedAction = null) => {
            $form.off('submit')
            $form.on('submit', function(e){
              e.preventDefault();
              clearInvalid();

              let formData = new FormData(this);
              $submit.ladda('start');

              ajaxSetup();
              $.ajax({
                url: $href,
                method: $method,
                data: formData,
                dataType: 'json',
                processData: false,
                contentType: false,
                }).done(response => {
                let{
                  message
                } = response;
                $.snack('success', message, 3000);
                reloadDT();
                clearFormCreate();
                $submit.ladda('stop');
                $modal.modal('hide');

                if (addedAction!==null) {
                  addedAction();

                }
              }).fail(error => {
                $submit.ladda('stop');
                ajaxErrorHandlingSnack(error, $form);
              })
            })
          }

          formSubmit(
            $modalCreate,
            $formCreate,
            $formCreateSubmitBtn,
            `{{ route ('admin.prize_pool.store') }}`,
            'post',
            () => {
              clearFormCreate()
            }
          )
        })
    </script>
@endsection
