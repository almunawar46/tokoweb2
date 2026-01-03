@extends('frontend.layouts.app')

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link rel="stylesheet" href="{{ asset('css/customer.css') }}">
@endpush

@section('content')
<div class="container py-5">
    <div class="home-animation-wrapper animate__animated animate__bounceInDown">
        <h2 class="section-title text-center">Semua Produk</h2>
        
        <div class="product-grid">
            @forelse ($produk as $f)
                <div class="product-card">
                    <div class="product-img-container" onclick="toggleImage(this)">
                        <img src="{{ asset('storage/img-produk/'.$f->foto) }}" class="product-img active">
                        @foreach ($f->fotoProduk as $fp)
                            <img src="{{ asset('storage/img-produk/'.$fp->foto) }}" class="product-img">
                        @endforeach
                        <span class="click-hint">Klik</span>
                    </div>

                    <div class="product-content">
                        <a href="{{ route('produk.detail', $f->id) }}" class="product-name">{{ $f->nama_produk }}</a>
                        <p class="product-description">{{ Str::limit(strip_tags($f->detail ?? $f->deskripsi), 85) }}</p>
                        <div class="product-price">
                            Rp {{ number_format($f->harga, 0, ',', '.') }}
                        </div>
                        <a href="https://wa.me/6282340368266" class="btn-buy" target="_blank">
                            Beli via WhatsApp
                        </a>
                    </div>
                </div>
            @empty
                {{-- TAMPILAN TENAH SAAT KOSONG --}}
                <div class="empty-state-full-width">
                    <div class="empty-state-card animate__animated animate__zoomIn">
                        <div class="icon-box">
                            <i class="fas fa-box-open fa-5x"></i>
                        </div>
                        <h3>Produk Tidak Ditemukan</h3>
                        <p>Maaf, saat ini belum ada produk yang tersedia untuk kategori ini.</p>
                        <a href="{{ route('produk') }}" class="btn-reset">Kembali ke Semua Produk</a>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function toggleImage(container) {
    const imgs = container.querySelectorAll('.product-img');
    if (imgs.length <= 1) return;

    let activeIndex = 0;
    imgs.forEach((img, i) => {
        if (img.classList.contains('active')) activeIndex = i;
        img.classList.remove('active');
    });

    const nextIndex = (activeIndex + 1) % imgs.length;
    imgs[nextIndex].classList.add('active');
}
</script>
@endpush