<?php


include_once 'model/product.php';
include_once 'model/entity.php';
include_once 'model/category.php';
include_once 'model/comment.php';
include_once 'model/user.php';
include_once 'model/shop.php';

include_once "model/cart.php";
$cate = new Category();
$product = new Product();
$classCart = new Cart();
$classComment = new Comment();
$getCartInfo = $classCart->getCartView();
$cartResult = $classCart->getCartUser();
// print_r($cartResult);
// return;


extract($_REQUEST);
if (isset($_GET['act']) && $_GET['act']) {
    switch ($_GET['act']) {
        case 'home':
            $allCategory = $cate->getAllCate();
            if ($allCategory == false) {
                $allCategory = array();
            }
            $megaPro = $product->filterProduct("random");
            $newPro = $product->filterProduct("", "", 8);
            $salePro = $product->filterProduct("random");
            $bestPro = $product->filterProduct("random", "", 10);
            $suggestionPro = $product->filterProduct("random", "", 10);
            include_once 'view/inc/header.php';
            include_once 'view/home.php';
            include_once 'view/inc/footer.php';
            break;
        case 'collection':
            $allCategory = $cate->getAllCate();
            $page = 1;
            if (isset($_GET['page']) && $_GET['page']) {
                $page = $_GET['page'];
            }
            if (isset($_GET['category']) && !empty($_GET['category']) && is_numeric($_GET['category'])) {
                $collectionPro = $product->filterProduct("category", $_GET['category'], 8, $page);
                $infoCate = $cate->getInfoCate($_GET['category']);
            } else {
                $collectionPro = $product->filterProduct('', '', 8, $page);
            }
            if (isset($infoCate))
                $viewTitle = $infoCate['nameCate'];
            include_once 'view/inc/header.php';
            include_once 'view/collection.php';
            include_once 'view/inc/footer.php';
            break;
        case 'detail':
            if (isset($_GET['id']) && !empty($_GET['id']) && is_numeric($_GET['id'])) {
                $infoPro = $product->filterProduct("detail", $_GET['id']);

                if (isset($infoPro) && $infoPro->status == true) {
                    $productInfo = $infoPro->result;
                    if (!isset($productInfo[0]['namePro'])) {
                        header("Location: ?page=404");
                    }
                    $page = 1;
                    if (isset($_GET['page']) && $_GET['page']) {
                        $page = $_GET['page'];
                    }
                    $listCmt = $classComment->getAllCommentById($_GET['id'], $page);

                    $viewTitle = $productInfo[0]['namePro'];
                } else {
                    header("Location: ?page=404");
                }
            } else {
                header("Location: ?page=404");
            }
            $newPro = $product->filterProduct("", "", 8);
            include_once 'view/inc/header.php';
            include_once 'view/detail.php';
            include_once 'view/inc/footer.php';
            break;
        case 'cart':
            if (Session::get("isLogin") == true) {
                include_once 'view/inc/header.php';
                include_once 'view/cart.php';
                include_once 'view/inc/footer.php';
            } else {
                header('location: ./');
            }
            break;
        case 'checkout':
            $cartcheckout = $classCart->getCartUser('checked');
            $classUser = new User();
            $getUserInfo = $classUser->getAddress();
            if ($getUserInfo->status == true) {
                $userInfo = $getUserInfo->result;
            }

            if (isset($_POST['nameReceiver']) && !empty($_POST['nameReceiver'])) {
                $nameReceiver = $_POST['nameReceiver'];
                $city = $_POST['city'];
                $province = $_POST['province'];
                $addressDetail = $_POST['addressDetail'];
                $phone = $_POST['phone'];
                $note = $_POST['note'];
                $subtotal = $_POST['subTotal'];
                $total = $_POST['total'];
                $fee = $_POST['fee'];
                $valueCheckout = $classCart->checkout($nameReceiver, $city, $province, $addressDetail, $phone, $note, $subtotal, $total, $fee);
                if (isset($valueCheckout)) {
                    if ($valueCheckout->status == false) {
                        echo '<div id="toast" mes-type="error" mes-title="Thất bại!" mes-text="' . $valueCheckout->message . '."></div>';
                    } else {
                        echo '<div id="toast" mes-type="success" mes-title="Thành công!" mes-text="' . $valueCheckout->message . '."></div>';
                        echo ' <script>
                                setTimeout(function() {
                                    window.location.href="' . $valueCheckout->redirect . '";
                                }, 2000);
                            </script>';
                    }
                }
            }
            include_once 'view/inc/header.php';
            include_once 'view/checkout.php';
            include_once 'view/inc/footer.php';
            break;
        case 'shop':
            //  code
            $shop = new Shop();
            if (isset($_GET['uuid']) && $_GET['uuid']) {
                $shop_info = $shop->get_info_shop($_GET['uuid']);
                if ($shop_info->status) {
                    $shop_info = $shop_info->result;
                } else {
                    header('location:?page=404');
                }
            }

            include_once 'view/inc/header.php';
            include_once 'view/shop.php';
            include_once 'view/inc/footer.php';

            break;
        default:
            header("Location: ?page=404");
    }
}
