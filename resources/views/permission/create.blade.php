@extends('layouts.home')
@section('title_page','Tambah Izin')
@section('content')

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row">
        <div class="col-md-8">
            <a href="{{ route('permission.index') }}" class="btn btn-secondary mb-3">Kembali</a>
            <h3>Tambah Izin Baru</h3>
        </div>
    </div>

    <form action="{{ route('permission.store') }}" method="POST">
        @csrf
        <div class="row mb-3">
            <label for="name" class="col-md-3 col-form-label">Nama Izin</label>
            <div class="col-md-9">
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required maxlength="50">
                @error('name')
                    <div class="invalid-feedback>{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="display_name" class="col-md-3 col-form-label">Display Name</label>
            <div class="col-md-9">
                <input type="text" class="form-control @error('display_name') is-invalid @enderror" id="display_name" name="display_name" value="{{ old('display_name') }}" required maxlength="100">
                @error('display_name')
                    <div class="invalid-feedback>{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="group" class="col-md-3 col-form-label">Grup Izin</label>
            <div class="col-md-9">
                <input type="text" class="form-control @error('group') is-invalid @enderror" id="group" name="group" value="{{ old('group') }}" required maxlength="50">
                @error('group')
                    <div class="invalid-feedback>{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row">
            <div class="col-md-3 offset-md-9">
                <button type="submit" class="btn btn-primary">Simpan Izin</button>
            </div>
        </div>
    </form>

@endsection

@push('scripts')
<script>
    // Optional: add some interactivity if needed
</script>
@endpush