<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    protected $fillable = [
        'track_id', 'title', 'artist', 'album', 'genre', 'play_count', 'play_date', 'created_at', 'updatead_at'
    ];

    public function playlists()
    {
        return $this->belongsToMany('App\Playlist');
    }
}
