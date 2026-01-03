@extends('frontend.layouts.app')

@section('title', 'Detail - ' . $produk->nama_produk)

@section('content')
<div class="detail-wrapper">
    {{-- Kolom Kiri: Gambar --}}
    <div class="detail-image-section">
        <div class="detail-media-box">
            @if($produk->foto)
                <img src="{{ asset('storage/img-produk/'.$produk->foto) }}" alt="{{ $produk->nama_produk }}">
            @else
                <div class="icon-circle">
                    <i class="fa fa-image"></i>
                </div>
            @endif
        </div>
    </div>

    {{-- Kolom Kanan: Informasi & Form --}}
    <div class="detail-info-section">
        <nav class="breadcrumb-nav">
            <a href="{{ route('home') }}">Beranda</a> <span>/</span> 
            <a href="#">{{ $produk->kategori->nama_kategori ?? 'Produk' }}</a>
        </nav>

        <h1 class="detail-title">{{ $produk->nama_produk }}</h1>
        <p class="detail-category">Kategori: {{ $produk->kategori->nama_kategori ?? '-' }}</p>
        
        <h2 class="detail-price-tag">Rp {{ number_format($produk->harga, 0, ',', '.') }}</h2>

        <div class="detail-desc">
            <h5>Deskripsi</h5>
            <p>{{ $produk->deskripsi }}</p>
        </div>

        <div class="order-box">
            <div class="qty-group">
                <label for="jumlah">Jumlah</label>
                <input type="number" id="jumlah" class="input-qty" value="1" min="1">
            </div>

            <a href="https://wa.me/082340368266?text={{ urlencode('Halo, saya ingin memesan Produk '.$produk->nama_produk.' sebanyak 1') }}"
               id="wa-order-btn"
               class="btn-whatsapp"
               target="_blank">
               <i class="fab fa-whatsapp"></i> Pesan via WhatsApp
            </a>
        </div>
    </div>
</div>

<script>
    // Logic update link WhatsApp (Tetap seperti milik Anda, hanya ganti variabel id)
    const jumlahInput = document.getElementById('jumlah');
    const waBtn = document.getElementById('wa-order-btn');

    jumlahInput.addEventListener('input', function() {
        const jumlah = this.value || 1;
        const produk = "{{ $produk->nama_produk }}";
        const waNumber = "6281234567890"; 
        const text = `Halo, saya ingin memesan Produk ${produk} sebanyak ${jumlah}`;
        waBtn.href = `https://wa.me/${waNumber}?text=${encodeURIComponent(text)}`;
    });
</script>
@endsection