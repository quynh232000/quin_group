<!-- main -->
<main class="checkout">
    <div class="wrapper">

        <div class="detail-tab">
            <a href="./" class="detail-tab-item">
                <span>Trang chủ</span>
                <i class="fa-solid fa-angle-right"></i>
            </a>
            <a href="?mod=page&act=cart" class="detail-tab-item">
                <span>Giỏ hàng</span>
                <i class="fa-solid fa-angle-right"></i>
            </a>
            <div class="detail-tab-item detail-tab-item-name">
                <span>Đặt hàng</span>
            </div>
        </div>
        <div class="checkout_group">
            <div class="checkout_line"></div>
            <div class="checkout_address">
                <div class="c_address-title"><i class="fa-solid fa-location-dot"></i> Địa chỉ nhận hàng</div>
                <div class="c_address-info">
                    <div class="c_address_name">
                        <?= $address_info['name_receiver'] ?> -
                        <?= $address_info['phone_number'] ?>
                    </div>
                    <div class="c_address_content">
                        <div class="c_address_address">
                            <?= $address_info['address_detail'] . ' - ' . $address_info['district'] . ' - ' . $address_info['province'] ?>

                        </div>
                        <div class="c_address_default">Mặc định</div>
                    </div>
                    <a href="?mod=profile&act=address&redirect=true<?= $currentPath ?>" class="c_address_chhange">Thay
                        đổi</a>
                </div>
            </div>
        </div>
        <!-- show prodduct -->
        <div class="checkout_body">
            <div class="checkout_group checkout_list_cart">
                <div class="cart-shop">
                    <div class="cart-checkbox">
                    </div>
                    <div class="cart-shop-info">
                        <div class="cart-shop-img">
                            <img src="./assest/images/logo-no-text.png" alt="">
                        </div>
                        <div class="cart-shop-name">QUIN SHOP</div>
                    </div>
                </div>
                <div class="cart-nav">
                    <div class="cart-item">
                        <div class="cart-info">
                            <div class="cart-checkbox">
                            </div>
                            <div class="cart-title">Tất cả (
                                <?= isset ($products) ? ($products->total['count']) : 0 ?> Sản phẩm)
                            </div>
                        </div>
                        <div class="cart-price">
                            <div class="cart-title">Giá</div>
                        </div>
                        <div class="cart-quantity">
                            <div class="cart-title">Số lượng</div>
                        </div>
                        <div class="cart-subtotal">
                            <div class="cart-title">Tổng tiền</div>
                        </div>
                    </div>
                </div>
                <div class="cart-list-shop">
                    <div class="cart-group">
                        <div class="cart-product">
                            <?php
                            if (isset ($products) && count($products->result) > 0) {
                                foreach ($products->result as $key => $value) { ?>
                                    <div class="cart-item" idpro="" checkpro="">
                                        <div class="cart-info">
                                            <div class="cart-item-pro">
                                                <div class="cart-item-img">
                                                    <img src="./assest/upload/<?= $value['image_cover'] ?>" alt="">
                                                </div>
                                                <div class="cart-info-right">
                                                    <a href="?mod=page&act=detail&product=<?= $value['slug'] ?>"
                                                        class="cart-item-name">
                                                        <?= $value['name'] ?>
                                                    </a>
                                                    <div class="cart-item-note">
                                                        <?= $value['brand'] ?>-
                                                        <?= $value['origin'] ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="cart-price">
                                            <div class="cart-item-price fm-price">
                                                <?= $value['price'] ?>
                                            </div>
                                        </div>
                                        <div class="cart-quantity">

                                            <div class="cart-item-count">
                                                <input type="text" class="cart-count-input" readonly
                                                    value="<?= $value['quantity'] ?>" disabled>
                                            </div>
                                        </div>
                                        <div class="cart-subtotal">
                                            <div class="cart-item-subtotal cart-subtotal1 fm-price">
                                                <?= $value['price'] * $value['quantity'] ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php }

                            } else {
                                echo '<div class="no-product-cart">Bạn không có sản phẩm nào trong giỏ hàng</div>';
                            } ?>

                        </div>
                    </div>
                </div>
            </div>
            <div class="checkout_group checkout_group_total">
                <div class="c_total">
                    <div class="c_total_title">Ghi chú</div>
                    <div class="c_total_content">
                        <textarea class="total_note" name="" id="note_textarea" rows="2"
                            placeholder="Viết ghi chú của bạn"><?= isset ($_POST['note']) ? $_POST['note'] : "" ?></textarea>
                    </div>
                    <script>
                        $("#note_textarea").change(function (e) {
                            $("#checkout_note").val(e.target.value)
                        })

                    </script>
                </div>
                <div class="c_total">
                    <div class="c_total_title">Chọn phương thức thanh toán</div>
                    <div class="c_total_content">
                        <div class="c_payment">
                            <div class="c_payment-title" data_type='cod'>
                                <label for="payment1"
                                    class="payment_method-item <?= (isset ($_GET['vnp_ResponseCode'])) ? "" : "active" ?>">
                                    <img class="c_pament-title_img"
                                        src="https://img.lazcdn.com/g/tps/tfs/TB1ZP8kM1T2gK0jSZFvXXXnFXXa-96-96.png_2200x2200q80.png_.webp"
                                        alt="">
                                    <div class="c_payment-title_name">Thanh toán khi nhận hàng</div>
                                    <input hidden type="radio" id="payment1" name="payment_method" value="COD" checked>
                                </label>
                            </div>
                            <form method="POST" class="c_payment-title" data_type='banking'>
                                <label for="payment2"
                                    class="payment_method-item <?= (isset ($_GET['vnp_ResponseCode'])) ? "active" : "" ?>">
                                    <img class="c_pament-title_img"
                                        src="https://cdn.bio.link/uploads/profile_pictures/2023-08-09/ZCXnagobVPlSSCAOrumGbLsEQI1KPYsq.png"
                                        alt="">
                                    <div class="c_payment-title_name">Thanh toán bằng VNPAY</div>
                                    <input hidden type="radio" id="payment2" name="payment_method" name="Banking">
                                </label>
                                <div
                                    class="c_payment_type  <?= (isset ($_GET['vnp_ResponseCode']) && $_GET['vnp_ResponseCode'] == '00') ? "" : "hidden" ?> ">
                                    <div class="list_bank">
                                        <label for="submit_payment" class="bank_item active">
                                            <input id="bank1" type="radio" hidden name="" value="NCB" checked>
                                            <img src="https://www.saokim.com.vn/wp-content/uploads/2023/01/Bieu-Tuong-Logo-Ngan-Hang-NCB.png"
                                                alt="">
                                        </label>
                                        <label for="submit_payment" class="bank_item">
                                            <input id="bank2" type="radio" hidden name="" value="VISA">
                                            <img src="https://e7.pngegg.com/pngimages/308/426/png-clipart-visa-logo-credit-card-visa-logo-payment-visa-blue-text-thumbnail.png"
                                                alt="">
                                        </label>
                                        <label for="submit_payment" class="bank_item">
                                            <input id="bank3" type="radio" hidden name="" value="MasterCard">
                                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/b/b7/MasterCard_Logo.svg/2560px-MasterCard_Logo.svg.png"
                                                alt="">
                                        </label>
                                        <label for="submit_payment" class="bank_item">
                                            <input id="bank5" type="radio" hidden name="" value="EXIMBANK">
                                            <img src="https://upanh.vector6.com/images/2020/04/24/008-Logo-PNG-FILE-NganHang-Eximbank.jpg"
                                                alt="">
                                        </label>
                                        <input type="text" name="bank_code" value="NCB" hidden id="bank_code">
                                    </div>
                                    <input type="submit" id="submit_payment" name="submit_payment" value="Thanh toán"
                                        hidden>
                                    <?php
                                    if (isset ($_GET['vnp_ResponseCode'])) {
                                        if ($_GET['vnp_ResponseCode'] == '00') {
                                            echo ' <div class="c_payment_success">
                                            <div class="container">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="svg-success"
                                                    viewBox="0 0 24 24">
                                                    <g stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-miterlimit="10">
                                                        <circle class="success-circle-outline" cx="12" cy="12" r="11.5" />
                                                        <circle class="success-circle-fill" cx="12" cy="12" r="11.5" />
                                                        <polyline class="success-tick" points="17,8.5 9.5,15.5 7,13" />
                                                    </g>
                                                </svg>
                                            </div>
                                            <div class="c_payment_success-title">Thanh toán thành công!</div>
                                        </div>';

                                        } else {
                                            echo ' <div class="c_payment_success">
                                            <div class="container">
                                                
                                            </div>
                                            <div class="c_payment_success-title no-product">Thanh toán thất bại!</div>
                                        </div>';
                                        }
                                    }

                                    ?>

                                </div>
                            </form>
                        </div>
                        <script>
                            $("input[name='payment_method']").change(function (e) {
                                $(".payment_method-item").each(function () {
                                    $(this).removeClass("active")
                                })
                                $("input[name='payment_method']").each(function () {
                                    $(this).attr('checked', false)
                                })
                                const type = $(this).closest('.c_payment-title').attr("data_type")
                                $(this).closest(".payment_method-item").addClass("active")
                                if (type == 'banking') {
                                    $(".c_payment_type").removeClass("hidden")
                                    $("#btn_submit_checkout").addClass("disabled")
                                    $("#btn_submit_checkout").attr("disabled", true)
                                } else {
                                    $(".c_payment_type").addClass("hidden")
                                    $("#btn_submit_checkout").removeClass("disabled")
                                    $("#btn_submit_checkout").attr("disabled", false)
                                }
                            })
                            $(".bank_item").click(function () {
                                $(".bank_item").each(function () {
                                    $(this).removeClass("active")
                                    $(this).find("input[type='radio']").attr('checked', false)
                                })
                                $(this).addClass('active')
                                $('#bank_code').val($(this).find("input[type='radio']").val())
                            })
                        </script>
                    </div>
                </div>
                <div class="c_total">
                    <div class="c_total_title">Thông tin đơn hàng</div>
                    <form method="POST" class="c_total_content c_total-end">
                        <div class="c_end">
                            <div class="c_end-left">Tạm tính (
                                <?= isset ($products) ? $products->total['count'] : 0 ?> sản
                                phẩm)
                            </div>
                            <div class="c_end-right fm-price">
                                <?= isset ($products) ? $products->total['total'] : 0 ?>
                            </div>
                        </div>
                        <?php
                        if (isset ($voucher_info) && $voucher_info->status == true) {
                            echo '<div class="c_end">
                                    <div class="c_end-left">Giảm voucher</div>
                                    <div class="c_end-right fm-price">-<div class="fm-price">' . $voucher_info->result['discount_amount'] . '</div></div>
                                </div>';
                        }
                        ?>

                        <div class="c_end">
                            <div class="c_end-left">Phí vận chuyển</div>
                            <?php
                            if (isset ($get_ship) && $get_ship > 0) {
                                echo '<div class="c_end-right " style="display:flex">+<div class="fm-price">' . $get_ship . '</div></div>';
                            } else {
                                echo '<div class="c_end-right">Miễn phí vận chuyển</div>';
                            }
                            ?>
                        </div>
                        <div class="c_end total">
                            <div class="c_end-left">Tổng cộng:</div>
                            <div class="c_end-right fm-price">
                                <?php
                                $total = $products->total['total'] ?? 0;
                                if (isset ($get_ship) && $get_ship > 0) {
                                    $total += $get_ship;
                                }
                                if (isset ($voucher_info) && $voucher_info->status) {
                                    $total -= $voucher_info->result['discount_amount'];
                                }

                                echo $total;
                                ?>
                            </div>
                        </div>
                        <?php if (isset ($_GET['vnp_ResponseCode']) && $_GET['vnp_ResponseCode'] == '00') {
                            echo '<div class="c_end-submit disabled">Đang xử lý</div>';
                            if (isset ($payment_checkcout) && $payment_checkcout->status == false) {

                            } else {
                                echo '<div id="modal_waiting">
                                        <div aria-label="Orange and tan hamster running in a metal wheel" role="img" class="wheel-and-hamster">
                                        <div class="wheel"></div>
                                        <div class="hamster">
                                            <div class="hamster__body">
                                                <div class="hamster__head">
                                                    <div class="hamster__ear"></div>
                                                    <div class="hamster__eye"></div>
                                                    <div class="hamster__nose"></div>
                                                </div>
                                                <div class="hamster__limb hamster__limb--fr"></div>
                                                <div class="hamster__limb hamster__limb--fl"></div>
                                                <div class="hamster__limb hamster__limb--br"></div>
                                                <div class="hamster__limb hamster__limb--bl"></div>
                                                <div class="hamster__tail"></div>
                                            </div>
                                        </div>
                                        <div></div>
                                        </div>
                                        <div class="processing">Đang xử lý</div>
                                </div>';
                            }
                        } else { ?>
                            <input type="text" hidden  value="<?= isset ($_POST['note']) ? $_POST['note'] : "" ?>" name="note"
                                id="checkout_note">
                            <input class="c_end-submit " type="submit" id="btn_submit_checkout" name="btn_submit_checkout"
                                value='Đặt hàng'>
                        <?php } ?>

                    </form>
                </div>
            </div>
        </div>



        <div class="more-info more-info-edit">
            <div class="more-info-item">
                <div class="more-infor-wrapper">
                    <div class="more-info-img"><img src="./assest/images/xe 1.svg" alt=""></div>
                    <div class="more-info-text1">Giao hàng miễn phí</div>
                    <div class="more-info-text2">Miễn phí vận chuyển các tỉnh</div>
                </div>
            </div>
            <div class="more-info-item">
                <div class="more-infor-wrapper">
                    <div class="more-info-img"><img src="./assest/images/save 1.svg" alt=""></div>
                    <div class="more-info-text1">Mua hàng tiết kiệm</div>
                    <div class="more-info-text2">Chương trình Flash Sale mỗi ngày</div>
                </div>
            </div>
            <div class="more-info-item">
                <div class="more-infor-wrapper">
                    <div class="more-info-img"><img src="./assest/images/online.svg"></div>
                    <div class="more-info-text1">Hỗ trợ 24/7</div>
                    <div class="more-info-text2">Hỗ trợ giải đáp thắc mắc 24/7</div>
                </div>
            </div>
            <div class="more-info-item">
                <div class="more-infor-wrapper">
                    <div class="more-info-img"><img src="./assest/images/money.svg" alt=""></div>
                    <div class="more-info-text1">Chính sách hoàn tiền đơn hàng</div>
                    <div class="more-info-text2">Hoàn trả đơn hàng trong 7 ngày</div>
                </div>
            </div>
            <div class="more-info-item">
                <div class="more-infor-wrapper">
                    <div class="more-info-img"><img src="./assest/images/member.svg" alt=""></div>
                    <div class="more-info-text1">Chính sách thành viên</div>
                    <div class="more-info-text2">Deal Sale cho khách hàng thành viên</div>
                </div>
            </div>
        </div>
    </div>
</main>