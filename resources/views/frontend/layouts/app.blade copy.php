<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Warasiko')</title>
    <link rel="stylesheet" href="{{ asset('css/customer.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

<header class="topbar">
    <div class="header-left">
        <div class="logo">
            <strong>Warasiko</strong>
        </div>
        <nav class="nav-menu">
            <a href="{{ route('home') }}">Beranda</a>
            <div class="dropdown">
    <button class="dropbtn">
        Kategori <i class="fa fa-chevron-down"></i>
    </button>

    <div class="dropdown-content">
        <a href="{{ route('produk') }}">Semua</a>
        @foreach($kategoriMenu as $kat)
            <a href="{{ route('produk.kategori', $kat->id) }}">
                {{ $kat->nama_kategori }}
            </a>
        @endforeach
    </div>
</div>

        </nav>
    </div>

    <div class="search-bar">
        <i class="fa fa-search"></i>
        <input type="text" placeholder="Cari produk...">
    </div>

    <div class="header-right">
        <a href="#" class="help-link">help</a>
    </div>
</header>

<main class="container">
    @yield('content')
</main>

<footer class="footer">
    <div class="footer-container">
        <div class="footer-col">
            <h4>Kontak Kami</h4>
            <p><i class="fa fa-map-marker-alt"></i> Jl. Rasa Enak No. 10, Jakarta</p>
            <p><i class="fa fa-phone"></i> (021) 123-4567</p>
            <p><i class="fa fa-envelope"></i> info@rasanusantara.id</p>
        </div>
        <div class="footer-col">
            <h4>Tautan Cepat</h4>
            <ul>
                <li><a href="#">Tentang Kami</a></li>
                <li><a href="#">Karir</a></li>
                <li><a href="#">Kebijakan Privasi</a></li>
                <li><a href="#">Syarat & Ketentuan</a></li>
            </ul>
        </div>
        <div class="footer-col">
            <h4>Ikuti Kami</h4>
            <div class="social-icons">
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-facebook"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-youtube"></i></a>
            </div>
        </div>
        <div class="footer-col">
            <h4>Hak Cipta</h4>
            <p>© 2024 Rasa Nusantara. Semua hak dilindungi.</p>
        </div>
    </div>
</footer>

</body>
</html>