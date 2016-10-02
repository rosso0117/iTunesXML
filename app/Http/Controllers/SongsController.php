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
        return view('songs.show', compact('song', 'reviews'));
    }

}
