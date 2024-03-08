<link rel="stylesheet" href="./src/css/shopsettings.css">
<style>
    .s-profile-input input {
        border: none;
    }
</style>
<main class="shop-main">
    <!-- content -->
    <form method="POST" action="<?=$_SERVER['REQUEST_URI']?>" enctype="multipart/form-data" class="shop-profile">
        <div class="shop-title"><span>Cài đặt Shop </span>
            <div class="shop-title-small">
                Xem trạng thái và cập nhật thông tin Shop
            </div>
        </div>
        <div class="s-profile-top">
            <div class="s-profile-img">

                <!-- <img style="margin-left:10px" src="https://rewind.com/wp-content/uploads/2021/06/RWD_Why-Is-My-Shopify-Store-Not-Working_Blog_v1_Header.png" -->
                <img style="margin-left:10px" src="./assest/upload/<?= $shop_info->result['icon'] ?? '' ?>" alt=""
                    id="imagePreview">
            </div>
            <input type="file" hidden id="img-shop" name="icon">
            <label class="s-profile-img-upload" for="img-shop">
                <i class="fa-regular fa-pen-to-square"></i>
                <span>Đăng hình</span>
            </label>
            <script>
                const imageInput = document.getElementById('img-shop');
                const imagePreview = document.getElementById('imagePreview');

                imageInput.addEventListener('change', function () {
                    const file = this.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function (e) {
                            imagePreview.src = e.target.result;
                        }
                        reader.readAsDataURL(file);
                    }
                });
            </script>
        </div>
        <div class="s-profile-content" style="margin-top:20px">
            <div class="s-profile-group">
                <div class="s-profile-label">Trạng thái</div>

                <?php
                if (($shop_info->result['phone_number'] == '') || ($shop_info->result['address'] == '') || ($shop_info->result['name'] == '')) {
                    echo '<div class="s-profile-input s-profile-input-status" style="border:none;color:red;">
                    <span><i class="fa-solid fa-ban" style="color:red;padding-right:6px"></i> Bạn chưa đạt yêu cầu trở thành nhà bán hàng</span>
                </div>';
                } else {
                    echo '<div class="s-profile-input s-profile-input-status" style="border:none;color:green;">
                    <span><i class="fa-solid fa-circle-check" style="color:green;padding-right:6px"></i> Đang hoạt động</span>
                </div>';
                }
                ?>

            </div>
            <div class="s-profile-group">
                <div class="s-profile-label">Tên shop</div>
                <div class="s-profile-input">
                    <input type="text" placeholder="Aa..." name="name" value="<?= $shop_info->result['name'] ?? '' ?>">
                </div>
            </div>
            <div class="s-profile-group">
                <div class="s-profile-label">Số điện thoại</div>
                <div class="s-profile-input">
                    <input type="text" placeholder="+84..." name="phone_number"
                        value="<?= $shop_info->result['phone_number'] ?? '' ?>">
                </div>
            </div>
            <div class="s-profile-group">
                <div class="s-profile-label" >Địa chỉ</div>
                <div class="s-profile-input">
                    <input type="text" placeholder="Aa..." name="address" value="<?= $shop_info->result['address'] ?? '' ?>">
                </div>
            </div>


            <div class="s-profile-group s-profile-group-btn">
                <div class="s-profile-label"></div>
                <button type="submit" class="s-profile-btn">
                    Cập nhật
                </button>
            </div>

        </div>
    </form>
</main>

</div>
</div>