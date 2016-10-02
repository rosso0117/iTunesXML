<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Song;
use App\Helpers\XMLParser;

class SongsController extends Controller
{
    public function show(Song $song)
    {
        $reviews = $song->reviews;
        if ($reviews) {
                $review_jsons = json_encode($reviews, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);
        }
        return view('songs.show', compact('song', 'reviews', 'review_jsons'));
    }

}
