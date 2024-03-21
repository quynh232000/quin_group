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
                    </div>
                    <span class="shop-sidebar-title">Tổng quan</span>
                </a>
            </div>
            <!--shop-sidebar item -->
            <div class="shop-sidebar-item <?php if (($act == "manageproduct") || ($act == "addproduct")) {
                echo "active";
            } ?>">
                <a href="?mod=seller&act=manageproduct" class="shop-sidebar-link">
                    <div class="shop-sidebar-icon">
                        <i class="fa-solid fa-box"></i>
                    </div>
                    <span class="shop-sidebar-title">Sản phẩm</span>

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
                        <i class="fa-solid fa-file-invoice"></i>
                    </div>
                    <span class="shop-sidebar-title">Đơn hàng</span>
                </a>
            </div>

            <div class="shop-sidebar-item <?php if (($act == "manage_voucher")) {
                echo "active";
            } ?>">
                <a href="?mod=seller&act=manage_voucher" class="shop-sidebar-link">
                    <div class="shop-sidebar-icon">
                        <i class="fa-solid fa-gift"></i>
                    </div>
                    <span class="shop-sidebar-title">Vouchers</span>
                </a>
            </div>

            <div class="shop-sidebar-item <?php if (($act == "manage_review")) {
                echo "active";
            } ?>">
                <a href="?mod=seller&act=manage_review" class="shop-sidebar-link">
                    <div class="shop-sidebar-icon">
                    <i class="fa-solid fa-arrows-to-eye"></i>
                    </div>
                    <span class="shop-sidebar-title">Đánh giá SP</span>
                </a>
            </div>

            <div class="shop-sidebar-item <?php if (($act == "setting")) {
                echo "active";
            } ?>">
                <a href="?mod=seller&act=setting" class="shop-sidebar-link">
                    <div class="shop-sidebar-icon">
                        <i class="fa-solid fa-gear"></i>
                    </div>
                    <span class="shop-sidebar-title">Cài đặt</span>
                </a>
            </div>

        </div>
    </div>
</div>