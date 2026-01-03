@extends('backend.v_layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-11">

        {{-- HEADER --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="font-weight-bold mb-1">Daftar Produk</h3>
                <p class="text-muted small mb-0">
                    Kelola daftar produk Anda di sini, termasuk menambahkan, mengubah, dan menghapus item.
                </p>
            </div>
            <a href="{{ route('backend.produk.create') }}" class="btn btn-danger px-4 shadow-sm rounded">
                <i class="fas fa-plus-circle mr-1"></i> Tambah Produk
            </a>
        </div>

        {{-- CARD --}}
        <div class="card border-0 shadow-sm rounded-lg">
            <div class="card-body p-4">

                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="bg-light">
                            <tr class="text-muted">
                                <th width="50">No</th>
                                <th>Nama Produk</th>
                                <th>Kategori</th>
                                <th>Stok</th>
                                <th class="text-center">Harga</th>
                                <th class="text-center" width="200">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>

                            @forelse ($index as $row)
                                <tr>
                                    <td class="text-muted small">
                                        {{ $loop->iteration }}
                                    </td>

                                    {{-- NAMA + STATUS --}}
                                    <td>
                                        <div class="font-weight-bold">
                                            {{ $row->nama_produk }}
                                        </div>

                                        @if ($row->status == 1)
                                            <span class="badge badge-success small">Publis</span>
                                        @else
                                            <span class="badge badge-secondary small">Blok</span>
                                        @endif
                                    </td>

                                    {{-- KATEGORI --}}
                                    <td>
                                        @if ($row->kategori)
                                            <span class="badge badge-light px-3 py-2">
                                                {{ $row->kategori->nama_kategori }}
                                            </span>
                                        @else
                                            <span class="text-muted small">-</span>
                                        @endif
                                    </td>

                                    {{-- STOK --}}
                                    <td>
                                        {{ $row->stok }}
                                    </td>

                                    {{-- HARGA --}}
                                    <td class="text-center font-weight-bold">
                                        Rp {{ number_format($row->harga, 0, ',', '.') }}
                                    </td>

                                    {{-- AKSI --}}
                                    <td class="text-center">
                                        <a href="{{ route('backend.produk.edit', $row->id) }}"
                                           class="btn btn-link text-primary"
                                           title="Ubah Produk">
                                            <i class="far fa-edit fa-lg"></i>
                                        </a>

                                        <a href="{{ route('backend.produk.show', $row->id) }}"
                                           class="btn btn-link text-warning"
                                           title="Kelola Gambar">
                                            <i class="far fa-image fa-lg"></i>
                                        </a>

                                        <form action="{{ route('backend.produk.destroy', $row->id) }}"
                                              method="POST"
                                              class="d-inline">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                class="btn btn-link text-danger show_confirm"
                                                data-konf-delete="{{ $row->nama_produk }}"
                                                title="Hapus Produk">
                                                <i class="far fa-trash-alt fa-lg"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-4">
                                        Data produk belum tersedia
                                    </td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>

            </div>
        </div>

    </div>
</div>
@endsection
