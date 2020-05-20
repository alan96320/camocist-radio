<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Filters extends Model
{
    protected $table = 'filters';

    protected $fillable = [
        'name',
        'active',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
