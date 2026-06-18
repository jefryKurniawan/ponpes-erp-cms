<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    /**
     * The table associated with the model.
     */
    protected $table = 'settings';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'type',
        'nama_pesantren',
        'tahun_berdiri',
        'pendiri',
        'isi',
        'isi_misi',
        'tanggal_buka',
        'tanggal_tutup',
        'tanggal_seleksi_akademik',
        'tanggal_pengumuman',
        'biaya_pendaftaran',
        'biaya_spp',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'biaya_pendaftaran' => 'decimal:2',
        'biaya_spp' => 'decimal:2',
    ];
}