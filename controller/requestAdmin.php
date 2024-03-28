<?php
include_once 'model/admin/manage_order/manage_order.php';
include_once 'model/admin/manage_user/manage_user.php';
include_once 'model/admin/manage_user/user_detail.php';
$orderAdmin = new OrderAdmin();
$userAdmin = new UserAdmin();
$userDetailAdmin = new UserDetailAdmin();
extract($_REQUEST);
if (isset($status) && $status) {
    switch (strtolower($status)) {
        case "all":
        case "new":
        case "processing":
        case "confirmed":
        case "completed":
        case "cancelled":
            $orderAdmin->getOrders();
            break;
        default:
            $orderAdmin->getOrders();
            break;
    }
} else if (isset($act) && $act) {
    switch ($act) {
        case "order-detail":
            $orderAdmin->orderDetail();
            break;
        case "edit-user":
            $userAdmin->doingWithUser();
            break;
        case "update-user";
            $userAdmin->updateUser();
            break;
        case "user_detail":
            $data = $userDetailAdmin->getDataStatistic();
            break;
    }
}
