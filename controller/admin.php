<?php
// include_once "lib/database.php";
include_once 'model/adminlogin.php';
$classAdmin = new Adminlogin();
$classAdmin->check_permistion();
include_once 'model/admin/manage_category.php';
include_once 'model/admin/manage_product.php';
include_once 'model/admin/manage_order/manage_order.php';
include_once 'model/admin/manage_user/manage_user.php';
include_once 'model/admin/manage_user/user_detail.php';
$categoryAdmin = new CategoryAdmin();
$productAdmin = new ProductAdmin();
$orderAdmin = new OrderAdmin();
$userAdmin = new UserAdmin();
$userDetailAdmin = new UserDetailAdmin();
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
            }
            $arrayOfCategories = $categoryAdmin->getAllCate();
            include_once "view/admin/component/header.php";
            include_once "view/admin/pages/manage_category/settings_category.php";
            include_once "view/admin/component/scripts.php";
            break;
        case "mn_deleted_cat":
            include_once "view/admin/component/header.php";
            include_once "view/admin/pages/manage_category/deleted_category.php";
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
                $productPagination = $productAdmin->getProducts($status, 10, ($page));
            } else {
                header("location: ?page=404");
                exit;
            }

            if (isset($_POST["approve"]) && $_POST["approve"]) {
                $idProduct = $_POST["id_product"];
                $productAdmin->updateProduct("Activated", $idProduct);
                header("location: ?mod=admin&act=mn_all_products&status=Activated&page=1");
            } else if (isset($_POST["reject"]) && $_POST["reject"] && isset($_POST["reason"])) {
                $idProduct = $_POST["id_product"];
                $reason = $_POST["reason"];
                $productAdmin->updateProduct("Rejected", $idProduct, $reason);
                header("location: ?mod=admin&act=mn_all_products&status=Rejected&page=1");
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
        case "mn_returned_order":
            include_once "view/admin/component/header.php";
            include_once "view/admin/pages/manage_order/returned_order.php";
            include_once "view/admin/component/scripts.php";
            break;

            //voucher ??

            //user
        case "mn_all_user":
            $role = "";
            $roles = ["All", "Member", "Seller", "Admin", "AdminAll"];
            if (isset($_GET["role"]) && in_array($_GET["role"], $roles)) {
                $role = $_GET["role"];
                $countPageUser = $userAdmin->countPages($role);
                $countPage = ceil($countPageUser["total"] / 5);
                if (isset($_GET["page"]) && ($_GET["page"] <= $countPage && !empty($_GET["page"]))) {
                    $page = $_GET["page"];
                    $users = $userAdmin->selectUsers($role, 5, $page);
                } else {
                    header("location: ?page=404");
                    exit;
                }
            } else {
                header("location: ?page=404");
                exit;
            }

            include_once "view/admin/component/header.php";
            include_once "view/admin/pages/manage_user/all_user.php";
            include_once "view/admin/component/scripts.php";
            break;

        case "mn_user_detail":
            if (isset($_GET["uid"]) && $_GET["uid"]) {
                $user = $userDetailAdmin->getInfoUser($_GET["uid"]);
            } else {
                $user = false;
            }

            if (isset($_GET["search"]) && $_GET["search"]) {
                $uid = $userDetailAdmin->searchUserByEmail($_GET["search"]);
                header("location: ?mod=admin&act=mn_user_detail&uid=" . $uid["id"] . "");
            }

            include_once "view/admin/component/header.php";
            include_once "view/admin/pages/manage_user/detail_user.php";
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
