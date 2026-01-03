@extends('frontend.layouts.app')

@section('title', 'Detail - ' . $produk->nama_produk)

@push('styles')
    {{-- Memanggil CSS Detail yang dipisah tadi --}}
    <link rel="stylesheet" href="{{ asset('css/product-detail.css') }}">
@endpush

@section('content')
<div class="detail-container">
    {{-- Breadcrumb --}}
    <div class="breadcrumb-custom">
        <a href="{{ route('home') }}" style="color: inherit; text-decoration: none;">Beranda</a> 
        <span style="margin: 0 10px;">&gt;</span> 
        <span style="color: var(--dark-text);">{{ $produk->nama_produk }}</span>
    </div>

    <div class="product-main">
        {{-- Sisi Kiri: Foto --}}
        <div class="product-gallery">
            @if($produk->foto)
                <img src="{{ asset('storage/img-produk/'.$produk->foto) }}" alt="{{ $produk->nama_produk }}">
            @else
                <div style="text-align: center; color: #ccc;">
                    <i class="fa fa-image fa-4x"></i>
                    <p>Gambar tidak tersedia</p>
                </div>
            @endif
        </div>

        {{-- Sisi Kanan: Detail --}}
        <div class="product-info">
            <h1 class="product-title">{{ $produk->nama_produk }}</h1>
            <div class="product-price">Rp {{ number_format($produk->harga, 0, ',', '.') }}</div>

            <div class="control-group">
                <div class="control-label">Stok</div>
                <div class="qty-input-wrapper">
                    <button class="qty-btn" type="button" onclick="adjustQty(-1)">-</button>
                    <input type="number" id="jumlah" class="qty-input" value="1" min="1" readonly>
                    <button class="qty-btn" type="button" onclick="adjustQty(1)">+</button>
                </div>
            </div>

            <div class="control-group">
                <div class="control-label">Ukuran</div>
                <select class="size-select">
                    <option>Kecil</option>
                    <option selected>Sedang</option>
                    <option>Besar</option>
                </select>
            </div>

            <div class="wa-link-wrapper">
                <a href="#" id="wa-order-btn" class="wa-link-text" target="_blank">
                    whatsapp
                </a>
            </div>
        </div>
    </div>

    {{-- Deskripsi --}}
    <div class="description-box">
        <div class="description-title">Deskripsi</div>
        <p class="description-text">
            {{ $produk->deskripsi ?? 'Detail deskripsi produk belum tersedia.' }}
        </p>
    </div>
</div>

<script>
    function adjustQty(amount) {
        const input = document.getElementById('jumlah');
        let newVal = parseInt(input.value) + amount;
        if (newVal >= 1) {
            input.value = newVal;
            updateWhatsAppURL();
        }
    }

    function updateWhatsAppURL() {
        const qty = document.getElementById('jumlah').value;
        const produk = "{{ $produk->nama_produk }}";
        const waNumber = "6282340368266"; // Format internasional wajib 62
        const message = `Halo Warasiko, saya ingin memesan ${produk} sebanyak ${qty} unit.`;
        
        document.getElementById('wa-order-btn').href = `https://wa.me/${waNumber}?text=${encodeURIComponent(message)}`;
    }

    window.onload = updateWhatsAppURL;
</script>
@endsection