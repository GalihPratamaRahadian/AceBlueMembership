@extends('layout/aplikasi')

@section('konten')
    <p>
    <h1>{{ $judul }}</h1>
    </p>
    <br>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Voluptas dolores similique quae consequuntur
    adipisci deserunt? Quibusdam culpa mollitia est facere.

    <p>
        <ul>
            <li>Email : {{ $kontak['email'] }}</li>
        </ul>
    </p>
@endsection
