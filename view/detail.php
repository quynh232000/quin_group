<!-- main -->
<?php
if (isset($productInfo)) {
    $proInfo = $productInfo[0];
    $listImg = $productInfo[1];
    ?>

    <main class="detail">
        <div class="wrapper">
            <!-- info -->
            <div class="detail-body">
                <div class="detail-tab">
                    <a href="./" class="detail-tab-item">
                        <span>Home</span>
                        <i class="fa-solid fa-angle-right"></i>
                    </a>
                    <a href="?mod=page&act=collection&category=<?= $proInfo['categoryId'] ?>" class="detail-tab-item">
                        <span class="navllink-cate">
                            <?= $proInfo['nameCategory'] ?>
                        </span>
                        <i class="fa-solid fa-angle-right"></i>
                    </a>

                    <div class="detail-tab-item detail-tab-item-name">
                        <span>
                            <?= $proInfo['namePro'] ?>
                        </span>
                    </div>

                </div>
                <div class="detail-content">
                    <div class="detail-left">
                        <div class="detail-img">
                            <div class="detail-img-show">
                                <img src="./assest/upload/<?= $proInfo['image'] ?>" alt="">
                            </div>
                            <div class="detail-list-img">
                                <?php
                                if (count($listImg) > 0) {

                                    foreach ($listImg as $key => $value) {
                                        echo ' <div class="detail-img-item">
                                                <img src="./assest/upload/' . $value['link'] . '"
                                                    alt="">
                                            </div>';
                                    }
                                    echo ' <div class="detail-img-item">
                                                <img src="./assest/upload/' . $proInfo['image'] . '"
                                                    alt="">
                                            </div>';
                                } else {
                                    echo ' <div class="detail-img-item">
                                    <img src="./assest/upload/' . $proInfo['image'] . '"
                                        alt="">
                                </div>';
                                }

                                ?>

                            </div>
                        </div>
                        <div class="detail-share">
                            <div class="detail-share-title">Share:</div>
                            <a href="#" class="detail-share-item">
                                <i class="fa-brands fa-facebook-f"></i>
                            </a>
                            <a href="#" class="detail-share-item">
                                <i class="fa-brands fa-instagram"></i>
                            </a>
                            <a href="#" class="detail-share-item">
                                <i class="fa-brands fa-twitter"></i>
                            </a>
                            <a href="#" class="detail-share-item">
                                <i class="fa-solid fa-message"></i>
                            </a>
                        </div>
                    </div>
                    <div class="detail-right">
                        <div class="detail-name">
                            <?= $proInfo['namePro'] ?>
                        </div>
                        <div class="detail-rate">
                            <div class="detail-rate-left">
                                <span>5.0</span>
                                <div class="detail-rate-star">
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                </div>
                            </div>
                            <div class="detail-rate-right">
                                <span>
                                    <?= $proInfo['sold'] ?>
                                </span>
                                <div>Đã bán</div>
                            </div>
                        </div>
                        <div class="detail-flash">
                            <div class="detail-flash-left">
                                <span>FLASH</span>
                                <span>SALE</span>
                            </div>
                            <div class="detail-flash-right">
                                <i class="fa-regular fa-clock"></i>
                                <span>Kết thúc trong</span>
                                <div class="detail-flash-time">
                                    <div class="detail-flash-item">00</div>
                                    <div class="detail-flash-item">00</div>
                                    <div class="detail-flash-item">00</div>
                                    <div class="detail-flash-item">00</div>
                                </div>
                            </div>
                        </div>
                        <div class="detail-price">
                            <del class="detail-price-old fm-price">
                                <?= $proInfo['price'] * (1 + $proInfo['salePercent'] / 100) ?>
                            </del>
                            <div class="detail-price-current fm-price">
                                <?= $proInfo['price'] ?>
                            </div>
                            <div class="detail-sale">-
                                <?= $proInfo['salePercent'] ?>%
                            </div>
                        </div>
                        <div class="detail-group">
                            <div class="detail-info-title">Shop giảm giá</div>
                            <div class="detail-info-content">
                                <div class="detail-info-sale">Sale
                                    <?= $proInfo['salePercent'] ?>%
                                </div>
                            </div>
                        </div>
                        <div class="detail-group">
                            <div class="detail-info-title">Vận chuyển</div>
                            <div class="detail-info-content">
                                <div class="detail-deli">
                                    <div class="detail-deli-item">
                                        <div class="detail-deli-wrapper">
                                            <i class="fa-solid fa-truck-moving"></i>
                                            <span>Free Ship</span>
                                        </div>
                                    </div>
                                    <div class="detail-deli-item">
                                        <div class="detail-deli-wrapper">
                                            <i class="fa-solid fa-truck-moving"></i>
                                            <span>Vận chuyển đến</span>
                                            <div class="detail-deli-dropdown">
                                                HCM city
                                                <i class="fa-solid fa-angle-down"></i>
                                                <div class="detail-deli-more">
                                                    <div class="detail-deli-more-item">HN City</div>
                                                    <div class="detail-deli-more-item">HN City</div>
                                                    <div class="detail-deli-more-item">HN City</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="detail-deli">
                                    <div class="detail-deli-item">
                                        <div class="detail-deli-wrapper">
                                            <span>Phí vận chuyển</span>
                                            <div class="detail-deli-dropdown">
                                                0đ
                                                <i class="fa-solid fa-angle-down"></i>
                                                <div class="detail-deli-more">
                                                    <div class="detail-deli-more-item">10đ</div>
                                                    <div class="detail-deli-more-item">5đ</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="detail-group">
                            <div class="detail-info-title">Size</div>
                            <div class="detail-info-size">
                                <div class="detail-info-size-item">Iphone 15</div>
                                <div class="detail-info-size-item">Iphone 15</div>
                                <div class="detail-info-size-item">Iphone 15</div>
                            </div>
                        </div> -->
                        <div class="detail-group">
                            <div class="detail-info-title">Số lượng</div>
                            <div class="detail-info-quantity">
                                <div class="detail-amount">
                                    <div class="detail-info-quantity-item detail-btn-count" type="minus"><i
                                            class="fa-solid fa-minus"></i></div>
                                    <input class="detail-info-quantity-item detail-input-quantity" type="text" value="1"
                                        readonly />
                                    <div class="detail-info-quantity-item detail-btn-count" type="plus"><i
                                            class="fa-solid fa-plus"></i></div>
                                </div>
                                <div class="detail-amount-total">
                                    <?= $proInfo['quantity'] ?> sản phẩm
                                </div>
                            </div>
                        </div>
                        <div class="detail-btn-body" style="margin-top:30px">
                            <a href="?mod=page&act=cart" class="detail-btn detail-btn-cart">Giỏ hàng </a>
                            <button class=" detail-btn  detail-btn-add detail-btn-buy" idpro="<?= $proInfo['id'] ?>"
                                data-price="<?= $proInfo['price'] ?>">
                                <i class="fa-solid fa-cart-plus"></i>
                                <span>Thêm vào giỏ hàng</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- desciption -->
            <div class="detail-wrapper-des">
                <div class="detail-desciption detail-des">
                    <div class="detail-desctiption-title">MÔ TẢ CHI TIẾT</div>
                    <div class="detail-description-body">
                        <?= $proInfo['description'] ?>
                    </div>
                    <div class="detail-des-btn-more-wrapper">
                        <div class="detail-des-btn-more">

                            Xem thêm
                        </div>
                    </div>
                </div>
                <div class="detail-desciption des-cmt" id="show-list-cmt" >
                    <div class="detail-desctiption-title">Bình luận</div>
                    <div class="detail-cmt-body">
                        <!-- cmt -->
                        <div class="cmt">
                            <form id="form-cmt" class="cmt-input"><textarea name="content" class="cmt-textarea"
                                    placeholder="Nhập nội dung bình luận..."></textarea>
                                <input type="text" name="productId" value="<?= $proInfo['id'] ?>" hidden>
                                <button type="submit" class="cmt-send">Gửi</button>
                            </form>
                            <div class="cmt-total"><strong><?php
                                if(isset($listCmt)){
                                    echo $listCmt->result['count'];
                                }
                            ?> hỏi đáp về</strong> “<?= $proInfo['namePro'] ?>”</div>
                            <div class="cmt-list-comment">
                                <?php
                                if (isset($listCmt)) {
                                    foreach ($listCmt->result['data'] as $key => $value) { ?>
                                        <div class="cmt-item"><img class="cmt-user-img"
                                                src="./assest/upload/<?= $value['avatar'] ?>">
                                            <div class="cmt-user-info">
                                                <p class="cmt-user-name">
                                                    <?= $value['fullname'] ?>
                                                </p>
                                                <div class="cmt-user-content">
                                                    <?= $value['content'] ?>
                                                </div>
                                                <div class="cmt-user-time">
                                                    <p>
                                                        <?= explode(" ", $value['createdAt'])[0] ?>
                                                    </p><span>Thích</span><span>Trả lời</span>
                                                </div>
                                            </div>
                                            <?php 
                                                if(Session::get("id") == $value['userId'] ){?>
                                                
                                                <div class="cmt-icon-remove">
                                                    <svg stroke="currentColor" fill="none" stroke-width="2" viewBox="0 0 24 24"
                                                        stroke-linecap="round" stroke-linejoin="round"
                                                        class="DetailProduct_delete-icon__6GgVP" height="1em" width="1em"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <circle cx="12" cy="12" r="1"></circle>
                                                        <circle cx="12" cy="5" r="1"></circle>
                                                        <circle cx="12" cy="19" r="1"></circle>
                                                    </svg>
                                                    <p class="cmt-show-delete" cmt-id="<?=$value['id'] ?>">Xóa</p>
                                                </div>
                                           <?php } ?>
                                        </div>
                                    <?php }
                                }

                                ?>
                            </div>
                            <div class="cmt-more-wrapper">
                                <?php 
                                    $page=2;
                                    if(isset($_GET['page']) && $_GET['page']){
                                        $page = $_GET['page']+1;
                                    }
                                    ?>
                                <a href="?mod=page&act=detail&id=<?=$proInfo['id'] ?>&page=<?=$page ?>#show-list-cmt" class="cmt-view-more">Xem thêm</a>
                            </div>
                        </div>
                        <!-- cmt -->
                    </div>
                </div>
            </div>


            <div class="recommend-product">
                <div class="new-product">
                    <div class="wrapper">
                        <div class="new-product-wrapper">
                            <div class="new-product-top">
                                <div class="new-product-title">
                                    Gợi ý cho bạn
                                </div>
                                <div class="new-product-more">
                                    Xem thêm
                                    <i class="fa-solid fa-chevron-right"></i>
                                </div>
                            </div>
                            <div class="new-product-body">
                                <div class="new-product-big">
                                    <img src="./assest/images/new pro big.svg" alt="">
                                </div>
                                <?php
                                if (isset($newPro) && $newPro->status && is_array($newPro->result)) {
                                    foreach ($newPro->result as $key => $value) { ?>

                                        <div class="product">
                                            <div class="product-wrapper">
                                                <a href="?mod=page&act=detail&id=<?= $value['id'] ?>" class="product-info">
                                                    <div class="product-sale-label">
                                                        <svg width="48" height="50" viewBox="0 0 48 50" fill="none"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <g filter="url(#filter0_d_604_13229)">
                                                                <path
                                                                    d="M4.49011 0C3.66365 0 2.99416 0.677946 2.99416 1.51484V11.0288V26.9329C2.99416 30.7346 5.01545 34.2444 8.28604 36.116L20.4106 43.0512C22.6241 44.3163 25.3277 44.3163 27.5412 43.0512L39.6658 36.116C42.9363 34.2444 44.9576 30.7346 44.9576 26.9329V11.0288V1.51484C44.9576 0.677946 44.2882 0 43.4617 0H4.49011Z"
                                                                    fill="#F5C144" />
                                                            </g>
                                                            <defs>
                                                                <filter id="filter0_d_604_13229" x="-1.00584" y="0" width="49.9635"
                                                                    height="52" filterUnits="userSpaceOnUse"
                                                                    color-interpolation-filters="sRGB">
                                                                    <feFlood flood-opacity="0" result="BackgroundImageFix" />
                                                                    <feColorMatrix in="SourceAlpha" type="matrix"
                                                                        values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0"
                                                                        result="hardAlpha" />
                                                                    <feOffset dy="4" />
                                                                    <feGaussianBlur stdDeviation="2" />
                                                                    <feComposite in2="hardAlpha" operator="out" />
                                                                    <feColorMatrix type="matrix"
                                                                        values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0" />
                                                                    <feBlend mode="normal" in2="BackgroundImageFix"
                                                                        result="effect1_dropShadow_604_13229" />
                                                                    <feBlend mode="normal" in="SourceGraphic"
                                                                        in2="effect1_dropShadow_604_13229" result="shape" />
                                                                </filter>
                                                            </defs>
                                                        </svg>
                                                        <span>-%
                                                            <?= $value['salePercent'] ?>
                                                        </span>
                                                    </div>
                                                    <div class="product-img">
                                                        <img src="./assest/upload/<?= $value['image'] ?>" alt="">
                                                    </div>
                                                    <div class="product-brand">
                                                        <?= $value['brand'] ?>
                                                    </div>
                                                    <div class="product-name">
                                                        <?= $value['namePro'] ?>
                                                    </div>
                                                    <div class="product-stars">
                                                        <i class="fa-solid fa-star"></i>
                                                        <i class="fa-solid fa-star"></i>
                                                        <i class="fa-solid fa-star"></i>
                                                        <i class="fa-solid fa-star"></i>
                                                        <i class="fa-solid fa-star"></i>
                                                        <span>(1.1k)</span>
                                                    </div>
                                                    <div class="product-price">
                                                        <div class="product-price-sale fm-price">
                                                            <?= $value['price'] ?>
                                                        </div>
                                                        <del class="product-price-old fm-price">
                                                            <?= $value['price'] * (1 - $value['salePercent'] / 100) ?>
                                                        </del>
                                                    </div>
                                                </a>
                                                <div class="product-btn" idpro="<?= $value['id'] ?>"
                                                    data-price="<?= $value['price'] ?>">
                                                    <i class="fa-solid fa-cart-plus"></i>
                                                    <span>Thêm giỏ hàng</span>
                                                </div>
                                            </div>
                                        </div>

                                    <?php }
                                } ?>
                            </div>
                        </div>
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

<?php }
?>