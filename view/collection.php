<!-- main -->
<main class="collection">
    <div class="wrapper">
        <!-- <div class="c-banner">
            <div class="swiper  swipper-banner-collection">
                <div class="swiper-wrapper">
                    <div class="swiper-slide banner-mid-item ">
                        <img src="./assest/images/collections/c-banner.png" alt="">
                    </div>
                    <div class="swiper-slide banner-mid-item " style="height: 100%;">
                        <img src="./assest/images/collections/banner-group3.png" style="height: 100%;" alt="">
                    </div>

                </div>
                <div class="swiper-pagination"></div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            </div>
        </div> -->
        <div class="c-mall">
            <div class="c-mall-top">
                <div class="c-mall-top-title">
                    <?php
                    if (isset($infoCate)) {
                        echo ($infoCate['nameCate']);
                    }else{
                        echo "Tất cả sản phẩm";
                    }
                    ?>
                </div>
                <a href="?mod=page&act=collection" class="suggestion-nav-right">
                    Xem tất cả
                    <i class="fa-solid fa-chevron-right"></i>
                </a>
            </div>
            <!-- <div class="c-mall-body">
                <div class="swiper-collection-brand">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide c-mall-item">
                            <div class="c-mall-item-img">
                                <img src="./assest/images/collections/brand1.png" alt="">
                            </div>
                            <div class="c-mall-item-img">
                                <img src="./assest/images/collections/brand2.png" alt="">
                            </div>
                        </div>
                        <div class="swiper-slide c-mall-item">
                            <div class="c-mall-item-img">
                                <img src="./assest/images/collections/brand1.png" alt="">
                            </div>
                            <div class="c-mall-item-img">
                                <img src="./assest/images/collections/brand2.png" alt="">
                            </div>
                        </div>
                        <div class="swiper-slide c-mall-item">
                            <div class="c-mall-item-img">
                                <img src="./assest/images/collections/brand2.png" alt="">
                            </div>
                            <div class="c-mall-item-img">
                                <img src="./assest/images/collections/brand1.png" alt="">
                            </div>
                        </div>
                        <div class="swiper-slide c-mall-item">
                            <div class="c-mall-item-img">
                                <img src="./assest/images/collections/brand1.png" alt="">
                            </div>
                            <div class="c-mall-item-img">
                                <img src="./assest/images/collections/brand2.png" alt="">
                            </div>
                        </div>
                        <div class="swiper-slide c-mall-item">
                            <div class="c-mall-item-img">
                                <img src="./assest/images/collections/brand2.png" alt="">
                            </div>
                            <div class="c-mall-item-img">
                                <img src="./assest/images/collections/brand1.png" alt="">
                            </div>
                        </div>
                        <div class="swiper-slide c-mall-item">
                            <div class="c-mall-item-img">
                                <img src="./assest/images/collections/brand1.png" alt="">
                            </div>
                            <div class="c-mall-item-img">
                                <img src="./assest/images/collections/brand2.png" alt="">
                            </div>
                        </div>
                        <div class="swiper-slide c-mall-item">
                            <div class="c-mall-item-img">
                                <img src="./assest/images/collections/brand2.png" alt="">
                            </div>
                            <div class="c-mall-item-img">
                                <img src="./assest/images/collections/brand1.png" alt="">
                            </div>
                        </div>

                    </div>

                </div>
            </div> -->
        </div>

        <div class="c-body">
            <div class="g-left">

                <div class="g-left-top">
                    <div class="g-left-top-title">
                        <i class="fa-solid fa-filter"></i>
                        <p>LỌC</p>
                    </div>
                    <div class="g-left-top-body g-left-top-body-checkbox">
                        <div class="g-left-top-item">
                            <span>THEO ĐANH MỤC</span>
                        </div>
                        <?php
                        if (isset($allCategory)) {
                            foreach ($allCategory as $key => $value) { ?>
                                <p>
                                    <a href="?mod=page&act=collection&category=<?= $value['id'] ?>">
                                        <input type="radio" <?= isset($_GET['category']) ? ($_GET['category'] == $value['id'] ? "checked" : "") : "" ?> />
                                        <?= $value['nameCate'] ?> (
                                        <?= $value['count'] ?>)
                                    </a>
                                </p>
                            <?php }
                        }
                        ?>
                    </div>
                </div>

                <div class="g-left-top">

                    <div class="g-left-top-body">
                        <div class="g-left-top-title"></div>
                        <div class="g-left-top-item">
                            <span>THEO GIÁ</span>
                        </div>
                        <div class="g-left-price-body">
                            <input type="text" placeholder="$ Từ" />
                            <p>-</p>
                            <input type="text" placeholder="$ Đến" />
                        </div>

                        <div class="g-left-btn">Áp dụng</div>
                    </div>
                </div>
            </div>
            <div class="g-right">
                <div class="g-nav">
                    <div class="g-nav-left">
                        <div class="c-nav-hhiden">
                            <i class="fa-solid fa-bars"></i>
                        </div>
                        <div class="g-nav-title">Lọc theo</div>
                        <div class="g-nav-item">
                            <span>Phổ biến</span>
                        </div>
                        <div class="g-nav-item">
                            <span>Mới nhất</span>
                        </div>
                        <div class="g-nav-item">
                            <span>Bán chạy</span>
                        </div>

                    </div>
                    <div class="g-nav-right">





                        <!-- <div class="g-nav-page">
                            <span class="g-nav-current">
                                <?= $_GET['page'] ?? '1' ?>
                            </span>
                            <span>/</span>
                            <span class="g-nav-total">
                                <?= ceil($collectionPro->total / 8) ?>
                            </span>
                        </div> -->
                        <div class="g-nav-btn-group">

                            <!-- pagination -->
                            <?php
                            $totalPage = ceil($collectionPro->total / 8);
                            $page = $_GET['page'] ?? 1;
                            $cate = isset($_GET['category'])?"&category=".$_GET['category'] :"";
                            // previous

                            echo '<a href="'.($page>1?"?mod=page&act=collection$cate&page=".($page-1):"#").'" class="g-nav-btn '.($page==1?"disabled":"").'">
                                        <i class="fa-solid fa-angle-left"></i>
                                    </a>';
                            // for number
                            for ($i = 0; $i < $totalPage; $i++) {
                                $active = $page == ($i + 1) ? "active" : "";

                                $link ="?mod=page&act=collection$cate&page=".($i+1);
                                echo '<a href="'.$link.'" class="g-nav-btn ' . $active . '">
                                       ' . ($i + 1) . '
                                    </a>';
                            }
                            // next
                            echo '<a href="'.($page<$totalPage?"?mod=page&act=collection$cate&page=".($page+1):"#").'" class="g-nav-btn '.($page==$totalPage?"disabled":"").'">
                                        <i class="fa-solid fa-angle-right"></i>
                                    </a>';
                            ?>

                        </div>
                    </div>
                </div>
                <!-- list product -->
                <div class="g-list-product">
                    <?php if (isset($collectionPro) && $collectionPro->status && is_array($collectionPro->result) && count($collectionPro->result)>0) {
                        foreach ($collectionPro->result as $key => $value) { ?>

                            <div class="product">
                                <div class="product-wrapper">
                                    <a href="?mod=page&act=detail&id=<?= $value['id'] ?>" class="product-info">
                                        <div class="product-sale-label">
                                            <svg width="48" height="50" viewBox="0 0 48 50" fill="red"
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
                                                <?= $value['price'] * (1 + $value['salePercent'] / 100) ?>
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
                    } else {
                        echo '<div class="no-data">No product found!</div>';
                    } ?>



                </div>
            </div>
        </div>
    </div>
</main>