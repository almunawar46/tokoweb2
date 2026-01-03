<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Models\Produk;

class HomeController extends Controller
{
   public function index()
{
    $kategoriMenu = Kategori::select('id', 'nama_kategori')->get();
    $produk = Produk::select('id','nama_produk','harga','foto','detail')
                ->latest()
                ->take(8)
                ->get();

    return view('frontend.home', compact('kategoriMenu', 'produk'));
}

}
