@extends('layout/aplikasi')
@section('konten')
    <table class="table">
        <thead>
            <tr>
                <th>Nomor Induk</th>
                <th>Nama</th>
                <th>Alamat</th>
            </tr>
        </thead>
        <tbody>
                @foreach ($data as $item)
                    <tr>
                        <td>{{ $item->nomor_induk }}</td>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->alamat }}</td>
                @endforeach
        </tbody>
@endsection