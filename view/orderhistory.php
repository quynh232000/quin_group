<link rel="stylesheet" href="src/css/order_detail.css">
<?php
$arrMessage = [
    'New' => "Đặt hàng thành công!",
    'Processing' => "Đơn hàng đợi xử lý!",
    'Confirmed' => "Đã xác nhận đơn hàng thành công!",
    "On_Delivery" => "Đơn hàng đang được vận chuyển!",
    'Completed' => "Đã hoàn thành đơn hàng!",
    "Cancelled" => "Đơn hàng đã được hủy!"
];

?>
<div class="o_detail">
    <div class="h_nav">
        <div class="h_nav-top">
            <a href="?mod=profile&act=orderhistory" class="h_nav-top_item <?=!isset($_GET['status']) ?"active":""?>" data-type="All">Tất cả</a>
            <a href="?mod=profile&act=orderhistory&status=Processing" class="h_nav-top_item <?=isset($status) && $status =='Processing' ? "active":""?>" data-type="All">Chở xử
                lý</a>
            <a href="?mod=profile&act=orderhistory&status=On_Delivery" class="h_nav-top_item <?=isset($status) && $status =='On_Delivery' ? "active":""?>" data-type="All">Đang vận
                chuyển</a>
            <a href="?mod=profile&act=orderhistory&status=Completed" class="h_nav-top_item <?=isset($status) && $status =='Completed' ? "active":""?>" data-type="All">Đã giao</a>
            <a href="?mod=profile&act=orderhistory&status=Cancelled" class="h_nav-top_item <?=isset($status) && $status =='Cancelled' ? "active":""?>" data-type="All">Đã hủy</a>
        </div>
    </div>
    <div class="h_search">
        <label for="input_search-submit"><i class="fa-solid fa-magnifying-glass"></i></label>
        <form  class="h_search-input">
            <input type="submit" id="input_search-submit" hidden>
            <input type="text" hidden name="mod" value="profile">
            <input type="text" hidden name="act" value="orderhistory">
            <input type="text" hidden name="status" value="<?=$status?>">
            <input type="text" name="search" value="<?=isset($_GET['search'])?$_GET['search']:""?>" placeholder="Tìm kiếm đơn hàng theo tên Shop, ID đơn hàng...">
            <input type="text" hidden name="page" value="<?=$page?>">
        </form>
    </div>


    <div class="h_list_order">
        <?php
        if (isset ($list_order) && $list_order && count($list_order) > 0) {
            foreach ($list_order as $key => $value) {
                $order = $classOrder->get_order_user_detail($value['uuid'])->result;
                ?>
                <div class="h_order_group">
                    <div class="o_shop">
                        <div class="cart-shop">
                            <div class="o_h-left">
                                <a href="?mod=page&act=shop&uuid=<?= $order['order_info']['shop_uuid'] ?>"
                                    class="cart-shop-info">
                                    <div class="cart-shop-img">
                                        <img src="./assest/upload/<?= $order['order_info']['shop_icon'] ?>" alt="">
                                    </div>
                                    <div class="cart-shop-name">
                                        <?= $order['order_info']['shop_name'] ?>
                                    </div>
                                </a>
                                <a href="?mod=page&act=shop&uuid=<?= $order['order_info']['shop_uuid'] ?>" class="o_shop-btn">
                                    <i class="fa-solid fa-shop" style="margin-right:10px" ></i>
                                    Xem shop
                                </a>
                            </div>
                            <div class="o_h_right">
                                <div class="h_h_status">
                                    <?= $arrMessage[$order['order_info']['status']] ?>
                                </div>
                                <a href="?mod=profile&act=order_detail&order=<?= $order['order_info']['uuid'] ?>"
                                    class="o_h-btn_see">Xem chi tiết</a>
                            </div>
                        </div>
                    </div>
                    <div class="o_product">
                        <?php
                        foreach ($order['list_order'] as $key => $value) { ?>
                            <div class="o_product_item">
                                <div class="o_pro-img">
                                    <img src="./assest/upload/<?= $value['image_cover'] ?>" alt="">
                                </div>
                                <div class="o_pro-body">
                                    <div class="o_pro-name">
                                        <?= $value['name'] ?>
                                    </div>
                                    <div class="o_pro-brand">
                                        <?= $value['brand'] ?> -
                                        <?= $value['origin'] ?>
                                    </div>
                                    <div class="o_pro-quantity">x
                                        <?= $value['quantity'] ?>
                                    </div>
                                </div>
                                <div class="o_pro-price fm-price">
                                    <?= $value['quantity'] * $value['price'] ?>
                                </div>
                            </div>
                        <?php }

                        ?>
                    </div>
                    <div class="o_end">
                        <div class="o_end_item total">
                            <div class="o_end_left">Thành tiền</div>
                            <div class="o_end_right fm-price total">
                                <?= $order['order_info']['total'] ?>
                            </div>
                        </div>
                        <?php
                        $arrayPayment = ['COD' => 'Thanh toán khi nhận hàng', 'Banking' => 'Thanh toán qua thẻ ngân hàng'];
                        ?>
                        <div class="o_end_item">
                            <div class="o_end_left"><i class="fa-solid fa-shield-halved"></i>Phương thức thanh toán</div>
                            <div class="o_end_right fm-price">
                                <?= $arrayPayment[$order['order_info']['payment_method']] ?>
                            </div>
                        </div>
                    </div>
                    <?php 
                        if(in_array($order['order_info']['status'],['New','Processing'])){
                            echo '
                            <form method="POST" class="o_cancel">
                                <input type="text" hidden name="order_uuid" value="'.$order['order_info']['uuid'].'">
                                <input type="submit" name="submit_delete" class="o_cancel-btn" value="Hủy đơn hàng">
                            </form>';
                        }
                    ?>
                </div>
            <?php } ?>
            <div class="g-nav1">
                <div class="g-nav-left">
                </div>
                <div class="g-nav-right">
                    <div class="g-nav-btn-group">

                        <!-- pagination -->
                        <?php
                        $totalPage = ceil($total / $limit);
                        $page = $_GET['page'] ?? 1;
                        // previous
                        echo '<a href="' . ($page > 1 ? "$urlFilter&page=" . ($page - 1) : "#") . '" class="g-nav-btn ' . ($page == 1 ? "disabled" : "") . '">
                                        <i class="fa-solid fa-angle-left"></i>
                                    </a>';
                        // for number
                        for ($i = 0; $i < $totalPage; $i++) {
                            $active = $page == ($i + 1) ? "active" : "";

                            $link = "$urlFilter&page=" . ($i + 1);
                            echo '<a href="' . $link . '" class="g-nav-btn ' . $active . '">
                                       ' . ($i + 1) . '
                                    </a>';
                        }
                        // next
                        echo '<a href="' . ($page < $totalPage ? "$urlFilter&page=" . ($page + 1) : "#") . '" class="g-nav-btn ' . ($page == $totalPage ? "disabled" : "") . '">
                                        <i class="fa-solid fa-angle-right"></i>
                                    </a>';
                        ?>

                    </div>
                </div>
            </div>
        <?php } else {
            echo '<div class="no-product gray">Bạn chưa có đơn hàng nào!</div>';
        }
        ?>
        <!-- item -->



    </div>
</div>

</div>
</div>
</main>