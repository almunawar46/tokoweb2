<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <title>@yield('title', 'Warasiko') - Toko Online Terpercaya</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <link rel="stylesheet" href="{{ asset('css/customer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    
    @stack('styles')

    <style>
        body { font-family: 'Inter', sans-serif; background-color: #fcfcfc; }
        .dropdown-content.show { display: block !important; z-index: 9999; }
    </style>
</head>
<body>

<header class="topbar">
    <div class="header-content">
        <div class="nav-left">
            <div class="logo">
                <a href="{{ route('home') }}"><strong>Warasiko</strong></a>
            </div>
            <nav class="nav-links">
                <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Beranda</a>
                
                <div class="dropdown">
                    <span class="dropbtn" id="categoryBtn">
                        Kategori <i class="fa fa-chevron-down" style="font-size: 10px; margin-left: 5px;"></i>
                    </span>
                    <div class="dropdown-content" id="myDropdown">
                        <a href="{{ route('produk') }}">Semua Produk</a>
                        {{-- Variabel kategoriMenu harus dikirim dari Controller atau AppServiceProvider --}}
                        @if(isset($kategoriMenu))
                            @foreach($kategoriMenu as $kat)
                                <a href="{{ route('produk.kategori', $kat->id) }}">{{ $kat->nama_kategori }}</a>
                            @endforeach
                        @endif
                    </div>
                </div>
            </nav>
        </div>

       <div class="search-area">
    <form action="{{ route('produk') }}" method="GET">
        <div class="search-input-wrapper">
            <i class="fa fa-search search-icon"></i>
            <input type="text" name="search" placeholder="Cari produk..." value="{{ request('search') }}">
           
            <button type="submit" class="btn-search-text">Cari</button>
        </div>
    </form>
</div>

        <div class="nav-right">
            <a href="https://wa.me/6282340368266" target="_blank" class="help-link">
                <i class="fa fa-question-circle"></i> Bantuan
            </a>
        </div>
    </div>
</header>

<main>
    {{-- BAGIAN PENTING: Di sini isi dari home.blade.php akan muncul --}}
    @yield('content')
</main>

<footer class="footer">
    <div class="footer-container">
        <div class="footer-col">
            <h4>Kontak Kami</h4>
            <p><i class="fa fa-map-marker-alt"></i> Jl. Rasa Enak No. 10, Jakarta</p>
        </div>
        <div class="footer-col">
            <h4>Hak Cipta</h4>
            <p>&copy; {{ date('Y') }} Warasiko. Semua hak dilindungi.</p>
        </div>
    </div>
</footer>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const dropBtn = document.getElementById('categoryBtn');
        const dropdownMenu = document.getElementById('myDropdown');

        if(dropBtn && dropdownMenu) {
            dropBtn.addEventListener('click', function(event) {
                event.stopPropagation();
                dropdownMenu.classList.toggle('show');
            });

            window.addEventListener('click', function() {
                if (dropdownMenu.classList.contains('show')) {
                    dropdownMenu.classList.remove('show');
                }
            });
        }
    });
</script>

@stack('scripts')
</body>
</html>