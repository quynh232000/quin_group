<?php
class Tool
{
    public function GUID()
    {
        if (function_exists('com_create_guid') === true) {
            return trim(com_create_guid(), '{}');
        }

        return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
    }
    public function uploadFile($file)
    {
        // print_r($file);
        $fileDir = "./assest/upload/";
        if (isset($file) && $file['error'] == 0) {
            $fileName = basename($file['name']);
            if (!file_exists($fileDir)) {
                mkdir($fileDir, 0, true);
            }
            $fileNameNew =   self::GUID() . "." . (explode(".", $fileName)[1]);
            $fileDir = $fileDir . $fileNameNew;
            if (move_uploaded_file($file['tmp_name'], $fileDir)) {
                return $fileNameNew;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function slug($text, string $divider = '-')
    {
        // replace non letter or digits by divider
        $text = preg_replace('~[^\pL\d]+~u', $divider, $text);

        // transliterate
        // $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);

        // trim
        $text = trim($text, $divider);

        // remove duplicate divider
        $text = preg_replace('~-+~', $divider, $text);

        // lowercase
        $text = strtolower($text);

        if (empty($text)) {
            return 'n-a';
        }

        return $text;
    }
    function path()
    {
        $url = $_SERVER['HTTP_HOST'];
        $url .= $_SERVER['REQUEST_URI'];
        $url = str_contains($url, "localhost") ? str_replace("localhost/web-demo_php", "", $url) : $url;

        $url = explode("/", $url);
        $value = "";
        if (count($url) > 2) {
            for ($i = 0; $i < count($url) - 2; $i++) {
                $value .= "../";
            }
        } else {
            $value = "/";
        }
        return $value;
    }
}
