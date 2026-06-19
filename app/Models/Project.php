<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'title',
        'subtitle',
        'description',
        'image',
        'url',
        'github_url',
        'status',
        'meta_title',
        'meta_description',
        'meta_keywords',
    ];

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
