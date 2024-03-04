<?php
// session_start();
include_once "./lib/session.php";
// session_start();
Session::checkSession();
Session::checkPermission("admin");
include_once 'model/category.php';
include_once 'model/product.php';
include_once 'model/user.php';
include_once 'model/order.php';

extract($_REQUEST);
if (isset($act)) {
    switch ($act) {
        case 'dashboard':
            $classPro = new Product();
            $resultData = $classPro->dashboard();

            $viewTitle = 'Dashboard';
            include_once 'view/inc/headerAdmin.php';
            include_once 'view/inc/sidebarAdmin.php';
            include_once 'view/admin/dashboard.php';
            include_once 'view/inc/footer.php';
            break;
        case 'addproduct':
            $viewTitle = 'Create new product';
            $classPro = new Product();
            $cate = new Category();
            $allCategory = $cate->getAllCate();
            if (isset($_POST['btn-create-product']) && $_POST['btn-create-product']) {
                $type = isset($_GET['type']) ? $_GET['type'] : "create";
                $id = isset($_GET['idPro']) ? $_GET['idPro'] : "";
                $resAddPro = $classPro->updateProduct(
                    $_POST['name'],
                    $_POST["description"],
                    $_POST["categoryId"],
                    $_POST["quantity"],
                    $_POST["origin"],
                    $_POST["brand"],
                    $_POST["price"],
                    $_POST["salePercent"],
                    $_FILES["image"],
                    $_FILES["listImage"],
                    $_POST["unit"],
                    $type,
                    $id
                );
            }
            if (isset($resAddPro)) {
                if ($resAddPro->status) {
                    echo '<div id="toast" mes-type="success" mes-title="Thành công!" mes-text="' . $resAddPro->message . '"></div>';
                } else {
                    echo '<div id="toast" mes-type="error" mes-title="Thành công!" mes-text="' . $resAddPro->message . '"></div>';
                }
            }
            if (isset($_GET['type']) && $_GET['idPro']) {
                $infoPro = $classPro->filterProduct("detail", $_GET['idPro']);
                if (isset($infoPro) && $infoPro->status == true) {
                    $productInfo = $infoPro->result;
                    $viewTitle = $productInfo[0]['namePro'];
                }
            }
            include_once 'view/inc/headerAdmin.php';
            include_once 'view/inc/sidebarAdmin.php';
            include_once 'view/admin/addproduct.php';
            include_once 'view/inc/footer.php';
            break;
        case 'manageproduct':
            $viewTitle = 'Manage your products';
            $classPro = new Product();
            // get page product
            $page = 1;
            if (isset($_GET['page']) && $_GET['page']) {
                $page = $_GET['page'];
            }
            $allProduct = $classPro->getAllProduct($page);
            $cate = new Category();
            $allCategory = $cate->getAllCate();
            // ddelete product
            if ((isset($_GET['type']) && isset($_GET['idPro'])) && ($_GET['type']) && $_GET['idPro']) {
                $type = $_GET['type'];
                $idPro = $_GET['idPro'];
                if ($type == "delete") {
                    $resultDeletePro = $classPro->deleteProduct($idPro);
                    header("Location: ?mod=admin&act=manageproduct");
                }
            }
            include_once 'view/inc/headerAdmin.php';
            if (isset($resultDeletePro)) {
                if ($resultDeletePro->status == true) {
                    echo '<div id="toast" mes-type="success" mes-title="Thành công!" mes-text="' . $resultDeletePro->message . '"></div>';
                } else {
                    echo '<div id="toast" mes-type="error" mes-title="Thất bại!" mes-text="' . $resultDeletePro->message . '"></div>';

                }
                // echo ' <script>
                //     setTimeout(function() {
                //         window.location.href="'.$resultDeletePro->redirect.'";
                //     }, 4000);
                // </script>';
            }
            include_once 'view/inc/sidebarAdmin.php';
            include_once 'view/admin/manageproduct.php';
            include_once 'view/inc/footer.php';
            break;
        case 'managecategory':
            $viewTitle = 'Manage category';
            $cate = new Category();
            if (isset($_POST['create-cate-btn']) && $_POST['create-cate-btn']) {
                $createCate = $cate->createNewCate($_POST['name'], $_FILES['image']);
            }
            if (
                isset($_POST['create-cate-btn']) &&
                $_POST['create-cate-btn'] &&
                (isset($_GET['type']) && isset($_GET['idCate'])) &&
                ($_GET['type']) && $_GET['idCate'] &&
                $_GET['type'] == "edit"
            ) {
                $createCate = $cate->createNewCate($_POST['name'], $_FILES['image'], "update", $_GET['idCate']);
            }
            if ((isset($_GET['type']) && isset($_GET['idCate'])) && ($_GET['type']) && $_GET['idCate']) {
                $type = $_GET['type'];
                $idCate = $_GET['idCate'];
                if ($type == 'delete') {
                    $resultDeleteCate = $cate->deleteCate($idCate);
                }
                if ($type == 'edit') {
                    $resultGetInfo = $cate->getInfoCate($idCate);
                }


            }
            if (isset($resultDeleteCate)) {
                if ($resultDeleteCate->status == true) {
                    echo '<div id="toast" mes-type="success" mes-title="Thành công!" mes-text="' . $resultDeleteCate->message . '"></div>';
                } else {
                    echo '<div id="toast" mes-type="error" mes-title="Thất bại!" mes-text="' . $resultDeleteCate->message . '"></div>';

                }
            }
            $allCategory = $cate->getAllCate();
            include_once 'view/inc/headerAdmin.php';
            include_once 'view/inc/sidebarAdmin.php';
            include_once 'view/admin/managecategory.php';
            include_once 'view/inc/footer.php';
            break;
        case 'manageorders':
            $classOrder = new Order();
            $type = '';
            if (isset($_GET['type']) && ($_GET['type'] == 'confirmed' || $_GET['type'] == 'new' || $_GET['type'] == 'cancel')) {
                $type = $_GET['type'];
            }
            $resultOrder = $classOrder->getAllInvoince($type);
            $viewTitle = 'Manage orders';
            include_once 'view/inc/headerAdmin.php';
            include_once 'view/inc/sidebarAdmin.php';
            include_once 'view/admin/manageorders.php';
            include_once 'view/inc/footer.php';
            break;
        case 'detailorder':
            $classOrder = new Order();
            
            $resultOrder = $classOrder->getAllInvoince();
            if(isset($_GET['id']) && $_GET['id']){
                $getInvoiceDetail = $classOrder->getOrderDetail($_GET['id']);
                if($getInvoiceDetail->status ==true){
                    $data = $getInvoiceDetail->result;
                }else{
                    header('location: ?mod=admin&act=manageorders');
                }
            }else{
                header('location: ?mod=admin&act=manageorders');
            }
            $viewTitle = 'Manage orders';
            include_once 'view/inc/headerAdmin.php';
            include_once 'view/inc/sidebarAdmin.php';
            include_once 'view/admin/orderdetail.php';
            include_once 'view/inc/footer.php';
            break;
        case 'manageuser':
            $classUser = new User();
            $allUser = $classUser->getAllUser();
            if (
                isset($_GET['type']) &&
                isset($_GET['userid']) &&
                $_GET['type'] != ""
            ) {
                $type = $_GET['type'];
                if($type== 'edit'){
                    $userInfo = $classUser->getUserById($_GET['userid']);

                }else if($type == 'delete'){
                    $deleteUser = $classUser->deleteUser($_GET['userid']);
                    if (isset($deleteUser)) {
                        if ($deleteUser->status ==true) {
                            echo '<div id="toast" mes-type="success" mes-title="Thành công!" mes-text="' .'Xóa tài khoản thành công' . '"></div>';
                            
                        } else {
                            echo '<div id="toast" mes-type="error" mes-title="Thất bại!" mes-text="' . 'Bạn không có quyền với hàng động này!' . '"></div>';
                        }
                        echo ' <script>
                                    setTimeout(function() {
                                        window.location.href="?mod=admin&act=manageuser";
                                    }, 2000);
                                </script>';
                    }
                }
            }

            if (isset($_POST['fullName']) && $_POST['fullName'] && isset($_GET['userid'])) {
                $updateUser = $classUser->updateUser($_POST["fullName"], $_FILES['avatar'], $_POST["phone"], $_POST["email"], $_POST["role"], $_GET['userid']);
                if (isset($updateUser)) {
                    if ($updateUser->status) {
                        echo '<div id="toast" mes-type="success" mes-title="Thành công!" mes-text="' . $updateUser->message . '"></div>';
                        echo ' <script>
                                setTimeout(function() {
                                    window.location.href="' . $updateUser->redirect . '";
                                }, 2000);
                            </script>';
                    } else {
                        echo '<div id="toast" mes-type="error" mes-title="Thất bại!" mes-text="' . $updateUser->message . '"></div>';
                    }
                }
            }



            $viewTitle = 'Quản lý user';
            include_once 'view/inc/headerAdmin.php';
            include_once 'view/inc/sidebarAdmin.php';
            include_once 'view/admin/manageuser.php';
            include_once 'view/inc/footer.php';
            break;
        default:
            header('Location: ?page=404');
    }
}

?>