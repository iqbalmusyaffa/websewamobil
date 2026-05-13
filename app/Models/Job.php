<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $table = 'job_postings';

    protected $guarded = [];

    protected $casts = [
        'requirements' => 'array',
        'benefits' => 'array',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    // Mutators for handling textarea input
    public function setRequirementsTextAttribute($value)
    {
        if (is_string($value)) {
            $this->attributes['requirements'] = json_encode(array_filter(array_map('trim', explode("\n", $value))));
        }
    }

    public function setBenefitsTextAttribute($value)
    {
        if (is_string($value)) {
            $this->attributes['benefits'] = json_encode(array_filter(array_map('trim', explode("\n", $value))));
        }
    }

    public function getRequirementsTextAttribute()
    {
        return is_array($this->attributes['requirements'] ?? null)
            ? implode("\n", $this->attributes['requirements'])
            : implode("\n", json_decode($this->attributes['requirements'] ?? '[]', true));
    }

    public function getBenefitsTextAttribute()
    {
        return is_array($this->attributes['benefits'] ?? null)
            ? implode("\n", $this->attributes['benefits'])
            : implode("\n", json_decode($this->attributes['benefits'] ?? '[]', true));
    }
}
