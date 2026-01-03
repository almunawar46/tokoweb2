@extends('backend.v_layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('backend/css/custom-style.css') }}">
@endpush

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-lg-11">
            <div class="card shadow-sm border-0 card-produk-create">
                <div class="card-header bg-white py-3 border-0">
                    <h4 class="card-title mb-0 text-primary">
                        <i class="fas fa-plus-circle mr-2"></i>{{$judul}}
                    </h4>
                </div>
                
                {{-- TAMBAHKAN BAGIAN ERROR INI --}}
                @if ($errors->any())
                    <div class="alert alert-danger mx-lg-5 mt-3">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('backend.produk.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body px-lg-5">
                        <div class="row">
                            {{-- SISI KIRI: PREVIEW --}}
                            <div class="col-md-4 text-center border-right">
                                <div class="foto-preview-container mb-4">
                                    <label>Pratinjau Foto</label>
                                    <img class="foto-preview rounded shadow-sm border mb-3" 
                                         id="img-preview" {{-- Tambahkan ID --}}
                                         src="{{ asset('backend/images/no-image.jpg') }}" 
                                         style="width: 100%; max-height: 300px; object-fit: cover;">
                                    
                                    <div class="custom-file text-left">
                                        <input type="file" name="foto" class="custom-file-input @error('foto') is-invalid @enderror" id="fotoInput" onchange="previewFoto()">
                                        <label class="custom-file-label" for="fotoInput">Pilih file...</label>
                                    </div>
                                </div>
                            </div>

                            {{-- SISI KANAN: INPUT DATA --}}
                            <div class="col-md-8 pl-md-4">
                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <label>Kategori</label>
                                        <select class="form-control @error('kategori_id') is-invalid @enderror" name="kategori_id">
                                            <option value="" disabled selected>-- Pilih --</option>
                                            @foreach ($kategori as $k)
                                                <option value="{{ $k->id }}" {{ old('kategori_id') == $k->id ? 'selected' : '' }}>{{ $k->nama_kategori }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label>Nama Produk</label>
                                        <input type="text" name="nama_produk" class="form-control @error('nama_produk') is-invalid @enderror" value="{{ old('nama_produk') }}" placeholder="Nama Produk">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Detail Deskripsi</label>
                                    <textarea name="detail" id="ckeditor">{{ old('detail') }}</textarea>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-md-4 form-group">
                                        <label>Harga</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend"><span class="input-group-text">Rp</span></div>
                                            <input type="text" name="harga" class="form-control @error('harga') is-invalid @enderror" value="{{ old('harga') }}" onkeypress="return hanyaAngka(event)">
                                        </div>
                                    </div>
                                    <div class="col-md-4 form-group" style="display: none;"> {{-- Menambahkan style sembunyi --}}
    <label>Berat</label>
    <div class="input-group">
        <input type="text" name="berat" class="form-control" value="0" onkeypress="return hanyaAngka(event)">
        <div class="input-group-append"><span class="input-group-text">Gr</span></div>
    </div>
</div>
                                    <div class="col-md-4 form-group">
                                        <label>Stok</label>
                                        <input type="text" name="stok" class="form-control @error('stok') is-invalid @enderror" value="{{ old('stok') }}" onkeypress="return hanyaAngka(event)">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer bg-light py-3 d-flex justify-content-end">
                        <a href="{{ route('backend.produk.index') }}" class="btn btn-secondary mr-2">Batal</a>
                        <button type="submit" class="btn btn-primary btn-save shadow">Simpan Produk</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function previewFoto() {
        const fotoInput = document.querySelector('#fotoInput');
        const imgPreview = document.querySelector('#img-preview');
        const label = document.querySelector('.custom-file-label');

        label.textContent = fotoInput.files[0].name;

        const fileReader = new FileReader();
        fileReader.readAsDataURL(fotoInput.files[0]);

        fileReader.onload = function(e) {
            imgPreview.src = e.target.result;
        }
    }

    function hanyaAngka(evt) {
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
        return true;
    }
</script>
@endpush