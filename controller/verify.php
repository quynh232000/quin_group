<?php
include_once "model/order.php";
include_once "model/address.php";
include_once "helpers/format.php";

extract($_REQUEST);
if (isset($_GET['act']) && $_GET['act']) {
    switch ($_GET['act']) {
        case 'order':
            $viewTitle = "Thông tin đơn hàng";
            if (!isset($_GET['code']) && !$_GET['code']) {
                header("Location: ?page=404");
            }
            $code = $_GET['code'];
            $classOrder = new Order();
            $classAddress = new Address();
            $format = new Format();
            $order = $classOrder->get_order_detail($code);
            if (isset($order) && ($order->status == true)&&(($order->result['status']=='Confirmed')||$order->result['status']=='On_Delivery') ) {
                if (isset($_GET['qrcode']) && $_GET['qrcode'] == "true") {
                    $classOrder->update_status_order($order->result['id'], 'Completed');
                    echo ' <script>
                            setTimeout(function() {
                                window.location.reload()
                            }, 2500);
                        </script>';
                }

            }
            include_once 'view/ordership.php';
            break;


        default:
            header("Location: ?page=404");
    }
}
?>