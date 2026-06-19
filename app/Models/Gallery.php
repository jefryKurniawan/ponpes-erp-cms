<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    /**
     * The table associated with the model.
     */
    protected $table = 'galleries';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'title',
        'description',
        'image_path',
        'is_active',
        'sort_order',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    /**
     * Scope a query to only include active galleries.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Get the judul attribute (alias for title).
     */
    public function getJudulAttribute()
    {
        return $this->title;
    }

    /**
     * Set the judul attribute (alias for title).
     */
    public function setJudulAttribute($value)
    {
        $this->title = $value;
    }

    /**
     * Get the deskripsi attribute (alias for description).
     */
    public function getDeskripsiAttribute()
    {
        return $this->description;
    }

    /**
     * Set the deskripsi attribute (alias for description).
     */
    public function setDeskripsiAttribute($value)
    {
        $this->description = $value;
    }
}