<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Playlist;
use App\Song;
use App\Review;

class ReviewsController extends Controller
{
    public function create()
    {
        return view('reviews.create');
    }

    public function destroy(Review $review)
    {
        $song = $review->song();
        $review->delete();
        \Session::flash('flash_message', 'レビューを消去しました');
        return redirect()->route('songs.show', $song);
    }

    public function show(Playlist $playlist, Song $song, Review $review)
    {
        return view('reviews.show', compact('review'));
    }

    public function store(Request $request)
    {
        $playlist_id = $request->input('playlist_id');
        $song_id = $request->input('song_id');

        $rules = [
            'song_id'  => 'required',
            'title'    => 'required',
            'body'     => 'required',
            'stars'    => 'min:0|max:5',
            'artistic' => 'min:0|max:5',
            'exciting' => 'min:0|max:5',
            'pop'      => 'min:0|max:5',
            'fun'      => 'min:0|max:5',
        ];

        $this->validate($request, $rules);

        $review = new Review($request->all());
        // TODO User対応させる
        $review->user_id = 1;
        $review->save();

        $song = Song::findOrFail($song_id);
        $song->reviews()->save($review);

        \Session::flash('flash_message', 'レビューを投稿しました');

        if ($playlist_id) {
            return redirect()->route('playlists.songs.show', [$playlist_id,$song_id]);
        } else {
            return redirect()->route('playlists');
        }
    }
}
