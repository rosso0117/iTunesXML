<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

use App\Http\Requests;
use App\Playlist;
use App\User;
use App\Song;
use App\Helpers\XMLParser;

class PlaylistsController extends Controller
{
    public function index() {
        $playlists = Playlist::all();
        return view('playlists.index', compact('playlists'));
    }

    public function create() {
        return view('playlists.create');
    }

    public function destroy(Playlist $playlist)
    {
        $playlist->delete();
        \Session::flash('flash_message', 'プレイリストを消去しました');
        return redirect()->route('playlists.index');
    }

    public function show(Playlist $playlist)
    {
        return view('playlists.show', compact('playlist'));
    }

    public function store(Request $request)
    {
        $rules = [
            'playlist_xml' => 'required'
        ];

        $this->validate($request, $rules);

        $file = $request->file('playlist_xml');

        if ( !XMLParser::isXML($file) ) {
            \Session::flash('flash_message', 'XMLファイルではありません');
            return redirect()->route('playlists.index');
        }

        // Fileを命名して保存
        $file_name = (string)filter_var($request->input(['name']));
        if ($file_name == '') {
            $file_name = $file->getClientOriginalName();
        }
        $file_name_with_time = $file_name . '_' . time();
        $move = $file->move(storage_path() . '/xml', $file_name_with_time);

        DB::transaction(function() use($file_name, $file_name_with_time) {
            $playlist = new Playlist(['name' => $file_name]);
            $playlist->save();

            // 曲の情報の連想配列が入った配列を取得する
            // TODO このあたりの処理もヘルパーでやる
            $xml_path = storage_path() . '/xml' . '/' . $file_name_with_time;
            $xml_file = new \SplFileObject($xml_path);
            $xml_text = XMLParser::joinXMLFile($xml_file);
            $songs_info_text = XMLParser::grepSongsInfoTextFromXMLText($xml_text);

            self::saveOrUpdateSongs($playlist, $songs_info_text);
        });

        \Session::flash('flash_message', 'XMLファイルをアップロードしました');
        return redirect()->route('playlists.index');
    }

    private static function saveOrUpdateSongs(Playlist $playlist, array $songs_info_text) {
        // 各楽曲のXMLテキストを連想配列にして、DBに保存
        foreach ($songs_info_text as $song_info_text) {
            $song_data = XMLParser::getSongDataFromInfoText($song_info_text);
            $song = Song::create($song_data);

            // 既存の曲なら再生回数と時間だけを更新する
            if (Song::where('track_id', $song->track_id)) {
                $song->update([
                    'play_count' => $song->play_count,
                    'play_date' => $song->play_date
                ]);
            } else {
                $song->save();
            }
            $playlist->songs()->attach($song);
        }
    }
}
