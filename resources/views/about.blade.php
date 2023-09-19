@extends('front_template')

@section('title', $title)

@section('header', $header)

@section('konten')
    <header class="bg-primary text-white text-center py-5">
        <h1>Tentang Aplikasi Gudang</h1>
    </header>

    <!-- Bagian 2: Deskripsi -->
    <section class="container mt-5">
        <div class="row">
            <div class="col-md-6">
                <h2>Apa Itu Aplikasi Gudang?</h2>
                <p>
                    Aplikasi Gudang adalah perangkat lunak yang dirancang untuk membantu mengelola dan mengoptimalkan operasi gudang atau penyimpanan barang.
                    Ini memungkinkan perusahaan untuk melacak inventaris, mengelola pesanan, dan memantau pergerakan barang secara efisien.
                </p>
            </div>
            <div class="col-md-6">
                <img src="{{ asset('bg.jpg') }}" alt="Gudang" class="img-fluid rounded">
            </div>
        </div>
    </section>

    <!-- Bagian 3: Fitur Utama -->
    <section class="bg-light py-5 mt-2">
        <div class="container">
            <h2>Fitur Utama Aplikasi Gudang</h2>
            <ul>
                <li>Manajemen Inventaris</li>
                <li>Pelacakan Pesanan</li>
                <li>Optimasi Penyimpanan</li>
                <li>Integrasi dengan Sistem Lainnya</li>
                <li>Laporan dan Analisis</li>
            </ul>
        </div>
    </section>

    <!-- Bagian 4: Tim Kami -->
    <section class="container mt-5">
        <h2>Tim Kami Terbaru</h2>
        <div class="row">
            @foreach ($tim_terbaru as $item)
                <div class="col-md-4 mt-2 mt-md-4">
                    <div class="card text-center">
                        <img src="{{ asset('user.png') }}" alt="Anggota Tim" class="mt-1">
                        <div class="card-body">
                            <h5 class="card-title">{{ $item->name }}</h5>
                            <p class="card-text">{{ $item->email }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <!-- Bagian 5: produk terbaru -->
    <section class="container mt-5">
        <div class="d-flex justify-content-between">
            <h2>Produk Kami Terbaru</h2>
            <form class="form-inline" method="GET" action="{{ route('about') }}">
                <div class="form-group mx-sm-3 mb-2">
                    <input type="text" name="q" class="form-control" placeholder="nama, deskripsi produk">
                </div>
                <button type="submit" class="btn btn-primary mb-2">Cari</button>
            </form>
        </div>
        <div class="row">
            @foreach ($produk_terbaru as $item)
                <div class="col-md-4 mt-2 mt-md-4">
                    <div class="card text-center">
                        <img src="{{ asset('produk.jpg') }}" alt="Anggota Tim" class="mt-1 rounded">
                        <div class="card-body">
                            <h5 class="card-title">{{ $item->nama }}</h5>
                            <p class="card-text">{{ Str::limit($item->deskripsi, 20, '...') }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="row mt-5">
            <div class="col-md-12 text-center">
                {{ $produk_terbaru->withQueryString()->links() }}
            </div>
        </div>
    </section>
@endsection
