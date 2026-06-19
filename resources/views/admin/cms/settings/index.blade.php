@extends('layouts.home')

@section('title_page', 'Pengaturan CMS')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Pengaturan CMS</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            @can('admin' , 'bendahara')
            <a href="{{ route('admin.cms.settings.create') }}" class="btn btn-sm btn-outline-secondary">Tambah Pengaturan</a>
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

    @if(empty($settings) || $settings->isEmpty())
        <div class="alert alert-info">
            Belum ada pengaturan yang ditambahkan.
        </div>
    @else
        <div class="row">
            @foreach($settings as $type => $typeSettings)
                <div class="col-md-6">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="card-title mb-0">{{ ucfirst($type) }}</h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>Field</th>
                                        <th>Nilai</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($typeSettings as $setting)
                                        <tr>
                                            <td>{{ $setting->nama_pesantren ?? $setting->tahun_berdiri ?? $setting->pendiri ?? $setting->isi ?? $setting->isi_misi ?? $setting->tanggal_buka ?? $setting->tanggal_tutup ?? $setting->tanggal_seleksi_akademik ?? $setting->tanggal_pengumuman ?? $setting->biaya_pendaftaran ?? $setting->biaya_spp ?? 'unknown' }}</td>
                                            <td>
                                                @if($setting->nama_pesantren)
                                                    {{ $setting->nama_pesantren }}
                                                @elseif($setting->tahun_berdiri)
                                                    {{ $setting->tahun_berdiri }}
                                                @elseif($setting->pendiri)
                                                    {{ $setting->pendiri }}
                                                @elseif($setting->isi)
                                                    {{ strlen($setting->isi) > 50 ? Str::limit($setting->isi, 50) . '...' : $setting->isi }}
                                                @elseif($setting->isi_misi)
                                                    {{ strlen($setting->isi_misi) > 50 ? Str::limit($setting->isi_misi, 50) . '...' : $setting->isi_misi }}
                                                @elseif($setting->tanggal_buka)
                                                    {{ $setting->tanggal_buka ? $setting->tanggal_buka->format('d M Y') : '-' }}
                                                @elseif($setting->tanggal_tutup)
                                                    {{ $setting->tanggal_tutup ? $setting->tanggal_tutup->format('d M Y') : '-' }}
                                                @elseif($setting->tanggal_seleksi_akademik)
                                                    {{ $setting->tanggal_seleksi_akademik ? $setting->tanggal_seleksi_akademik->format('d M Y') : '-' }}
                                                @elseif($setting->tanggal_pengumuman)
                                                    {{ $setting->tanggal_pengumuman ? $setting->tanggal_pengumuman->format('d M Y') : '-' }}
                                                @elseif($setting->biaya_pendaftaran)
                                                    {{ 'Rp ' . number_format($setting->biaya_pendaftaran, 0, ',', '.') }}
                                                @elseif($setting->biaya_spp)
                                                    {{ 'Rp ' . number_format($setting->biaya_spp, 0, ',', '.') }}
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <div class="btn-group">
                                                    <a href="{{ route('admin.cms.settings.show', $setting->id) }}" class="btn btn-sm btn-outline-info">
                                                        <i class="bi bi-eye"></i>
                                                    </a>
                                                    @can('admin' , 'bendahara')
                                                    <a href="{{ route('admin.cms.settings.edit', $setting->id) }}" class="btn btn-sm btn-outline-primary">
                                                        <i class="bi bi-pencil"></i>
                                                    </a>
                                                    <form action="{{ route('admin.cms.settings.destroy', $setting->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus pengaturan ini?')">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    </form>
                                                    @endcan
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                @if($loop->index % 2 == 1)
                    </div><div class="row">
                @endif
            @endforeach
        </div>
    @endif
</div>
@endsection