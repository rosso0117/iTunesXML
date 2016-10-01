<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Song;
use App\Helpers\XMLParser;

class SongsController extends Controller
{
    public function index() {
        $songs = Song::all();
        return view('songs.index', compact('songs'));
    }

    public function create() {
        return view('songs.create');
    }

    public function store(Request $request)
    {
        $file = $request->file('songs_xml');

        if ( !XMLParser::isXML($file) ) {
            return;
        }

        // Fileを命名して保存
        $file_name = $request->input('name', $file->getClientOriginalName());
        $file_name_with_time = $file_name . '_' . time();
        $move = $file->move(storage_path() . '/xml', $file_name_with_time);

        // 曲の情報の連想配列が入った配列を取得する
        // TODO このあたりの処理もヘルパーでやる
        $xml_path = storage_path() . '/xml' . '/' . $file_name_with_time;
        $xml_file = new \SplFileObject($xml_path);
        $xml_text = XMLParser::joinXMLFile($xml_file);
        $songs_info_text = XMLParser::grepSongsInfoTextFromXMLText($xml_text);

        // 各楽曲のXMLテキストを連想配列にして、DBに保存
        foreach ($songs_info_text as $song_info_text) {
            $song_data = XMLParser::getSongDataFromInfoText($song_info_text);
            $song = new Song($song_data);

            // 既存の曲なら再生回数と時間だけを更新する
            if (Song::where('track_id', $song->track_id)) {
                $song->update([
                    'play_count' => $song->play_count,
                    'play_date' => $song->play_date
                ]);
            } else {
                $song->save();
            }
        }

        return view('playlists.index');
    }

}
