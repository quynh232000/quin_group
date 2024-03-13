<?php
extract($_REQUEST);

if (isset($mod)) {
    switch ($mod) {
        case "pages":
            include_once "controller/pages.php";
            break;
        case "request":
            include_once "controller/request.php";
            break;
        default:
            header("location: ?mod=pages&act=dashboard");
            break;
    }
} else {
    header("location: ?mod=pages&act=dashboard");
}
