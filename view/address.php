<link rel="stylesheet" href="src/css/custom_profile.css">
<div class="address-main address">

    <div class="pro-b-r-top address-title">
        <p class="pro-title">Địa chỉ của tôi</p>
        <div class="address-add">
            <a href="?mod=profile&act=address&modal=show&type=create" class="btn-add-address"><i
                    class="fa-solid fa-plus" style="margin-right:4px"></i>Thêm địa chỉ mới</a>
        </div>
    </div>
    <div class="pro-b-r-body ">
        <section class=" address-container">
            <!-- Address list -->
            <div class="address-list-container">
                <div class="address-list">

                    <!-- Address list items -->
                    <?php
                    if (count($all_address) > 0) {
                        foreach ($all_address as $key => $value) {
                            if ($value['is_default']) {
                                echo '
                                    <div class="address-item">
                                        <div class="address-info">
                                            <div class="detail-info">
                                                <div class="address_name">' . $value['name_receiver'] . '</div>
                                                <span class=" info-divider">|</span>
                                                <i class="fa-solid fa-phone"></i>
                                                <div class=" addres-phone">' . $value['phone_number'] . '</div>
                                            </div>
                                            <div class="detailed-address">
                                                <p class="address-info-text"><i class="fa-solid fa-location-dot"></i>
                                                ' . $value['address_detail'] . ' - 
                                                ' . $value['district'] . ' - 
                                                ' . $value['province'] . ' 
                                                </p>
                                            </div>
                                        </div>
                                        <div class="action-btn">
                                            <div class="delete-update-btn">
                                                <a href="?mod=profile&act=address&modal=show&type=update&id=' . $value['id'] . '" class="update-btn">Cập nhật</a>
                                            </div>
                                            <button disabled class="address-default-btn active ">Mặc định</button>
                                        </div>
                                    </div>
                                ';
                                break;
                            }
                        }
                        foreach ($all_address as $key => $value) {
                            if ($value['is_default'] == false) {
                                echo '
                                    <div class="address-item">
                                        <div class="address-info">
                                            <div class="detail-info">
                                                <div class="address_name">' . $value['name_receiver'] . '</div>
                                                <span class=" info-divider">|</span>
                                                <i class="fa-solid fa-phone"></i>
                                                <div class=" addres-phone">' . $value['phone_number'] . '</div>
                                            </div>
                                            <div class="detailed-address">
                                                <p class="address-info-text"><i class="fa-solid fa-location-dot"></i>
                                                ' . $value['address_detail'] . ' - 
                                                ' . $value['district'] . ' - 
                                                ' . $value['province'] . ' 
                                                </p>
                                            </div>
                                        </div>
                                        <div class="action-btn">
                                            <div class="delete-update-btn">
                                                <a href="?mod=profile&act=address&modal=show&type=update&id=' . $value['id'] . '" class="update-btn">Cập nhật</a>
                                               
                                            </div>
                                            <a href="?mod=profile&act=address&type=set_default&id=' . $value['id'] . '" class="address-default-btn ">Cài mặc định</a>
                                        </div>
                                    </div>
                                ';
                            }
                        }
                    } else {
                        echo '<div class="no-product">Không có địa chỉ nào!</div>';
                    } ?>

                </div>
            </div>
            <!-- // <a href="?mod=profile&act=address&type=delete&id='.$value['id'].'" class="delete-btn">Xoá</a> -->
            <!-- Add modal -->
            <div id="add-modal" style="display:<?= (isset ($modal) && ($modal == 'show')) ? "flex" : "none" ?>">
                <div class="add-modal-wrapper">
                    <div class="add-modal-body">
                        <div class="address-header">
                            <h1 class="address-tilte">
                                <?= (isset ($type) && ($type == 'create')) ? "Địa chỉ mới" : "Cập nhật địa chỉ" ?>
                            </h1>

                        </div>
                        <div>
                            <form class="update-form form-submit-address" id="form-submit-address" method="POST"
                                action="">
                                <div class="form-input-group">
                                    <label class="form-input-label" for="name">Tên người nhận</label><br>
                                    <input class="form-input" id="name" type="text" name="name_receiver"
                                        value="<?= isset ($address_info) ? $address_info['name_receiver'] : "" ?>"
                                        placeholder="Aa.." required>
                                </div>
                                <div class="form-input-group">
                                    <label class="form-input-label" for="phone_number">Số điện thoại</label><br>
                                    <input class="form-input" id="phone_number" type="text" placeholder="+84 .."
                                        value="<?= isset ($address_info) ? $address_info['phone_number'] : "" ?>"
                                        name="phone_number" required>
                                </div>
                                <div class="form-input-group">
                                    <label class="form-input-label" for="province">Tỉnh</label><br>
                                    <select name="province" id="province" onchange="select_address(this,'district')"
                                        class="form-input list-country" required>
                                        <option value="">--Chọn--</option>
                                        <?php
                                        foreach ($classAddress->get_all_province() as $key => $value) {
                                            echo '<option ' . ($address_info['province'] == $value['matp'] ? "selected" : "") . ' value="' . $value['matp'] . '">' . $value['name'] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-input-group">
                                    <label class="form-input-label" for="district">Quận/ Thành phố</label><br>
                                    <select name="district" id="district" required
                                        onchange="select_address(this,'ward')" class="form-input list-country">
                                        <?php
                                        if (isset($address_info)) {
                                            foreach ($classAddress->get_district($address_info['province']) as $key => $value) {
                                                echo '<option ' . ($address_info['district'] == $value['maqh'] ? "selected" : "") . ' value="' . $value['maqh'] . '">' . $value['name'] . '</option>';
                                            }
                                        } else {
                                            echo '<option value="">--Chọn--</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-input-group">
                                    <label class="form-input-label" for="ward">Phường xã</label><br>
                                    <select name="address_detail" required id="ward" class="form-input list-country">
                                        <?php if (isset($address_info)) {
                                            foreach ($classAddress->get_ward($address_info['district']) as $key => $value) {
                                                echo '<option ' . ($address_info['address_detail'] == $value['xaid'] ? "selected" : "") . ' value="' . $value['xaid'] . '">' . $value['name'] . '</option>';
                                            }
                                        } else {
                                            echo '<option value="">--Chọn--</option>';
                                        } ?>


                                    </select>
                                </div>

                                <div class="addres-set-default">
                                    <input type="text" name="is_default" id="is_default" value="default" hidden>
                                    <input type="checkbox" id="checkbox_default" value="default" checked name="" />
                                    <script>
                                        $('#checkbox_default').change(function (e) {
                                            if (e.target.checked) {
                                                $('#is_default').val('default')
                                            } else {
                                                $('#is_default').val('not_default')
                                            }
                                        })
                                    </script>
                                    <label for="checkbox_default">Sử
                                        dụng làm địa chỉ mặc định</label>
                                </div>
                                <div class="btn-address-wrapper">
                                    <a href="?mod=profile&act=address" class="modal-update-btn back">
                                        Trở lại
                                    </a>
                                    <input class="modal-update-btn submit" name="submit_address" type="submit"
                                        value="Hoàn thành"></input>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


        </section>
    </div>


</div>
<!-- ===== -->
</div>
</div>
</main>