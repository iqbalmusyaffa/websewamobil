<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BugReport extends Model
{
    protected $fillable = ['name', 'email', 'title', 'description', 'attachments', 'status'];

    protected $casts = [
        'attachments' => 'array',
    ];
}
