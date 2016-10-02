<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'user_id', 'song_id', 'title', 'body', 'stars', 'artistic', 'exciting', 'pop', 'fun'
    ];

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function song() {
        return $this->belongsTo('App\Song');
    }
}
