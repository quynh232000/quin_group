<!-- main -->
<main class="shop-main">
    <!-- content -->
    <div class="shop-main-content">
        <div class="shop-top">
            <div class="shop-title">Thống kê</div>

            <!--  -->

            <!--  -->
            <div class="dash-top">
                <!-- item -->
                <div class="card work">
                    <div class="card-header">
                        <div class="card-desc-icon">
                            <i class="fa-solid fa-money-bills"></i>
                        </div>
                        <div class="card-title">Tổng doanh thu tháng</div>
                    </div>
                    <div class="card-desc">
                        <div class="card-time fm-price"> <?php
                                                            if (isset($resultData)) {
                                                                echo $resultData->result['totalBalance'];
                                                            }
                                                            ?></div>
                    </div>
                </div>
                <!-- item -->
                <div class="card work">
                    <div class="card-header">
                        <div class="card-desc-icon">
                            <i class="fa-solid fa-clipboard"></i>
                        </div>
                        <div class="card-title">Tổng số đơn hàng</div>
                    </div>
                    <div class="card-desc">
                        <div class="card-time"> <?php
                                                if (isset($resultData)) {
                                                    echo $resultData->result['totalOrder'];
                                                }
                                                ?></div>
                    </div>
                </div>
                <!-- item -->
                <div class="card work">
                    <div class="card-header">
                        <div class="card-desc-icon">
                            <i class="fa-solid fa-gift"></i>
                        </div>
                        <div class="card-title">Tổng voucher cửa hàng</div>
                    </div>
                    <div class="card-desc">
                        <div class="card-time"> <?php
                                                if (isset($resultData)) {
                                                    echo $resultData->result['totalOrder'];
                                                }
                                                ?></div>
                    </div>
                </div>
                <!-- item -->
                <div class="card work">
                    <div class="card-header">
                        <div class="card-desc-icon">
                            <i class="fa-solid fa-users"></i>
                        </div>
                        <div class="card-title">Số người theo dõi</div>
                    </div>
                    <div class="card-desc">
                        <div class="card-time"> <?php
                                                if (isset($resultData)) {
                                                    echo $resultData->result['totalOrder'];
                                                }
                                                ?></div>
                    </div>
                </div>




                <!-- <div class="dash-top-item">
                    <div class="dash-top-title">
                        <div class="dash-top-icon">
                            <i class="fa-solid fa-money-bills"></i>
                        </div>
                        <span>Doanh thu</span>
                    </div>
                    <div class="dash-top-content fm-price">
                        <?php
                        if (isset($resultData)) {
                            echo $resultData->result['totalBalance'];
                        }
                        ?>
                    </div>
                </div>
                <div class="dash-top-item">
                    <div class="dash-top-title">
                        <div class="dash-top-icon">
                            <i class="fa-solid fa-box-open"></i>
                        </div>
                        <span>Tổng đơn hàng</span>
                    </div>
                    <div class="dash-top-content">
                        <?php
                        if (isset($resultData)) {
                            echo $resultData->result['totalOrder'];
                        }
                        ?>
                    </div>
                </div> -->
            </div>
        </div>
        <div class="dash-content">
            <div class="dash-content-row">
                <a href="?mod=seller&act=manageproduct" class="dash-content-item">
                    <div class="dash-content-count">
                        <?php
                        if (isset($resultData)) {
                            echo $resultData->result['totalPro'];
                        }
                        ?>
                    </div>
                    <div class="dash-content-title">Tổng số sản phẩm</div>
                </a>
                <a href="?mod=seller&act=manageproduct&type=sold" class="dash-content-item">
                    <div class="dash-content-count">
                        <?php
                        if (isset($resultData)) {
                            echo $resultData->result['totalSold'] ?? 0;
                        }
                        ?>
                    </div>
                    <div class="dash-content-title">Sản phẩm đã duyệt</div>
                </a>
                <a href="?mod=seller&act=manageproduct&type=out" class="dash-content-item">
                    <div class="dash-content-count">
                        <?php
                        if (isset($resultData)) {
                            echo $resultData->result['totalOut'];
                        }
                        ?>
                    </div>
                    <div class="dash-content-title">Chờ xác nhận</div>
                </a>
                <a href="?mod=seller&act=manageproduct&type=hidden" class="dash-content-item">
                    <div class="dash-content-count">
                        <?php
                        if (isset($resultData)) {
                            echo $resultData->result['totalHidden'];
                        }
                        ?>
                    </div>
                    <div class="dash-content-title">Bị từ chối</div>
                </a>
            </div>
            <div class="dash-content-row">
                <a href="?mod=seller&act=manageorders" class="dash-content-item">
                    <div class="dash-content-count">
                        <?php
                        if (isset($resultData)) {
                            echo $resultData->result['totalOrder'];
                        }
                        ?>
                    </div>
                    <div class="dash-content-title">Sản phẩm hết hàng</div>
                </a>
                <a href="?mod=seller&act=manageorders&status=New" class="dash-content-item">
                    <div class="dash-content-count">
                        <?php
                        if (isset($resultData)) {
                            echo $resultData->result['totalOrderNew'];
                        }
                        ?>
                    </div>
                    <div class="dash-content-title">Đang hoạt động</div>
                </a>
                <a href="?mod=seller&act=manageorders&status=Completed" class="dash-content-item">
                    <div class="dash-content-count">
                        <?php
                        if (isset($resultData)) {
                            echo $resultData->result['totalOrderSuccess'];
                        }
                        ?>
                    </div>
                    <div class="dash-content-title">Chờ lấy hàng</div>
                </a>
                <a href="?mod=seller&act=manageorders&status=Cancelled" class="dash-content-item">
                    <div class="dash-content-count">
                        <?php
                        if (isset($resultData)) {
                            echo $resultData->result['totalOrderCancel'];
                        }
                        ?>
                    </div>
                    <div class="dash-content-title">Đã giao thành công</div>
                </a>

            </div>
        </div>
    </div>
</main>
</div>
</div>