<link rel="stylesheet" href="./src/css/manageuser.css">
<main class="shop-main main-manageuser">
    <div class="manage-user">

        <div class="p-body">
            <div class="p-body-title">
                <span class="title-item active" data-user="">Tất cả người dùng </span>
            </div>
            <div class="p-content">
                <div class="p-search">
                    <div class="p-search-item filter">
                        <span>Tìm kiếm</span>
                        <i class="fa-solid fa-sort"></i>
                        <div class="p-fillter-more">
                            <div class="p-fillter-item">Tên</div>
                            <div class="p-fillter-item">Email</div>
                        </div>
                    </div>
                    <div class="p-search-item p-search">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        <input type="text" placeholder="Tìm kiếm..." />
                    </div>
                    <div class="p-search-item p-search-item-trash">
                        <i class="fa-solid fa-trash-can"></i>
                    </div>
                </div>
                <div class="p-pagination">
                    <div class="p-pagination-left">
                        <span>
                            (<span class="count-product"><?php
                             if (isset($allUser)){
                                echo count($allUser->result);
                             }
                            ?></span>/20)
                            Users
                        </span>
                        <!-- <div>|</div>
                        <span>
                            (<span class="current-page">1</span>/
                            <span class="total-page">6</span>) trang
                        </span> -->
                    </div>
                    <!-- <div class="p-pagination-right">
                        <div class="p-pagination-item previous-page">
                            Trước
                        </div>
                        <div class="p-pagination-item">1</div>
                        <div class="p-pagination-item">2</div>
                        <div class="p-pagination-item">3</div>
                        <div class="p-pagination-item next-page">Sau</div>
                    </div> -->
                </div>
                <div class="item item-nav">
                    <div class="item-left">
                        <!-- <input type="checkbox" class="item-input" /> -->
                        <i class="fa-solid fa-feather-pointed item-input hidden"></i>
                        <div class="item-img">Ảnh</div>
                        <div class="item-name">Tài khoản</div>
                    </div>
                    <div class="item-right">
                        <div class="item-role">Quyền</div>
                        <div class="item-action">Hành động</div>
                    </div>
                </div>
                <div class="list-item list-users">
                    <div class="loading">
                        <div class="spinner-2"></div>
                    </div>
                    <?php
                    if (isset($allUser) && is_array($allUser->result)) {

                        foreach ($allUser->result as $key => $value) { ?>
                            <div class="item">
                                <div class="item-left">
                                    <!-- <input type="checkbox" class="item-input" user-id='${item?.id}' /> -->
                                    <i class="fa-solid fa-feather-pointed item-input"></i>
                                    <div class="item-img">
                                        <img src='./assest/upload/<?= $value['avatar'] ?>' />
                                    </div>
                                    <div class="item-name">
                                        <p>
                                            <?= $value['userName'] ?>
                                        </p>
                                        <span>
                                            <?= $value['email'] ?>
                                        </span>
                                    </div>
                                </div>
                                <div class="item-right">
                                    <div class="item-role">
                                        <div class="role <?= $value['role'] ?>">
                                            <?= $value['role'] ?>
                                        </div>
                                    </div>
                                    <div class="item-action">
                                        <a href="?mod=seller&act=manageuser&type=edit&userid=<?= $value['id'] ?>"
                                            class="action modify">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                            <span>Sửa</span>
                                        </a>
                                        <a href="?mod=seller&act=manageuser&type=delete&userid=<?= $value['id'] ?>" class="action delete-btn" user-id='${item?.id}'>
                                            <i class="fa-solid fa-trash"></i>
                                            <span>Xóa</span>
                                        </a>
                                    </div>
                                </div>
                            </div>

                        <?php }

                    }
                    ?>
                    <!-- item -->

                </div>

            </div>
        </div>
    </div>
</main>
<div class="modal 
    <?php
    if (isset($_GET['type']) && isset($_GET['userid']) && ($_GET['type']) == "edit") {
        echo "";
    } else {
        echo "hidden";
    }
    ?>
    modal-detail-user">
    <div class="modal-wrapper">
        <a href="?mod=seller&act=manageuser" class="m-close">
            <i class="fa-solid fa-xmark"></i>
        </a>
        <div class="m-title">Chỉnh sửa hồ sơ</div>

        <div class="m-body">
            <?php
            if (isset($userInfo) && $userInfo->status == 1) { 
                $user = $userInfo->result;
                ?>

                <!-- body -->
                <form class="form-modal-user" method="POST" enctype="multipart/form-data">
                    <div class="form-body-wrapper">
                        <div class="body-item w-50">
                            <div class="avatar w-100">
                                <div class="avatar-body">
                                    <img src="./assest/upload/<?=$user['avatar'] ?>"
                                        alt="" class="img-avatar" />
                                    <label for="input-avatar" class="label-avatar">
                                        <i class="fa-regular fa-pen-to-square"></i>
                                    </label>
                                    <input type="file" name="avatar" id="input-avatar" class="input-avatar" />
                                </div>
                            </div>


                            <div class="form-group w-100">
                                <div class="form-wrapper">
                                    <label for="">Vai trò</label>
                                    <div class="form-body">
                                        <div class="list-roles">
                                            <div class="role">
                                                <span><?=$user['role'] ?></span>
                                                <!-- <i class="fa-solid fa-trash-can"></i> -->
                                            </div>

                                        </div>
                                    </div>
                                    <div class="form-msg"></div>
                                </div>
                            </div>
                            <div class="form-group w-100">
                                <div class="form-wrapper">
                                    <label for="">Thay đổi vai trò</label>
                                    <div class="form-body">
                                       
                                        <select class="select-role w-100" name="role" id="">
                                            <option value="">--Chọn--</option>
                                            <?php 
                                            foreach ($userInfo->total as $key => $value) {
                                                if($user['role'] != $value['role']){
                                                    echo '<option value="'. $value['role'].'">'. $value['role'].'</option>';
                                                }
                                            }
                                            ?>
                                          
                                        </select>
                                    </div>
                                    <div class="form-msg"></div>
                                </div>
                            </div>
                        </div>

                        <div class="body-item w-50">

                            <div class="form-group w-100">
                                <div class="form-wrapper">
                                    <label for="userName">Tài khoản</label>
                                    <div class="form-body">
                                        <input readonly type="text" class="form-control" id="userName" name="UserName"
                                          value="<?=$user['userName'] ?>"  rules="required" placeholder="userName" />
                                    </div>
                                    <div class="form-msg"></div>
                                </div>
                            </div>

                            <div class="form-group w-100">
                                <div class="form-wrapper">
                                    <label for="">Số điện thoại</label>
                                    <div class="form-body">
                                        <input type="text" value="<?=$user['phone'] ?>" class="form-control" name="phone" rules="required"
                                            placeholder="Phone Number" />
                                    </div>
                                    <div class="form-msg"></div>
                                </div>
                            </div>

                            <div class="form-group w-100">
                                <div class="form-wrapper">
                                    <label for="userName">Họ tên</label>
                                    <div class="form-body">
                                        <input type="text" value="<?=$user['fullName'] ?>" class="form-control" name="fullName" rules="required"
                                            placeholder="FullName" />
                                    </div>
                                    <div class="form-msg"></div>
                                </div>
                            </div>

                            <div class="form-group w-100">
                                <div class="form-wrapper">
                                    <label for="userName">Email</label>
                                    <div class="form-body">
                                        <input type="text" class="form-control" value="<?=$user['email'] ?>" name="email" rules="required"
                                            placeholder="Email" />
                                    </div>
                                    <div class="form-msg"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="btn-body w-100">
                        <button type="reset" class="btn">Hủy</button>
                        <button type="submit" class="btn btn-submit">Lưu</button>
                    </div>
                </form>

            <?php }
            ?>
        </div>
    </div>
</div>

</div>
</div>