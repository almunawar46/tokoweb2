@extends('frontend.layouts.app')

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link rel="stylesheet" href="{{ asset('css/customer.css') }}">
@endpush

@section('content')
<div class="container py-5">
    <div class="home-animation-wrapper animate__animated animate__bounceInDown">
        <h2 class="section-title text-center">Produk Terbaru</h2>
        
        <div class="product-grid">
            @forelse ($produk as $f)
                <div class="product-card">
                    <div class="product-img-container" onclick="toggleImage(this)">
                        {{-- FOTO UTAMA --}}
                        <img src="{{ asset('storage/img-produk/'.$f->foto) }}" class="product-img active">

                        {{-- FOTO TAMBAHAN --}}
                        @if($f->fotoProduk)
                            @foreach ($f->fotoProduk as $fp)
                                <img src="{{ asset('storage/img-produk/'.$fp->foto) }}" class="product-img">
                            @endforeach
                        @endif

                        <span class="click-hint"><i class="fas fa-sync-alt"></i> Klik</span>
                    </div>

                    <div class="product-content">
                        <a href="{{ route('produk.detail', $f->id) }}" class="product-name">
                            {{ $f->nama_produk }}
                        </a>
                        
                        <p class="product-description">
                            {{ Str::limit(strip_tags($f->detail ?? $f->deskripsi), 85) }}
                        </p>

                        <div class="product-price">
                            Rp {{ number_format($f->harga, 0, ',', '.') }}
                        </div>

                        @php
                            $waNumber = '6282340368266';
                            $pesan = urlencode("Halo Warasiko, saya ingin memesan: *" . $f->nama_produk . "*");
                        @endphp
                        <a href="https://wa.me/{{ $waNumber }}?text={{ $pesan }}" class="btn-buy" target="_blank">
                            <i class="fab fa-whatsapp"></i> Beli via WhatsApp
                        </a>
                    </div>
                </div>
            @empty
                <div class="empty-state-full-width">
                    <div class="empty-state-card animate__animated animate__zoomIn">
                        <div class="icon-box">
                            <i class="fas fa-box-open fa-5x"></i>
                        </div>
                        <h3>Produk Tidak Tersedia</h3>
                        <p>Maaf, saat ini koleksi produk kami sedang diperbarui.</p>
                        <a href="https://wa.me/6282340368266" class="btn-reset">Tanya Admin</a>
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