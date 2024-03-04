<div class="shop-sidebar">
    <div class="shop-sidebar-inner">
        <div class="shop-sidebar-menu">
            <!--shop-sidebar item -->
            <div class="shop-sidebar-item  <?php if (
                ($act != "manageproduct") &&
                ($act != "manageorders") &&
                ($act != "addproduct") &&
                ($act != "manageuser") &&
                ($act != "managecategory") &&
                ($act != "delivery")
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
            <div class="shop-sidebar-item <?php if (($act == "managecategory")) {
                echo "active";
            } ?>">
                <a href="?mod=seller&act=managecategory" class="shop-sidebar-link">
                    <div class="shop-sidebar-icon">
                        <i class="fa-solid fa-box"></i>
                    </div>
                    <span class="shop-sidebar-title">Danh mục</span>

                </a>

            </div>
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
            <div class="shop-sidebar-item <?php if (($act == "manageuser")) {
                echo "active";
            } ?>">
                <a href="?mod=seller&act=manageuser" class="shop-sidebar-link">
                    <div class="shop-sidebar-icon">
                        <i class="fa-regular fa-user"></i>
                    </div>
                    <span class="shop-sidebar-title">Quản lý user</span>
                </a>
            </div>

        </div>
    </div>
</div>