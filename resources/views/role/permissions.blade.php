@extends('layouts.home')
@section('title_page','Manajemen Izin untuk Role: {{ $role->name }}')
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

    @if (Session::has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ Session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        <div class="col-md-8">
            <a href="{{ route('role.edit', $role->id) }}" class="btn btn-secondary mb-3">Kembali ke Edit Role</a>
            <h3>Atur Izin untuk Role: <strong>{{ $role->display_name }}</strong></h3>
            <p class="text-muted">Centang izin yang ingin diberikan kepada role ini.</p>
        </div>
    </div>

    <form action="{{ route('role.updatePermissions', $role->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-4">
            @foreach($permissions->groupBy('group') as $groupName => $groupPerms)
                <div class="border rounded p-3 mb-3">
                    <h5>{{ ucfirst($groupName) }}</h5>
                    <div class="row">
                        @foreach($groupPerms as $perm)
                            <div class="col-md-4 mb-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="permissions[]" value="{{ $perm->id }}" id="perm_{{ $perm->id }}" {{ $role->permissions->contains($perm->id) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="perm_{{ $perm->id }}">
                                        {{ $perm->name }}
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>

        <div class="row">
            <div class="col-md-6 offset-md-6">
                <button type="submit" class="btn btn-primary">Simpan Izin</button>
            </div>
        </div>
    </form>

@endsection

@push('scripts')
<script>
    // Optional: add select all per group if needed
</script>
@endpush