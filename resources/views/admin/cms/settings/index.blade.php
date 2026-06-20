@extends('layouts.admin')

@section('title', 'Pengaturan CMS')

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="mb-6">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-headline-md text-headline-md text-on-surface">Pengaturan CMS</h2>
                <p class="font-body-sm text-body-sm text-on-surface-variant mt-1">Kelola pengaturan sistem CMS</p>
            </div>
            @can('admin', 'bendahara')
            <a href="{{ route('admin.cms.settings.create') }}" class="bg-primary text-on-primary px-4 py-2 rounded-lg font-label-sm hover:bg-primary/90 transition-colors">
                Tambah Pengaturan
            </a>
            @endcan
        </div>
    </div>

    @if(session('success'))
        <div class="mb-6 rounded-lg border border-success bg-success-container/10 p-4">
            <p class="font-body-sm text-success">{{ session('success') }}</p>
        </div>
    @endif

    @if(session('error'))
        <div class="mb-6 rounded-lg border border-error bg-error-container/10 p-4">
            <p class="font-body-sm text-error">{{ session('error') }}</p>
        </div>
    @endif

    @if(empty($settings) || $settings->isEmpty())
        <div class="cms-card bg-surface-container-lowest rounded-xl p-8 border border-outline-variant/20 text-center">
            <span class="material-symbols-outlined text-6xl text-on-surface-variant/50 mb-4">settings</span>
            <p class="text-on-surface-variant">Belum ada pengaturan yang ditambahkan.</p>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach($settings as $type => $typeSettings)
                <div class="cms-card bg-surface-container-lowest rounded-xl border border-outline-variant/20 overflow-hidden">
                    <div class="px-6 py-4 border-b border-outline-variant/10 bg-surface-container/50">
                        <h3 class="font-headline-sm text-headline-sm text-on-surface">{{ ucfirst($type) }}</h3>
                    </div>
                    <div class="p-6">
                        <table class="w-full">
                            <thead>
                                <tr class="text-left text-on-surface-variant text-sm">
                                    <th class="pb-2 font-label-sm">Field</th>
                                    <th class="pb-2 font-label-sm">Nilai</th>
                                    <th class="pb-2 text-center font-label-sm">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-outline-variant/10">
                                @foreach($typeSettings as $setting)
                                    <tr>
                                        <td class="py-3 text-on-surface-variant text-sm">
                                            @if($setting->nama_pesantren)
                                                Nama Pesantren
                                            @elseif($setting->tahun_berdiri)
                                                Tahun Berdiri
                                            @elseif($setting->pendiri)
                                                Pendiri
                                            @elseif($setting->isi)
                                                Visi
                                            @elseif($setting->isi_misi)
                                                Misi
                                            @elseif($setting->tanggal_buka)
                                                Tanggal Buka
                                            @elseif($setting->tanggal_tutup)
                                                Tanggal Tutup
                                            @elseif($setting->tanggal_seleksi_akademik)
                                                Tanggal Seleksi
                                            @elseif($setting->tanggal_pengumuman)
                                                Tanggal Pengumuman
                                            @elseif($setting->biaya_pendaftaran)
                                                Biaya Pendaftaran
                                            @elseif($setting->biaya_spp)
                                                Biaya SPP
                                            @else
                                                Unknown
                                            @endif
                                        </td>
                                        <td class="py-3 text-on-surface text-sm">
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
                                        <td class="py-3">
                                            <div class="flex items-center justify-center gap-2">
                                                <a href="{{ route('admin.cms.settings.show', $setting->id) }}" class="text-info hover:text-info/80 transition-colors" title="Lihat Detail">
                                                    <span class="material-symbols-outlined text-sm">visibility</span>
                                                </a>
                                                @can('admin', 'bendahara')
                                                <a href="{{ route('admin.cms.settings.edit', $setting->id) }}" class="text-primary hover:text-primary/80 transition-colors" title="Edit">
                                                    <span class="material-symbols-outlined text-sm">edit</span>
                                                </a>
                                                <form action="{{ route('admin.cms.settings.destroy', $setting->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-error hover:text-error/80 transition-colors" title="Hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus pengaturan ini?')">
                                                        <span class="material-symbols-outlined text-sm">delete</span>
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
                @if($loop->index % 2 == 1)
                    </div><div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @endif
            @endforeach
        </div>
    @endif
</div>
@endsection