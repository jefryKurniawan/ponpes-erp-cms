<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PsbApplication extends Model
{
    use HasFactory;

    protected $table = 'psb_applications';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'nama_lengkap',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'alamat',
        'no_telepon',
        'email',
        'asal_sekolah',
        'nama_wali',
        'pekerjaan_wali',
        'no_telepon_wali',
    ];
}
