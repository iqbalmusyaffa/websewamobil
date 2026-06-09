<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BugBountyProgram extends Model
{
    protected $fillable = [
        'title',
        'description',
        'reward_details',
        'start_date',
        'end_date',
        'is_active',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'is_active' => 'boolean',
    ];
}
