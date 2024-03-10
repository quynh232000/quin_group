<!-- main -->
<main class="shop-main">
    <!-- content -->
    <div class="shop-main-content">
        <div class="shop-top">
            <div class="shop-title">Tổng quan</div>

            <!--  -->

            <!--  -->
            <div class="dash-top">
                <!-- item -->
                <div class="card work">
                    <div class="img-section">
                        <svg xmlns="http://www.w3.org/2000/svg" height="77" width="76">
                            <path fill-rule="nonzero" fill="#3F9CBB"
                                d="m60.91 71.846 12.314-19.892c3.317-5.36 3.78-13.818-2.31-19.908l-26.36-26.36c-4.457-4.457-12.586-6.843-19.908-2.31L4.753 15.69c-5.4 3.343-6.275 10.854-1.779 15.35a7.773 7.773 0 0 0 7.346 2.035l7.783-1.945a3.947 3.947 0 0 1 3.731 1.033l22.602 22.602c.97.97 1.367 2.4 1.033 3.732l-1.945 7.782a7.775 7.775 0 0 0 2.037 7.349c4.49 4.49 12.003 3.624 15.349-1.782Zm-24.227-46.12-1.891-1.892-1.892 1.892a2.342 2.342 0 0 1-3.312-3.312l1.892-1.892-1.892-1.891a2.342 2.342 0 0 1 3.312-3.312l1.892 1.891 1.891-1.891a2.342 2.342 0 0 1 3.312 3.312l-1.891 1.891 1.891 1.892a2.342 2.342 0 0 1-3.312 3.312Zm14.19 14.19a2.343 2.343 0 1 1 3.315-3.312 2.343 2.343 0 0 1-3.314 3.312Zm0 7.096a2.343 2.343 0 0 1 3.313-3.312 2.343 2.343 0 0 1-3.312 3.312Zm7.096-7.095a2.343 2.343 0 1 1 3.312 0 2.343 2.343 0 0 1-3.312 0Zm0 7.095a2.343 2.343 0 0 1 3.312-3.312 2.343 2.343 0 0 1-3.312 3.312Z">
                            </path>
                        </svg>
                    </div>
                    <div class="card-desc">
                        <div class="card-header">
                            <div class="card-title">Doanh thu</div>
                            <div class="card-menu">
                                <div class="dot"></div>
                                <div class="dot"></div>
                                <div class="dot"></div>
                            </div>
                        </div>
                        <div class="card-time fm-price"> <?php
                        if (isset($resultData)) {
                            echo $resultData->result['totalBalance'];
                        }
                        ?></div>
                        <p class="recent">Trong vòng 3 tháng</p>
                    </div>
                </div>
                <!-- item -->
                <div class="card work">
                    <div class="img-section">
                        <svg xmlns="http://www.w3.org/2000/svg" height="77" width="76">
                            <path fill-rule="nonzero" fill="#3F9CBB"
                                d="m60.91 71.846 12.314-19.892c3.317-5.36 3.78-13.818-2.31-19.908l-26.36-26.36c-4.457-4.457-12.586-6.843-19.908-2.31L4.753 15.69c-5.4 3.343-6.275 10.854-1.779 15.35a7.773 7.773 0 0 0 7.346 2.035l7.783-1.945a3.947 3.947 0 0 1 3.731 1.033l22.602 22.602c.97.97 1.367 2.4 1.033 3.732l-1.945 7.782a7.775 7.775 0 0 0 2.037 7.349c4.49 4.49 12.003 3.624 15.349-1.782Zm-24.227-46.12-1.891-1.892-1.892 1.892a2.342 2.342 0 0 1-3.312-3.312l1.892-1.892-1.892-1.891a2.342 2.342 0 0 1 3.312-3.312l1.892 1.891 1.891-1.891a2.342 2.342 0 0 1 3.312 3.312l-1.891 1.891 1.891 1.892a2.342 2.342 0 0 1-3.312 3.312Zm14.19 14.19a2.343 2.343 0 1 1 3.315-3.312 2.343 2.343 0 0 1-3.314 3.312Zm0 7.096a2.343 2.343 0 0 1 3.313-3.312 2.343 2.343 0 0 1-3.312 3.312Zm7.096-7.095a2.343 2.343 0 1 1 3.312 0 2.343 2.343 0 0 1-3.312 0Zm0 7.095a2.343 2.343 0 0 1 3.312-3.312 2.343 2.343 0 0 1-3.312 3.312Z">
                            </path>
                        </svg>
                    </div>
                    <div class="card-desc">
                        <div class="card-header">
                            <div class="card-title">Tổng đơn hàng</div>
                            <div class="card-menu">
                                <div class="dot"></div>
                                <div class="dot"></div>
                                <div class="dot"></div>
                            </div>
                        </div>
                        <div class="card-time"> <?php
                        if (isset($resultData)) {
                            echo $resultData->result['totalOrder'];
                        }
                        ?></div>
                        <p class="recent">Trong vòng 3 tháng</p>
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
                    <div class="dash-content-title">Tổng sản phẩm</div>
                </a>
                <a href="?mod=seller&act=manageproduct&type=sold" class="dash-content-item">
                    <div class="dash-content-count">
                        <?php
                        if (isset($resultData)) {
                            echo $resultData->result['totalSold']??0;
                        }
                        ?>
                    </div>
                    <div class="dash-content-title">Sản phẩm đã bán</div>
                </a>
                <a href="?mod=seller&act=manageproduct&type=out" class="dash-content-item">
                    <div class="dash-content-count">
                        <?php
                        if (isset($resultData)) {
                            echo $resultData->result['totalOut'];
                        }
                        ?>
                    </div>
                    <div class="dash-content-title">Sản phẩm hết hàng</div>
                </a>
                <a href="?mod=seller&act=manageproduct&type=hidden" class="dash-content-item">
                    <div class="dash-content-count">
                        <?php
                        if (isset($resultData)) {
                            echo $resultData->result['totalHidden'];
                        }
                        ?>
                    </div>
                    <div class="dash-content-title">Sản phẩm ẩn</div>
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
                    <div class="dash-content-title">Tổng đơn hàng</div>
                </a>
                <a href="?mod=seller&act=manageorders&status=New" class="dash-content-item">
                    <div class="dash-content-count">
                        <?php
                        if (isset($resultData)) {
                            echo $resultData->result['totalOrderNew'];
                        }
                        ?>
                    </div>
                    <div class="dash-content-title">Đơn hàng mới</div>
                </a>
                <a href="?mod=seller&act=manageorders&status=Completed" class="dash-content-item">
                    <div class="dash-content-count">
                        <?php
                        if (isset($resultData)) {
                            echo $resultData->result['totalOrderSuccess'];
                        }
                        ?>
                    </div>
                    <div class="dash-content-title">Đơn hàng đã giao</div>
                </a>
                <a href="?mod=seller&act=manageorders&status=Cancelled" class="dash-content-item">
                    <div class="dash-content-count">
                        <?php
                        if (isset($resultData)) {
                            echo $resultData->result['totalOrderCancel'];
                        }
                        ?>
                    </div>
                    <div class="dash-content-title">Đơn hàng hủy</div>
                </a>

            </div>
        </div>
    </div>
</main>
</div>
</div>