<?php
// session_start();
include_once "./lib/session.php";
// session_start();
// Session::checkSession();
include_once 'model/seller.php';

$class_seller = new Seller();
$class_seller->check_seller();
include_once 'model/category.php';
include_once 'model/product.php';
include_once 'model/user.php';
include_once 'model/order.php';
include_once 'model/shop.php';
include_once 'model/address.php';
include_once 'model/voucher.php';
include_once 'helpers/tool.php';
include_once 'model/product_review.php';
$classShop = new Shop();
$shop_info = $classShop->get_shop_info();


extract($_REQUEST);
if (isset($act)) {
    switch ($act) {
        case 'dashboard':
            $classPro = new Product();
            $resultData = $classPro->dashboard();

            $viewTitle = 'Dashboard';
            include_once 'view/inc/headerAdmin.php';
            include_once 'view/inc/sidebarAdmin.php';
            include_once 'view/seller/dashboard.php';
            include_once 'view/inc/footer.php';
            break;
        case 'addproduct':
            $classShop->check_shop_info();
            $viewTitle = 'Create new product';
            $classPro = new Product();
            $cate = new Category();
            $allCategory = $cate->getAllCate();
            // echo ($allCategory);
            // return;
            if (isset($_POST['btn-create-product']) && $_POST['btn-create-product']) {
                $type = isset($_GET['type']) ? $_GET['type'] : "create";
                $id = isset($_GET['idPro']) ? $_GET['idPro'] : "";
                $resAddPro = $classPro->updateProduct(
                    $_POST['type'],
                    $_POST['name'],
                    $_POST["description"],
                    $_POST["category_id"],
                    $_POST["quantity"],
                    $_POST["origin"],
                    $_POST["brand"],
                    $_POST["price"],
                    $_POST["salePercent"],
                    $_FILES["image"],
                    $_FILES["listImage"],
                    $type,
                    $id
                );
            }
            if (isset($resAddPro)) {
                if ($resAddPro->status) {
                    echo '<div id="toast" mes-type="success" mes-title="Thành công!" mes-text="' . $resAddPro->message . '"></div>';
                } else {
                    echo '<div id="toast" mes-type="error" mes-title="Thất bại!" mes-text="' . $resAddPro->message . '"></div>';
                }
            }
            if (isset($_GET['type']) && $_GET['idPro']) {
                $infoPro = $classPro->filterProduct("detail", $_GET['idPro']);
                if (isset($infoPro) && $infoPro->status == true) {
                    $productInfo = $infoPro->result;
                    $viewTitle = $productInfo[0]['name'];
                    // print_r($product_info);
                    // return;
                }
            }
            include_once 'view/inc/headerAdmin.php';
            include_once 'view/inc/sidebarAdmin.php';
            include_once 'view/seller/addproduct.php';
            include_once 'view/inc/footer.php';
            break;
        case 'manageproduct':
            $viewTitle = 'Manage your products';
            $classPro = new Product();
            $page = 1;
            if (isset($_GET['page']) && $_GET['page']) {
                $page = $_GET['page'];
            }
            $search ="";
            if(isset($_POST['submitsearch'])&& $_POST['submitsearch']){
                $search = $_POST['search'];
            }
            $allProduct = $classPro->getAllProductSeller($page, 10, "",$search);
            $cate = new Category();
            if ((isset($_GET['type']) && isset($_GET['idPro'])) && ($_GET['type']) && $_GET['idPro']) {
                $type = $_GET['type'];
                $idPro = $_GET['idPro'];
                if ($type == "delete") {
                    $resultDeletePro = $classPro->deleteProduct($idPro);
                    if ($resultDeletePro->status == true) {
                        echo '<div id="toast" mes-type="success" mes-title="Thành công!" mes-text="' . $resultDeletePro->message . '"></div>';
                    } else {
                        echo '<div id="toast" mes-type="error" mes-title="Thất bại!" mes-text="' . $resultDeletePro->message . '"></div>';

                    }
                    // sleep(3);
                    // header("Location: ?mod=seller&act=manageproduct");
                }
            }
            include_once 'view/inc/headerAdmin.php';

            include_once 'view/inc/sidebarAdmin.php';
            include_once 'view/seller/manageproduct.php';
            include_once 'view/inc/footer.php';
            break;
        
        case 'manageorders':
            $limit = 20;
            $param = "";
            $classOrder = new Order();
            $status = '';
            if (
                isset($_GET['status']) && ($_GET['status'] == 'New' ||
                    $_GET['status'] == 'Processing' ||
                    $_GET['status'] == 'Confirmed' ||
                    $_GET['status'] == 'On_Delivery' ||
                    $_GET['status'] == 'Completed' ||
                    $_GET['status'] == 'Cancelled')
            ) {
                $status = $_GET['status'];
                $param = "&status=" . $_GET['status'];
            }
            // get page
            $page = 1;
            if (isset($_GET['page']) && $_GET['page']) {
                $page = $_GET['page'];
            }
            $resultOrder = $classOrder->get_all_order($status, $page, $limit);


            $viewTitle = 'Manage orders';
            include_once 'view/inc/headerAdmin.php';
            include_once 'view/inc/sidebarAdmin.php';
            include_once 'view/seller/manageorders.php';
            include_once 'view/inc/footer.php';
            break;
        
        case 'setting':
            $class_address = new Address();
            if (isset($_POST['name']) && $_POST['name']) {
                $name = $_POST['name'];
                $phone_number = $_POST['phone_number'];
                $address_detail = $_POST['address_detail'];
                $province = $_POST['province'];
                $district = $_POST['district'];
                $icon = $_FILES['icon'];

                $ship_north = $_POST['ship_north'];
                $ship_south = $_POST['ship_south'];
                $ship_mid_north = $_POST['ship_mid_north'];
                $ship_mid_south = $_POST['ship_mid_south'];


                if (

                    empty($name) || empty($phone_number) ||
                    empty($address_detail) || empty($province) ||
                    empty($district) || ($ship_north == "") || ($ship_south == "") ||
                    ($ship_mid_north == "") || ($ship_mid_south == "")
                ) {
                    echo '<div id="toast" mes-type="error" mes-title="Thất bại!" mes-text="Thông tin không được để trống!"></div>';
                } else {
                    $updateshop = $classShop->update_shop(
                        $name,
                        $phone_number,
                        $address_detail,
                        $icon,
                        $province,
                        $district,
                        $ship_south,
                        $ship_north,
                        $ship_mid_north,
                        $ship_mid_south
                    );

                    if ($updateshop->status == true) {

                        echo '<div id="toast" mes-type="success" mes-title="Thành công!" mes-text="' . $updateshop->message . '"></div>';

                        echo ' <script>
                                setTimeout(function() {
                                    window.location.href="?mod=seller&act=setting";
                                }, 2500);
                            </script>';

                    } else {
                        echo '<div id="toast" mes-type="error" mes-title="Thất bại!" mes-text="' . $updateshop->message . '"></div>';
                    }
                }
            }
            if (Session::get('checkshop')) {
                echo '<div id="toast" mes-type="error" mes-title="Thành công!" mes-text="' . Session::get('checkshop') . '"></div>';
                sleep(3);
                Session::remove('checkshop');
            }
            if ($classShop->get_shipping_shop()->status) {
                $shop_ship = $classShop->get_shipping_shop();
            }
            $viewTitle = 'Cài đặt shop';
            include_once 'view/inc/headerAdmin.php';
            include_once 'view/inc/sidebarAdmin.php';
            include_once 'view/seller/setting.php';
            include_once 'view/inc/footer.php';
            break;
        case 'manage_voucher':
            $classVoucher = new Voucher();
            $viewTitle = 'Quản lý vouchers';
            $tool = new Tool();
            $classShop = new Shop();
            $shop = $classShop->get_shop_info();
            $slug_name = $tool->slug($shop->result['name']);
            $name_shop_code_arr = explode("-", $slug_name);
            $name_shop_code_str = implode("", $name_shop_code_arr);
            $name_code = strtoupper(substr($name_shop_code_str, 0, 5));
            // return;
            if (isset($_POST['submit']) && $_POST['submit']) {
                $label = $_POST['label'] ?? "";
                $code = $_POST['code'] ?? "";
                $date_start = $_POST['date_start'] ?? "";
                $date_end = $_POST['date_end'] ?? "";
                $discount_amount = $_POST['discount_amount'] ?? "";
                $quantity = $_POST['quantity'] ?? "";
                $minimum_price = $_POST['minimum_price'] ?? "";

                $createVoucher = $classVoucher->create_voucher(
                    $label,
                    $name_code . strtoupper($code),
                    $date_start,
                    $date_end,
                    $discount_amount,
                    $quantity,
                    $minimum_price
                );

                if ($createVoucher->status == true) {
                    echo '<div id="toast" mes-type="success" mes-title="Thành công!" mes-text="' . $createVoucher->message . '"></div>';
                    echo ' <script>
                    setTimeout(function() {
                        window.location.href="?mod=seller&act=manage_voucher#list-order";
                    }, 2000);
                </script>';

                } else {
                    echo '<div id="toast" mes-type="error" mes-title="Thất bại!" mes-text="' . $createVoucher->message . '"></div>';
                }

            }
            $status = "";
            $page = 1;
            if (isset($_GET['status']) && (($_GET['status'] == 'continuing') || ($_GET['status'] == 'upcoming') || ($_GET['status'] == 'finished'))) {
                $status == $_GET['status'];
            }
            // delete voucher
            if (isset($_POST['submit_delete']) && $_POST['submit_delete']) {
                $delete_voucher = $classVoucher->delete_voucher($_POST['id']);
                if ($delete_voucher->status == true) {
                    echo '<div id="toast" mes-type="success" mes-title="Thành công!" mes-text="' . $delete_voucher->message . '"></div>';
                    echo ' <script>
                    setTimeout(function() {
                        window.location.href="?mod=seller&act=manage_voucher#list-order";
                    }, 2000);
                </script>';

                } else {
                    echo '<div id="toast" mes-type="error" mes-title="Thất bại!" mes-text="' . $delete_voucher->message . '"></div>';
                }
            }
            $search ="";
            if(isset($_POST['submitsearch'])&& $_POST['submitsearch']){
                $search = $_POST['search'];
            }
            $vouchers = $classVoucher->get_voucher($status,"","",$search);
            include_once 'view/inc/headerAdmin.php';
            include_once 'view/inc/sidebarAdmin.php';
            include_once 'view/seller/shopmanagevoucher.php';
            include_once 'view/inc/footer.php';


            break;
        case 'manage_review':
            $viewTitle = "Quản lý đánh giá";
            $classPro = new Product();
            $classReview = new ProductReview();
            $page = 1;
            if (isset($_GET['page']) && $_GET['page']) {
                $page = $_GET['page'];
            }
            $search ="";
            if(isset($_POST['submitsearch'])&& $_POST['submitsearch']){
                $search = $_POST['search'];
            }
            $allProduct = $classPro->getAllProductSeller($page, 10, "",$search);
            $cate = new Category();

            include_once 'view/inc/headerAdmin.php';
            include_once 'view/inc/sidebarAdmin.php';
            include_once 'view/seller/managereview.php';
            include_once 'view/inc/footer.php';

            break;

            case 'review_detail':
                $viewTitle = "Đánh giá chi tiết";
                $classPro = new Product();
                if(isset($_GET['id'])&& $_GET['id']){
                    $result = $classPro->get_one_product_seller($_GET['id']);
                    if($result->status){
                        $product= $result->result[0];
                    }else{
                        header("Location: ?page=404");
                    }
                }else{
                    header("Location: ?page=404");
                }
                $avg_rate= $classPro->get_star_product($product['id'])??0;
                
                $cate = new Category();
                $clasReview = new ProductReview();

                $star = '';
                if(isset($_GET['star'])&&$_GET['star']){
                    $star = $_GET['star'];
                }
                $page = 1;
                $limit = 10;
                if(isset($_GET['page']) && $_GET['page']){
                    $page = $_GET['page'];
                }

                $listReview = $clasReview->get_all_review_product($product['id'],$star,$page,$limit);
                include_once 'view/inc/headerAdmin.php';
                include_once 'view/inc/sidebarAdmin.php';
                include_once 'view/seller/reviewdetail.php';
                include_once 'view/inc/footer.php';
    
                break;

            
        default:
            header('Location: ?page=404');
    }
}

?>