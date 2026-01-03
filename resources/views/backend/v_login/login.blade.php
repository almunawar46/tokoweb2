<!DOCTYPE html>
<html dir="ltr" lang="id">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Warasiko</title>

    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('image/icon_univ_bsi.png') }}" />



   

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

   <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    
    @stack('styles')
</head>

<body>
    <div class="login-container animate__animated animate__flip">

        <div id="loginform">
            <div class="logo-box">
                <img src="{{ asset('image/logo.png') }}" alt="logo" width="50%" />
            </div>
            <h1>Warasiko</h1>

            @if(session()->has('error'))
            <div class="alert">
                <strong>{{ session('error') }}</strong>
            </div>
            @endif

            <form action="{{ route('backend.login') }}" method="POST">
    @csrf
    
    <div class="input-group">
        <input type="text" id="email" name="email"
            class="@error('email') is-invalid @enderror"
            placeholder=" " value="{{ old('email') }}" required />
        <label for="email">Email</label>
        @error('email')
        <span class="error-message">{{ $message }}</span>
        @enderror
    </div>

    <div class="input-group">
        <input type="password" id="password" name="password"
            class="@error('password') is-invalid @enderror"
            placeholder=" " required />
        <label for="password">Kata Sandi</label>
        @error('password')
        <span class="error-message">{{ $message }}</span>
        @enderror
    </div>

    <button type="submit">Masuk</button>

    <div class="links">
        <span id="to-recover">Lupa Password?</span>
    </div>
</form>
        </div>

        <div id="recoverform" style="display: none;">
            <h1>Pulihkan Password</h1>
            <p style="font-size: 13px; text-align: center; color: #666; margin-bottom: 20px;">
                Masukkan email Anda dan kami akan mengirimkan instruksi pemulihan.
            </p>
            <form action="#">
                <label for="recover-email">Email</label>
                <input type="email" id="recover-email" placeholder="Email Address" required />
                <button type="button">Kirim Instruksi</button>
                <div class="links" style="justify-content: center;">
                    <span id="to-login">Kembali ke Login</span>
                </div>
            </form>
        </div>
    </div>

    <script src="{{ asset('backend/libs/jquery/dist/jquery.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $("#to-recover").on("click", function() {
                $("#loginform").hide();
                $("#recoverform").fadeIn();
            });
            $("#to-login").on("click", function() {
                $("#recoverform").hide();
                $("#loginform").fadeIn();
            });
        });
    </script>
</body>

</html>