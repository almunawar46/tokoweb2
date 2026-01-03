<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\FotoProduk;

class FotoProdukController extends Controller
{
    // ================= SIMPAN FOTO =================
    public function store(Request $request)
    {
        $request->validate([
            'produk_id' => 'required|exists:produk,id',
            'foto_produk.*' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        foreach ($request->file('foto_produk') as $foto) {
            $namaFile = time().'_'.$foto->getClientOriginalName();

            // simpan ke storage/app/public/img-produk
            $foto->storeAs('img-produk', $namaFile, 'public');

            DB::table('foto_produk')->insert([
                'produk_id' => $request->produk_id,
                'foto' => $namaFile,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        return back()->with('success', 'Foto produk berhasil ditambahkan');
    }

    // ================= HAPUS FOTO =================
    public function destroy($id)
    {
        $foto = FotoProduk::findOrFail($id);

        // hapus file fisik
        if ($foto->foto && Storage::disk('public')->exists('img-produk/'.$foto->foto)) {
            Storage::disk('public')->delete('img-produk/'.$foto->foto);
        }

        // hapus data DB
        $foto->delete();

        return back()->with('success', 'Foto berhasil dihapus');
    }
}
