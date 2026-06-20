<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuids;

class Nilai extends Model
{
    use HasFactory, Uuids;

    public $incrementing = false;
    protected $guarded = [];

    public function santri()
    {
        return $this->belongsTo(Santri::class);
    }

    public function mapel()
    {
        return $this->belongsTo(Mapel::class);
    }
}
