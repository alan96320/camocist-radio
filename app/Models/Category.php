<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

    protected $fillable = [
        'name',
        'type',
        'color',        
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function posts() {
        return $this->hasMany(Post::class);
    }

    public function news() {
        return $this->hasMany(News::class);
    }
}
