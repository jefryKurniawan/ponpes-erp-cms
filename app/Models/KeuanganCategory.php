<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Traits\Uuids;

class KeuanganCategory extends Model
{
    use HasFactory, Uuids;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'nama',
        'tipe',
        'icon',
        'warna',
        'keterangan'
    ];

    /**
     * Get pemasukan categories
     */
    public static function pemasukan()
    {
        return self::where('tipe', 'pemasukan')->get();
    }

    /**
     * Get pengeluaran categories
     */
    public static function pengeluaran()
    {
        return self::where('tipe', 'pengeluaran')->get();
    }

    /**
     * Boot the model
     */
    protected static function boot()
    {
        parent::boot();

        // Auto-generate UUID if not present
        static::creating(function ($model) {
            if (empty($model->id)) {
                $model->id = (string) Str::uuid();
            }
        });
    }
}