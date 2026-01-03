<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use App\Models\Kategori;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index(Request $request)
{
    $kategoriMenu = Kategori::select('id','nama_kategori')->get();

    $query = Produk::query();

    if ($request->search) {
        $query->where('nama_produk', 'like', '%' . $request->search . '%');
    }

    $produk = $query->latest()->get();

    return view('frontend.produk.index', compact('kategoriMenu', 'produk'));
}


    public function kategori($id)
    {
        $kategoriMenu = Kategori::all(); // TAMBAHKAN INI
        
        $produk = Produk::with(['fotoProduk','kategori'])
            ->where('kategori_id', $id)
            ->get();

        return view('frontend.produk.index', compact('produk', 'kategoriMenu'));
    }

    public function detail($id)
    {
        $kategoriMenu = Kategori::all(); // TAMBAHKAN INI
        
        $produk = Produk::with(['fotoProduk'])->findOrFail($id);
        return view('frontend.produk.detail', compact('produk', 'kategoriMenu'));
    }

    public function show($id)
{
    $produk = Produk::with('fotoProduk')->findOrFail($id);
    return view('frontend.v_produk.show', compact('produk'));
}

}