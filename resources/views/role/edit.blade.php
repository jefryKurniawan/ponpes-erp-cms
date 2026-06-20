@extends('layouts.home')
@section('title_page','Edit Role')
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
            <a href="{{ route('role.index') }}" class="btn btn-secondary mb-3">Kembali</a>
            <h3>Edit Role: {{ $role->name }}</h3>
        </div>
    </div>

    <form action="{{ route('role.update', $role->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row mb-3">
            <label for="name" class="col-md-3 col-form-label">Nama Role</label>
            <div class="col-md-9">
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $role->name) }}" required maxlength="50">
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="display_name" class="col-md-3 col-form-label">Display Name</label>
            <div class="col-md-9">
                <input type="text" class="form-control @error('display_name') is-invalid @enderror" id="display_name" name="display_name" value="{{ old('display_name', $role->display_name) }}" required maxlength="100">
                @error('display_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="description" class="col-md-3 col-form-label">Deskripsi</label>
            <div class="col-md-9">
                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3">{{ old('description', $role->description) }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="permissions" class="col-md-3 col-form-label">Izin</label>
            <div class="col-md-9">
                <div class="row">
                    @foreach($permissions as $perm)
                        <div class="col-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="permissions[]" value="{{ $perm->id }}" id="perm_edit_{{ $perm->id }}" {{ $role->permissions->contains($perm->id) ? 'checked' : '' }}>
                                <label class="form-check-label" for="perm_edit_{{ $perm->id }}">
                                    <span class="badge bg-secondary">{{ $perm->group }}</span>: {{ $perm->name }}
                                </label>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3 offset-md-9">
                <button type="submit" class="btn btn-primary">Update Role</button>
            </div>
        </div>
    </form>

@endsection

@push('scripts')
<script>
    // Optional: add some interactivity if needed
</script>
@endpush