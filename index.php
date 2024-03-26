<?php
session_start();
include_once "./lib/session.php";


extract($_REQUEST);
if (isset($mod)) {
    switch ($mod) {
        case 'page':
            include_once 'controller/page.php';
            break;
        case 'profile':
            include_once 'controller/profile.php';
            break;
        case 'seller':
            include_once 'controller/seller.php';
            break;
        case 'admin':
            include_once 'controller/admin.php';
            break;
        case 'admin':
            include_once 'controller/admin.php';
            break;
        case 'requestAdmin':
            include_once 'controller/requestAdmin.php';
            break;
        case 'redirect-google':
            include_once 'model/redirect-google.php';
            break;
        case 'verify':
            include_once 'controller/verify.php';
            break;

        default:
            header("Location: ?page=404");
    }
} else {
    if (isset($page)) {
        if ($page == "404") {
            include_once 'view/error.php';
        }
    } else {
        header('location: ?mod=page&act=home');
    }
}
