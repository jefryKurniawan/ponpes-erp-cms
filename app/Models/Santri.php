<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Santri extends Model
{
    use HasFactory, Uuids;

    public $incrementing = false;
    protected $guarded = [];

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function registration_cost()
    {
        return $this->hasOne(RegistrationCost::class);
    }

    public function syahriahs()
    {
        return $this->hasMany(Syahriah::class);
    }

    public function kelas()
    {
        return $this->belongsToMany(Kelas::class, 'santri_kelas')
                    ->withPivot('tahun_ajaran', 'masuk_kelas', 'keluar_kelas')
                    ->withTimestamps();
    }

    public function nilai()
    {
        return $this->hasMany(Nilai::class);
    }
}
