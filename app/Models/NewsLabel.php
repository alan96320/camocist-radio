<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsLabel extends Model
{
    protected $table = 'news_label';

    protected $fillable = [
        'name',     
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
