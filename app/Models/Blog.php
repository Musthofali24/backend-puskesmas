<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'category',
        'excerpt',
        'content',
        'featured_image',
        'author',
        'read_time',
        'is_published',
        'published_at',
        'views_count',
        'meta_tags',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'published_at' => 'datetime',
        'meta_tags' => 'array',
        'views_count' => 'integer',
        'read_time' => 'integer',
    ];

    // Automatically generate slug from title
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($blog) {
            if (empty($blog->slug)) {
                $blog->slug = Str::slug($blog->title);
            }
        });

        static::updating(function ($blog) {
            if ($blog->isDirty('title')) {
                $blog->slug = Str::slug($blog->title);
            }
        });
    }

    // Scope untuk filter berdasarkan kategori
    public function scopeCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    // Scope untuk blog yang sudah dipublish
    public function scopePublished($query)
    {
        return $query->where('is_published', true)
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now());
    }

    // Accessor untuk kategori dalam format readable
    public function getCategoryLabelAttribute()
    {
        return match ($this->category) {
            'berita-kesehatan' => 'Berita Kesehatan',
            'promosi-kesehatan' => 'Promosi Kesehatan',
            'artikel-kesehatan' => 'Artikel Kesehatan',
            'kegiatan-puskesmas' => 'Kegiatan Puskesmas',
            default => $this->category,
        };
    }
}
