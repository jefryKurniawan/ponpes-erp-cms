@extends('layouts.home')

@section('title_page', 'Data Berita')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Data Berita</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            @can('admin' , 'bendahara')
            <a href="{{ route('admin.berita.create') }}" class="btn btn-sm btn-outline-secondary">Tambah Berita</a>
            @endcan
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Judul</th>
                    <th>Kategori</th>
                    <th>Status</th>
                    <th>Tanggal Publikasi</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @if(empty($posts) || $posts->isEmpty())
                    <tr>
                        <td colspan="6" class="text-center py-4">Belum ada data berita.</td>
                    </tr>
                @else
                    @php
                    $no = 1 + ($posts->currentPage() - 1) * $posts->perPage();
                    @endphp
                    @foreach($posts as $post)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $post->judul }}</td>
                        <td>
                            @if($post->category)
                                <span class="badge bg-secondary">{{ $post->category->nama }}</span>
                            @else
                                <span class="badge bg-light text-dark">-</span>
                            @endif
                        </td>
                        <td>
                            @switch($post->status)
                                @case('draft')
                                    <span class="badge bg-warning text-dark">Draft</span>
                                    @break
                                @case('published')
                                    <span class="badge bg-success">Published</span>
                                    @break
                                @case('archived')
                                    <span class="badge bg-secondary">Archived</span>
                                    @break
                                @default
                                    <span class="badge bg-light text-dark">{{ $post->status }}</span>
                            @endswitch
                        </td>
                        <td>{{ $post->published_at ? $post->published_at->format('d M Y') : '-' }}</td>
                        <td class="text-center">
                            <div class="btn-group">
                                <a href="{{ route('admin.berita.show', $post->id) }}" class="btn btn-sm btn-outline-info">
                                    <i class="bi bi-eye"></i>
                                </a>
                                @can('admin' , 'bendahara')
                                <a href="{{ route('admin.berita.edit', $post->id) }}" class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('admin.berita.destroy', $post->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus berita ini?')">
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

    {{ $posts->links() }}
</div>
@endsection