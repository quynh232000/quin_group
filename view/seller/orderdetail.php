<link rel="stylesheet" href="./src/css/detailorder.css">

<div class="shop-main invoicePreview">
    <?php
    if (isset($order)) {
        $order_info = $order['order_info'];
        $list = $order['list_order']?>

        <div class="panel">
            <div class="de-top">
                <div class="de-title">Chi tiết đơn hàng</div>
                <div class="shrink-0">
                    <img src="assest/upload/<?=$order_info['shop_icon']?>" alt="image" class="de-logo">
                </div>
            </div>
            <div class="de-info">
                <div class="de-info-item">
                    <div class="de-info-title">Thông tin khách hàng</div>
                    <div class="de-info-group-wrapper">
                        <div class="de-info-item-group">
                            <span>Họ tên:</span>
                            <strong>
                                <?= $order_info['address_name'] ?>
                            </strong>
                        </div>
                        <div class="de-info-item-group">
                            <span>Email:</span>
                            <strong>
                                <?= $order_info['email'] ?>
                            </strong>
                        </div>
                        <div class="de-info-item-group">
                            <span>Phone:</span>
                            <strong class="">
                                <?= $order_info['address_phone']?>
                            </strong>
                        </div>
                        <div class="de-info-item-group">
                            <span>Địa chỉ:</span>
                            <strong class="">
                                <?= $order_info['address_ward']." - ".$order_info['address_district']." - ".$order_info['address_province'] ?>
                            </strong>
                        </div>
                       
                        <div class="de-info-item-group">
                            <span>Ghi chú:</span>
                            <strong class="">
                                <?= $order_info['note']??"-" ?>
                            </strong>
                        </div>
                    </div>
                </div>
                <div class="de-info-item">
                    <div class="de-info-title">Thông tin đơn hàng</div>
                    <div class="de-info-group-wrapper">
                        <div class="de-info-item-group">
                            <span>Đơn hàng:</span>
                            <strong>#
                                <?= $order_info['id'] ?>
                            </strong>
                        </div>
                        <div class="de-info-item-group">
                            <span>Ngày:</span>
                            <strong>
                                <?= $order_info['created_at'] ?>
                            </strong>
                        </div>
                        <div class="de-info-item-group">
                            <span>Phí ship:</span>
                            <strong class="fm-price"><?=$order_info['shipping_fee']?></strong>
                        </div>
                        <div class="de-info-item-group">
                            <span>Tạm tính:</span>
                            <strong class="fm-price">
                                <?=$order_info['sub_total'] ?>
                            </strong>
                        </div>
                        <div class="de-info-item-group de-group-total">
                            <span>Tổng tiền:</span>
                            <strong class="fm-price">
                                <?= $order_info['total'] ?>
                            </strong>
                        </div>
                    </div>

                </div>
            </div>
            <div class="de-content">
                <div class="de-info-title">Thông tin chi tiết</div>
                <table class="de-table">
                    <tr>
                        <th>Stt</th>
                        <th>Ảnh</th>
                        <th>Tên</th>
                        <th class="">Giá</th>
                        <th>Số lượng</th>
                        <th>Loại</th>
                        <th>Tạm tính</th>
                        <th>Trạng thái</th>
                    </tr>
                    <!-- list -->
                    <?php
                    $i = 0;
                    foreach ($list as $key => $value) {  $i++?>
                        <tr>
                            <td>
                                <div class="de-pro"><?=$i ?></div>
                            </td>
                            <td>
                                <div class="de-pro">
                                    <img src="assest/upload/<?=$value['image_cover'] ?>"
                                        alt="">
                                </div>
                            </td>
                            <td>
                                <a href="?mod=page&act=detail&id=<?=$value['id'] ?>" class="de-pro"><?=$value['name'] ?></a>
                            </td>
                            <td>
                                <div class="de-pro fm-price"><?=$value['price'] ?></div>
                            </td>
                            <td>
                                <div class="de-pro"><?=$value['quantity'] ?></div>
                            </td>
                            <td>
                                <div class="de-pro"><?=$value['categoryName'] ?>
                            </div>
                            </td>
                            <td>
                                <div class="de-pro fm-price"><?=$value['quantity']*$value['price'] ?></div>
                            </td>
                            <td>
                                <div class="de-pro de-pro-status"><?=$order_info['status'] ?></div>
                            </td>
                        </tr>
                    <?php }

                    ?>

                    
                </table>
            </div>
        </div>
    <?php }
    ?>
</div>
<!-- end main content section -->

</div>
</div>