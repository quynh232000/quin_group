<?php
extract($_REQUEST);

?>

<main class="profile">
    <div class="wrapper">
        <div class="profile-body">
            <div class="profile-nav">
                <div class="profile-nav-user">
                    <div class="profile-nav-avatar">
                        <img src="<?php echo "./assest/upload/" . Session::get("avatar");?>" alt="">
                    </div>
                    <div class="profile-nav-info">
                        <div class="profile-nav-user-name">
                            <?= Session::get("full_name") ?>
                        </div>
                        <div class="profile-nav-user-edit">Chỉnh sửa</div>
                    </div>
                </div>
                <div class="profile-nav-list">
                    <div class="profile-nav-item  <?php if (
                        ($act != "orderhistory") &&
                        ($act != "sercurity")
                    ) {
                        echo "active";
                    } ?>">
                        <a href="?mod=profile&act=profile" class="profile-nav-content ">
                            <div class="profile-nav-item-title">
                                <i class="fa-regular fa-user"></i>
                                <div class="profile-nav-name">Hồ sơ</div>
                            </div>
                            <div class="profile-nav-item-down">

                            </div>
                        </a>

                    </div>
                    <div class="profile-nav-item <?php if (($act == "orderhistory")) {
                        echo "active";
                    } ?>">
                        <a href="?mod=profile&act=orderhistory" class="profile-nav-content">
                            <div class="profile-nav-item-title">
                                <i class="fa-solid fa-box"></i>
                                <div class="profile-nav-name">Đơn hàng</div>
                            </div>
                        </a>

                    </div>
                    <div class="profile-nav-item <?php if (($act == "sercurity")) {
                        echo "active";
                    } ?>">
                        <a href="?mod=profile&act=sercurity" class="profile-nav-content">
                            <div class="profile-nav-item-title">
                                <i class="fa-solid fa-shield"></i>
                                <div class="profile-nav-name">Mật khẩu</div>
                            </div>
                            <div class="profile-nav-item-down">
                            </div>
                        </a>
                    </div>
                    <div class="profile-nav-item <?=$act == "address"? "active":""?>">
                        <a href="?mod=profile&act=address" class="profile-nav-content">
                            <div class="profile-nav-item-title">
                            <i class="fa-solid fa-location-dot"></i>
                                <div class="profile-nav-name">Địa chỉ</div>
                            </div>
                            <div class="profile-nav-item-down">
                            </div>
                        </a>
                    </div>
                    <div class="profile-nav-item <?=$act == "notification"? "active":""?>">
                        <a href="?mod=profile&act=notification" class="profile-nav-content">
                            <div class="profile-nav-item-title">
                            <i class="fa-regular fa-bell"></i>
                                <div class="profile-nav-name">Thông báo</div>
                            </div>
                            <div class="profile-nav-item-down">
                            </div>
                        </a>
                    </div><div class="profile-nav-item <?=$act == "voucher"? "active":""?>">
                        <a href="?mod=profile&act=voucher" class="profile-nav-content">
                            <div class="profile-nav-item-title">
                            <i class="fa-solid fa-ticket"></i>
                                <div class="profile-nav-name">Kho Voucher</div>
                            </div>
                            <div class="profile-nav-item-down">
                            </div>
                        </a>
                    </div>


                </div>
            </div>