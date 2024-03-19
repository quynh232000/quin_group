<div class="profile-container quin-profile">
    <div class="profile-title">Hồ sơ</div>
    <form class="form-update-profile" method="POST" enctype="multipart/form-data">
        <div class="profile-avatar-body">
            <div class="profile-img">
                <img src="<?php echo "./assest/upload/" . Session::get("avatar");?>" alt="" class="profile-show-img">
            </div>
            <label for="avatar-input">
                <i class="fa-regular fa-pen-to-square"></i>
                <span>Tải lên</span>
            </label>
            <input type="file" name="avatar" id="avatar-input" hidden>
        </div>
        <div class="profile-wrapper">
            <div class="profile-group">
                <label for="">Tài khoản</label>
                <div class="profile-content">
                    <input readonly type="text" value="<?= Session::get("userName") ?>" name="username"
                        class="profile-input">
                </div>
            </div>
            <div class="profile-group">
                <label for="">Họ tên</label>
                <div class="profile-content">
                    <input type="text" value="<?= Session::get("fullName") ?>" name="fullName" class="profile-input">
                </div>
            </div>

            <div class="profile-group">
                <label for="">Số điện thoại</label>
                <div class="profile-content">
                    <input type="text" value="<?= Session::get("phone") ?>" name="phone" class="profile-input">
                </div>
            </div>
            <div class="profile-group">
                <label for="">Email</label>
                <div class="profile-content">
                    <input type="email" value="<?= Session::get("email") ?>" name="email" class="profile-input">
                </div>
            </div>
           
            <div class="profile-eidt-submit">
                <button class="btn-update-profile" type="submit">
                    Cập nhật
                </button>
            </div>
        </div>




    </form>
</div>
</div>
</div>
</main>
<?php
include 'inc/footer.php';
?>