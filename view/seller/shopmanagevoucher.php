<link rel="stylesheet" href="./src/css/shopsettings.css">
<link rel="stylesheet" href="./src/css/shopvoucher.css">
<style>
    .s-profile-input input {
        border: none;
    }
</style>
<main class="shop-main">
    <!-- content -->
    <form method="POST" action="<?= $_SERVER['REQUEST_URI'] ?>"  class="shop-profile">
        <div class="shop-title"><span>Quản lý Vouchers </span>
            <div class="shop-title-small">
                Xem trạng thái và voucher cho Shop
            </div>
        </div>

        <div class="s-profile-content" style="margin-top:20px">
            <div class="s-voucher-title">Tạo Voucher</div>

            <div class="voucher-row">
                <div class="voucher-group">
                    <div class="voucher-label">Tên chương trình giảm giá</div>
                    <div class="voucher-input">
                        <i class="fa-solid fa-file-signature"></i>
                        <input type="text" placeholder="Aa..." name="label" value="<?= $_POST['label'] ?? '' ?>">
                    </div>
                </div>
                <div class="voucher-group">
                    <div class="voucher-label">Mã voucher</div>
                    <div class="voucher-input">
                        <span class="voucher-input-name">QUIN</span>
                        <i class="fa-solid fa-store"></i>
                        <input type="text" placeholder="Nhập 5 số (0-9)" name="code" value="<?= $_POST['code'] ?? '' ?>">
                    </div>
                </div>
            </div>
            <div class="voucher-row">
                <div class="voucher-group">
                    <div class="voucher-label">Giá đơn hàng tối thiểu (VND)</div>
                    <div class="voucher-input">
                        <i class="fa-solid fa-money-bill-wave"></i>
                        <input type="number" placeholder="0" name="minimum_price"
                            value="<?= $_POST['minimum_price'] ?? '' ?>">
                    </div>
                </div>

                <div class="voucher-group">
                    <div class="voucher-label">Mức giảm (VND)</div>
                    <div class="voucher-input">
                        <i class="fa-solid fa-money-bill-wave"></i>
                        <input type="number" placeholder="0" name="discount_amount"
                            value="<?= $_POST['discount_amount'] ?? '' ?>">
                    </div>
                </div>
            </div>


            <div class="voucher-row">
                <div class="voucher-group ">
                    <div class="voucher-label">Thời gian sử dụng mã</div>
                    <div class="voucher-group-date-wrapper">
                        <div class="voucher-input date">
                            Start:
                            <input type="date" placeholder="Aa..." name="date_start"
                                value="<?= $_POST['date_start'] ?? '' ?>">
                        </div>
                        -
                        <div class="voucher-input date">
                            End
                            <input type="date" placeholder="Aa..." name="date_end"
                                value="<?= $_POST['date_end'] ?? '' ?>">
                        </div>
                    </div>
                </div>

                <div class="voucher-group">
                    <div class="voucher-label">Số lượng</div>
                    <div class="voucher-input">
                        <i class="fa-solid fa-money-bill-wave"></i>
                        <input type="number" placeholder="0" name="quantity"
                            value="<?= $_POST['quantity'] ?? '' ?>">
                    </div>
                </div>
            </div>
            <div class=" voucher-group-btn ">
                <button type="submit" class="voucher-btn">
                    Xác nhận
                </button>
            </div>

        </div>
    </form>
    <!-- list voucher -->
    <div class="shop-profile" style="margin-top:20px">
        <div class="shop-title"><span>Danh sách mã giảm giá</span>
            <div class="shop-title-small">
                Tạo mã giảm giá ngay bây giờ để thu hút người mua.
            </div>
        </div>

        <div class="s-profile-content" style="margin-top:20px">
            <div class="s-order-nav">
                <a href="?mod=seller&act=manage_voucher#list-order"
                    class="s-order-nav-item <?= !isset($_GET['status']) ? "active" : "" ?>">Tất cả</a>
                <a href="?mod=seller&act=manage_voucher&status=continuing#list-order"
                    class="s-order-nav-item   <?= (isset($_GET['status']) && $_GET['status'] == 'continuing') ? 'active' : "" ?>">Đang
                    diễn ra
                </a>
                <a href="?mod=seller&act=manage_voucher&status=upcoming#list-order"
                    class="s-order-nav-item   <?= (isset($_GET['status']) && $_GET['status'] == 'upcoming') ? 'active' : "" ?>">Sắp
                    diễn ra
                </a>
                <a href="?mod=seller&act=manage_voucher&status=finished#list-order"
                    class="s-order-nav-item  <?= (isset($_GET['status']) && $_GET['status'] == 'finished') ? 'active' : "" ?>">Đã
                    kết thúc
                </a>

            </div>
            <div class="voucher-body" id="list-order">
                <div class="s-orders-body">
                    <div class="s-ordes-nav">
                        <div class="s-order-item">
                            <div class="s-order-left">
                                <div class="s-orders-time">
                                    <div class="s-orders-title">Tên | Mã giảm giá</div>
                                </div>

                                <div class="s-orders-code">
                                    <div class="s-orders-title">Đơn hàng tối thiểu</div>
                                </div>

                            </div>
                            <div class="s-order-right">
                                <div class="s-orders-payment">
                                    <div class="s-orders-title">Mức giảm</div>
                                </div>
                                <div class="s-orders-status">
                                    <div class="s-orders-title"> Số lượng</div>
                                </div>

                                <div class="s-orders-status">
                                    <!-- s-orders-total-price  -->
                                    <div class="s-orders-title">Đã dùng</div>
                                </div>
                                <div class="s-orders-status">
                                    <div class="s-orders-title">Trạng thái| Thời gian</div>
                                </div>
                                <div class="s-orders-phone">
                                    <div class="s-orders-title">Hành động</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="s-orders-list">


                        <div class="s-order-item">
                            <div class="s-order-left">

                                <div class="s-orders-time">
                                    <div class="v-item-label">Giảm lớn</div>
                                    <div class="v-item-code">QUIN-23456</div>
                                </div>

                                <div class="s-orders-code fm-price">
                                    500000
                                </div>

                            </div>
                            <div class="s-order-right">
                                <div class="s-orders-payment green ">
                                    20000
                                </div>
                                <div class="s-orders-status success ">
                                    20
                                </div>

                                <div class="s-orders-total-price s-orders-status">
                                    7
                                </div>
                                <div class="s-orders-status ">
                                    <div class="s-orders-title voucher">
                                        <div class="v-status">Đang diễn ra</div>
                                        <div class="v-date">From: 23/07/2033</div>
                                        <div class="v-date">To: 23/07/2033</div>
                                    </div>
                                </div>
                                <div class="s-orders-user btn-or-action-wrapper">
                                    <!-- <button class="btn-or-action btn-orange">Nhận đơn</button> -->
                                    <button class="btn-or-action">Hủy</button>
                                </div>
                            </div>
                        </div>

                        <div class="s-order-item">
                            <div class="s-order-left">

                                <div class="s-orders-time">
                                    <div class="v-item-label">Giảm lớn</div>
                                    <div class="v-item-code">QUIN-23456</div>
                                </div>

                                <div class="s-orders-code fm-price">
                                    500000
                                </div>

                            </div>
                            <div class="s-order-right">
                                <div class="s-orders-payment green ">
                                    20000
                                </div>
                                <div class="s-orders-status success ">
                                    20
                                </div>

                                <div class="s-orders-total-price s-orders-status">
                                    7
                                </div>
                                <div class="s-orders-status ">
                                    <div class="s-orders-title voucher">
                                        <div class="v-status">Đang diễn ra</div>
                                        <div class="v-date">From: 23/07/2033</div>
                                        <div class="v-date">To: 23/07/2033</div>
                                    </div>
                                </div>
                                <div class="s-orders-user btn-or-action-wrapper">
                                    <!-- <button class="btn-or-action btn-orange">Nhận đơn</button> -->
                                    <button class="btn-or-action">Hủy</button>
                                </div>
                            </div>
                        </div>

                        <div class="s-order-item">
                            <div class="s-order-left">

                                <div class="s-orders-time">
                                    <div class="v-item-label">Giảm lớn</div>
                                    <div class="v-item-code">QUIN-23456</div>
                                </div>

                                <div class="s-orders-code fm-price">
                                    500000
                                </div>

                            </div>
                            <div class="s-order-right">
                                <div class="s-orders-payment green ">
                                    20000
                                </div>
                                <div class="s-orders-status success ">
                                    20
                                </div>

                                <div class="s-orders-total-price s-orders-status">
                                    7
                                </div>
                                <div class="s-orders-status ">
                                    <div class="s-orders-title voucher">
                                        <div class="v-status">Đang diễn ra</div>
                                        <div class="v-date">From: 23/07/2033</div>
                                        <div class="v-date">To: 23/07/2033</div>
                                    </div>
                                </div>
                                <div class="s-orders-user btn-or-action-wrapper">
                                    <!-- <button class="btn-or-action btn-orange">Nhận đơn</button> -->
                                    <button class="btn-or-action">Hủy</button>
                                </div>
                            </div>
                        </div>



                    </div>
                    <!-- // echo '<div class="no-orders">Không có đơn hàng nào!</div>'; -->
                </div>
            </div>

        </div>


    </div>
</main>

</div>
</div>