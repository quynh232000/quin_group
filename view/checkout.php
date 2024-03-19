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
        <!-- show prodduct -->
        <div class="cart-body">
            <div class="cart-nav">
                <div class="cart-item">
                    <div class="cart-info">
                        <div class="cart-checkbox">
                            <!-- <input checked type="checkbox"> -->
                        </div>
                        <div class="cart-title">Tất cả (
                            <?= $cartcheckout->status ? count($cartcheckout->result) : 0 ?> Sản phẩm)
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
                    <!-- <div class="cart-action">
                        <div class="cart-title"><i class="fa-solid fa-trash-can"></i></div>
                    </div> -->
                </div>
            </div>
            <div class="cart-list-shop">
                <!-- shop  -->
                <div class="cart-group">
                   
                    <div class="cart-product">
                        <?php
                        if ($cartcheckout->status && count($cartcheckout->result) > 0) {
                            foreach ($cartcheckout->result as $key => $value) { 
                                ?>
                                <div class="cart-item" idpro="<?=$value['productId'] ?>" checkpro="<?=$value['origin']; ?>" countpro = "<?=$value['count'] ?>" pricepro="<?=$value['price'] ?>">
                                    <div class="cart-info">
                                        
                                        <div class="cart-item-pro">
                                            <div class="cart-item-img">
                                                <img src="./assest/upload/<?=$value['image'] ?>"
                                                    alt="">
                                            </div>
                                            <div class="cart-info-right">
                                                <div class="cart-item-name">
                                                <?=$value['namePro']; ?>
                                                </div>
                                                <div class="cart-item-note">
                                                <?=$value['brand']; ?> - <?=$value['origin']; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="cart-price">
                                        <div class="cart-item-price fm-price"><?=$value['price'];?> </div>
                                    </div>
                                    <div class="cart-quantity">

                                        <div class="cart-item-count">
                                            <input type="text" class="cart-count-input" readonly value="<?=$value['count']?>" disabled>
                                        </div>
                                    </div>
                                    <div class="cart-subtotal">
                                        <div class="cart-item-subtotal cart-subtotal1 fm-price" data-subtotal="<?=($value['price']*$value['count']) ?>"><?=($value['price']*$value['count']) ?></div>
                                    </div>
                                    <!-- <div class="cart-action">
                                        <div class="cart-item-action-icon">
                                            <i class="fa-regular fa-heart"></i>
                                        </div>
                                        <div class="cart-item-action-icon cart-btn-action" type-btn="delete">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </div>
                                    </div> -->
                                </div>
                            <?php }
                        } else {
                            echo '<div class="no-product-cart">Bạn không có sản phẩm nào trong giỏ hàng</div>';
                        };
                        ?>
                    </div>
                </div>
               
            </div>
           

        </div>
        <!-- show prodduct -->
        <form method="POST" class="checkout-body">

            <div class="checkout-left">
                <div class="checkout-info-address">
                    <div class="input-box">
                        <div class="checkout-title">
                            <i class="fa-solid fa-user"></i> Người nhận
                        </div>
                        <div class="checkout-group">
                            <input class="checkout-input" value="<?php echo isset($userInfo) ? $userInfo['nameReceiver']:"" ?>" required placeholder="Aa.." name="nameReceiver">
                        </div>
                    </div>
                    <div class="input-box">
                        <div class="checkout-title">
                            <i class="fa-solid fa-city"></i> Thành phố
                        </div>
                        <div class="checkout-group">
                            <input class="checkout-input" value="<?php echo isset($userInfo) ? $userInfo['city']:"" ?>" required placeholder="Aa..." name="city">
                        </div>
                    </div>
                    <div class="input-box">
                        <div class="checkout-title">
                            <i class="fa-solid fa-user"></i>Huyện
                        </div>
                        <div class="checkout-group">
                            <input class="checkout-input" value="<?php echo isset($userInfo) ? $userInfo['province']:"" ?>" required placeholder="Aa..." name="province">
                        </div>
                    </div>
                    <div class="input-box">
                        <div class="checkout-title">
                            <i class="fa-solid fa-road"></i>Địa chỉ chi tiết
                        </div>
                        <div class="checkout-group">
                            <input class="checkout-input" value="<?php echo isset($userInfo) ? $userInfo['addressDetail']:"" ?>" required placeholder="Aa..." name="addressDetail">
                        </div>
                    </div>
                    

                    <div class="checkout-group input-box">
                        <div class="checkout-title mt-2">
                            <i class="fa-solid fa-phone"></i> Số điện thoại
                        </div>
                        <input class="checkout-input" value="<?php echo isset($userInfo) ? $userInfo['phone']:Session::get("phone") ?>"  required placeholder="+84-..." name="phone">
                    </div>
                    
                </div>



                <div class="input-box">
                    <div class="checkout-title mt-2">
                        <i class="fa-solid fa-file-lines"></i>Ghi chú
                    </div>
                    <div class="checkout-group">
                        <textarea class="checkout-input"  placeholder="Thêm ghi chú..." rows="5" name="note"></textarea>
                    </div>
                </div>
            </div>



            <div class="checkout-right">

                <div class="checkout-title">
                    <i class="fa-solid fa-money-check-dollar"></i>Tổng cộng
                </div>
                <div class="cart-total-item">
                    <div class="cart-total-text">
                        Tạm tính
                    </div>
                    <div class="cart-total-price fm-price">
                    <?= ($getCartInfo->result['totalPrice']) ?>
                </div>
            </div>
            <input type="text" hidden value="<?= ($getCartInfo->result['totalPrice']) ?>" name="subTotal" placeholder="okoko">
                <div class="cart-total-item">
                    <div class="cart-total-text">
                        Phí vận chuyển
                        <input type="text" hidden value="30000" name="fee"  >
                    </div>
                    <div class="cart-total-ship cart-total-price">
                        30,000đ
                    </div>
                </div>

                <div class="cart-total-item cart-total-item--final">
                    <div class="cart-total-final">
                        Tổng thanh toán
                    </div>
                    <div class="cart-total-final-price price cart-total-price fm-price">
                    <?= ($getCartInfo->result['totalPrice'])+ 30000 ?>
                    
                </div>
            </div>
            <input type="text" hidden  value=" <?= ($getCartInfo->result['totalPrice'])+ 30000 ?>" name="total" placeholder="okoko">
                <div class="checkout-btn-wrapper">
                    <button type="submit" class="checkout-btn">
                        Đặt hàng
                    </button>
                </div>
            </div>
        </form>


        <div class="more-info">
            <div class="more-info-item">
                <div class="more-infor-wrapper">
                    <div class="more-info-img"><img src="./assest/images/xe 1.svg" alt=""></div>
                    <div class="more-info-text1">Free Delivery</div>
                    <div class="more-info-text2">Free shipping on all order</div>
                </div>
            </div>
            <div class="more-info-item">
                <div class="more-infor-wrapper">
                    <div class="more-info-img"><img src="./assest/images/save 1.svg" alt=""></div>
                    <div class="more-info-text1">Big Saving Shop</div>
                    <div class="more-info-text2">save Big Every Day</div>
                </div>
            </div>
            <div class="more-info-item">
                <div class="more-infor-wrapper">
                    <div class="more-info-img"><img src="./assest/images/online.svg"></div>
                    <div class="more-info-text1">Online Support 24/7</div>
                    <div class="more-info-text2">Support online 24 hours a day</div>
                </div>
            </div>
            <div class="more-info-item">
                <div class="more-infor-wrapper">
                    <div class="more-info-img"><img src="./assest/images/money.svg" alt=""></div>
                    <div class="more-info-text1">Money Back Return</div>
                    <div class="more-info-text2">Back guarantee under 7 day</div>
                </div>
            </div>
            <div class="more-info-item">
                <div class="more-infor-wrapper">
                    <div class="more-info-img"><img src="./assest/images/member.svg" alt=""></div>
                    <div class="more-info-text1">Member Discount</div>
                    <div class="more-info-text2">Onevery order over $120.000</div>
                </div>
            </div>
        </div>
    </div>
</main>