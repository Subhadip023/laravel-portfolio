<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resume extends Model
{
    protected $fillable = [
        'title',
        'name',
        'email',
        'phone',
        'location',
        'linkedin',
        'website',
        'education',
        'experience',
        'training',
        'projects',
        'skills',
        'is_active',
    ];

    protected $casts = [
        'education' => 'array',
        'experience' => 'array',
        'training' => 'array',
        'projects' => 'array',
        'skills' => 'array',
        'is_active' => 'boolean',
    ];
}
