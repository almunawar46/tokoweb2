@extends('backend.v_layouts.app')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="font-weight-bold">Manajemen Kategori Produk</h3>
            <a href="{{ route('backend.kategori.create') }}" class="btn btn-primary px-4 shadow-sm">
                <i class="fas fa-plus"></i> Tambah Kategori Baru
            </a>
        </div>

        <div class="card border-0 shadow-sm" style="border-radius: 12px;">
            <div class="card-body p-4">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="text-muted">
                            <tr>
                                <th width="50">No</th>
                                <th>Nama Kategori</th>
                                <th width="200" class="text-end">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                           @foreach ($index as $row)
<tr>
    <td class="text-muted small">{{ $loop->iteration }}</td>
    <td class="font-weight-medium">{{ $row->nama_kategori }}</td>
    <td class="text-end">
        <a href="{{ route('backend.kategori.edit', $row->id) }}" class="btn btn-link text-primary p-1" title="Ubah Data">
            <i class="far fa-edit fa-lg"></i>
        </a>

        <form method="POST" action="{{ route('backend.kategori.destroy', $row->id) }}" style="display: inline-block;">
            @method('delete')
            @csrf
            <button type="submit" class="btn btn-link text-danger p-1 show_confirm" data-konf-delete="{{ $row->nama_kategori }}" title="Hapus Data">
                <i class="far fa-trash-alt fa-lg"></i>
            </button>
        </form>
    </td>
</tr>
@endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection