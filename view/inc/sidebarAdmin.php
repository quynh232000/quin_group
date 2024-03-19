<div class="shop-sidebar">
    <div class="shop-sidebar-inner">
        <div class="shop-sidebar-menu">
            <!--shop-sidebar item -->
            <div class="shop-sidebar-item  <?php if (
                                                $act == "dashboard"

                                            ) {
                                                echo "active";
                                            } ?>">
                <a href="?mod=seller&act=dashboard" class="shop-sidebar-link">
                    <div class="shop-sidebar-icon">
                        <i class="fa-solid fa-house"></i>
                        <span class="shop-sidebar-title">Tổng quan</span>
                    </div>
                </a>
            </div>
            <!--shop-sidebar item -->
            <div class="shop-sidebar-item <?php if (($act == "manageproduct") || ($act == "addproduct")) {
                                                echo "active";
                                            } ?>">
                <a href="?mod=seller&act=manageproduct" class="shop-sidebar-link">
                    <div class="shop-sidebar-icon">
                        <i class="fa-solid fa-bag-shopping"></i>
                        <span class="shop-sidebar-title">Quản lý sản phẩm</span>
                    </div>
                    <div class="shop-sidebar-icon-downs">
                        <i class="fa-solid fa-chevron-down"></i>
                    </div>
                </a>
            </div>
            <!-- <div class="shop-sidebar-item <?php if (($act == "managecategory")) {
                                                    echo "active";
                                                } ?>">
                <a href="?mod=seller&act=managecategory" class="shop-sidebar-link">
                    <div class="shop-sidebar-icon">
                        <i class="fa-solid fa-box"></i>
                    </div>
                    <span class="shop-sidebar-title">Danh mục</span>

                </a>

            </div> -->
            <!--shop-sidebar item -->
            <div class="shop-sidebar-item <?php if (($act == "manageorders")) {
                                                echo "active";
                                            } ?>">
                <a href="?mod=seller&act=manageorders" class="shop-sidebar-link">
                    <div class="shop-sidebar-icon">
                        <i class="fa-solid fa-clipboard"></i>
                        <span class="shop-sidebar-title">Quản lý đơn hàng</span>
                    </div>
                    <div class="shop-sidebar-icon-downs">
                        <i class="fa-solid fa-chevron-down"></i>
                    </div>
                </a>
            </div>

            <div class="shop-sidebar-item <?php if (($act == "manage_voucher")) {
                                                echo "active";
                                            } ?>">
                <a href="?mod=seller&act=manage_voucher" class="shop-sidebar-link">
                    <div class="shop-sidebar-icon">
                        <i class="fa-solid fa-gift"></i>
                        <span class="shop-sidebar-title">Quản lý Vouchers</span>
                    </div>
                    <div class="shop-sidebar-icon-downs">
                        <i class="fa-solid fa-chevron-down"></i>
                    </div>
                </a>
            </div>

            <div class="shop-sidebar-item <?php if (($act == "manage_revenue")) {
                                                echo "active";
                                            } ?>">
                <a href="?mod=seller&act=manage_revenue" class="shop-sidebar-link">
                    <div class="shop-sidebar-icon">
                        <i class="fa-solid fa-money-bill"></i>
                        <span class="shop-sidebar-title">Quản lý doanh thu</span>
                    </div>
                    <div class="shop-sidebar-icon-downs">
                        <i class="fa-solid fa-chevron-down"></i>
                    </div>
                </a>
            </div>

            <div class="shop-sidebar-item <?php if (($act == "manage_review")) {
                                                echo "active";
                                            } ?>">
                <a href="?mod=seller&act=manage_review" class="shop-sidebar-link">
                    <div class="shop-sidebar-icon">
                        <i class="fa-solid fa-arrows-to-eye"></i>
                        <span class="shop-sidebar-title">Quản lý đánh giá</span>
                    </div>
                    <div class="shop-sidebar-icon-downs">
                        <i class="fa-solid fa-chevron-down"></i>
                    </div>
                </a>
            </div>

            <div class="shop-sidebar-item <?php if (($act == "managecategory")) {
                                                echo "active";
                                            } ?>">
                <a href="?mod=seller&act=managecategory" class="shop-sidebar-link">
                    <div class="shop-sidebar-icon">
                        <i class="fa-solid fa-sliders"></i>
                        <span class="shop-sidebar-title">Quản lý danh mục</span>
                    </div>
                    <div class="shop-sidebar-icon-downs">
                        <i class="fa-solid fa-chevron-down"></i>
                    </div>
                </a>
            </div>

            <div class="shop-sidebar-item <?php if (($act == "setting")) {
                                                echo "active";
                                            } ?>">
                <a href="?mod=seller&act=setting" class="shop-sidebar-link">
                    <div class="shop-sidebar-icon">
                        <i class="fa-solid fa-gear"></i>
                        <span class="shop-sidebar-title">Thiết lập cửa hàng</span>
                    </div>
                    <div class="shop-sidebar-icon-downs">
                        <i class="fa-solid fa-chevron-down"></i>
                    </div>
                </a>
            </div>

            <div class="shop-sidebar-item <?php if (($act == "manage_helps")) {
                                                echo "active";
                                            } ?>">
                <a href="?mod=seller&act=manage_helps" class="shop-sidebar-link">
                    <div class="shop-sidebar-icon">
                        <i class="fa-solid fa-circle-question"></i>
                        <span class="shop-sidebar-title">Trợ giúp</span>
                    </div>
                    <div class="shop-sidebar-icon-downs">
                        <i class="fa-solid fa-chevron-down"></i>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
</div>