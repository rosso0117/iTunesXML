<?php

namespace App\Helpers;

class CSVHelper
{
    public static function exportCSV(string $file_path)
    {
        $export_path = str_replace('.xml', '', $file_path) . 'csv';
        
        $header = ['曲名', 'アーティスト', 'アルバム', 'ジャンル', '再生回数', '最後に再生した時間'];
    }
}
