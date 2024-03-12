<?php
// include_once "lib/database.php";
include_once 'model/adminlogin.php';
$classAdmin = new Adminlogin();
$classAdmin->check_permistion();
include_once 'model/admin/manage_category.php';
include_once 'model/admin/manage_product.php';
$categoryAdmin = new CategoryAdmin();
$productAdmin = new ProductAdmin();
extract($_REQUEST);
if (isset($act) && $act) {
    switch ($act) {

            //dashboard
        case "dashboard":
            include_once "view/admin/component/header.php";
            include_once "view/admin/component/dashboard.php";
            include_once "view/admin/component/scripts.php";
            break;

            //category
        case "mn_settings_cat":


            if (isset($_POST["submit"]) && $_POST["submit"]) {

                $id_parent = $_POST["id_parent"];
                $name_category = $_POST["name_category"];
                $icon = $_FILES["icon"];
                $type = $_POST["type"];
                $createCategory = $categoryAdmin->manageCategory($name_category, $icon, $id_parent, $type);
                // header("location: ?mod=admin&act=mn_settings_cat");
            }
            $arrayOfCategories = $categoryAdmin->getAllCate();
            // return;
            include_once "view/admin/component/header.php";
            include_once "view/admin/pages/manage_category/settings_category.php";
            include_once "view/admin/component/scripts.php";
            break;
        case "mn_deleted_cat":
            include_once "view/admin/component/header.php";
            include_once "view/admin/pages/manage_category/deleted_category.php";
            include_once "view/admin/component/scripts.php";
            break;

            //user
        case "mn_all_user":
            include_once "view/admin/component/header.php";
            include_once "view/admin/pages/manage_user/all_user.php";
            include_once "view/admin/component/scripts.php";
            break;
        case "mn_addNew_user":
            include_once "view/admin/component/header.php";
            include_once "view/admin/pages/manage_user/addNew_user.php";
            include_once "view/admin/component/scripts.php";
            break;
        case "mn_deleted_user":
            include_once "view/admin/component/header.php";
            include_once "view/admin/pages/manage_user/deleted_user.php";
            include_once "view/admin/component/scripts.php";
            break;

            // product 
        case "mn_all_products":
            $status = "";
            if (isset($_GET["status"]) && $_GET["status"]) {
                $status = $_GET["status"];
            }
            $products = $productAdmin->getProducts($status, 0, 0);
            if (isset($_GET["page"]) && $_GET["page"]) {
                $page = $_GET["page"];
                $productPagination = $productAdmin->getProducts($status, 10, ($page - 1) * 9);
            } else {
                echo "Page is not found";
            }

            // print_r($products);
            // return;

            if (isset($_POST["approve"]) && $_POST["approve"]) {
                $idProduct = $_POST["id_product"];
                $productAdmin->updateProduct("Activated", $idProduct);
                header("location: ?mod=admin&act=mn_all_products");
            } else if (isset($_POST["reject"]) && $_POST["reject"] && isset($_POST["reason"])) {
                $idProduct = $_POST["id_product"];
                $reason = $_POST["reason"];
                $productAdmin->updateProduct("Rejected", $idProduct, $reason);
                header("location: ?mod=admin&act=mn_all_products");
            }
            include_once "view/admin/component/header.php";
            include_once "view/admin/pages/manage_product/all_products.php";
            include_once "view/admin/component/scripts.php";
            break;

            //order
        case "mn_all_order":
            include_once "view/admin/component/header.php";
            include_once "view/admin/pages/manage_order/all_order.php";
            include_once "view/admin/component/scripts.php";
            break;
        case "mn_processcing_order":
            include_once "view/admin/component/header.php";
            include_once "view/admin/pages/manage_order/processing_order.php";
            include_once "view/admin/component/scripts.php";
            break;
        case "mn_delivered_order":
            include_once "view/admin/component/header.php";
            include_once "view/admin/pages/manage_order/delivered_order.php";
            include_once "view/admin/component/scripts.php";
            break;
        case "mn_returned_order":
            include_once "view/admin/component/header.php";
            include_once "view/admin/pages/manage_order/returned_order.php";
            include_once "view/admin/component/scripts.php";
            break;
        case "mn_statistic_order":
            include_once "view/admin/component/header.php";
            include_once "view/admin/pages/manage_order/statistic_order.php";
            include_once "view/admin/component/scripts.php";
            break;


            //products
        case "mn_statistic_order":
            include_once "view/admin/component/header.php";
            include_once "view/admin/pages/manage_order/statistic_order.php";
            include_once "view/admin/component/scripts.php";
            break;
        case "mn_statistic_order":
            include_once "view/admin/component/header.php";
            include_once "view/admin/pages/manage_order/statistic_order.php";
            include_once "view/admin/component/scripts.php";
            break;
        case "mn_statistic_order":
            include_once "view/admin/component/header.php";
            include_once "view/admin/pages/manage_order/statistic_order.php";
            include_once "view/admin/component/scripts.php";
            break;
        case "mn_statistic_order":
            include_once "view/admin/component/header.php";
            include_once "view/admin/pages/manage_order/statistic_order.php";
            include_once "view/admin/component/scripts.php";
            break;
        case "mn_statistic_order":
            include_once "view/admin/component/header.php";
            include_once "view/admin/pages/manage_order/statistic_order.php";
            include_once "view/admin/component/scripts.php";
            break;
        case "mn_statistic_order":
            include_once "view/admin/component/header.php";
            include_once "view/admin/pages/manage_order/statistic_order.php";
            include_once "view/admin/component/scripts.php";
            break;
        case "mn_statistic_order":
            include_once "view/admin/component/header.php";
            include_once "view/admin/pages/manage_order/statistic_order.php";
            include_once "view/admin/component/scripts.php";
            break;

            //seller
        case "mn_all_seller":
            include_once "view/admin/component/header.php";
            include_once "view/admin/pages/manage_order/statistic_order.php";
            include_once "view/admin/component/scripts.php";
            break;
        case "mn_addNew_seller":
            include_once "view/admin/component/header.php";
            include_once "view/admin/pages/manage_order/statistic_order.php";
            include_once "view/admin/component/scripts.php";
            break;
        case "mn_deleted_seller":
            include_once "view/admin/component/header.php";
            include_once "view/admin/pages/manage_order/statistic_order.php";
            include_once "view/admin/component/scripts.php";
            break;
        case "mn_statistic_revenue":
            include_once "view/admin/component/header.php";
            include_once "view/admin/pages/manage_order/statistic_order.php";
            include_once "view/admin/component/scripts.php";
            break;

            //traffic
        case "mn_all_traffic":
            include_once "view/admin/component/header.php";
            include_once "view/admin/pages/manage_order/statistic_order.php";
            include_once "view/admin/component/scripts.php";
            break;
        case "mn_traffic_detail":
            include_once "view/admin/component/header.php";
            include_once "view/admin/pages/manage_order/statistic_order.php";
            include_once "view/admin/component/scripts.php";
            break;
        default:
            break;
    }
}
