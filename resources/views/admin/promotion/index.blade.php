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
            <h1 class="h3 mb-0 text-gray-800"></h1>
            <button class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-bs-toggle="modal"
                data-bs-target="#modalCreate">
                <i class="fas fa-circle-plus fa-sm text-white-50"></i> Tambah</button>
        </div>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data Promosi</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0" id="dataTable">
                        <thead>
                            <tr>
                                <th>Nama Promosi</th>
                                <th>Harga Awal</th>
                                <th>Diskon</th>
                                <th>Harga Setelah Diskon</th>
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
<!-- Modal -->
<div class="modal fade" id="modalCreate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Promosi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" id="formCreate">
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" class="form-control" id="name" name="name">
                        <span class="invalid-feedback"></span>
                    </div>
                    <div class="form-group">
                        <label for="price">Harga Awal</label>
                        <input type="number" class="form-control" id="price" name="price" readonly>
                        <span class="invalid-feedback"></span>
                    </div>
                    <div class="form-group">
                        <label for="discount">Diskon</label>
                        <input type="number" class="form-control" id="discount" name="discount">
                    </div>
                    <div class="form-group">
                        <label for="price_total">Harga Setelah Diskon</label>
                        <input type="text" class="form-control" id="price_total" name="price_total">
                    </div>
                    <div class="form-group">
                        <label for="description">Deskripsi</label>
                        <textarea class="form-control" id="description" name="description"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Buat</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Promosi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formEdit" enctype="multipart/form-data">
                    @method('PUT')
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" class="form-control" id="name" name="name">
                        <span class="invalid-feedback"></span>
                    </div>
                    <div class="form-group">
                        <label for="price">Harga Awal</label>
                        <input type="number" class="form-control" id="price" name="price" readonly>
                        <span class="invalid-feedback"></span>
                    </div>
                    <div class="form-group">
                        <label for="discount">Diskon</label>
                        <input type="number" class="form-control" id="discount" name="discount">
                    </div>
                    <div class="form-group">
                        <label for="price_total">Harga Setelah Diskon</label>
                        <input type="text" class="form-control" id="price_total" name="price_total">
                    </div>
                    <div class="form-group">
                        <label for="description">Deskripsi</label>
                        <textarea class="form-control" id="description" name="description"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
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
    $(document).ready(function () {
        const $modalCreate = $('#modalCreate');
        const $formCreate = $('#formCreate');
        const $modalEdit = $('#modalEdit');
        const $formEdit = $('#formEdit');
        const $formCreateSubmitBtn = $formCreate.find(`[type="submit"]`).ladda();
        const $formEditSubmitBtn = $formEdit.find(`[type="submit"]`).ladda();

        $modalCreate.on('show.bs.modal', () => {
            $formCreate.find(`[name="packet_name"]`).focus()
            $formCreate.find(`[name="type"]`).select2({
                dropdownParent: $modalCreate,
                placeholder: 'Pilih Tipe Paket'
            })
        })

        $modalEdit.on('show.bs.modal', () => {
            $formEdit.find(`[name="packet_name"]`).focus()
            $formEdit.find(`[name="type"]`).select2({
                dropdownParent: $modalEdit,
                placeholder: 'Pilih Tipe Paket'
            })
        })

        $('#dataTable').DataTable().destroy();
        $('#dataTable').DataTable({
            processing: true,
            serverSide: true,
            autoWidth: false,
            ajax: {
                url : "{{ route('admin.promotion') }}"
            },
            columnDefs: [{
                "defaultContent": "-",
                "targets": "_all"
            }],
            columns: [
                {
                    data: 'name',
                    name: 'name',
                },
                {
                    data: 'price',
                    name: 'price',
                },
                {
                    data: 'discount',
                    name: 'discount',
                },
                {
                    data: 'price_total',
                    name: 'price_total',
                },
                {
                    data: 'description',
                    name: 'description',
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
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
                    $(deleteBtn).on('click', function() {
                        let {
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
                                    let {
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
                        let {
                            editHref,
                            getHref,
                         } = $(this).data();
                            $.get({
                            url: getHref,
                            dataType: 'json'
                            })
                            .done(response => {
                                let{
                                    promotion
                                } = response;
                                    clearInvalid();
                                    $formEdit.attr('action', editHref);
                                    $formEdit.find(`[name="name"]`).val(promotion.name);
                                    $formEdit.find(`[name="price"]`).val(promotion.price);
                                    $formEdit.find(`[name="discount"]`).val(promotion.discount);
                                    $formEdit.find(`[name="price_total"]`).val(promotion.price_total).trigger('change');
                                    $formEdit.find(`[name="description"]`).val(promotion.description);
                                    $modalEdit.modal('show');

                                    formSubmit(
                                        $modalEdit,
                                        $formEdit,
                                        $formEditSubmitBtn,
                                        editHref,
                                        'post'
                                    );

                            })
                            .fail(error => {
                                ajaxErrorHandlingSnack(error, $modalUpdate);
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
                processData: false,
                contentType: false,
                dataType: 'json',
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
            `{{ route ('admin.promotion.store') }}`,
            'post',
            () => {
              clearFormCreate()
            }
          )
    })
</script>
@endsection
