<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class LyricsStore extends Model
{
    protected $table = 'lyricsstore';

    protected $fillable = [
        'id',
        'songstore_id',
        'lfid',
        'instrumental',
        'viewable',
        'has_lrc',
        'lrc_verified',
        'title',
        'duration',
        'artists',
        'artist' ,
        'last_update',
        'lyrics',
        'lrc_version',
        'lrc',
        'api_url'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

  
}
