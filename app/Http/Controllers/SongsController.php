<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Song;
use App\Helpers\XMLParser;
use App\Playlist;

class SongsController extends Controller
{
    public function show(Playlist $playlist, Song $song)
    {
        $reviews = $song->reviews;
        if ($reviews) {
                $review_jsons = json_encode($reviews, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);
        }
        return view('songs.show', compact('playlist', 'song', 'reviews', 'review_jsons'));
    }

}
