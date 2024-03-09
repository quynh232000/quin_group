<?php
include_once "model/order.php";

extract($_REQUEST);
if (isset($_GET['act'] )&& $_GET['act']) {
    switch ($_GET['act']) {
        case 'order':
            if(!isset($_GET['token'])&& !$_GET['token']){
                header("Location: ?page=404");
            }
            // check token is expire
            $token = $_GET['token'];
            $classOrder = new Order();
            $id = base64_decode($token);
            $is_expire = $classOrder->check_link_order($id) ==true ?"expired":"new";
            // echo $is_expire;
            // return;
            if(isset($_POST['submit']) &&$_POST['submit'] ){
                $classOrder->update_status_order($id,'confirm_delivered');
                $is_expire = true;
            }
            if($is_expire =='new'){
                // confirm by qrcode
                if(isset($_GET['qrcode']) && $_GET['qrcode']){
                    $is_expire="qrcode";
                }
            }
            include_once 'view/ordership.php';
            break;
        
        default:
            header("Location: ?page=404");
    }
}
?>