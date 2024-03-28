<?php
// session_start();
include_once "lib/session.php";
include_once 'model/category.php';
include_once 'model/product.php';
include_once "model/category.php";
include_once "model/adminlogin.php";
include_once "model/cart.php";
include_once "model/order.php";
include_once "model/user.php";
include_once "model/address.php";
include_once "model/voucher.php";
include_once "model/notification.php";

$classCart = new Cart();
$classUser = new Adminlogin();
$cart_user = $classCart->get_cart_user();
$classAddress = new Address();
$classVoucher = new Voucher();
$classOrder = new Order();
$classNotify = new Notification();
extract($_REQUEST);
if (isset($act)) {
    switch ($act) {
        case 'profile':
            if (Session::get('isLogin') == false) {
                header("Location: ?mod=profile&act=login");
            }
            $viewTitle = 'Hồ sơ';
            if (isset($_POST['email']) && $_POST['email']) {
                $updateUser = $classUser->updateProfile($_POST["full_name"], $_FILES['avatar'], $_POST["phone_number"], $_POST["address"]);
                if (isset($updateUser)) {
                    if ($updateUser->status) {

                        echo '<div id="toast" mes-type="success" mes-title="Thành công!" mes-text="' . $updateUser->message . '"></div>';
                    } else {
                        echo '<div id="toast" mes-type="error" mes-title="Thành công!" mes-text="' . $updateUser->message . '"></div>';
                    }
                }
            }
            include_once 'view/inc/header.php';
            include_once 'view/inc/profilesidebar.php';
            include_once 'view/profile.php';
            include_once 'view/inc/footer.php';
            break;
        case 'login':
            $viewTitle = 'Đăng nhập';
            // session_start();
            $class = new AdminLogin();
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $redirect = "";
                if (isset($_GET['redirect']) && $_GET['redirect'] == 'admin') {
                    $redirect = "?mod=admin&act=dashboard";
                } elseif (isset($_GET['redirect']) && $_GET['redirect'] == 'seller') {
                    $redirect = "?mod=seller&act=dashboard";
                } elseif (isset($_GET['redirect']) && $_GET['redirect'] == 'cart') {
                    $redirect = "?mod=page&act=cart";
                } else {
                    $redirect = "./";
                }
                $email = $_POST['email'];
                $password = $_POST['password'] ? md5($_POST['password']) : "";
                $login_check = $class->login_admin($email, $password, $redirect);
            }
            include_once 'view/login.php';
            break;
        case 'register':
            $viewTitle = 'Đăng kí';
            $class = new Adminlogin();
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $checkRegister = $class->register_admin(
                    $_POST['full_name'],
                    $_POST['email'],
                    $_POST['phone'],
                    ($_POST['password']),
                    ($_POST['confirmpassword'])
                );

            }
            include_once 'view/register.php';
            break;


        case 'orderhistory':
            $viewTitle = 'Lịch sử đơn hàng';
            $classOrder = new Order();
            $urlFilter = "?mod=profile&act=orderhistory";
            $status = '';
            $search = "";
            $page = 1;
            $limit = 5;
            // get list order
            if (isset($_GET['status'])) {
                $status = $_GET['status'];
                $urlFilter .= '&status=' . $status;
            }
            if (isset($_GET['search'])) {
                $search = $_GET['search'];
                $urlFilter .= '&search=' . $search;
            }
            if (isset($_GET['page'])) {
                $page = $_GET['page'];
                $urlFilter .= '&page=' . $page;
            }
            $orders = $classOrder->get_list_user_order($status, $search, $page, $limit);
            if ($orders->status == true) {
                $list_order = $orders->result;
                $total = $orders->total;
            }
            // cancel ỏder
            if (isset($_POST['submit_delete']) && $_POST['submit_delete']) {
                $cancel_order = $classOrder->cancel_order_user($_POST['order_uuid']);
                if ($cancel_order->status) {
                    echo '<div id="toast" mes-type="error" mes-title="Thành công!" mes-text="' . $cancel_order->message . '"></div>';
                    echo ' <script>
                             setTimeout(function() {
                                 window.location.href="?mod=profile&act=order_detail&order=' . $_POST['order_uuid'] . '";
                             }, 2500);
                         </script>';
                }
            }

            include_once 'view/inc/header.php';
            include_once 'view/inc/profilesidebar.php';
            include_once 'view/orderhistory.php';

            include_once 'view/inc/footer.php';
            break;
        case 'sercurity':
            $viewTitle = 'Đổi mật khẩu';
            if (isset($_POST['submit-change-pass']) && $_POST['submit-change-pass']) {
                $oldpassword = $_POST['oldpassword'];
                $newpassword = $_POST['newpassword'];
                $confirmpassword = $_POST['confirmpassword'];
                if (($oldpassword) == '' || ($newpassword) == "" || ($confirmpassword) == "") {
                    echo '<div id="toast" mes-type="error" mes-title="Thất bại!" mes-text="Vui lòng nhập đầy đủ thông tin"></div>';
                } else {
                    $classUser = new User();
                    $checkPass = $classUser->checkPass(md5($oldpassword));
                    if ($checkPass->status == false) {
                        echo '<div id="toast" mes-type="error" mes-title="Thất bại!" mes-text="' . $checkPass->message . '"></div>';
                    } else {
                        if ($newpassword != $confirmpassword) {
                            echo '<div id="toast" mes-type="error" mes-title="Thất bại!" mes-text="Mật khẩu mới không khớp nhau!"></div>';
                        } else {
                            $changeNewPass = $classUser->changeNewPass(md5($newpassword));
                            if ($changeNewPass->status == false) {
                                echo '<div id="toast" mes-type="error" mes-title="Thất bại!" mes-text="' . $changeNewPass->message . '"></div>';

                            } else {
                                echo '<div id="toast" mes-type="success" mes-title="Thành công!" mes-text="Thay đổi mật khẩu thành công!"></div>';

                            }
                        }
                    }

                }
            }


            include_once 'view/inc/header.php';
            include_once 'view/inc/profilesidebar.php';
            include_once 'view/sercurity.php';
            include_once 'view/inc/footer.php';
            break;
        case 'forgotpassword':
            $active = 'default';
            if (isset($_POST['email']) && $_POST['email'] != "") {

                $email = $_POST['email'];

                $checkemail = $classUser->sendCodePassEmail($email);

                if ($checkemail->status == false) {
                    echo '<div id="toast" mes-type="error" mes-title="Thất bại!" mes-text="' . $checkemail->message . '"></div>';
                } else {

                    header('location: ' . $checkemail->redirect);
                }
            }
            if (isset($_GET['verifytoken']) && $_GET['verifytoken']) {
                $token = $_GET['verifytoken'];
                $checkToken = $classUser->checkToken($token);
                if ($checkToken->status == false) {
                    echo '<div id="toast" mes-type="error" mes-title="Thất bại!" mes-text="' . $checkToken->message . '"></div>';
                    $active = 'tokenerror';
                } else {
                    $active = 'submitcode';

                }
            }
            // submit code
            if (isset($_POST['code']) && count($_POST['code']) == 4) {
                $codes = $_POST['code'];
                $code = implode("", $codes);
                if (strlen($code) != 4) {
                    echo '<div id="toast" mes-type="error" mes-title="Thất bại!" mes-text="Vui lòng nhập mã CODE gồm 4 kí tự!"></div>';
                } else {
                    $token = $_GET['verifytoken'];
                    $checkCode = $classUser->checkCode($code, $token);

                    if ($checkCode->status == false) {

                        echo '<div id="toast" mes-type="error" mes-title="Thất bại!" mes-text="' . $checkCode->message . '"></div>';
                    } else {
                        $active = 'changepassword';
                    }
                }
            }
            // submit password
            if (isset($_POST['password']) && $_POST['password']) {
                $active = 'changepassword';
                $pass = $_POST['password'];
                $passConfirm = $_POST['passwordconfirm'];
                if ($passConfirm == "") {
                    echo '<div id="toast" mes-type="error" mes-title="Thất bại!" mes-text="Vui lòng nhập đầy đủ thông tin!"></div>';
                } elseif ($pass != $passConfirm) {
                    echo '<div id="toast" mes-type="error" mes-title="Thất bại!" mes-text="Mật khẩu không khớp. Vui lòng nhập lại"></div>';
                } else {
                    $token = $_GET['verifytoken'];
                    $changePass = $classUser->changePassword(md5($pass), $token);
                    if ($changePass->status == false) {
                        echo '<div id="toast" mes-type="error" mes-title="Thất bại!" mes-text="' . $changePass->message . '"></div>';

                    } else {
                        echo '<div id="toast" mes-type="success" mes-title="Thành công!" mes-text="Thay đổi mật khẩu thành công!"></div>';

                        echo ' <script>
                            setTimeout(function() {
                                window.location.href="?mod=profile&act=login";
                            }, 2500);
                        </script>';
                    }

                }

            }
            include_once 'view/forgotpassword.php';
            break;
        case 'address':
            // get address info by id
            $id = $_GET['id'] ?? "";
            if (isset($type) && ($type == 'update') && isset($id) && $id) {
                $address = $classAddress->get_address_by_id($id);
                if ($address->status == true) {
                    $address_info = $address->result;
                }
            }
            // update address
            if (isset($type) && (($type == 'delete') || ($type == 'set_default')) && isset($id) && $id) {
                $update_address = $classAddress->update_address_user($type, $id);
            }
            $type = $_GET['type'] ?? "";
            if (isset($_POST['submit_address']) && $_POST['submit_address']) {
                $name_receiver = $_POST['name_receiver'] ?? "";
                $phone_number = $_POST['phone_number'] ?? "";
                $province = $_POST['province'] ?? "";
                $district = $_POST['district'] ?? "";
                $address_detail = $_POST['address_detail'] ?? "";
                $is_default = $_POST['is_default'] ?? "";
                $update_address = $classAddress->update_address_user($type, $id, $name_receiver, $phone_number, $province, $district, $address_detail, $is_default);
            }
            if (isset($update_address)) {
                if ($update_address->status) {
                    echo '<div id="toast" mes-type="success" mes-title="Thành công!" mes-text="' . $update_address->message . '"></div>';
                    $redirect = isset($_POST['shop'])?"?mod=page&act=checkout&shop=".$_POST['shop']:"";
                    $redirect = isset($_POST['voucher'])? $redirect."&voucher=".$_POST['voucher']:$redirect;
                    if(empty($redirect)){
                        echo ' <script>
                                setTimeout(function() {
                                    window.location.href="?mod=profile&act=address";
                                }, 2500);
                            </script>';

                    }else{
                        echo ' <script>
                                setTimeout(function() {
                                    window.location.href="'.$redirect.'";
                                }, 2500);
                            </script>';
                    }


                } else {
                    echo '<div id="toast" mes-type="error" mes-title="Thất bại!" mes-text="' . $update_address->message . '"></div>';
                }

            }
            // get all address
            $all_address = $classAddress->get_all_address_user();
            $viewTitle = "Quản lý địa chỉ";
            include_once 'view/inc/header.php';
            include_once 'view/inc/profilesidebar.php';
            include_once 'view/address.php';
            include_once 'view/inc/footer.php';
            break;
        case "voucher":
            $viewTitle = "Quản lý Voucher";
            $type = 'all';
            if (isset($_GET['type']) && $_GET['type'])
                $type = $_GET['type'];
            $all_voucher = $classVoucher->get_voucher_user($type);
            if (isset($_POST['btn_submit_search']) && $_POST['btn_submit_search']) {
                $all_voucher = $classVoucher->get_voucher_user($type, $_POST['search_voucher']);
            }
            include_once 'view/inc/header.php';
            include_once 'view/inc/profilesidebar.php';
            include_once 'view/voucher.php';
            include_once 'view/inc/footer.php';
            break;
        case "notification":
            $viewTitle = "Quản lý thông báo";
            $urlFilter = "?mod=profile&act=notification";
            $limit = 5;
            $page = 1;
            if (isset($_GET['page'])) {
                $page = $_GET['page'];
                $urlFilter .= '&page=' . $page;

            }
            $notifies = $classNotify->get_notification_user($page, $limit);
            $total = $notifies->total;
            // read notification
            $classNotify->read_notify_user();

            include_once 'view/inc/header.php';
            include_once 'view/inc/profilesidebar.php';
            include_once 'view/notification.php';
            include_once 'view/inc/footer.php';
            break;
        case "order_detail":
            if (isset($_GET['order']) && $_GET['order']) {
                $result = $classOrder->get_order_user_detail($_GET['order']);
                if ($result->status) {
                    $data = $result->result;
                } else {
                    header("Location: ?page=404");
                }
            } else {
                header("Location: ?page=404");
            }
            // cancel order
            if (isset($_POST['submit_delete']) && $_POST['submit_delete']) {
                $cancel_order = $classOrder->cancel_order_user($_POST['order_uuid']);
                if ($cancel_order->status) {
                    echo '<div id="toast" mes-type="error" mes-title="Thành công!" mes-text="' . $cancel_order->message . '"></div>';
                    echo ' <script>
                            setTimeout(function() {
                                window.location.href="?mod=profile&act=order_detail&order=' . $_POST['order_uuid'] . '";
                            }, 2500);
                        </script>';
                }
            }

            $viewTitle = "Chi tiết đơn hàng";
            include_once 'view/inc/header.php';
            include_once 'view/inc/profilesidebar.php';
            include_once 'view/order_detail.php';
            include_once 'view/inc/footer.php';
            break;
        default:
            include_once 'view/inc/header.php';
            include_once 'view/error.php';
            include_once 'view/inc/footer.php';
    }
}

?>