<?php

namespace App\Helpers;

class XMLParser
{
    /**
     * 1つの楽曲のテキストから、その連想配列を返す
     * @param  string $song_info_text ある楽曲のXMLテキスト(keyとvalue)
     * @return array                  XMLから必要な情報を連想配列にしたもの
     */
    public static function getSongDataFromInfoText(string $song_info_text) :array
    {
        if (! preg_match_all('/<key>(.+?)<\/key><.+?>(.+?)<\/.+?>/', $song_info_text, $keys_and_values_matches)) {
            exit('not matches');
            return [];
        }

        if (empty($keys_and_values_matches)) {
            exit ('Cant Find Key And Value');
            return [];
        }

        $xml_keys = $keys_and_values_matches[1];
        $xml_values = $keys_and_values_matches[2];
        $xml_keys_and_values = array_combine($xml_keys, $xml_values);

        foreach ($xml_keys_and_values as $key => $val) {
            $val = html_entity_decode($val);
            if ($key === 'Track ID') {
                $song_data['track_id'] = $val;
            } elseif ($key === 'Name') {
                $song_data['title'] = $val;
            } elseif ($key === 'Artist') {
                $song_data['artist'] = $val;
            } elseif ($key === 'Album') {
                $song_data['album'] = $val;
            } elseif ($key === 'Genre') {
                $song_data['genre'] = $val;
            } elseif ($key === 'Play Count') {
                $song_data['play_count'] = (int)$val;
            } elseif ($key === 'Play Date') {
                $song_data['play_date'] = $val;
            }
        }


        var_dump($song_data);
        return $song_data;
    }

    /**
    * 改行を取り除いたXMLのテキストから楽曲の部分だけを取り出して返す
    * @param  string $file XMLから改行を取り除いたテキスト
    * @return array        各楽曲の情報テキスト
    */
    public static function grepSongsInfoTextFromXMLText(string $xml_text) :array
    {
        // 各楽曲のdictをxmlから取り出す
        $dicts =    (preg_match('/<dict>.*?<dict>(.+)<\/dict>.*?<key>Playlists<\/key>/', $xml_text, $dict_matches)) ? $dict_matches[1] : '';

        $songs_info_text = (preg_match_all('/<dict>(.+?)<\/dict>/', $dicts, $song_info_matches)) ? $song_info_matches[1] : '';

        return $songs_info_text;
    }

    public static function isXML($file)
    {
        $file_mime_type = $file->getMimeType();
        $valid_mime_type = ['text/xml', 'application/xml'];

        $is_valid_extenstion = $file->getClientOriginalExtension() == 'xml';
        $is_valid_mime_type = in_array($file_mime_type, $valid_mime_type, true);
        return $is_valid_extenstion && $is_valid_mime_type;
    }

    public static function joinXMLFile(\SplFileObject $xml_file) :string
    {
        $xml_text = str_replace(["\r\n", "\r", "\n", "\t"], '', $xml_file->fread($xml_file->getSize()));

        return $xml_text;
    }
}
