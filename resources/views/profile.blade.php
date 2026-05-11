@extends('layouts.layout_main_page')

@section('content')
<title>{{ $title }}</title>
<div class="hosting_section layout_padding pt-5 mt-5">
    <div class="container">
        <h3 class="text-center mt-5 mb-4">Tentang Kami</h3>

        <div class="about-content px-3">
            <h5><strong>Ace Jaya Renewable Energy</strong></h5>
            <p>
                Didirikan pada 2025, <strong>Ace Jaya Renewable Energy</strong> menghadirkan solusi tenaga surya inovatif dengan penyimpanan energi berbasis <strong>Solid-State Battery (SSB)</strong>.
                Teknologi SSB yang digunakan menawarkan keamanan lebih tinggi, efisiensi maksimal, dan ramah lingkungan dibandingkan baterai konvensional.
                Kami berkomitmen mendukung transisi menuju energi bersih di Indonesia dengan menyediakan sistem energi surya yang andal, aman, dan berkelanjutan untuk rumah tangga, industri, dan komunitas.
            </p>

            <p>
                Indonesia tengah menghadapi tantangan energi yang signifikan. Pertumbuhan ekonomi dan populasi mendorong kebutuhan listrik meningkat pesat setiap tahun.
                Berdasarkan Rencana Umum Ketenagalistrikan Nasional (RUKN), proyeksi pertumbuhan konsumsi listrik mencapai 6,9% per tahun hingga 2038.
                Namun, lebih dari 60% pasokan listrik nasional masih bergantung pada energi fosil yang berkontribusi terhadap emisi karbon tinggi dan dampak lingkungan negatif.
            </p>
            <p>
                <img src="{{ url('assets/img/img/ESDM.png') }}" alt="" width="50%">
            </p>
            <p><small>Source: <a href="https://www.esdm.go.id/id/berita-unit/direktorat-jenderal-ketenagalistrikan/proyeksi-sektor-kelistrikan-dalam-rukn-2019-2038" target="_blank">esdm.go.id</a></small>

            </p>
            <p>
                Selain itu, distribusi listrik
                belum merata, terutama di
                daerah terpencil dan
                kepulauan, yang
                menghambat pembangunan
                ekonomi setempat. Kondisi
                geografis Indonesia
                sebenarnya memberi
                keunggulan besar
                potensi energi matahari melimpah sepanjang tahun karena posisinya di
                garis khatulistiwa.Melihat permasalahan ini, Pembangkit Listrik Tenaga
                Surya (PLTS) berbasis Solid-State Battery (SSB) menjadi solusi tepat
                untuk menyediakan energi bersih, aman, dan berkelanjutan, sekaligus
                mendukung transisi Indonesia menuju masa depan energi hijau.
                <img src="{{ url('assets/img/img/KOMPASIANA.png') }}" alt="" style="width: 50%;">
            </p>
            <p><small>Source: <a href="https://www.kompasiana.com/sapphiraneysabahana9562/68ac6b8934777c22fd2a71c2/listrik-belum-merata-ketimpangan-akses-listrik-di-nusantara" target="_blank">kompasiana.com</a></small>

            <hr class="my-4">

            <h5><strong>Produk Kami</strong></h5>

            <h6 class="mt-3">🏠 Home Battery 16 kWh</h6>
            <img src="{{ url('assets/img/img/EN 0707 with Logo.png') }}" alt="" style="width: 30%;">
            <p>
                Sistem penyimpanan energi rumah tangga berbasis LFP solid-state yang aman, efisien, dan tahan lama.
                Dengan perlindungan IP66/IP65, baterai ini tahan debu, air, serta bekerja pada suhu -25°C hingga 60°C.
                Desain modular memudahkan instalasi dan penyesuaian kapasitas, menjadikannya solusi hemat biaya dan ramah lingkungan.
            </p>

            <h6 class="mt-3">🏭 Cabinet Type – Industrial System Battery</h6>
            <img src="{{ url('assets/img/img/EN-WELION wth logo.png') }}" alt="" style="width: 30%;">
            <p>
                Tipe Kabinet 215 kWh sistem baterai industri solid-state aman dan andal, tahan IP55/IP67 dengan opsi anti-korosi,
                desain modular mudah dipasang dan dirawat, serta dapat diskalakan hingga 10 unit untuk kebutuhan energi besar.
            </p>
            <p>
                Tipe Kabinet 522 kWh sistem baterai industri solid-state berkapasitas besar, aman dengan perlindungan kebakaran multi-sensor,
                tahan IP55/IP67 dengan opsi anti-korosi, fleksibel hingga 36 unit, dan mudah dipasang serta dikelola.
            </p>

            <h6 class="mt-3">🚛 Containerized Type – Grid-Scale Battery</h6>
            <img src="{{ url('assets/img/img/Wellion 3.png') }}" alt="" style="width: 30%;">
            <p>
                10-ft Containerized 2 MWh sistem baterai grid-scale solid-state aman, tahan IP55/IP67, dan mudah dipasang serta dikelola.
            </p>
            <p>
                20-ft Containerized 4.18 MWh sistem baterai grid-scale solid-state aman, tahan IP55/IP67, desain terintegrasi untuk pengelolaan mudah,
                dan andal di kondisi ekstrem.
            </p>
            <p>
                20-ft Containerized 5 MWh sistem baterai grid-scale solid-state aman, tahan IP55/IP67, dan kondisi ekstrem,
                dengan desain terintegrasi yang memudahkan instalasi, pengoperasian, dan pengelolaan jarak jauh.
            </p>

        </div>
    </div>
</div>

<style>
.about-content {
    background: #ffffff;
    border-radius: 16px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    line-height: 1.8;
}
.about-content h5, .about-content h6 {
    color: #0d6efd;
}
.about-content p {
    text-align: justify;
}
</style>
@endsection
