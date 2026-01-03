@extends('backend.v_layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card border-0 shadow-sm" style="border-radius: 15px;">
                <div class="card-body p-5">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h3 class="font-weight-bold">{{ $judul }}</h3>
                        <a href="{{ route('backend.produk.index') }}" class="btn btn-outline-secondary px-4">
                            <i class="fas fa-arrow-left mr-1"></i> Kembali
                        </a>
                    </div>

                    <div class="row">
                        {{-- ================= KIRI: DETAIL PRODUK ================= --}}
                        <div class="col-md-5">
                            <div class="form-group mb-3">
                                <label class="font-weight-bold text-muted small">NAMA PRODUK</label>
                                <div class="p-3 bg-light rounded">{{ $show->nama_produk }}</div>
                            </div>

                            <div class="form-group mb-3">
                                <label class="font-weight-bold text-muted small">KATEGORI</label>
                                <div class="p-2 bg-light rounded">
                                    {{ $show->kategori->nama_kategori ?? 'Tanpa Kategori' }}
                                </div>
                            </div>

                            <div class="form-group mb-4">
                                <label class="font-weight-bold text-muted small">DESKRIPSI DETAIL</label>
                                <div class="p-3 bg-light rounded" style="min-height: 100px;">
                                    {{ $show->detail }}
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold text-muted small">FOTO UTAMA PRODUK</label>
                                <img src="{{ asset('storage/img-produk/' . $show->foto) }}" 
                                     class="img-fluid rounded shadow-sm border w-100" 
                                     style="max-height: 300px; object-fit: cover;">
                            </div>
                        </div>

                        {{-- ================= KANAN: MANAGEMENT FOTO TAMBAHAN ================= --}}
                        <div class="col-md-7 border-left pl-md-5">
                            <div class="card border-0 bg-light" style="border-radius: 12px;">
                                <div class="card-body">
                                    <h5 class="font-weight-bold mb-3">Tambah Koleksi Foto</h5>
                                    <form action="{{ route('backend.foto_produk.store') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="produk_id" value="{{ $show->id }}">
                                        
                                        <div id="foto-inputs" class="mb-3">
                                            <input type="file" name="foto_produk[]" class="form-control mb-2" required>
                                        </div>

                                        <div class="d-flex">
                                            <button type="button" class="btn btn-primary btn-sm mr-2" id="addFoto">
                                                <i class="fas fa-plus"></i> Baris Foto
                                            </button>
                                            <button type="submit" class="btn btn-success btn-sm">
                                                <i class="fas fa-save"></i> Unggah Foto
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <hr class="my-4">

                            <h5 class="font-weight-bold mb-3">Koleksi Foto Tambahan</h5>
                            <div class="row">
                                @forelse ($show->fotoProduk as $gambar)
                                    <div class="col-md-4 col-6 mb-4">
                                        <div class="position-relative gallery-container">
                                            <img src="{{ asset('storage/img-produk/' . $gambar->foto) }}" 
                                                 class="img-fluid rounded shadow-sm border gallery-img"
                                                 style="height: 120px; width: 100%; object-fit: cover;">
                                            
                                            <form action="{{ route('backend.foto_produk.destroy', $gambar->id) }}" method="POST" 
                                                  class="position-absolute" style="top: 5px; right: 10px;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm rounded-circle shadow-sm" 
                                                        onclick="return confirm('Hapus foto ini?')">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                @empty
                                    <div class="col-12 text-center py-3">
                                        <p class="text-muted small">Belum ada foto tambahan.</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.getElementById('addFoto').addEventListener('click', function () {
        const container = document.getElementById('foto-inputs');
        const input = document.createElement('input');
        input.type = 'file';
        input.name = 'foto_produk[]';
        input.className = 'form-control mb-2';
        input.required = true;
        container.appendChild(input);
    });
</script>
@endpush