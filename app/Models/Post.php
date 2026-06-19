<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /**
     * The table associated with the model.
     */
    protected $table = 'posts';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'title',
        'slug',
        'content',
        'excerpt',
        'status',
        'published_at',
        'category_id',
        'featured_image',
        'meta_title',
        'meta_description',
    ];

    /**
     * The attributes that should be cast to native types.
     */
    protected $casts = [
        'published_at' => 'datetime',
        'status' => 'string',
    ];

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName()
    {
        return 'slug';
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
     * Get the isi attribute (alias for content).
     */
    public function getIsiAttribute()
    {
        return $this->content;
    }

    /**
     * Set the isi attribute (alias for content).
     */
    public function setIsiAttribute($value)
    {
        $this->content = $value;
    }

    /**
     * Scope a query to only include published posts.
     */
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    /**
     * Get the category that owns the post.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}