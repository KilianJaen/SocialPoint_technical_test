<?php

namespace KilianJaen\Ranking\Controllers;

class FileController
{
    private const FILENAME = "src/saved_info.json";

    public function getFile(): array
    {
        $json = '';

        if (file_exists(self::FILENAME)) {
            $json = file_get_contents(self::FILENAME);
        }
        $file = json_decode($json, true);

        return !empty($file)? $file : [];
    }

    public function insertData(array $fileInfo)
    {
        file_put_contents(self::FILENAME,json_encode($fileInfo));
    }
}