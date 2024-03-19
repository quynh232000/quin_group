<!-- main -->
<main class="shop-main">
    <!-- content -->
    <div class="shop-main-content">
        <div class="shop-top">
            <div class="shop-title">Quản lý đơn hàng</div>
        </div>
        <div class="shop-orders">
            <div class="s-orders-top">
                <div class="s-order-nav">
                    <a href="?mod=seller&act=manageorders"
                        class="s-order-nav-item <?= !isset($_GET['status']) ? "active" : "" ?>">Tất cả</a>
                    <a href="?mod=seller&act=manageorders&status=New"
                        class="s-order-nav-item   <?= (isset($_GET['status']) && $_GET['status'] == 'New') ? 'active' : "" ?>">Chờ
                        nhận đơn</a>
                    <a href="?mod=seller&act=manageorders&status=Processing"
                        class="s-order-nav-item   <?= (isset($_GET['status']) && $_GET['status'] == 'Processing') ? 'active' : "" ?>">Chờ
                        xác nhận</a>
                    <a href="?mod=seller&act=manageorders&status=Confirmed"
                        class="s-order-nav-item  <?= (isset($_GET['status']) && $_GET['status'] == 'Confirmed') ? 'active' : "" ?>">Chờ
                        lấy hàng</a>
                    <a href="?mod=seller&act=manageorders&status=On_Delivery"
                        class="s-order-nav-item  <?= (isset($_GET['status']) && $_GET['status'] == 'On_Delivery') ? 'active' : "" ?>">Đang
                        giao</a>
                    <a href="?mod=seller&act=manageorders&status=Completed"
                        class="s-order-nav-item  <?= (isset($_GET['status']) && $_GET['status'] == 'Completed') ? 'active' : "" ?>">Đã
                        giao</a>
                    <a href="?mod=seller&act=manageorders&status=Cancelled"
                        class="s-order-nav-item  <?= (isset($_GET['status']) && $_GET['status'] == 'Cancelled') ? 'active' : "" ?>">Đơn
                        hủy</a>

                </div>
                <div class="s-order-count">
                    <div class="s-order-count-total"><?= $resultOrder->total ?> Đơn hàng</div>
                    <?php
                    if (
                        !isset($_GET['status']) || (isset($_GET['status']) && $_GET['status'] == 'New')
                        || (isset($_GET['status']) && $_GET['status'] == 'Processing')
                    )
                        echo '<div class="s-order-delivery-all" onclick="update_status_order_all('."'Confirmed'".')">
                                    <i class="fa-solid fa-truck"></i>
                                    <span>Giao hàng loạt</span>
                                </div>';
                    ?>

                </div>


            </div>


            <div class="s-orders-body">
                <div class="s-ordes-nav">
                    <div class="s-order-item">
                        <div class="s-order-left">
                            <div class="s-orders-input">
                                <input type="checkbox">
                                <div class="s-orders-view">
                                    <div class="s-orders-title">Chi tiết</div>
                                </div>
                            </div>
                            
                            <div class="s-orders-time">
                                <div class="s-orders-title">Ngày</div>
                            </div>

                            <div class="s-orders-code">
                                <div class="s-orders-title">Mã</div>
                            </div>

                        </div>
                        <div class="s-order-right">
                            <div class="s-orders-payment">
                                <div class="s-orders-title">Thanh toán</div>
                            </div>
                            <div class="s-orders-status">
                                <div class="s-orders-title">Trạng thái</div>
                            </div>

                            <div class="s-orders-status">
                                <!-- s-orders-total-price  -->
                                <div class="s-orders-title">Tổng</div>
                            </div>
                            <div class="s-orders-phone">
                                <div class="s-orders-title">Hành động</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="s-orders-list">
                    <?php

                    if (isset($resultOrder) && is_array($resultOrder->result) && count($resultOrder->result) > 0) {

                        $status = [
                            'New' => ["s1" => "Chờ nhận đơn", 's2' => 'Chưa thanh toán'],
                            'Processing' => ["s1" => "Đang Xử lý", '0' => 'Chưa thanh toán'],
                            'Confirmed' => ['s1' => "Đang đợi vận chuyển", 's2' => 'Đã thanh toán'],
                            'On_Delivery' => ['s1' => "Đang vận chuyển", 's2' => "Đã hủy"],
                            'Completed' => ['s1' => "Đã hoàn thành", 's2' => "Đã hủy"],
                            'Cancelled' => ['s1' => "Đã hủy", 's2' => "Đã hủy"]
                        ];
                        foreach ($resultOrder->result as $key => $value) { ?>
                            <div class="s-order-item">
                                <div class="s-order-left">
                                    <div class="s-orders-input">
                                        <input type="checkbox" class="order-input-check" orderid="<?= $value['id'] ?>">
                                        <div class="s-orders-view">
                                            <a href="?mod=seller&act=detailorder&id=<?= $value['id'] ?>"
                                                class="s-orders-view-wrapper">
                                                <i class="fa-solid fa-eye"></i>
                                                <span>Xem</span>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="s-orders-time">
                                        <?= explode(" ", $value['created_at'])[0] ?>
                                    </div>

                                    <div class="s-orders-code">#000
                                        <?= $value['id'] ?>
                                    </div>

                                </div>
                                <div class="s-order-right">
                                    <!-- <div class="s-orders-user"><?= $value['name_receiver'] ?></div> -->
                                    <!-- <div class="s-orders-phone"><?= $value['phone_number'] ?></div> -->
                                    <div class="s-orders-payment <?= $value['payment_status'] == 1 ? 'green' : "confirmed" ?>">
                                        <?= $value['payment_status'] == 1 ? "Đã thanh toán" : "Chưa thanh toán" ?>
                                    </div>
                                    <div class="s-orders-status <?= $value['status'] ?>">
                                        <?= $status[$value['status']]['s1'] ?>
                                    </div>

                                    <div class="s-orders-total-price s-orders-status fm-price">
                                        <?= $value['total'] ?>
                                    </div>
                                    <div class="s-orders-user btn-or-action-wrapper">
                                        <?php
                                        if ($value['status'] == 'New') {

                                            echo '<button class="btn-or-action btn-orange" onclick="update_status_order(' . $value['id'] . ',' . "'Processing'" . ')" >Nhận đơn</button>';

                                        } elseif ($value['status'] == 'Processing') {
                                            echo '<button class="btn-or-action" onclick="update_status_order(' . $value['id'] . ','."'".'Confirmed'."'".')">Xác nhận</button>
                                            <button class="btn-or-action" onclick="update_status_order(' . $value['id'] . ','."'Cancelled'".')">Hủy</button>';
                                        } elseif ($value['status'] == 'Cancelled') {
                                            echo '<button class="btn-or-action" disabled>Đã hủy</button>';
                                        } elseif ($value['status'] == 'On_Delivery') {
                                            echo '<a target="_blank" href="?mod=verify&act=order&code=' .($value['uuid']) . '" title="Xem link" class="btn-or-action"><i class="fa-solid fa-link"></i></a>';

                                        } elseif ($value['status'] == 'Completed') {
                                            // '
                                            echo '<button class="btn-or-action" disabled>Đã Giao</button>';
                                        } else {

                                            echo '<a target="_blank" href="?mod=verify&act=order&code=' . (($value['uuid'])). '" title="Xem link" class="btn-or-action"><i class="fa-solid fa-link"></i></a>';
                                        }
                                        ?>

                                    </div>
                                </div>
                            </div>
                        <?php }
                    } else {
                        echo '<div class="no-orders">Không có đơn hàng nào!</div>';
                    }
                    ?>


                </div>
                <!-- <div class="p-pagination" style="margin-top:40px">
                    <div class="p-pagination-left">
                        <span>
                            (<span class="count-product">0</span>/20)
                            sản phẩm
                        </span>
                        <div>|</div>
                        <span>
                            (<span class="current-page">1</span>/
                            <span class="total-page">6</span>) trang
                        </span>
                    </div>
                    <div class="p-pagination-right">
                        <div class="p-pagination-item previous-page">
                            Trước
                        </div>
                        <div class="p-pagination-item">1</div>
                        <div class="p-pagination-item">2</div>
                        <div class="p-pagination-item">3</div>
                        <div class="p-pagination-item next-page">Sau</div>
                    </div>
                </div> -->
            </div>
            <!-- pagination -->
            <div class="p-pagination" style="margin-top:40px;padding:0">
                <div class="p-pagination-left">
                    <span>
                        (<span class="count-product">
                            <?php if (isset($resultOrder) && isset($resultOrder->status)) {
                                echo count($resultOrder->result);
                            } else {
                                echo "0";
                            }
                            ?>
                        </span>/
                        <?= $limit ?>)
                        sản phẩm
                    </span>
                    <div>|</div>
                    <span>
                        (<span class="current-page">
                            <?= isset($_GET['page']) ? $_GET['page'] : 1 ?>
                        </span>/
                        <span class="total-page">
                            <?php if (isset($resultOrder) && isset($resultOrder->status)) {
                                echo ceil($resultOrder->total / $limit);
                            } else {
                                echo "0";
                            } ?>
                        </span>) trang
                    </span>
                </div>
                <div class="p-pagination-right">
                    <a href="?mod=seller&act=manageorders<?= $param ?>&page=<?= isset($_GET['page']) ? $_GET['page'] > 1 ? $_GET['page'] - 1 : 1 : 1 ?>"
                        class="<?php if (!isset($_GET['page']) || $_GET['page'] == 1)
                            echo "disabled"; ?> p-pagination-item previous-page">
                        <i class="fa-solid fa-angles-left"></i>
                    </a>
                    <?php if (isset($resultOrder) && isset($resultOrder->status)) {
                        for ($i = 1; $i < ceil($resultOrder->total / $limit) + 1; $i++) {
                            $active = "";
                            if (isset($_GET['page']) && $_GET['page'] == $i) {
                                $active = "active";
                            } else {
                                if (!isset($_GET['page']) && $i == 1) {
                                    $active = "active";
                                }
                            }
                            echo '<a href="?mod=seller&act=manageorders' . $param . '&page=' . $i . '" class="p-pagination-item ' . $active . '">' . $i . '</a>';
                        }
                    } else {
                        echo "";
                    }
                    ?>

                    <a href="?mod=seller&act=manageorders<?= $param ?>&page=<?php
                    if (isset($_GET['page']) && ($_GET['page'] < ceil($resultOrder->total / $limit))) {
                        echo $_GET['page'] + 1;
                    } else {
                        echo ceil($resultOrder->total / $limit);
                    } ?>" class="p-pagination-item next-page <?php
                     if (isset($_GET['page']) && (($_GET['page'] == ceil($resultOrder->total / $limit)))) {
                         echo "disabled";
                     }
                     ?>"><i class="fa-solid fa-angles-right"></i></a>
                </div>
            </div>
            <!-- pagination -->
        </div>
    </div>
</main>
</div>
</div>