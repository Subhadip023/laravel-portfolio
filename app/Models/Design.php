<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Design extends Model
{
    protected $fillable = [
        'title',
        'subtitle',
        'description',
        'image',
        'bg_gradient',
        'url',
        'status',
    ];

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
