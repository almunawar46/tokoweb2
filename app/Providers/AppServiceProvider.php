<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View; // Tambahkan ini
use App\Models\Kategori; // Tambahkan ini sesuai nama Model Anda
use Illuminate\Support\Facades\Schema;
class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
{
    // Jangan jalan saat build / composer / artisan
    if (app()->runningInConsole()) {
        return;
    }

    // Cegah error PDO
    if (!extension_loaded('pdo_mysql')) {
        return;
    }

    // Cegah error kalau table belum ada
    if (!Schema::hasTable('kategori')) {
        return;
    }

    // Baru aman query DB
    $kategoris = Kategori::all();
    View::share('kategoris', $kategoris);
}
}