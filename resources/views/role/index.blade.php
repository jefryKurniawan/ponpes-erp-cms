@extends('layouts.home')
@section('title_page','Data Role')
@section('content')

    @if (Session::has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ Session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (Session::has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ Session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        <div class="col-md-8">
            <a href="{{ route('role.create') }}" class="btn btn-primary mb-3">Tambah Role</a>
        </div>
        <div class="col-md-4 mb-3">
            <form action="{{ route('role.index') }}" method="GET" class="d-flex">
                <input type="text" name="keyword" class="form-control me-2" placeholder="Search" value="{{ request()->get('keyword') }}">
                <button type="submit" class="btn btn-primary">Cari</button>
                <a href="{{ route('role.index') }}" class="btn btn-outline-secondary ms-2">Reset</a>
            </form>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Nama Role</th>
                    <th>Display Name</th>
                    <th>Deskripsi</th>
                    <th>Jenis Izin</th>
                    <th class="text-end">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($roles as $role => $result)
                    <tr>
                        <td>{{ $role + $roles->firstitem() }}</td>
                        <td>{{ $result->name }}</td>
                        <td>{{ $result->display_name }}</td>
                        <td>{!! nl2br(e($result->description)) !!}</td>
                        <td>
                            @if($result->permissions->isNotEmpty())
                                <ul class="list-unstyled mb-0 small">
                                    @foreach($result->permissions as $perm)
                                        <li><span class="badge bg-info">{{ $perm->group }}</span>: {{ $perm->name }}</li>
                                    @endforeach
                                </ul>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td class="text-end">
                            <a href="{{ route('role.edit', $result->id) }}" class="btn btn-sm btn-outline-primary"><i class="fas fa-pen"></i></a>
                            <form action="{{ route('role.destroy', $result->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus role ini? Jika ada pengguna yang menggunakan role ini, penghapusan akan ditolak.')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-4">Belum ada data role.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3">
        {{ $roles->links() }}
    </div>

@endsection