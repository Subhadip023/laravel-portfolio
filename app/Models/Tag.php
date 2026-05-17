<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['name', 'slug'];

    public function blogs()
    {
        return $this->belongsToMany(Blog::class);
    }

    public function designs()
    {
        return $this->belongsToMany(Design::class);
    }

    public function projects()
    {
        return $this->belongsToMany(Project::class);
    }
}
