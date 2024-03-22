<?php


include_once 'model/product.php';
include_once 'model/entity.php';
include_once 'model/category.php';
include_once 'model/comment.php';
include_once 'model/user.php';
include_once 'model/shop.php';
include_once 'model/like_product.php';
include_once 'model/product_review.php';

include_once 'helpers/format.php';

include_once "model/cart.php";
$cate = new Category();
$product = new Product();
$classCart = new Cart();
$classComment = new Comment();
$cart_user = $classCart->get_cart_user();
// $cartResult = $classCart->getCartUser();
$classProductReview = new ProductReview();


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
            $randomCate = $cate->get_cate_random();
            $megaPro = $product->filterProduct("by_type",'Flash Sale');
            $newPro = $product->filterProduct("by_type", "New", 8);
            $salePro = $product->filterProduct("by_type",'Hot');
            $bestPro = $product->filterProduct("random", "", 10);
            $suggestionPro = $product->filterProduct("category", $randomCate[0]['slug'] );
            include_once 'view/inc/header.php';
            include_once 'view/home.php';
            include_once 'view/inc/footer.php';
            break;
        case 'collection':
            $allCategory = $cate->getAllCate();
            $page = 1;
            $category="";
            $min_price = "";
            $max_price = "";
            $type = "";
            if(isset($_GET['category'])&& $_GET['category']){
                $category = $_GET['category'];
            }
            if(isset($_GET['min_price'])&& $_GET['min_price'] && isset($_GET['max_price'])&& $_GET['max_price']){
                $min_price = $_GET['min_price'];
                $max_price = $_GET['max_price'];
            }
            if(isset($_GET['type'])&& $_GET['type']){
                $type = $_GET['type'];
            }
            
            if (isset($_GET['page']) && $_GET['page']) {
                $page = $_GET['page'];
            }
            $collectionPro = $product->filter_product_collection($category,$min_price,$max_price,$type, 8, $page);
            $infoCate = $cate->getInfoCate($_GET['category']);
            if (isset($infoCate))
                $viewTitle = $infoCate['name'];

            include_once 'view/inc/header.php';
            include_once 'view/collection.php';
            include_once 'view/inc/footer.php';
            break;
        case 'detail':
            $classFormat = new Format();
            $classProduct = new Product();
            $classShop = new Shop();
            $classLike = new LikeProduct();
            // kiểm tra xem có slug k - nếu k có slug thì điều hướng tới trang 404
            // !(...) để phủ định lại
            if(!(isset($_GET['product']) && $_GET['product'])){
                header("Location: ?page=404");
            }
            // nếu có slug thì gọi tới funtion lấy thông tin san phảm
            $slug = $_GET['product'];

            $kq_san_pham = $classProduct->get_product_detail($slug);
           
            // $kq_san_pham sẽ trả về 2 giá trị
            //   +false: sản phẩm không tồn tại
            if($kq_san_pham->status ==false) {
                header("location: ?page=404");
            }
            // nếu đúng thì gán sản phẩm vào $san_pham
            $san_pham =$kq_san_pham->result;
            // $san_pham nó sẽ trả về array có [product và listimage] nên là chú ý bên view
            // dung $san_pham để hiển thị bên view

            // Xử lý review sản phẩm
            // phân trang
            $page = 1;
            $limit =3;
            if(isset($_GET['page'])&& $_GET['page']){
                $page = $_GET['page'];
            }
            $kq_danhsach_danhgia = $classProductReview->get_review_product_detail( $san_pham['product']['id'],$page,$limit);
            
            if($kq_danhsach_danhgia->status == true){
                $danhsach_danhgia = $kq_danhsach_danhgia->result['reviews'];
                $is_review = $kq_danhsach_danhgia->result['allow_review'];

            }
            // submit form review
            if(isset($_POST['reviewsubmit'])&& $_POST['reviewsubmit']){
                $level = $_POST['level'];
                $content = $_POST['content'];
                $id_review =isset( $_POST['id_review'])? $_POST['id_review']:'';
                
                $kq_sumit_review = $classProductReview->create_review($level,$content,$san_pham['product']['id'],$id_review);
                if ($kq_sumit_review->status == false) {
                    echo '<div id="toast" mes-type="error" mes-title="Thất bại!" mes-text="' . $kq_sumit_review->message . '."></div>';
                } else {
                    echo '<div id="toast" mes-type="success" mes-title="Thành công!" mes-text="' . $kq_sumit_review->message . '."></div>';
                    echo ' <script>
                            setTimeout(function() {
                                window.location.href="?mod=page&act=detail&product='.$slug.'";
                            }, 2000);
                        </script>';
                }
            }
            // Lây danh sách sản phẩm gợi ý
            $productSuggestion = $classProduct->get_productSuggestion();
            // lấy thông tin shop theo id product
            $kq_thong_tin_shop = $classShop->get_shop_by_id_product($san_pham['product']['id']);
            if($kq_thong_tin_shop->status ==true){
                $thong_tin_shop = $kq_thong_tin_shop->result;
            }
            // $kq_thong_tin_shop chứa các định dạng response như bên model

           $viewTitle = $san_pham['product']['name'];
            include_once 'view/inc/header.php';
            include_once 'view/detail.php';
            include_once 'view/inc/footer.php';
            break;
        case 'cart':
            $viewTitle ='Giỏ hàng';
            $data=[];
            foreach ($cart_user->result as $key => $value) {
               $data[$value['shop_info']['id']][]=$value; 
            }
            include_once 'view/inc/header.php';
            include_once 'view/cart.php';
            include_once 'view/inc/footer.php';
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
            $tool = new Format();
            $shop = new Shop();
            if (isset($_GET['uuid']) && $_GET['uuid']) {
                $shop_info = $shop->get_info_shop($_GET['uuid']);
                if ($shop_info->status) {
                    $shop_info = $shop_info->result;
                    $shop_brands = $shop->get_brands_shop($shop_info['uuid'])->result;
                    $shop_products = $shop->get_products_shop($shop_info['id']);
                    $shop_sale_products = $shop->get_products_shop($shop_info['id'], true);
                    $shop_categories = $shop->get_categories_shop($shop_info['id']);
                    $shop_product_count = $shop->get_product_count_shop($shop_info['id']);
                    $shop_followers = count($shop->get_followers_shop($shop_info['id']));
                    $shop_rating = $shop->get_rating_shop($shop_info['id']);
                    $shop_voucher = $shop->get_voucher_shop($shop_info['id']);
                    $shop_category_menus = $shop->get_category_menus_shop($shop_info['id']);
                    $shop_products_all = $shop->get_products_shop_response($shop_info['id']);
                    $shop_filtered_products = $shop->get_filtered_products_shop($shop_info['id']);
                } else {
                    header('location:?page=404');
                }
            } else {
                header('location:?page=404');
            }
            include_once 'view/inc/header.php';
            include_once 'view/shop.php';
            include_once 'view/inc/footer.php';
            break;
        default:
            header("Location: ?page=404");
    }
}
