<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class News extends Model
{
    protected $table = 'news';

    protected $fillable = [
        'title',
        'description',
        'category_id',
        'date',
        'external_url',
        'image_url',
        'ordering',       
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
