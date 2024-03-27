<link rel="stylesheet" href="src/css/custom_profile.css">
<div class="address-main address voucher">

    <!-- <div class="pro-b-r-top address-title">
        <p class="pro-title">Voucher của tôi</p>

    </div> -->
    <div class="pro-b-r-body voucher_container">
        <div class="pro-b-r-top address-title">
            Thông báo của tôi

        </div>
        <div class="notification">
            <?php
            if (isset ($notifies) && $notifies->status && count($notifies->result) > 0) {
                foreach ($notifies->result as $key => $value) { ?>
                    <div class="noti_item  <?= ($value['is_read'] == false) ? 'no_read' : '' ?>">
                        <div class="noti_img">
                            <img src="./assest/upload/<?= $value['shop_icon'] ?>" alt="">
                        </div>
                        <div class="noti_item-body">
                            <div class="noti_item-title">
                                <?php
                                $title = '';
                                switch ($value['type']) {
                                    case 'NEW_ORDER':
                                        $title = 'Đơn hàng mới';
                                        break;
                                    case 'CONFIRMED_ORDER':
                                        $title = 'Đơn hàng đã xác nhận';
                                        break;
                                    case 'COMPLETED_ORDER':
                                        $title = 'Hoàn tất đơn hàng';
                                        break;
                                    default:
                                        $title = 'Thông báo mới';

                                        break;
                                }
                                echo $title;
                                ?>

                            </div>
                            <div class="noti_item-content">
                                <?= $value['message'] ?>
                            </div>
                            <div class="noti_item-date">
                                <?= $value['updated_at'] ?>
                            </div>
                        </div>
                        <div class="noti_item-right">
                            <?php
                            switch ($value['type']) {
                                case 'NEW_ORDER':
                                    echo '<a  href="?mod=profile&act=order_detail&order=' . $value['data'] . '" class="noti_item-btn">Xem chi tiết</a>';
                                    break;
                                case 'COMPLETED_ORDER':
                                    echo '<a  href="?mod=page&act=detail&product=' . $value['data'] . '" class="noti_item-btn">Đánh giá sản phẩm</a>';
                                default:
                                    $title = 'Thông báo mới';

                                    break;
                            }

                            ?>

                        </div>
                    </div>
                <?php } ?>

                <div class="g-nav1" style="margin-top:20px" >
                    <div class="g-nav-left">
                    </div>
                    <div class="g-nav-right" style="justify-content: flex-end;" >
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
                echo '<div class="no-product">Bạn không có thông báo nào!</div>';
            }

            ?>




        </div>
    </div>



</div>
<!-- ===== -->
</div>
</div>
</main>