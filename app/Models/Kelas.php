<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuids;

class Kelas extends Model
{
    use HasFactory, Uuids;

    public $incrementing = false;
    protected $guarded = [];

    public function santris()
    {
        return $this->belongsToMany(Santri::class, 'santri_kelas')
                    ->withPivot('tahun_ajaran', 'masuk_kelas', 'keluar_kelas')
                    ->withTimestamps();
    }
}
