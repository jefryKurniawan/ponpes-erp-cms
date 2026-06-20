<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SystemSetting extends Model
{
    use HasFactory;

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'notif_email' => 'boolean',
        'notif_sms' => 'boolean',
        'tahun_berdiri' => 'integer',
    ];

    /**
     * Get the singleton system settings instance.
     *
     * @return SystemSetting
     */
    public static function singleton()
    {
        return self::firstOrCreate([]);
    }
}
