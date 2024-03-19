<link rel="stylesheet" href="src/css/shop.css">
<link rel="stylesheet" href="src/css/shopreview_detail.css">
<link rel="stylesheet" href="src/css/nhung.css">
<main class="detail">
    <div class="wrapper">
        <!-- info -->
        <div class="detail-body">
            <div class="detail-tab">
                <a href="./" class="detail-tab-item">
                    <span>Home</span>
                    <i class="fa-solid fa-angle-right"></i>
                </a>
                <a href="?mod=page&act=collection&category=<?= $san_pham['product']['nameCategory'] ?>" class="detail-tab-item">
                    <span class="navllink-cate">
                        <?= $san_pham['product']['nameCategory'] ?>
                    </span>
                    <i class="fa-solid fa-angle-right"></i>
                </a>

                <div class="detail-tab-item detail-tab-item-name">
                    <span>
                        <?= $san_pham['product']['name'] ?>
                    </span>
                </div>

            </div>
            <div class="detail-content">
                <div class="detail-left">
                    <div class="detail-img">
                        <div class="detail-img-show">
                            <img src="./assest/upload/<?= $san_pham['product']['image_cover'] ?>" alt="">
                        </div>
                        <div class="detail-list-img">
                            <?php

                            if (count($san_pham['listimage']) > 0) {

                                foreach ($san_pham['listimage'] as $key => $value) {
                                    echo ' <div class="detail-img-item">
                                                <img src="./assest/upload/' . $value['link'] . '"
                                                    alt="">
                                            </div>';
                                }
                                echo ' <div class="detail-img-item">
                                                <img src="./assest/upload/' . $san_pham['product']['image_cover'] . '"
                                                    alt="">
                                            </div>';
                            } else {
                                echo ' <div class="detail-img-item">
                                    <img src="./assest/upload/' . $san_pham['product']['image_cover'] . '"  
                                        alt="">
                                </div>';
                            }

                            ?>

                        </div>
                    </div>
                    <div class="detail-share">
                        <div class="detail-share-title">Chia sẻ: </div>
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
                        <?= $san_pham['product']['name'] ?>
                    </div>
                    <div class="detail-rate">
                        <div class="detail-rate-left">
                            <span><?= round($classProduct->get_star_product($san_pham['product']['id']), 2) ?? 0 ?></span>
                            <div class="detail-rate-star detail-rate-star-edit">
                                <?php
                                $avg_rate = $classProduct->get_star_product($san_pham['product']['id']) ?? 0;
                                for ($i = 0; $i < floor($avg_rate); $i++) {
                                    echo '<i class="fa-solid fa-star"></i>';
                                }
                                if (($avg_rate - floor($avg_rate)) > 0) {
                                    echo '<i class="fa-regular fa-star-half-stroke"></i>';
                                }
                                ?>
                            </div>
                        </div>
                        <div class="detail-rate-right">
                            <span>
                                <?= $san_pham['product']['quantity_sold'] ?>
                            </span>
                            <div>Đã bán</div>
                        </div>
                    </div>
                    <?php
                    if ($san_pham['product']['type'] == 'Flash Sale') { ?>
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
                    <?php  }
                    ?>
                    <div class="detail-price">
                        <del class="detail-price-old fm-price">
                            <?= $san_pham['product']['price'] * (1 + $san_pham['product']['percent_sale'] / 100) ?>
                        </del>
                        <div class="detail-price-current detail-price-current-edit fm-price">
                            <?= $san_pham['product']['price'] ?>
                        </div>
                    </div>
                    <div class="detail-group">
                        <div class="detail-info-title detail-info-title-edit">Giảm giá</div>
                        <div class="detail-info-content">
                            <div class="detail-info-sale">Sale
                                <?= $san_pham['product']['percent_sale'] ?>%
                            </div>
                        </div>
                    </div>
                    <div class="detail-group">
                        <div class="detail-info-title detail-info-title-edit">Số lượng</div>
                        <div class="detail-info-quantity">
                            <div class="detail-amount">
                                <div class="detail-info-quantity-item detail-btn-count" type="minus"><i class="fa-solid fa-minus"></i></div>
                                <input class="detail-info-quantity-item detail-input-quantity" type="text" value="1" readonly />
                                <div class="detail-info-quantity-item detail-btn-count" type="plus"><i class="fa-solid fa-plus"></i></div>
                            </div>
                            <div class="detail-amount-total">
                                <?= $san_pham['product']['quantity'] ?> sản phẩm
                            </div>
                        </div>
                    </div>
                    <div class="detail-btn-body detail-btn-body-edit" style="margin-top:30px">
                        <a href="?mod=page&act=cart" class="detail-btn detail-btn-cart">
                            <i class="fa-solid fa-cart-plus"></i>
                            Thêm vào giỏ hàng
                        </a>
                        <button class=" detail-btn  detail-btn-add detail-btn-buy" idpro="<?= $san_pham['product']['id'] ?>" data-price="<?= $san_pham['product']['price'] ?>">
                            <!-- <i class="fa-solid fa-cart-plus"></i> -->
                            <span>Mua ngay</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- ----Shop---- -->
        <div class="shop detail-shop">
            <div class="shop-top">
                <div class="shop-group-info">
                    <div class="shop-info">
                        <div class="shop-body">
                            <div class="shop-info-left">
                                <div class="shop-img">
                                    <img src="./assest/upload/5EA63482-44B3-40C9-B3A8-1479DB08CCD4.jpg" alt="">
                                </div>
                                <div class="shop-name1">Yêu thích</div>
                            </div>
                            <div class="shop-info-right">
                                <div class="shop-name">Model Shop</div>
                                <div class="shop-online">Online 4 minutes</div>
                            </div>
                        </div>
                        <div class="shop-info-btn-wrapper">
                            <div class="shop-btn">
                                <i class="fa-solid fa-plus"></i>
                                Xem shop
                            </div>
                            <div class="shop-btn">
                                <i class="fa-solid fa-comments"></i>
                                Nhắn tin
                            </div>
                        </div>
                    </div>
                </div>
                <div class="shop-group">
                    <div class="shop-item">
                        <i class="fa-solid fa-box-open"></i>
                        <div class="shop-item-title">Sản phẩm</div>
                        <div class="shop-item-info">33</div>
                    </div>
                    <div class="shop-item">
                        <i class="fa-solid fa-user-plus"></i>
                        <div class="shop-item-title">Đang theo dõi</div>
                        <div class="shop-item-info">33</div>
                    </div>
                </div>
                <div class="shop-group">
                    <div class="shop-item">
                        <i class="fa-regular fa-star"></i>
                        <div class="shop-item-title">Xếp hạng</div>
                        <div class="shop-item-info">4.9</div>
                    </div>
                    <div class="shop-item">
                        <i class="fa-solid fa-user-check"></i>
                        <div class="shop-item-title">Tham gia</div>
                        <div class="shop-item-info">5 năm</div>
                    </div>
                </div>
            </div>
            <div class="shop-item-slogan">
                <div class="shop-item-slogan-info">Cửa hàng chuyên cung cấp các mặt hàng quần áo thời trang, trang sức dành cho các cô gái</div>
            </div>
            <!-- <div class="shop-bottom">
                <div class="shop-bottom-item">
                    Home
                </div>
                <div class="shop-bottom-item">
                    All Products
                </div>
                <div class="shop-bottom-item">
                    Product 1
                </div>
                <div class="shop-bottom-item">
                    Product 2
                </div>
                <div class="shop-bottom-item">
                    Product 3
                </div>
                <div class="shop-bottom-item">
                    Product 4
                </div>
                <div class="shop-bottom-item shop-bottom-seemore">
                    See more
                    <i class="fa-solid fa-angle-right"></i>
                </div>
            </div> -->
        </div>
        <!-- desciption -->
        <div class="detail-wrapper-des">
            <div class="detail-desciption detail-des">
                <div class="detail-desctiption-title">MÔ TẢ CHI TIẾT</div>
                <div class="detail-description-body">
                    <?= $san_pham['product']['description'] ?>
                </div>
                <div class="detail-des-btn-more-wrapper">
                    <div class="detail-des-btn-more">

                        Xem thêm
                    </div>
                </div>
            </div>
        </div>

        <!-- <div class="detail-desciption des-cmt" id="show-list-cmt">
                <div class="detail-desctiption-title">Bình luận</div>
                <div class="detail-cmt-body">
                   <div class="cmt">
                            <form id="form-cmt" class="cmt-input"><textarea name="content" class="cmt-textarea"
                                    placeholder="Nhập nội dung bình luận..."></textarea>
                                <input type="text" name="productId" value="<?= $proInfo['id'] ?>" hidden>
                                <button type="submit" class="cmt-send">Gửi</button>
                            </form>
                            <div class="cmt-total"><strong><?php
                                                            if (isset($listCmt)) {
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
                                            if (Session::get("id") == $value['userId']) { ?>
                                                
                                                <div class="cmt-icon-remove">
                                                    <svg stroke="currentColor" fill="none" stroke-width="2" viewBox="0 0 24 24"
                                                        stroke-linecap="round" stroke-linejoin="round"
                                                        class="DetailProduct_delete-icon__6GgVP" height="1em" width="1em"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <circle cx="12" cy="12" r="1"></circle>
                                                        <circle cx="12" cy="5" r="1"></circle>
                                                        <circle cx="12" cy="19" r="1"></circle>
                                                    </svg>
                                                    <p class="cmt-show-delete" cmt-id="<?= $value['id'] ?>">Xóa</p>
                                                </div>
                                           <?php } ?>
                                        </div>
                                    <?php }
                                }

                                    ?>
                            </div>
                            <div class="cmt-more-wrapper">
                                <?php
                                $page = 2;
                                if (isset($_GET['page']) && $_GET['page']) {
                                    $page = $_GET['page'] + 1;
                                }
                                ?>
                                <a href="?mod=page&act=detail&id=<?= $proInfo['id'] ?>&page=<?= $page ?>#show-list-cmt" class="cmt-view-more">Xem thêm</a>
                            </div>
                        </div> 
                </div>
        </div> -->
        <!-- Review product------->
        <div class="detail-review">
            <div class="detail-review-wrapper">
                <div class="detail-review-overiew">
                    <?php
                    if (isset($is_review) && ($is_review == true)) {


                        foreach ($danhsach_danhgia as $key => $value) {
                            if ($value['user_id'] == Session::get('id')) {
                                $my_review = $value;
                                break;
                            }
                        }

                    ?>
                        <div class="detail-review-user-active">
                            <div class="detail-review-overiew-heading">
                                ĐÁNH GIÁ CỦA BẠN
                            </div>
                            <div class="detail-review-user-active__list">
                                <div class="detail-review-user-active__list-star" id="list_star">
                                    <?php
                                    if (isset($my_review)) {
                                        for ($i = 0; $i < 5; $i++) {
                                            if (($i + 1) <= $my_review['level']) {
                                                echo '<i data-level="' . ($i + 1) . '" class="fa-solid fa-star active"></i>';
                                            } else {
                                                echo '<i data-level="' . ($i + 1) . '" class="fa-solid fa-star"></i>';
                                            }
                                        }
                                    } else {
                                        echo ' <i data-level="1" class="fa-solid fa-star"></i>
                                        <i data-level="2" class="fa-solid fa-star"></i>
                                        <i data-level="3" class="fa-solid fa-star"></i>
                                        <i data-level="4" class="fa-solid fa-star"></i>
                                        <i data-level="5" class="fa-solid fa-star"></i>';
                                    }
                                    ?>

                                </div>
                                <div class="detail-review-user-active__star-quantity"><?= isset($my_review) ? $my_review['level'] : "" ?> <p>sao</p>
                                </div>
                            </div>
                            <form method="post" action="" class="detail-review-user-active__action">
                                <?php
                                if (isset($my_review)) {
                                    echo '<input value="' . $my_review['id'] . '" type="text" name="id_review" hidden="">';
                                }
                                ?>
                                <input id="input_level" type="text" value="<?= isset($my_review) ? $my_review['level'] : "" ?>" name="level" hidden="">
                                <input name="content" type="text" placeholder="Vui lòng đánh giá sản phẩm..." class="detail-review-user-active__input" value="<?= isset($my_review) ? $my_review['content'] : "" ?>"></input>
                                <div class="detail-review-user-active__link">
                                    <input type="submit" class="detail-review-user-active__btn" name="reviewsubmit" value="<?= isset($my_review) ? "Cập nhật đánh giá" : "Gửi đánh giá" ?>"></input>
                                </div>
                            </form>

                        </div>

                </div>
            <?php
                    }
            ?>
            <!-- JAVASCRIP ACTIVE STAR -->
            <script>
                $('#list_star i').click(function() {
                    const level = $(this).attr('data-level');
                    $('#input_level').val(level)
                    $('#list_star i').removeClass('active')
                    for (let index = 1; index <= level; index++) {
                        $("i[data-level='" + index + "']").addClass('active')
                    }
                })
            </script>
            <!-- ============================== -->
            <div class="detail-review-overiew-header">
                <div class="detail-review-overiew-heading">ĐÁNH GIÁ SẢN PHẨM</div>
                <div class="detail-review-overiew-body">
                    <div class="detail-review-overiew-star">
                        <span><?= round($classProduct->get_star_product($san_pham['product']['id']), 2) ?? 0 ?></span>
                        <div class="detail-rate-star">
                            <?php
                            $avg_rate = $classProduct->get_star_product($san_pham['product']['id']) ?? 0;
                            for ($i = 0; $i < floor($avg_rate); $i++) {
                                echo '<i class="fa-solid fa-star"></i>';
                            }
                            if (($avg_rate - floor($avg_rate)) > 0) {
                                echo '<i class="fa-regular fa-star-half-stroke"></i>';
                            }
                            ?>
                        </div>
                        <!-- <span>5.0</span>
                        <div class="detail-review-overiew-list-star">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                        </div> -->
                    </div>
                    <div class="detail-review-overiew-text">
                        <div class="detail-review-overiew-quantity">
                            ( <?= $kq_danhsach_danhgia->total ?> đánh giá )
                        </div>
                        <div class="detail-review-overiew-sold">
                            ( <?= $san_pham['product']['quantity_sold'] ?> đã bán )
                        </div>
                    </div>
                </div>
            </div>

            <!------- REVIEW OF USSER--------------------- -->
            <?php
            if (count($danhsach_danhgia) > 0) {
                foreach ($danhsach_danhgia as $key => $value) {
            ?>
                    <div class="detail-review-user">
                        <div class="detail-review-user__inforeview">
                            <div class="detail-review-user__avatar">
                                <img src="./assest/upload/<?= $value['avatar'] ?>" class="review_user-img" alt="">
                            </div>
                            <div class="detail-review-user__info">
                                <div class="detail-review-user__name"><?= $value['full_name'] ?></div>
                                <div class="detail-review-user__info-day">
                                    <div class="detail-review-user__review-star">
                                        <?php
                                        for ($i = 0; $i < $value['level']; $i++) {
                                            echo '<i class="fa-solid fa-star"></i>';
                                        }
                                        ?>
                                    </div>
                                    <div class="detail-review-user__day">
                                        <?= $classFormat->diffForHumans($value['updated_at']) ?>
                                    </div>
                                    <div class="detail-review-user__area">
                                        <?= $value['address'] ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="detail-review-user__body">
                            <?= $value['content'] ?>
                        </div>
                    </div>
            <?php
                }
            } else {
                echo '<div class="no-review-product">Chưa có đánh giá sản phẩm</div>';
            }
            ?>

            <!-- phân trang -->
            <div class="r-pagination-body pagination-body-edit">
                <div class="r-pagination">
                    <?php $starurl = isset($_GET['star']) ? "&star=" . $_GET['star'] : "" ?>
                    <!-- ==== -->
                    <a href="?mod=page&act=detail&product=<?= $_GET['product'] ?><?= $starurl ?>&page=<?= isset($_GET['page']) ? $_GET['page'] > 1 ? $_GET['page'] - 1 : 1 : 1 ?>#listReviews" class="<?php if (!isset($_GET['page']) || $_GET['page'] == 1)
                                                                                                                                                                                                            echo "disabled"; ?> r-pagination-item previous-page">
                        <i class="fa-solid fa-angles-left"></i>
                    </a>
                    <?php if (isset($kq_danhsach_danhgia) && isset($kq_danhsach_danhgia->status)) {
                        for ($i = 1; $i < ceil($kq_danhsach_danhgia->total / $limit) + 1; $i++) {
                            $active = "";
                            if (isset($_GET['page']) && $_GET['page'] == $i) {
                                $active = "active";
                            } else {
                                if (!isset($_GET['page']) && $i == 1) {
                                    $active = "active";
                                }
                            }
                            echo '<a href="?mod=page&act=detail&product=' . $_GET['product'] . $starurl . '&page=' . $i . '#listReviews" class="r-pagination-item ' . $active . ' ">' . $i . '</a>';
                        }
                    } else {
                        echo "";
                    }
                    ?>
                    <a href="?mod=page&act=detail&product=<?= $_GET['product'] ?><?= $starurl ?>&page=<?php
                                                                                                        if (isset($_GET['page']) && ($_GET['page'] < ceil($kq_danhsach_danhgia->total / $limit))) {
                                                                                                            echo $_GET['page'] + 1;
                                                                                                        } else {
                                                                                                            echo ceil($kq_danhsach_danhgia->total / $limit);
                                                                                                        } ?>#listReviews" class="r-pagination-item next-page <?php
                                                                                                                                                                if (isset($_GET['page']) && (($_GET['page'] == ceil($kq_danhsach_danhgia->total / $limit)))) {
                                                                                                                                                                    echo "disabled";
                                                                                                                                                                }
                                                                                                                                                                ?>"><i class="fa-solid fa-angles-right"></i></a>

                    <!-- === -->

                </div>
            </div>
            </div>
        </div>
    </div>
    <!-- ----Gợi ý sản phẩm--- -->
    <!-- new product -->
    <div class="new-product new-product-edit">
        <div class="wrapper">
            <div class="new-product-wrapper new-product-wrapper-edit">
                <div class="new-product-top new-product-top-edit">
                    <div class="new-product-title new-product-title-edit">
                        Sản phẩm gợi ý
                    </div>
                    <a href="?mod=page&act=collection" class="new-product-more">
                        Xem thêm
                        <i class="fa-solid fa-chevron-right"></i>
                    </a>
                </div>
                <div class="new-product-body">
                    <div class="new-product-big new-product-big-edit">
                        <img src="./assest/images/new pro big.svg" alt="">
                    </div>
                    <?php
                    if (isset($productSuggestion) && $productSuggestion->status && is_array($productSuggestion->result)) {
                        foreach ($productSuggestion->result as $key => $value) { ?>

                            <div class="product">
                                <div class="product-wrapper">
                                    <a href="?mod=page&act=detail&product=<?= $value['slug'] ?>" class="product-info">
                                        <div class="product-sale-label">
                                            <svg width="48" height="50" viewBox="0 0 48 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <g filter="url(#filter0_d_604_13229)">
                                                    <path d="M4.49011 0C3.66365 0 2.99416 0.677946 2.99416 1.51484V11.0288V26.9329C2.99416 30.7346 5.01545 34.2444 8.28604 36.116L20.4106 43.0512C22.6241 44.3163 25.3277 44.3163 27.5412 43.0512L39.6658 36.116C42.9363 34.2444 44.9576 30.7346 44.9576 26.9329V11.0288V1.51484C44.9576 0.677946 44.2882 0 43.4617 0H4.49011Z" fill="#F5C144" />
                                                </g>
                                                <defs>
                                                    <filter id="filter0_d_604_13229" x="-1.00584" y="0" width="49.9635" height="52" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                                        <feFlood flood-opacity="0" result="BackgroundImageFix" />
                                                        <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha" />
                                                        <feOffset dy="4" />
                                                        <feGaussianBlur stdDeviation="2" />
                                                        <feComposite in2="hardAlpha" operator="out" />
                                                        <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0" />
                                                        <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_604_13229" />
                                                        <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_604_13229" result="shape" />
                                                    </filter>
                                                </defs>
                                            </svg>
                                            <span>-%
                                                <?= $value['percent_sale'] ?>
                                            </span>
                                        </div>
                                        <div class="product-img">
                                            <img src="./assest/upload/<?= $value['image_cover'] ?>" alt="">
                                        </div>
                                        <div class="product-brand">
                                            <?= $value['brand'] ?>
                                        </div>
                                        <div class="product-name">
                                            <?= $value['name'] ?>
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
                                                <?= $value['price'] * (1 + $value['percent_sale'] / 100) ?>
                                            </del>
                                        </div>
                                    </a>
                                    <div class="product-btn" idpro="<?= $value['id'] ?>" data-price="<?= $value['price'] ?>">
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
    <!-- kết thúc Gợi ý sản phẩm -->
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