<link rel="stylesheet" href="./src/css/shopsettings.css">
<style>
    .s-profile-input input {
        border: none;
    }
</style>
<main class="shop-main">
    <!-- content -->
    <form method="POST" action="<?= $_SERVER['REQUEST_URI'] ?>" enctype="multipart/form-data" class="shop-profile">
        <div class="shop-title"><span>Cài đặt Shop </span>
            <div class="shop-title-small">
                Xem trạng thái và cập nhật thông tin Shop
            </div>
        </div>
        <div class="s-profile-top">
            <div class="s-profile-img">

                <!-- <img style="margin-left:10px" src="https://rewind.com/wp-content/uploads/2021/06/RWD_Why-Is-My-Shopify-Store-Not-Working_Blog_v1_Header.png" -->
                <img style="margin-left:10px" src="./assest/upload/<?= $shop_info->result['icon'] ?? '' ?>" alt="" id="imagePreview">
            </div>
            <input type="file" hidden id="img-shop" name="icon">
            <label class="s-profile-img-upload" for="img-shop">
                <i class="fa-regular fa-pen-to-square"></i>
                <span>Upload</span>
            </label>
            <script>
                const imageInput = document.getElementById('img-shop');
                const imagePreview = document.getElementById('imagePreview');

                imageInput.addEventListener('change', function() {
                    const file = this.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
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
                if (($shop_info->result['phone_number'] == '') || ($shop_info->result['address_detail'] == '') || ($shop_info->result['name'] == '')) {
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
                    <input type="text" placeholder="+84..." name="phone_number" value="<?= $shop_info->result['phone_number'] ?? '' ?>">
                </div>
            </div>
            <div class="s-profile-group">
                <div class="s-profile-label">Tỉnh</div>
                <div class="s-profile-input shop-ship-group">
                    <select name="province" id="province" onchange="select_address(this,'district')">
                        <option value="">--Chọn--</option>
                        <?php
                        foreach ($class_address->get_all_province() as $key => $value) {
                            echo '<option ' . ($shop_info->result['province'] == $value['matp'] ? "selected" : "") . ' value="' . $value['matp'] . '">' . $value['name'] . '</option>';
                        }
                        ?>

                    </select>
                </div>
            </div>
            <div class="s-profile-group">
                <div class="s-profile-label">Quận/Thành phố</div>
                <div class="s-profile-input shop-ship-group">
                    <select name="district" id="district" onchange="select_address(this,'ward')">
                        <?php
                        if ($shop_info->result['district']) {
                            foreach ($class_address->get_district($shop_info->result['province']) as $key => $value) {
                                echo '<option ' . ($shop_info->result['district'] == $value['maqh'] ? "selected" : "") . ' value="' . $value['maqh'] . '">' . $value['name'] . '</option>';
                            }
                        } else {
                            echo '<option value="">--Chọn</option>';
                        }
                        ?>


                    </select>
                </div>
                <!-- <input type="text" placeholder="Aa..." name="address"
                    value="<?= $shop_info->result['address_detail'] ?? '' ?>"> -->
            </div>
            <div class="s-profile-group">
                <div class="s-profile-label">Phường/Xã</div>
                <div class="s-profile-input shop-ship-group">
                    <select name="address_detail" id="ward">
                        <?php if ($shop_info->result['address_detail']) {
                            foreach ($class_address->get_ward($shop_info->result['district']) as $key => $value) {
                                echo '<option ' . ($shop_info->result['address_detail'] == $value['xaid'] ? "selected" : "") . ' value="' . $value['xaid'] . '">' . $value['name'] . '</option>';
                            }
                        } else {
                            echo '<option value="">--Chọn</option>';
                        } ?>


                    </select>
                </div>
            </div>
            <!-- shop shipping setting -->
            <div class="shop-title shop-shipping"><span>Cài đặt phí vận chuyển </span>
                <div class="shop-title-small">
                    Cập nhật phí ship đơn hàng
                </div>
            </div>
            <div class="s-profile-group ">
                <div class="s-profile-label">Kv miền Bắc</div>
                <div class="s-profile-input shop-ship-group">
                    <input type="number" placeholder="..." name="ship_north" value="<?= $shop_ship->result['ship_north'] ?? '' ?>">
                </div>
                VND
                <?php
                if (isset($shop_ship->result['ship_north']) && ($shop_ship->result['ship_north'] == 0)) {
                    echo '<div class="shop-ship-free">Miễn phí vận chuyển</div>';
                }
                ?>
            </div>
            <div class="s-profile-group ">
                <div class="s-profile-label">Kv miền Trung Bắc</div>
                <div class="s-profile-input shop-ship-group">
                    <input type="number" placeholder="..." name="ship_mid_north" value="<?= $shop_ship->result['ship_mid_north'] ?? '' ?>">
                </div>
                VND
                <?php
                if (isset($shop_ship->result['ship_mid_north']) && ($shop_ship->result['ship_mid_north'] == 0)) {
                    echo '<div class="shop-ship-free">Miễn phí vận chuyển</div>';
                }
                ?>
            </div>
            <div class="s-profile-group ">
                <div class="s-profile-label">Kv miền Trung Nam</div>
                <div class="s-profile-input shop-ship-group">
                    <input type="number" placeholder="..." name="ship_mid_south" value="<?= $shop_ship->result['ship_mid_south'] ?? '' ?>">
                </div>
                VND
                <?php
                if (isset($shop_ship->result['ship_mid_south']) && ($shop_ship->result['ship_mid_south'] == 0)) {
                    echo '<div class="shop-ship-free">Miễn phí vận chuyển</div>';
                }
                ?>

            </div>
            <div class="s-profile-group ">
                <div class="s-profile-label">Kv miền Nam</div>
                <div class="s-profile-input shop-ship-group">
                    <input type="number" placeholder="..." name="ship_south" value="<?= $shop_ship->result['ship_south'] ?? '' ?>">
                </div>
                VND
                <?php
                if (isset($shop_ship->result['ship_south']) && ($shop_ship->result['ship_south'] == 0)) {
                    echo '<div class="shop-ship-free">Miễn phí vận chuyển</div>';
                }
                ?>
            </div>



            <div class="s-profile-group s-profile-group-btn ">
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