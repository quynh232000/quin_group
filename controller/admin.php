<?php

extract($_REQUEST);
if (isset($act) && $act) {
    switch ($act) {

        //dashboard
        case "dashboard":
            include_once "view/admin/header.php";
            include_once "view/admin/index.php";
            include_once "view/admin/scripts.php";
            break;

            //category
        case "mn_all_cat":
            include_once "view/admin/header.php";
            include_once "view/admin/pages/manage_category/all_category.php";
            include_once "view/admin/scripts.php";
            break;
        case "mn_addNew_cat":
            include_once "view/admin/header.php";
            include_once "view/admin/pages/manage_category/addNew_category.php";
            include_once "view/admin/scripts.php";
            break;
        case "mn_deleted_cat":
            include_once "view/admin/header.php";
            include_once "view/admin/pages/manage_category/deleted_category.php";
            include_once "view/admin/scripts.php";
            break;

            //user
        case "mn_all_user":
            include_once "view/admin/header.php";
            include_once "view/admin/pages/manage_user/all_user.php";
            include_once "view/admin/scripts.php";
            break;
        case "mn_addNew_user":
            include_once "view/admin/header.php";
            include_once "view/admin/pages/manage_user/addNew_user.php";
            include_once "view/admin/scripts.php";
            break;
        case "mn_deleted_user":
            include_once "view/admin/header.php";
            include_once "view/admin/pages/manage_user/deleted_user.php";
            include_once "view/admin/scripts.php";
            break;

            //order
        case "mn_all_order":
            include_once "view/admin/header.php";
            include_once "view/admin/pages/manage_order/all_order.php";
            include_once "view/admin/scripts.php";
            break;
        case "mn_processcing_order":
            include_once "view/admin/header.php";
            include_once "view/admin/pages/manage_order/processing_order.php";
            include_once "view/admin/scripts.php";
            break;
        case "mn_delivered_order":
            include_once "view/admin/header.php";
            include_once "view/admin/pages/manage_order/delivered_order.php";
            include_once "view/admin/scripts.php";
            break;
        case "mn_returned_order":
            include_once "view/admin/header.php";
            include_once "view/admin/pages/manage_order/returned_order.php";
            include_once "view/admin/scripts.php";
            break;
        case "mn_statistic_order":
            include_once "view/admin/header.php";
            include_once "view/admin/pages/manage_order/statistic_order.php";
            include_once "view/admin/scripts.php";
            break;


            //products
        case "mn_statistic_order":
            include_once "view/admin/header.php";
            include_once "view/admin/pages/manage_order/statistic_order.php";
            include_once "view/admin/scripts.php";
            break;
        case "mn_statistic_order":
            include_once "view/admin/header.php";
            include_once "view/admin/pages/manage_order/statistic_order.php";
            include_once "view/admin/scripts.php";
            break;
        case "mn_statistic_order":
            include_once "view/admin/header.php";
            include_once "view/admin/pages/manage_order/statistic_order.php";
            include_once "view/admin/scripts.php";
            break;
        case "mn_statistic_order":
            include_once "view/admin/header.php";
            include_once "view/admin/pages/manage_order/statistic_order.php";
            include_once "view/admin/scripts.php";
            break;
        case "mn_statistic_order":
            include_once "view/admin/header.php";
            include_once "view/admin/pages/manage_order/statistic_order.php";
            include_once "view/admin/scripts.php";
            break;
        case "mn_statistic_order":
            include_once "view/admin/header.php";
            include_once "view/admin/pages/manage_order/statistic_order.php";
            include_once "view/admin/scripts.php";
            break;
        case "mn_statistic_order":
            include_once "view/admin/header.php";
            include_once "view/admin/pages/manage_order/statistic_order.php";
            include_once "view/admin/scripts.php";
            break;

            //seller
        case "mn_all_seller":
            include_once "view/admin/header.php";
            include_once "view/admin/pages/manage_order/statistic_order.php";
            include_once "view/admin/scripts.php";
            break;
        case "mn_addNew_seller":
            include_once "view/admin/header.php";
            include_once "view/admin/pages/manage_order/statistic_order.php";
            include_once "view/admin/scripts.php";
            break;
        case "mn_deleted_seller":
            include_once "view/admin/header.php";
            include_once "view/admin/pages/manage_order/statistic_order.php";
            include_once "view/admin/scripts.php";
            break;
        case "mn_statistic_revenue":
            include_once "view/admin/header.php";
            include_once "view/admin/pages/manage_order/statistic_order.php";
            include_once "view/admin/scripts.php";
            break;

            //traffic
        case "mn_all_traffic":
            include_once "view/admin/header.php";
            include_once "view/admin/pages/manage_order/statistic_order.php";
            include_once "view/admin/scripts.php";
            break;
        case "mn_traffic_detail":
            include_once "view/admin/header.php";
            include_once "view/admin/pages/manage_order/statistic_order.php";
            include_once "view/admin/scripts.php";
            break;
        default:
            break;
    }
}
