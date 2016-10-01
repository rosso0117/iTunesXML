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

    public function upload(Request $request)
    {
        $file = $request->file('songs_xml');

        if ( !self::_isXML($file) ) {
            return;
        }

        // Fileを命名して保存
        $fileName = $file->getClientOriginalName() . '_' . time();
        $move = $file->move(storage_path() . '/xml', $fileName);

        // 曲の情報の連想配列が入った配列を取得する
        // TODO このあたりの処理もヘルパーでやる
        $xml_path = storage_path() . '/xml' . '/' . $fileName;
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

        return view('songs.index');
    }

    private static function _isXML($file)
    {
        $file_mime_type = $file->getMimeType();
        $valid_mime_type = ['text/xml', 'application/xml'];

        $is_valid_extenstion = $file->getClientOriginalExtension() == 'xml';
        $is_valid_mime_type = in_array($file_mime_type, $valid_mime_type, true);
        return $is_valid_extenstion && $is_valid_mime_type;
    }
}
