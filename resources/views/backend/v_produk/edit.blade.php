@extends('backend.v_layouts.app')
@section('content')

<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card border-0 shadow-sm" style="border-radius: 15px;">
                <div class="card-body p-5">
                    <h3 class="font-weight-bold mb-4">{{ $judul }}</h3>
                    
                    <form action="{{ route('backend.produk.update', $edit->id) }}" method="post" enctype="multipart/form-data">
                        @method('put')
                        @csrf

                        <div class="mb-4">
                            <label class="form-label font-weight-bold">Gambar Produk</label>
                            <div class="mb-3">
                                @if ($edit->foto)
                                    <img src="{{ asset('storage/img-produk/' . $edit->foto) }}" class="img-thumbnail foto-preview shadow-sm" style="width: 250px; border-radius: 10px; display: block;">
                                @else
                                    <img src="{{ asset('storage/img-produk/img-default.jpg') }}" class="img-thumbnail foto-preview shadow-sm" style="width: 250px; border-radius: 10px; display: block;">
                                @endif
                            </div>
                            <label class="btn btn-outline-danger btn-sm px-4" style="border-radius: 8px; cursor: pointer;">
                                Ganti Gambar
                                <input type="file" name="foto" class="d-none @error('foto') is-invalid @enderror" onchange="previewFoto()">
                            </label>
                            @error('foto')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 form-group mb-3">
                                <label class="form-label font-weight-bold">Nama Produk</label>
                                <input type="text" name="nama_produk" value="{{ old('nama_produk', $edit->nama_produk) }}" class="form-control bg-light border-0 py-3 @error('nama_produk') is-invalid @enderror" style="border-radius: 8px;" placeholder="Masukkan Nama Produk">
                                @error('nama_produk')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-6 form-group mb-3">
                                <label class="form-label font-weight-bold">Kategori</label>
                                <select name="kategori_id" class="form-control bg-light border-0 py-3 @error('kategori_id') is-invalid @enderror" style="border-radius: 8px; height: auto;">
                                    <option value="" disabled>Pilih Kategori</option>
                                    @foreach ($kategori as $row)
                                        <option value="{{ $row->id }}" {{ old('kategori_id', $edit->kategori_id) == $row->id ? 'selected' : '' }}> 
                                            {{ $row->nama_kategori }} 
                                        </option>
                                    @endforeach
                                </select>
                                @error('kategori_id')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-6 form-group mb-3">
                                <label class="form-label font-weight-bold">Stok</label>
                                <input type="text" onkeypress="return hanyaAngka(event)" name="stok" value="{{ old('stok', $edit->stok) }}" class="form-control bg-light border-0 py-3 @error('stok') is-invalid @enderror" style="border-radius: 8px;" placeholder="0">
                                @error('stok')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-6 form-group mb-3">
                                <label class="form-label font-weight-bold">Harga</label>
                                <input type="text" onkeypress="return hanyaAngka(event)" name="harga" value="{{ old('harga', $edit->harga) }}" class="form-control bg-light border-0 py-3 @error('harga') is-invalid @enderror" style="border-radius: 8px;" placeholder="Rp 0">
                                @error('harga')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group mb-4">
                            <label class="form-label font-weight-bold">Deskripsi Produk</label>
                            <textarea name="detail" class="form-control bg-light border-0 @error('detail') is-invalid @enderror" id="ckeditor" rows="5" style="border-radius: 8px;">{{ old('detail', $edit->detail) }}</textarea>
                            @error('detail')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="row mb-5">
                            <div class="col-md-6">
                                <label class="form-label font-weight-bold">Status</label>
                                <select name="status" class="form-control bg-light border-0 py-3 @error('status') is-invalid @enderror" style="border-radius: 8px; height: auto;">
                                    <option value="1" {{ old('status', $edit->status) == '1' ? 'selected' : '' }}>Publis</option>
                                    <option value="0" {{ old('status', $edit->status) == '0' ? 'selected' : '' }}>Blok</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label font-weight-bold">Berat (Gram)</label>
                                <input type="text" onkeypress="return hanyaAngka(event)" name="berat" value="{{ old('berat', $edit->berat) }}" class="form-control bg-light border-0 py-3 @error('berat') is-invalid @enderror" style="border-radius: 8px;">
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-2 mt-4">
                            <a href="{{ route('backend.produk.index') }}" class="btn btn-outline-secondary px-5 py-2 mr-2" style="border-radius: 8px;">Batal</a>
                            <button type="submit" class="btn btn-danger px-5 py-2" style="border-radius: 8px;">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection