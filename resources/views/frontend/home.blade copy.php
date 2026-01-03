@extends('frontend.layouts.app')

@section('title', 'Beranda - Warasiko')

@section('content')
    {{-- Hero Welcome --}}
    <section style="margin: 40px 0; text-align: left;">
        <h1 style="font-size: 32px; font-weight: 800;">Selamat Datang di Warasiko</h1>
        <p style="color: #666;">Nikmati pilihan kopi dan camilan terbaik dari Nusantara.</p>
    </section>

    <div style="margin-bottom: 25px;">
        <h2 style="font-size: 20px; font-weight: 700;">Produk Terbaru</h2>
        <p style="font-size: 14px; color: #999;">Cek koleksi terbaru kami minggu ini</p>
    </div>

    {{-- Grid Produk --}}
    <div class="grid">
        @foreach($produk as $p)
            <div class="card">
                <div class="media">
                    @if($p->foto)
                        <img src="{{ asset('storage/img-produk/'.$p->foto) }}" alt="{{ $p->nama_produk }}">
                    @else
                        {{-- Lingkaran Hitam Ikon --}}
                        <div class="icon-circle">
                            <i class="fa fa-image"></i>
                        </div>
                    @endif
                </div>

                <div class="card-body">
                    <h3 class="prod-name">{{ $p->nama_produk }}</h3>
                    <p class="prod-price">Rp {{ number_format($p->harga, 0, ',', '.') }}</p>
                    
                    <a href="{{ route('produk.detail', $p->id) }}" class="prod-action">
                        Lihat Detail
                    </a>
                </div>
            </div>
        @endforeach
    </div>
@endsection