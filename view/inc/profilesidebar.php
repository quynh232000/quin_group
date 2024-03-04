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
                            <?= Session::get("fullName") ?>
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


                </div>
            </div>