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
    <div class="o_detail-nav">
        <a href="?mod=profile&act=orderhistory" class="o_deetail-nav-left">
            <i class="fa-solid fa-chevron-left"></i>
            <span>Trở lại</span>
        </a>
        <div class="o_detail-nav-right code">Mã đơn hàng. <strong>
                <?= $data['order_info']['id'] ?>
            </strong></div>
        <div class="o_detail-nav-right status">
            <?= $arrMessage[$data['order_info']['status']] ?>
        </div>
    </div>
    <div class="o_track">
        <div class="o_track-item <?= in_array($data['order_info']['status'], ['New', 'Processing','Confirmed','On_Delivery','Completed']) ? "active" : "" ?>">
            <div class="o_track-item-wrapper">
                <div class="o_track-top">
                    <div class="o_track-icon">
                        <i class="fa-solid fa-clipboard"></i>
                    </div>
                    <div class="o_track-title">
                        Đơn hàng đã đặt
                    </div>
                </div>
                <div class="o_track-line"></div>
            </div>
        </div>
        <div class="o_track-item <?= (in_array($data['order_info']['status'],['Confirmed','On_Delivery','Completed'])) ? "active" : "" ?>">
            <div class="o_track-item-wrapper">
                <div class="o_track-top">
                    <div class="o_track-icon">
                        <i class="fa-solid fa-file-circle-check"></i>
                    </div>
                    <div class="o_track-title">
                        Đã được xử lý
                    </div>
                </div>
                <div class="o_track-line"></div>
            </div>
        </div>

        <div class="o_track-item <?= (in_array($data['order_info']['status'],['On_Delivery','Completed']) ) ? "active" : "" ?>">
            <div class="o_track-item-wrapper">
                <div class="o_track-top">
                    <div class="o_track-icon">
                        <i class="fa-solid fa-truck-fast"></i>
                    </div>
                    <div class="o_track-title">
                        Đã giao cho ĐVVC
                    </div>
                </div>
                <div class="o_track-line"></div>
            </div>
        </div>
        <div class="o_track-item <?= ($data['order_info']['status'] == 'Completed') ? "active" : "" ?>">
            <div class="o_track-item-wrapper">
                <div class="o_track-top">
                    <div class="o_track-icon">
                        <i class="fa-solid fa-diagram-next"></i>
                    </div>
                    <div class="o_track-title">
                        Đã nhận được hàng
                    </div>
                </div>
                <div class="o_star">
                    <i class="fa-solid fa-star"></i>
                </div>
                <!-- <div class="o_track-line"></div> -->
            </div>
        </div>
    </div>
    <div class="o_detail-line"></div>
    <div class="o_address">
        <div class="o_address-title">Địa chỉ nhận hàng</div>
        <div class="o_address-body">
            <div class="o_address-name">
                <?= $data['order_info']['address_name'] ?>
            </div>

            <div class="o_address-item">
                <?= $data['order_info']['address_phone'] ?>
            </div>
            <div class="o_address-item">
                <?= $data['order_info']['address_ward'] ?> -
                <?= $data['order_info']['address_district'] ?> -
                <?= $data['order_info']['address_province'] ?>
            </div>
            <div class="o_address-item"><span>Ghi chú: </span>
                <?= $data['order_info']['note'] ?? "..." ?>
            </div>

        </div>
    </div>
    <div class="o_shop">
        <div class="cart-shop">
            <div href="?mod=page&amp;act=shop&amp;uuid=9E735629-1207-46CE-9414-334ECA90k82E" class="cart-shop-info">
                <div class="cart-shop-img">
                    <img src="./assest/upload/<?= $data['order_info']['shop_icon'] ?>" alt="">
                </div>
                <div class="cart-shop-name">
                    <?= $data['order_info']['shop_name'] ?>
                </div>
            </div>
            <a href="?mod=page&act=shop&uuid=<?= $data['order_info']['shop_uuid'] ?>" class="o_shop-btn">
                <i class="fa-solid fa-shop"></i>
                Xem shop
            </a>
        </div>
    </div>
    <div class="o_product">
        <?php
        foreach ($data['list_order'] as $key => $value) { ?>
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
        <div class="o_end_item">
            <div class="o_end_left">Tổng tiền hàng</div>
            <div class="o_end_right fm-price">
                <?= $data['order_info']['sub_total'] ?>
            </div>
        </div>
        <?php
        if (isset ($data['order_info']['discount_amount']) && $data['order_info']['discount_amount'] > 0) {
            echo '<div class="o_end_item">
                    <div class="o_end_left">Giảm voucher</div>
                    <div class="o_end_right fm-price">' . $data['order_info']['discount_amount'] . '</div>
                </div>';
        }
        ?>

        <div class="o_end_item">
            <div class="o_end_left">Phí vận chuyển</div>
            <div class="o_end_right fm-price">
                <?= $data['order_info']['shipping_fee'] ?>
            </div>
        </div>
        <div class="o_end_item total">
            <div class="o_end_left">Thành tiền</div>
            <div class="o_end_right fm-price total">
                <?= $data['order_info']['total'] ?>
            </div>
        </div>
        <?php
        $arrayPayment = ['COD' => 'Thanh toán khi nhận hàng', 'Banking' => 'Thanh toán qua thẻ ngân hàng'];
        ?>
        <div class="o_end_item">
            <div class="o_end_left"><i class="fa-solid fa-shield-halved"></i>Phương thức thanh toán</div>
            <div class="o_end_right fm-price">
                <?= $arrayPayment[$data['order_info']['payment_method']] ?>
            </div>
        </div>
    </div>
    
    <?php
    if (in_array($data['order_info']['status'], ['New', 'Processing'])) {
        echo '<div class="o_cancel">
                <form method="post" action="?mod=profile&act=order_detail&order='.$_GET['order'].'">
                    <input type="text" hidden name="order_uuid" value="'.$_GET['order'].'">
                    <input type="submit" class="o_cancel-btn" name="submit_delete" value="Hủy đơn hàng">
                </form>
            </div>';
    }
    ?>

</div>

</div>
</div>
</main>