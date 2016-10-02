<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

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

    public function show(Review $review)
    {
        return view('reviews.show', compact('review'));
    }

    public function store(Request $request)
    {
        $rules = [
            'song_id' => 'required',
             'title' => 'required',
            'body' => 'required',
            'stars' => 'min:0|max:5',
            'artistic' => 'min:0|max:5',
            'exciting' => 'min:0|max:5',
            'pop' => 'min:0|max:5',
            'fun' => 'min:0|max:5',
        ];

        $this->validate($request, $rules);
        $review = new Review($request->all());
        // TODO 対応させる
        $review->user_id = 1;
        $review->save();
        $song = Song::findOrFail($request->input('song_id'));
        $song->reviews()->save($review);

        return redirect()->route('songs.show', $request->input('song_id'));
    }
}
