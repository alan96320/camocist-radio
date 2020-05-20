<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class SongsStore extends Model
{
    protected $table = 'songsstore';

    protected $fillable = [
        'channel',
        'cue_time_duration',
		'cue_time_start',
        'cue_title',
        'program_id',
        'track_artist_name'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
