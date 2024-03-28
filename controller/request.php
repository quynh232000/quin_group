<?php
// session_start();
include_once "lib/session.php";
include_once "model/cart.php";
include_once "model/product.php";
include_once "model/order.php";
include_once "model/comment.php";
include_once "model/category.php";
include_once "model/address.php";
include_once "model/shop.php";
include_once "model/like_product.php";
include_once "model/voucher.php";
include_once "model/traffic.php";


$classOrder = new Order();

extract($_REQUEST);
if (isset($act)) {
    switch ($act) {

        case 'seach_home':
            $classProduct = new Product();
            if (isset($_GET['keysearch'])) {
                $valueSearch = $classProduct->seach_home($_GET['keysearch']);
                echo json_encode($valueSearch, JSON_PRETTY_PRINT);
                return;
            }
            break;
        case 'fillterproduct':
            if (isset($_GET['id']) && $_GET['id']) {
                $classProduct = new Product();
                $result = $classProduct->filterProduct('category', $_GET['id']);
                echo json_encode($result, JSON_PRETTY_PRINT);
            }
            return;
        case 'get-all-category':
            $idCate = $_GET['idCate'] ?? 0;
            $class_category = new Category();
            $result = $class_category->getAllCate($idCate);

            echo json_encode($result, JSON_PRETTY_PRINT);
            return;
        case 'update_status_cate':
            if (isset($_GET['id']) && $_GET['id'] && isset($_GET['type']) && $_GET['type']) {

                $result = $classOrder->update_status_order($_GET['id'], $_GET['type']);
            } else {
                $result = ['status' => false, 'message' => "Missing paramater"];
            }


            echo json_encode($result, JSON_PRETTY_PRINT);
            return;
        case 'get_address':
            if (isset($_GET['type']) && isset($_GET['type'])) {
                $classAddress = new Address();
                switch ($_GET['type']) {
                    case 'province':
                        $result = $classAddress->get_all_province();
                        echo json_encode($result, JSON_PRETTY_PRINT);
                        break;
                    case 'district':
                        $result = $classAddress->get_district($_GET['id']);
                        echo json_encode($result, JSON_PRETTY_PRINT);
                        break;

                    case 'ward':
                        $result = $classAddress->get_ward($_GET['id']);
                        echo json_encode($result, JSON_PRETTY_PRINT);
                        break;
                    default:

                        echo json_encode([], JSON_PRETTY_PRINT);

                        break;
                }
            }
            return;

        // update status order
        case 'update_status_order':
            if (isset($_GET['id']) && $_GET['id'] && isset($_GET['status']) && $_GET['status']) {

                $data = $classOrder->update_status_order($_GET['id'], $_GET['status'], );
                echo json_encode($data, JSON_PRETTY_PRINT);
            } else {
                echo json_encode(['status' => false, 'message' => "Missing parameter"], JSON_PRETTY_PRINT);
            }
            return;
        case 'update_status_order_all':

            if (isset($_GET['status']) && $_GET['status']) {


                $data = $classOrder->update_status_order_all($_GET['status']);
                echo json_encode($data, JSON_PRETTY_PRINT);
            } else {
                echo json_encode(['status' => false, 'message' => "Missing parameter"], JSON_PRETTY_PRINT);
            }
            return;
        case 'get_status_order':
            echo json_encode($classOrder->get_status_order($_GET['uuid']), JSON_PRETTY_PRINT);


            return;

        case 'get_products_byCate':
            $shop = new Shop();
            if (isset($_POST['uuid']) && $_POST['uuid'] && isset($_POST['list_id']) && $_POST['list_id']) {
                echo json_encode($shop->get_products_byCate($_POST['uuid'], $_POST['list_id']), JSON_PRETTY_PRINT);
            } else {
                echo json_encode($shop->get_products_byCate($_POST['uuid']), JSON_PRETTY_PRINT);
            }
            return;

        case 'get_filtered_products_shop':
            // get_filtered_products_shop($uuid, $list_id_post = [], $type = "", $brand = "", $price_from = "", $price_to = "", $page = 1, $limit = 8)
            $uuid = isset($_GET['uuid']) ? $_GET['uuid'] : "";
            $list_id_post = isset($_GET['list_id']) ? $_GET['list_id'] : [];
            $type = isset($_GET['type']) ? $_GET['type'] : "";
            $brand = isset($_GET['brand']) ? $_GET['brand'] : "";
            $price_from = isset($_GET['price_from']) ? $_GET['price_from'] : "";
            $price_to = isset($_GET['price_to']) ? $_GET['price_to'] : "";
            $page = isset($_GET['page']) ? $_GET['page'] : "1";
            $limit = isset($_GET['limit']) ? $_GET['limit'] : "8";
            $type_price = isset($_GET['type_price']) ? $_GET['type_price'] : "";

            $shop = new Shop();
            // echo json_encode(['brand' => $brand], JSON_PRETTY_PRINT);
            echo json_encode($shop->get_filtered_products_shop($uuid, $list_id_post, $type, $brand, $price_from, $price_to, $page, $limit, $type_price), JSON_PRETTY_PRINT);
            return;

        case 'follow_shop':
            $uuid = isset($_GET['uuid']) ? $_GET['uuid'] : '';
            $type = isset($_GET['type']) ? $_GET['type'] : '';
            $shop = new Shop();
            echo json_encode($shop->follow_shop($uuid, $type), JSON_PRETTY_PRINT);
            return;
        case 'save_voucher':
            $voucher_id = isset($_GET['voucher_id']) ? $_GET['voucher_id'] : '';
            $shop = new Shop();
            echo json_encode($shop->save_voucher($voucher_id), JSON_PRETTY_PRINT);

            return;
        case "update_cart_user":
            $classCart = new Cart();
            $quantity = isset($_GET['quantity']) ? $_GET['quantity'] : "";
            echo json_encode($classCart->update_cart_user($_GET['type'], $_GET['product_id'], $quantity), JSON_PRETTY_PRINT);

            return;
        case 'like_product':
            $classLike = new LikeProduct();
            if (isset($_GET['type']) && $_GET['type'] && isset($_GET['product_id']) && $_GET['product_id'])
                $type = $_GET['type'];
            $product_id = $_GET['product_id'];
            if ($type == 'like') {
                echo json_encode($classLike->like_product($product_id), JSON_PRETTY_PRINT);
            } else {
                echo json_encode($classLike->unlike_product($product_id), JSON_PRETTY_PRINT);
            }
            return;
        case "check_code_voucher":
            $classVoucher = new Voucher();
            if (isset($_GET['code']) && isset($_GET['shop_id'])) {
                echo json_encode($classVoucher->check_code_voucher($_GET['code'], $_GET['shop_id']), JSON_PRETTY_PRINT);
            } else {
                echo json_encode(['status' => false, 'message' => "Missing parameter"], JSON_PRETTY_PRINT);
            }
            return;
        case "get_voucher_user":
            $classVoucher = new Voucher();
            $type = $_GET['type'] ?? "";
            $search = isset($_GET['search']) ? $_GET['search'] : "";
            $shop_id = isset($_GET['shop_id']) ? $_GET['shop_id'] : "";
            echo json_encode($classVoucher->get_voucher_user($type, $search, $shop_id), JSON_PRETTY_PRINT);
            return;
        case 'set_traffic':
            $data = $_POST;
            if (isset($data['ip']) && isset($data['location']) && isset($data['type'])) {
                $classTraffic = new Traffic();
                echo json_encode($classTraffic->set_traffic($data['ip'], $data['location'], $data['type']), JSON_PRETTY_PRINT);
            } else {
                echo json_encode(['status' => false, 'message' => "Missing"], JSON_PRETTY_PRINT);
            }
            return;
        default:
            break;
    }
}
