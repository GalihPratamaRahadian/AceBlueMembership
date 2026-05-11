@extends('layouts.layout_login')
@section('content')
<div class="container">
    <!-- Outer Row -->
    <div class="row justify-content-center">
        <div class="col-lg-7 col-sm-3 col-md-9">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="p-5">
                                <div class="text-center">
                                    <small class="text-danger">Harap anda membaca syarat dan ketentuan, sebelum menuju ke halaman pendaftaran</small>
                                    <h1 class="h4 text-gray-900 mb-4">Syarat dan Ketentuan</h1>
                                </div>
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-check" style="text-align: center">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Saya Setuju Dengan Syarat dan Ketentuan
                                </label>
                            </div>
                            <div class="form-check" style="text-align: center">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Saya Secara Sadar Siap Menerima Resiko dan Konsekuensi Yang Tertera
                                </label>
                                 <br>
                                <br>
                                <a href="{{ route('access_register') }}" class="btn btn-primary">Lanjut Ke Halaman Daftar</a>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
