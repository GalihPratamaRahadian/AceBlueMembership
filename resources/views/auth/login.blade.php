@extends('layouts.layout_login')

@section('content')
<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-lg-7 col-sm-3 col-md-9">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-3">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="p-3">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Silahkan Login</h1>
                                </div>
                                <form class="user">
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user"
                                            id="username" name="username" aria-describedby="usernameHelp"
                                            placeholder="Enter Username...">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user"
                                            id="password" name = "password" placeholder="Password">
                                    </div>
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox small">
                                            <input type="checkbox" class="custom-control-input" id="customCheck">
                                            <label class="custom-control-label" for="customCheck">Remember
                                                Me</label>
                                        </div>
                                    </div>
                                    <button class="btn btn-primary btn-user btn-block">
                                        Login
                                    </button>
                                </form>
                                <hr>
                                {{-- <div class="text-center">
                                    <a class="small" href="forgot-password.html">Forgot Password?</a>
                                </div> --}}
                                <div class="text-center">
                                    <p class="small">Belum memiliki akun? Silahkan klik tulisan daftar dibawah ini</p>
                                    <a class="small fw-bold text-decoration-underline" href="{{ route('access_register') }}">Daftar Disini!</a>
                                </div>
                                {{-- <div class="text-center">
                                    <a class="small" href="{{ route('home') }}">Kembali ke halaman utama</a>
                                </div> --}}
                            </div>
                        </div>

                        <div class="col-md-6">
                            <img src="{{ url('assets/img/awan.jpeg')}}" alt="background login" width="100%">
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>
@endsection
@section('scripts')
    @if (session()->has('error'))
        <script>
            $(document).ready(function() {
                let message = `{!! \Session::get('error') !!}`;
                warningNotificationSnack(message);
            })
        </script>
    @endif
@endsection
