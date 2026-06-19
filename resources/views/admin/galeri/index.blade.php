@extends('layouts.home')

@section('title_page', 'Data Galeri')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Data Galeri</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            @can('admin' , 'bendahara')
            <a href="{{ route('admin.galeri.create') }}" class="btn btn-sm btn-outline-secondary">Tambah Galeri</a>
            @endcan
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <form method="GET" action="{{ route('admin.galeri.index') }}" class="row g-3 mb-4">
        <div class="col-auto">
            <label for="is_active" class="visually-labeled">Status Aktif</label>
            <select class="form-select" id="is_active" name="is_active">
                <option value="">Semua Status</option>
                <option value="1" {{ request()->input('is_active') == '1' ? 'selected' : '' }}>Aktif</option>
                <option value="0" {{ request()->input('is_active') == '0' ? 'selected' : '' }}>Tidak Aktif</option>
            </select>
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-primary">Filter</button>
            <a href="{{ route('admin.galeri.index') }}" class="btn btn-outline-secondary">Reset</a>
        </div>
    </form>

    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Galeri</th>
                    <th>Status Aktif</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @if(empty($galleries) || $galleries->isEmpty())
                    <tr>
                        <td colspan="4" class="text-center py-4">Belum ada data galeri.</td>
                    </tr>
                @else
                    @php
                    $no = 1 + ($galleries->currentPage() - 1) * $galleries->perPage();
                    @endphp
                    @foreach($galleries as $gallery)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $gallery->nama }}</td>
                        <td>
                            @if($gallery->is_active == 1)
                                <span class="badge bg-success">Aktif</span>
                            @else
                                <span class="badge bg-secondary">Tidak Aktif</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <div class="btn-group">
                                <a href="{{ route('admin.galeri.show', $gallery->id) }}" class="btn btn-sm btn-outline-info">
                                    <i class="bi bi-eye"></i>
                                </a>
                                @can('admin' , 'bendahara')
                                <a href="{{ route('admin.galeri.edit', $gallery->id) }}" class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('admin.galeri.destroy', $gallery->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus galeri ini?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                                @endcan
                            </div>
                        </td>
                    </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>

    {{ $galleries->links() }}
</div>
@endsection