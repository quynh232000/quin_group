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
    public function uploadFile($file, $path = "")
    {
        // path = "foldername/"
        $fileDir = "./assest/upload/" . $path;
        if (isset($file) && $file['error'] == 0) {
            $fileName = basename($file['name']);
            if (!file_exists($fileDir)) {
                mkdir($fileDir, 0, true);
            }
            $fileNameNew = self::GUID() . "." . (explode(".", $fileName)[1]);
            $fileDir = $fileDir . $fileNameNew;
            if (move_uploaded_file($file['tmp_name'], $fileDir)) {
                return  $path . $fileNameNew;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function slug($string)
    {
        $string = preg_replace('/[^\p{L}\p{N}\s]/u', '', $string);

        // Convert Vietnamese characters to Latin characters
        $string = str_replace(
            ['á', 'à', 'ả', 'ã', 'ạ', 'ă', 'ắ', 'ằ', 'ẳ', 'ẵ', 'ặ', 'â', 'ấ', 'ầ', 'ẩ', 'ẫ', 'ậ', 'đ', 'é', 'è', 'ẻ', 'ẽ', 'ẹ', 'ê', 'ế', 'ề', 'ể', 'ễ', 'ệ', 'í', 'ì', 'ỉ', 'ĩ', 'ị', 'ó', 'ò', 'ỏ', 'õ', 'ọ', 'ô', 'ố', 'ồ', 'ổ', 'ỗ', 'ộ', 'ơ', 'ớ', 'ờ', 'ở', 'ỡ', 'ợ', 'ú', 'ù', 'ủ', 'ũ', 'ụ', 'ư', 'ứ', 'ừ', 'ử', 'ữ', 'ự', 'ý', 'ỳ', 'ỷ', 'ỹ', 'ỵ'],
            ['a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'd', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'i', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'y', 'y', 'y', 'y', 'y'],
            $string
        );

        // Remove remaining special characters
        $string = preg_replace('/[^\p{L}\p{N}\s]/u', '', $string);

        // Replace spaces with dashes
        $slug = str_replace(' ', '-', $string);

        // Remove extra dashes
        $slug = preg_replace('/-+/', '-', $slug);

        // Trim dashes from the beginning and end
        $slug = trim($slug, '-');

        // Convert to lowercase
        $slug = strtolower($slug);

        return $slug;
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
