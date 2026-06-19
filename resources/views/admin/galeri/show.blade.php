@extends('layouts.home')

@section('title_page', $gallery->nama)

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">{{ $gallery->nama }}</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <a href="{{ route('admin.galeri.index') }}" class="btn btn-sm btn-outline-secondary">Kembali ke Daftar</a>
            @can('admin' , 'bendahara')
            <a href="{{ route('admin.galeri.edit', $gallery->id) }}" class="btn btn-sm btn-outline-primary">Edit</a>
            @endcan
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row mb-4">
        <div class="col-md-6">
            @if($gallery->gambar && file_exists(public_path('storage/'.$gallery->gambar)))
                <img src="{{ asset('storage/'.$gallery->gambar) }}" class="img-fluid rounded" alt="Sampul Galeri">
            @else
                <div class="bg-light p-4 text-center rounded">
                    <i class="bi bi-images fs-1 text-muted mb-3"></i>
                    <p class="text-muted">Tidak ada gambar sampul</p>
                </div>
            @endif
        </div>
        <div class="col-md-6">
            <dl class="row">
                <dt class="col-sm-3">Status Aktif</dt>
                <dd class="col-sm-9">
                    @if($gallery->is_active == 1)
                        <span class="badge bg-success">Aktif</span>
                    @else
                        <span class="badge bg-secondary">Tidak Aktif</span>
                    @endif
                </dd>

                <dt class="col-sm-3">Tanggal Pembuatan</dt>
                <dd class="col-sm-9">{{ $gallery->created_at ? $gallery->created_at->format('d M Y H:i') : '-' }}</dd>

                <dt class="col-sm-3">Tanggal Perbaruan</dt>
                <dd class="col-sm-9">{{ $gallery->updated_at ? $gallery->updated_at->format('d M Y H:i') : '-' }}</dd>

                <dt class="col-sm-3">Slug (tidak digunakan)</dt>
                <dd class="col-sm-9">-</dd>
            </dl>
        </div>
    </div>

    @if(!empty($gallery->keterangan))
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Keterangan</h5>
            </div>
            <div class="card-body">
                {!! nl2br(e($gallery->keterangan)) !!}
            </div>
        </div>
    @endif

    @can('admin' , 'bendahara')
    <div class="mt-4">
        <!-- In a real implementation, this would show images belonging to this gallery -->
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Daftar Gambar dalam Galeri</h5>
            </div>
            <div class="card-body">
                <div class="alert alert-info">
                    <i class="bi bi-info-circle me-2"></i>
                    Fitur manajemen gambar dalam galeri akan diimplementasikan dalam modul yang terpisah.
                </div>
            </div>
        </div>
    @endcan
</div>
@endsection