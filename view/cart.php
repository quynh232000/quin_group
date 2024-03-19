<!-- main -->
<main class="cart">
    <div class="wrapper">
        <div class="detail-tab">
            <a href="#" class="detail-tab-item">
                <span>Trang chủ</span>
                <i class="fa-solid fa-angle-right"></i>
            </a>
            <div class="detail-tab-item detail-tab-item-name">
                <span>Giỏ hàng</span>
            </div>
        </div>
       
        <div class="cart-body">
            <div class="cart-nav">
                <div class="cart-item">
                    <div class="cart-info">
                        <div class="cart-checkbox">
                            <!-- <input checked type="checkbox"> -->
                        </div>
                        <div class="cart-title">Tất cả (
                            <?= $cartResult->status ? count($cartResult->result) : 0 ?> Sản phẩm)
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
                    <div class="cart-action">
                        <div class="cart-title"><i class="fa-solid fa-trash-can"></i></div>
                    </div>
                </div>
            </div>
            <div class="cart-list-shop">
                <!-- shop  -->
                <div class="cart-group">
                    <div class="cart-shop">
                        <div class="cart-checkbox">
                            <!-- <input type="checkbox" checked> -->
                        </div>
                        <div class="cart-shop-info">
                            <div class="cart-shop-img">
                                <img src="./assest/images/logo-no-text.png" alt="">
                            </div>
                            <div class="cart-shop-name">QUIN SHOP</div>
                        </div>
                    </div>
                    <div class="cart-product">
                        <?php
                        if ($cartResult->status && count($cartResult->result) > 0) {
                            foreach ($cartResult->result as $key => $value) { 
                                ?>
                                <div class="cart-item" idpro="<?=$value['productId'] ?>" checkpro="<?=$value['origin']; ?>" countpro = "<?=$value['count'] ?>" pricepro="<?=$value['price'] ?>">
                                    <div class="cart-info">
                                        <div class="cart-checkbox">
                                            <!-- <input type="checkbox "  <?=$value['check']?"checked":"" ?> > -->
                                            <input class="item-cart-checkbox" <?=($value['check']?"checked":"") ?> type="checkbox">
                                        </div>
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
                                            <div class="cart-count-btn cart-btn-action" type-btn="minus"><i class="fa-solid fa-minus"></i></div>
                                            <input type="text" class="cart-count-input" readonly value="<?=$value['count']?>">
                                            <div class="cart-count-btn cart-btn-action" type-btn="plus"><i class="fa-solid fa-plus"></i></div>
                                        </div>
                                    </div>
                                    <div class="cart-subtotal">
                                        <div class="cart-item-subtotal cart-subtotal1 fm-price" data-subtotal="<?=($value['price']*$value['count']) ?>"><?=($value['price']*$value['count']) ?></div>
                                    </div>
                                    <div class="cart-action">
                                        <div class="cart-item-action-icon">
                                            <i class="fa-regular fa-heart"></i>
                                        </div>
                                        <div class="cart-item-action-icon cart-btn-action" type-btn="delete">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </div>
                                    </div>
                                </div>
                            <?php }
                        } else {
                            echo '<div class="no-product-cart">Bạn không có sản phẩm nào trong giỏ hàng</div>';
                        };
                        ?>
                    </div>
                </div>
               
            </div>
            <div class="cart-bottom">
                <div class="cart-bottom-total">
                    <div class="cart-bottom-left">
                        <div class="cart-checkbox">
                            <!-- <input checked type="checkbox"> -->
                        </div>
                        <span>Tổng ( <?= $cartResult->status ? count($cartResult->result) : 0 ?> Sản phẩm)</span>
                    </div>
                    <div class="cart-bottom-right">
                        <div class="cart-bottom-right-title">
                            Tổng tiền:
                        </div>
                        <div class="cart-bottom-right-total fm-price" cart-total=" <?=($getCartInfo->result['totalPrice'])?>">
                        <?=($getCartInfo->result['totalPrice'])?>
                        </div>
                    </div>
                </div>
                <div class="cart-bottom-btn">
                    <!-- <button disabled class="cart-btn cart-btn-add">
                        <i class="fa-solid fa-cart-plus"></i>
                        Cập nhật giỏ hàng
                    </button> -->
                    <a href="?mod=page&act=checkout" class="cart-btn cart-btn-buy">Mua hàng</a>
                </div>
            </div>

        </div>


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