<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Post extends Model
{
    protected $table = 'posts';

    protected $fillable = [
        'title',
		'url',
        'description',
        'category_id',
		'video',
        'date',
        'featured',
        'content',
        'image_url',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function getFormattedDate($value){
        if ($value) {
            $date = new Carbon($value);
            return $date->format('M d, Y');
        }
    }
}
