<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $guarded = [];

    protected $casts = [
        'operational_hours' => 'json',
        'features' => 'json',
        'gallery_images' => 'json',
        'is_active' => 'boolean',
        'rating' => 'float',
    ];

    public function vehicles()
    {
        return $this->hasMany(CarUnit::class);
    }

    public function reviews()
    {
        return $this->hasMany(BranchReview::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('name');
    }

    /**
     * Get cover image URL
     */
    public function getCoverImageUrl()
    {
        if (!$this->cover_image) {
            return 'https://images.unsplash.com/photo-1514924013411-cbf25faa35bb?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80';
        }

        // If it's a URL (starts with http)
        if (str_starts_with($this->cover_image, 'http')) {
            return $this->cover_image;
        }

        // If it's a file path in storage
        return asset('storage/' . $this->cover_image);
    }

    /**
     * Get gallery images
     */
    public function getGalleryImages()
    {
        if (!$this->gallery_images || empty($this->gallery_images)) {
            return [
                'https://images.unsplash.com/photo-1514924013411-cbf25faa35bb?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80',
                'https://images.unsplash.com/photo-1535122066461-dbf9e675b865?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80',
                'https://images.unsplash.com/photo-1493857671505-72967e2e2760?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80',
            ];
        }

        return collect($this->gallery_images)->map(function ($image) {
            if (str_starts_with($image, 'http')) {
                return $image;
            }
            return asset('storage/' . $image);
        })->toArray();
    }

    /**
     * Get formatted operational hours
     */
    public function getOperationalHours()
    {
        return $this->operational_hours ?? [
            'opening_time' => '08:00',
            'closing_time' => '22:00',
        ];
    }
}
