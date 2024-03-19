<?php
class Format
{
    public function formatData($date)
    {
        return date('F j, Y, g:i a', strtotime($date));
    }
    public function textShorten($text, $limit = 400)
    {
        $text = $text . " ";
        $text = substr($text, 0, $limit);
        $text = substr($text, 0, strrpos($text, ' '));
        $text = $text . "....";
        return $text;
    }
    public function validation($data)
    {
        $data = trim($data);
        $data = stripcslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    public function title()
    {
        $path = $_SERVER['SCRIPT_FILENAME'];
        $title = basename($path, ".php");
        if ($title == 'index') {
            $title = 'home';
        } elseif ($title == 'contact') {
            $title = 'contact';
        }
        return $title = ucfirst($title);
    }
    function diffForHumans($date)
    {
        $date = new DateTime($date);
        $now = new DateTime("now");

        $interval = $date->diff($now);

        $years = $interval->y;
        $months = $interval->m;
        $days = $interval->d;
        $hours = $interval->h;
        $minutes = $interval->i;
        $seconds = $interval->s;

        if ($years > 0) {
            return $years . " năm trước";
        }
        if ($months > 0) {
            return $months . " tháng trước";
        }
        if ($days > 0) {
            return $days . " ngày trước";
        }
        if ($hours > 0) {
            return $hours . " giờ trước";
        }
        if ($minutes > 0) {
            return $minutes . " phút trước";
        }
        if ($seconds > 0) {
            return $seconds . " giây trước";
        }

        return "vừa xong";
    }
}
?>