@extends('layouts.layout_main_page')

@section('content')
<title>{{$title}}</title>
<div class="hosting_section layout_padding pt-5 mt-5">
    <div class="container">
        @php
            use App\Models\Packet;
            $packets = Packet::all();
        @endphp

        <h3 class="text-center mt-5">Pilihan Paket</h3>
        <div class="d-flex gap-3 overflow-auto pb-3" style="flex-wrap: nowrap; margin-left: 100px;">
            @foreach($packets as $packet)
            <div class="card" style="min-width: 300px; max-width: 300px; flex: 0 0 auto;">
                <div class="card-header text-center">
                    {{ $packet->packet_name }}
                </div>
                <div class="card-body d-flex flex-column" style="white-space: normal;">
                    <h5 class="card-title text-center">{{ $packet->kwh_total }} Kwh</h5>
                    <h6 class="card-title text-center">{!! \App\MyClass\Helper::getFormatRupiah($packet->price) ?? '-' !!}</h6>
                    <p class="card-text text-wrap" style="word-break: break-word;">
                        {{ $packet->description }}
                    </p>
                </div>
            </div>
            @endforeach
            <a href="{{ route('access_register') }}" class="btn btn-primary mt-auto">Mulai Berlangganan</a>
        </div>

    </div>
</div>
@endsection
