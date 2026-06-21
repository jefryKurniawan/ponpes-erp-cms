@extends('layouts.admin')
@section('title_page','Bayar Pendaftaran Santri')
@section('content')
    <!-- Header -->
    <div class="max-w-6xl mx-auto">
        <div class="flex items-center justify-between mb-6">
            <h2 class="font-headline-md text-headline-md text-on-surface">Bayar Pendaftaran Santri</h2>
            <a href="{{ route('registration.index') }}" class="bg-gray-200 text-on-surface px-4 py-2 rounded-lg font-label-sm hover:bg-gray-300 transition-colors">Kembali</a>
        </div>
    </div>

    @if (Session::has('error'))
        <div class="mb-6 rounded-lg border border-danger bg-danger-container/10 p-4">
            <p class="font-body-sm text-danger">{{ Session('error') }}</p>
        </div>
    @endif

    <form action="{{ route('registration.store') }}" method="POST" class="cms-card bg-surface-container-lowest rounded-xl p-6 border border-outline-variant/20">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="santri_id" class="block font-label-sm mb-2 text-on-surface">Nama Santri</label>
                <select name="santri_id" id="santri_id" required class="cms-input w-full">
                    <option disabled selected>Pilih Santri</option>
                    @foreach ($data as $santri)
                        <option value="{{ $santri->id }}" @if (\App\Models\RegistrationCost::where('santri_id', $santri->id)->exists()) disabled @endif>{{ $santri->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex items-end">
                <button type="submit" class="bg-primary text-on-primary px-6 py-2 rounded-lg font-label-sm hover:bg-primary/90 transition-colors">Bayar</button>
            </div>
        </div>
    </form>
@endsection