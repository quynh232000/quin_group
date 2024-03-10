<!-- main -->

<main class="home-main">
    <div class="main-top">
        <div class="banner">
            <div class="wrapper">
                <div class="banner-wrapper">
                    <div class="banner-left">
                        <img src="./assest/images/Banner/B-L.png" alt="">
                    </div>
                    <div class="banner-mid">
                        <div class="swiper  swipper-banner">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide banner-mid-item ">
                                    <img src="https://images.template.net/108414/fashion-sale-banner-template-85svg.jpg"
                                        alt="">
                                </div>
                                <div class="swiper-slide banner-mid-item ">
                                    <img src="https://i.pinimg.com/originals/f0/f5/a6/f0f5a6cc6bff547d2c7d5cbcb00bea85.png"
                                        alt="">
                                </div>
                                <div class="swiper-slide banner-mid-item ">
                                    <img src="./assest/images/Banner/banner1.png" alt="">
                                </div>
                                <div class="swiper-slide banner-mid-item ">
                                    <img src="https://img.freepik.com/premium-psd/shoes-facebook-cover-web-banner-template_220159-157.jpg"
                                        alt="">
                                </div>


                                <div class="swiper-slide banner-mid-item ">
                                    <img src="https://storeassets.im-cdn.com/temp/cuploads/ap-south-1%3Acf28e385-91dc-4140-bf02-095ec64f16a3/www-imagecorel-com/products/1622901351447shoe-sell-banner-flex-board-01.jpg"
                                        alt="">
                                </div>

                            </div>
                            <!-- If we need pagination -->
                            <div class="swiper-pagination"></div>

                            <!-- If we need navigation buttons -->
                            <div class="swiper-button-prev"></div>
                            <div class="swiper-button-next"></div>

                            <!-- If we need scrollbar -->
                            <div class="swiper-scrollbar"></div>
                        </div>
                    </div>

                    <div class="banner-right">
                        <div class="banner-right-img">
                            <img src="./assest/images/Banner/B-R1.png" alt="">
                        </div>
                        <div class="banner-right-img">
                            <img src="./assest/images/Banner/B-R2.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="categories">
            <div class="wrapper ">
                <div class=" categories-wrapper">
                    <?php foreach ($allCategory as $key => $value) { ?>
                        <a href="?mod=page&act=collection&category=<?= $value['id'] ?>" class="cate-item">
                            <div class="cate-item-body">
                                <div class="cate-img">
                                    <img src="assest/upload/<?= $value['icon'] ?>" alt="">
                                </div>
                                <div class="cate-name">
                                    <?= $value['name'] ?>
                                </div>
                                <div class="cate-count">
                                    <?=$value['count'] ?> sản phẩm
                                </div>
                            </div>
                        </a>
                    <?php } ?>
                </div>

            </div>
        </div>

    </div>

    <!-- mega-sale -->
    <div class="mega-sale">
        <div class="mage-sale-top">
            <div class="mega-top-content">
                <div class="mega-top-wrapper">
                    <div class="mega-top-date">
                        <span>02</span>
                        <p>DAYS</p>
                    </div>
                    <div class="mega-top-date">
                        <span class="mega-time" type="hour">12</span>
                        <p>HOUR</p>
                    </div>
                    <div class="mega-top-date">
                        <span class="mega-time" type="minute">12</span>
                        <p>MINUES</p>
                    </div>
                    <div class="mega-top-date">
                        <span class="mega-time" type="second">12</span>
                        <p>SECOND</p>
                    </div>
                  
                </div>
            </div>
        </div>

        <div class="mega-body">
            <div class="mega-content">
                <div class="wrapper">
                    <div class="swiper mega-swipper-products">
                        <!-- Additional required wrapper -->
                        <div class="swiper-wrapper">
                            <!-- Slides -->
                            <?php
                            if (isset($megaPro) && $megaPro->status && is_array($megaPro->result)) {
                                foreach ($megaPro->result as $key => $value) { ?>

                                    <div class="swiper-slide">
                                        <div class="product" id="pro<?= $value['id'] ?>">
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
                                                                <filter id="filter0_d_604_13229" x="-1.00584" y="0"
                                                                    width="49.9635" height="52" filterUnits="userSpaceOnUse"
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
                                                <div idpro="<?= $value['id'] ?>" data-price= "<?= $value['price'] ?>" class="product-btn">
                                                    <i class="fa-solid fa-cart-plus"></i>
                                                    <span>Thêm giỏ hàng</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                <?php }
                            } ?>

                        </div>
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-button-next"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <!-- new product -->
    <div class="new-product">
        <div class="wrapper">
            <div class="new-product-wrapper">
                <div class="new-product-top">
                    <div class="new-product-title">
                        Sản phẩm mới
                    </div>
                    <a href="?mod=page&act=collection" class="new-product-more">
                        Xem thêm
                        <i class="fa-solid fa-chevron-right"></i>
                    </a>
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
                                    <div class="product-btn" idpro="<?= $value['id'] ?>" data-price= "<?= $value['price'] ?>">
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
    <!-- banner sale -->
    <div class="banner2">
        <div class="wrapper">
            <div class="banner2-wrapper">
                <img src="./assest/images/banner affter new.svg" alt="">
            </div>
        </div>

    </div>
    <!-- best selling -->
    <div class="best-selling">
        <div class="best-selling-wrapper">
            <div class="wrapper">
                <div class="best-selling-top">
                    <img src="./assest/images/s3.svg" alt="">
                    <img src="./assest/images/mobile/m-bestselling.png" alt="">
                </div>
                <div class="best-selling-body">
                    <div class="best-selling-list">
                        <?php
                        if (isset($bestPro) && $bestPro->status && is_array($bestPro->result)) {
                            foreach ($bestPro->result as $key => $value) { ?>

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
                                        <div class="product-btn" idpro="<?= $value['id'] ?>" data-price= "<?= $value['price'] ?>">
                                            <i class="fa-solid fa-cart-plus"></i>
                                            <span>Thêm giỏ hàng</span>
                                        </div>
                                    </div>
                                </div>

                            <?php }
                        } ?>

                        <!-- item -->
                        <!-- <div class="product ">
                            <div class="product-wrapper">
                                <a href="?mod=page&act=detail" class="product-info">

                                    <div class="product-img">
                                        <img src="https://images.fpt.shop/unsafe/fit-in/240x215/filters:quality(90):fill(white)/fptshop.com.vn/Uploads/Originals/2023/8/14/638276090577696669_msiI-modern-14-c7m-221vn-r7-7730u-dd.jpg"
                                            alt="">
                                    </div>
                                    <div class="product-brand">
                                        IPHONE
                                    </div>
                                    <div class="product-name">
                                        Stainless Steel Dual Basket ProFry...
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
                                        <div class="product-price-sale">$500</div>
                                        <del class="product-price-old">$700</del>
                                        <div class="product-price-sale-percent">-25%</div>
                                    </div>
                                </a>
                                <div class="product-btn">
                                    <i class="fa-solid fa-cart-plus"></i>
                                    <span>Thêm giỏ hàng</span>
                                </div>
                            </div>
                        </div> -->
                    </div>
                    <div class="best-selling-btn-body">
                        <div class="best-selling-content">
                            <a href="?mod=page&act=collection" class="best-selling-btn">
                                Xem thêm
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- product -suggesetion -->
    <div class="suggestion">
        <div class="wrapper suggestion-wrapper">
            <div class="home-title">Sản phẩm gợi ý</div>
            <div class="suggestion-nav">
                <div class="suggestion-nav-left">
                    <div class="suggestion-nav-item active" cateid = '16'>
                        Laptop
                    </div>
                    <div class="suggestion-nav-item" cateid = '22'>
                        Túi ví nữ
                    </div>
                    <div class="suggestion-nav-item" cateid = '17'>
                        Đồng hồ
                    </div>

                </div>
                <a href="?mod=page&act=collection" class="suggestion-nav-right sg-btn-more" >
                    Xem thêm
                    <i class="fa-solid fa-chevron-right"></i>
                </a>
            </div>
            <div class="suggest-list-products">
                <?php
                if (isset($suggestionPro) && $suggestionPro->status && is_array($suggestionPro->result)) {
                    foreach ($suggestionPro->result as $key => $value) { ?>

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
                                                <filter id="filter0_d_604_13229" x="-1.00584" y="0" width="49.9635" height="52"
                                                    filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                                    <feFlood flood-opacity="0" result="BackgroundImageFix" />
                                                    <feColorMatrix in="SourceAlpha" type="matrix"
                                                        values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha" />
                                                    <feOffset dy="4" />
                                                    <feGaussianBlur stdDeviation="2" />
                                                    <feComposite in2="hardAlpha" operator="out" />
                                                    <feColorMatrix type="matrix"
                                                        values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0" />
                                                    <feBlend mode="normal" in2="BackgroundImageFix"
                                                        result="effect1_dropShadow_604_13229" />
                                                    <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_604_13229"
                                                        result="shape" />
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
                                <div class="product-btn" idpro="<?= $value['id'] ?>" data-price= "<?= $value['price'] ?>">
                                    <i class="fa-solid fa-cart-plus"></i>
                                    <span>Thêm giỏ hàng</span>
                                </div>
                            </div>
                        </div>

                    <?php }
                } ?>


            </div>
            <a href="?mod=page&act=collection" class="sugestion-btn-more">
                <div class="suggestion-btn-more-body ">Xem thêm</div>
            </a>
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
            <!-- news -->
            <div class="news">
                <div class="news-top">
                    <div class="home-title">Lastest News</div>
                    <a href="?mod=page&act=collection" class="suggestion-nav-right">
                        Xem thêm
                        <i class="fa-solid fa-chevron-right"></i>
                    </a>
                </div>
                <div class="news-wrapper">
                    <div class="news-left">
                        <img src="./assest/images/nl.svg" alt="">
                    </div>
                    <div class="news-right">
                        <!-- item -->
                        <div class="news-item">
                            <div class="news-item-img">
                                <img src="./assest/images/n-l1.svg" alt="">
                            </div>
                            <div class="new-item-content">
                                <div class="new-item-text1">
                                    Create Your Free Account
                                </div>
                                <div class="new-item-text2">
                                    You can create a completely free account using either your Gmail or phone number.
                                </div>
                            </div>
                        </div>
                        <!-- item -->
                        <div class="news-item">
                            <div class="news-item-img">
                                <img src="./assest/images/n-r3.svg" alt="">
                            </div>
                            <div class="new-item-content">
                                <div class="new-item-text1">
                                    Create Your Free Account
                                </div>
                                <div class="new-item-text2">
                                    You can create a completely free account using either your Gmail or phone number.
                                </div>
                            </div>
                        </div>
                        <!-- item -->
                        <div class="news-item">
                            <div class="news-item-img">
                                <img src="./assest/images/n-r2.svg" alt="">
                            </div>
                            <div class="new-item-content">
                                <div class="new-item-text1">
                                    Create Your Free Account
                                </div>
                                <div class="new-item-text2">
                                    You can create a completely free account using either your Gmail or phone number.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- bottom -->
    <div class="h_signup">

        <div class="signup-wrapper">
            <div class="sign-up-left">
                <div class="sign-up-left-big">Sign up for Newsletter</div>
                <div class="sign-up-left-small">...and reveive $20 coupon for first shopping and free delivery.</div>
            </div>
            <div class="sign-up-left">
                <div class="bottom-btn-signup">
                    Get Started
                </div>
            </div>
        </div>
    </div>
</main>
<?php
include 'inc/footer.php';
?>