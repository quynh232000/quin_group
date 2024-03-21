<link rel="stylesheet" href="../src/css/shop.css">
<script src="https://cdn.tailwindcss.com"></script>
<!-- main -->
<main class="collection">
    <div class="wrapper">
        <!-- shop info -->
        <div class="shop">
            <div class="shop-top">
                <div class="shop-group-info">
                    <div class="shop-info">
                        <div class="shop-body">
                            <div class="shop-info-left">
                                <div class="shop-img">
                                    <img src="./assest/upload/<?= $shop_info['icon'] ?>" alt="">
                                </div>
                                <div class="shop-name1"><?= $shop_info['name'] ?></div>
                            </div>
                            <div class="shop-info-right">
                                <div class="shop-name"><?= $shop_info['name'] ?></div>
                                <!-- <div class="shop-online">Online 4 minutes</div> -->
                            </div>
                        </div>
                        <div class="shop-info-btn-wrapper">
                            <div class="shop-btn" id="shop_follow_id">
                                <?php
                                if ($shop->check_follow_shop($shop_info['uuid'])) {
                                    echo '<div onclick="follow_shop(' . "'" . $shop_info['uuid'] . "'" . ', ' . "'unfollow'" . ')">
                                    <i class="fa-solid fa-minus"></i>
                                    Bỏ theo dõi
                                    </div>';
                                } else {
                                    echo '<div onclick="follow_shop(' . "'" . $shop_info['uuid'] . "'" . ', ' . "'follow'" . ')">
                                    <i class="fa-solid fa-plus"></i>
                                    Theo dõi
                                    </div>';
                                }

                                ?>

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
                        <div class="shop-item-title">Số mặt hàng:</div>
                        <div class="shop-item-info"><?= $shop_product_count ?></div>
                    </div>
                    <div class="shop-item">
                        <i class="fa-solid fa-people-arrows"></i>
                        <div class="shop-item-title">Người theo dõi:</div>
                        <div class="shop-item-info" id="count_followers"><?= $shop_followers ?></div>
                    </div>
                </div>
                <div class="shop-group">

                    <div class="shop-item">
                        <i style="color:gray" class="fa-regular fa-star"></i>
                        <div class="shop-item-title">Đánh giá:</div>
                        <div class="shop-item-info"><?= $shop_rating['stars'] ?> (<?= $shop_rating['votes'] ?> lượt đánh giá)</div>
                    </div>
                    <div class="shop-item">
                        <i class="fa-solid fa-user-check"></i>
                        <div class="shop-item-title">Đã đăng ký bán hàng:</div>
                        <div class="shop-item-info"><?= $tool->diffForHumans($shop_info['created_at']) ?></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="shop-voucher">
            <div class="shop-voucher-title">SHOP VOUCHERS</div>
            <div class="shop-voucher-body">
                <?php
                $html_voucher = "";
                foreach ($shop_voucher as $voucher) {
                    $voucher_label = $voucher['label'];
                    $voucher_discount_amount = ($voucher['discount_amount']) / 1000;
                    $voucher_minimum_price = ($voucher['minimum_price']) / 1000;
                    $voucher_check = $shop->check_voucher_user($voucher['id']);
                    $voucher_id = $voucher['id'];
                    if ($voucher_check->status) {
                        if ($voucher_check->result['is_used']) {
                            $message = '<div class="shop-voucher-btn">Đã sử dụng</div>';
                        } else {
                            $message = '<div class="shop-voucher-btn">Đã lưu</div>';
                        }
                    } else {
                        $message = "<div class='shop-voucher-btn ' id='' onclick='save_voucher(this,$voucher_id)'>Lưu</div>";
                    }
                    $voucher_date_end = $voucher['date_end'];
                    $html_voucher = <<<EOT
                    <div class="shop-voucher-item">
                    <div class="shop-voucher-wrapper">
                        <div class="shop-voucher-boder">
                            <div class="shop-voucher-left">
                                <div class="shop-voucher-text1">$voucher_label</div> 
                                <div class="shop-voucher-text2">Đơn tối thiểu $voucher_minimum_price k</div>
                                <div class="shop-voucher-text3">Giảm tối đa $voucher_discount_amount k</div>
                                <div class="shop-voucher-text4">HSD: $voucher_date_end</div>
                            </div>
                            <div class="shop-voucher-right">
                                $message
                            </div>
                        </div>
                    </div>
                    </div>
                    EOT;
                    echo $html_voucher;
                }
                ?>


            </div>
        </div>
        <div class="recommend-product">
            <div class="new-product">
                <div class="wrapper">
                    <div class="new-product-wrapper">
                        <div class="new-product-top">
                            <div class="new-product-title">
                                SẢN PHẨM BÁN CHẠY
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
                            <!-- item -->
                            <?php
                            // $shop->test($shop_products);
                            // brand, name, stars, votes, price, percent_sale
                            // $shop_rating['stars'], $shop_rating['votes']
                            foreach ($shop_products as $product) {
                                $brand = $product['brand'];
                                $slug = $product['slug'];
                                // $name = substr($product['name'], 0, 50);
                                $name = $product['name'];
                                $img = $product['image_cover'];
                                $rating = $shop->get_rating_product($shop_info['id'], $product['id']);
                                $stars = $rating['stars'];
                                $html_stars = str_repeat('<i class="fa-solid fa-star"></i>', ceil($stars));
                                $html_no_stars = str_repeat('<i style="color:gray" class="fa-regular fa-star"></i>', 5);
                                $html_render_stars = $stars ? $html_stars : $html_no_stars;
                                // $shop->test($html_stars);
                                $votes = $rating['votes'] ? "(" . $rating['votes'] . ")" : "";
                                $price = $product['price'];
                                $percent_sale = $product['percent_sale'];
                                $price_sale = $price * (100 - $percent_sale) / 100;
                                $price_format = number_format((float)$price, 0, ',', '.');
                                $price_sale_format = number_format((float)$price_sale, 0, ',', '.');
                                // $shop->test($price_format);

                                $html_product = <<<EOT
                                <div class="product ">
                                    <div class="product-wrapper">
                                        <a href="?mod=page&act=detail&product=$slug" class="product-info">
                                            <div class="product-sale-label">
                                            <svg width="48" height="50" viewBox="0 0 48 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <g filter="url(#filter0_d_604_13229)">
                                                    <path d="M4.49011 0C3.66365 0 2.99416 0.677946 2.99416 1.51484V11.0288V26.9329C2.99416 30.7346 5.01545 34.2444 8.28604 36.116L20.4106 43.0512C22.6241 44.3163 25.3277 44.3163 27.5412 43.0512L39.6658 36.116C42.9363 34.2444 44.9576 30.7346 44.9576 26.9329V11.0288V1.51484C44.9576 0.677946 44.2882 0 43.4617 0H4.49011Z" fill="#F5C144"></path>
                                                </g>
                                                <defs>
                                                    <filter id="filter0_d_604_13229" x="-1.00584" y="0" width="49.9635" height="52" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                                        <feFlood flood-opacity="0" result="BackgroundImageFix"></feFlood>
                                                        <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha"></feColorMatrix>
                                                        <feOffset dy="4"></feOffset>
                                                        <feGaussianBlur stdDeviation="2"></feGaussianBlur>
                                                        <feComposite in2="hardAlpha" operator="out"></feComposite>
                                                        <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0"></feColorMatrix>
                                                        <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_604_13229"></feBlend>
                                                        <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_604_13229" result="shape"></feBlend>
                                                    </filter>
                                                </defs>
                                            </svg>
                                            <span>-%$percent_sale</span>
                                        </div>
    
                                            <div class="product-img">
                                                <img src="./assest/upload/$img" alt="Ảnh về $name">
                                            </div>
                                            <div class="product-brand">
                                                $brand
                                            </div>
                                            <div class="product-name">
                                                $name
                                            </div>
                                            <div class="product-stars">
                                                $html_render_stars
                                                <span>$votes</span>
                                            </div>
                                            <div class="product-price">
                                                <div class="product-price-sale">đ$price_sale_format</div>
                                                <del class="product-price-old">đ$price_format</del>
                                            </div>
                                        </a>
                                        <div class="product-btn">
                                            <i class="fa-solid fa-cart-plus"></i>
                                            <span>Thêm giỏ hàng</span>
                                        </div>
                                    </div>
                                </div>
                                EOT;
                                echo $html_product;
                            }
                            ?>
                            <!-- item -->

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="c-banner">
            <div class="swiper  swipper-banner-collection">
                <div class="swiper-wrapper">
                    <div class="swiper-slide banner-mid-item ">
                        <img src="./assest/images/collections/c-banner.png" alt="">
                    </div>
                    <div class="swiper-slide banner-mid-item " style="height: 100%;">
                        <img src="./assest/images/collections/banner-group3.png" style="height: 100%;" alt="">
                    </div>

                </div>
                <!-- If we need pagination -->
                <div class="swiper-pagination"></div>

                <!-- If we need navigation buttons -->
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>

                <!-- If we need scrollbar -->
                <!-- <div class="swiper-scrollbar"></div> -->
            </div>
        </div>
        <!-- best seling -->
        <div class="shop-best-sale-product">
            <div class="wrapper">
                <div class="shop-product-wrapper">
                    <div class="new-product-top">
                        <div class="new-product-title">
                            SẢN PHẨM GIÁ SỐC
                        </div>
                        <a href="?mod=page&act=collection" class="new-product-more">
                            Xem thêm
                            <i class="fa-solid fa-chevron-right"></i>
                        </a>
                    </div>
                    <div class="shop-best-seling-body">
                        <!-- item -->
                        <?php
                        // $shop->test($shop_products);
                        // brand, name, stars, votes, price, percent_sale
                        // $shop_rating['stars'], $shop_rating['votes']
                        foreach ($shop_sale_products as $product) {
                            $slug = $product['slug'];
                            $brand = $product['brand'];
                            // $name = substr($product['name'], 0, 50);
                            $name = $product['name'];
                            $img = $product['image_cover'];
                            $rating = $shop->get_rating_product($shop_info['id'], $product['id']);
                            $stars = $rating['stars'];
                            $html_stars = str_repeat('<i class="fa-solid fa-star"></i>', ceil($stars));
                            $html_no_stars = str_repeat('<i style="color:gray" class="fa-regular fa-star"></i>', 5);
                            $html_render_stars = $stars ? $html_stars : $html_no_stars;
                            // $shop->test($html_stars);
                            $votes = $rating['votes'] ? "(" . $rating['votes'] . ")" : "";
                            /* <?= $stars ? $html_stars : $html_no_stars ?> */
                            $price = $product['price'];
                            $percent_sale = $product['percent_sale'];
                            $price_sale = $price * (100 - $percent_sale) / 100;
                            $price_format = number_format((float)$price, 0, ',', '.');
                            $price_sale_format = number_format((float)$price_sale, 0, ',', '.');

                            $html_product = <<<EOT
                                <div class="product ">
                                    <div class="product-wrapper">
                                        <a href="?mod=page&act=detail&product=$slug" class="product-info">
                                            <div class="product-sale-label">
                                            <svg width="48" height="50" viewBox="0 0 48 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <g filter="url(#filter0_d_604_13229)">
                                                    <path d="M4.49011 0C3.66365 0 2.99416 0.677946 2.99416 1.51484V11.0288V26.9329C2.99416 30.7346 5.01545 34.2444 8.28604 36.116L20.4106 43.0512C22.6241 44.3163 25.3277 44.3163 27.5412 43.0512L39.6658 36.116C42.9363 34.2444 44.9576 30.7346 44.9576 26.9329V11.0288V1.51484C44.9576 0.677946 44.2882 0 43.4617 0H4.49011Z" fill="#F5C144"></path>
                                                </g>
                                                <defs>
                                                    <filter id="filter0_d_604_13229" x="-1.00584" y="0" width="49.9635" height="52" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                                        <feFlood flood-opacity="0" result="BackgroundImageFix"></feFlood>
                                                        <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha"></feColorMatrix>
                                                        <feOffset dy="4"></feOffset>
                                                        <feGaussianBlur stdDeviation="2"></feGaussianBlur>
                                                        <feComposite in2="hardAlpha" operator="out"></feComposite>
                                                        <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0"></feColorMatrix>
                                                        <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_604_13229"></feBlend>
                                                        <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_604_13229" result="shape"></feBlend>
                                                    </filter>
                                                </defs>
                                            </svg>
                                            <span>-%$percent_sale</span>
                                        </div>
                                            <div class="product-img">
                                                <img src="./assest/upload/$img" alt="$name">
                                            </div>
                                            <div class="product-brand">
                                                $brand
                                            </div>
                                            <div class="product-name">
                                                $name
                                            </div>
                                            <div class="product-stars">
                                                $html_render_stars
                                                <span>$votes</span>
                                            </div>
                                            <div class="product-price">
                                                <del class="product-price-old">đ$price_format</del>
                                            </div>
                                            <div class="product-price">
                                                <div class="product-price-sale">đ$price_sale_format</div>
                                            </div>
                                        </a>
                                        <div class="product-btn">
                                            <i class="fa-solid fa-cart-plus"></i>
                                            <span>Thêm giỏ hàng</span>
                                        </div>
                                    </div>
                                </div>
                                EOT;
                            echo $html_product;
                        }
                        ?>
                        <!-- item -->


                    </div>
                </div>
            </div>
        </div>
        <div class="c-body">
            <div class="g-left">
                <div class="g-left-top">
                    <div class="g-left-top-title">
                        <i class="fa-solid fa-bars"></i>
                        <p class="lg lg-allCategory">DANH MỤC</p>
                    </div>
                    <form action="controller/page.php" id="filterCategory" method="get">
                        <?php
                        function showCateMenus($shop_category_menus, $parent_id = 0)
                        {
                            $menu_tmp = [];
                            // --
                            foreach ($shop_category_menus as $category) {
                                if ((int) $category['parent_id'] == (int) $parent_id) {
                                    $menu_tmp[] = $category;
                                }
                            }
                            // --
                            if ($menu_tmp) {
                                echo '<div class="g-left-top-body g-left-top-body-checkbox grid gap-6 mb-6 md:grid-cols-1">';
                                foreach ($menu_tmp as $menu) {
                                    // $... 
                                    $name = $menu['name'];
                                    $id = $menu['category_id'];
                                    // render
                                    $html = <<<EOT
                                <label class="cate_input text-2xl" for="input_cate_$id" id-cate="$id"><input class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800" id="input_cate_$id" type="checkbox" name="category[]" value="$id"/> $name</label>
                                EOT;
                                    echo $html;
                                    // showCateMenus($shop_category_menus, $menu['category_id']);
                                }
                                echo "</div>";
                            }
                        }
                        showCateMenus($shop_category_menus, $parent_id = 0);
                        ?>
                    </form>

                </div>


            </div>
            <div class="g-right">
                <div class="g-nav">
                    <div class="g-nav-left">
                        <div class="c-nav-hhiden">
                            <i class="fa-solid fa-bars"></i>
                        </div>
                        <div class="g-nav-title ">Lọc theo</div>

                        <!-- Sort by price sort  -->
                        <div class=" g-nav-item_down">
                            <button id="dropdownCheckboxButton" onclick="toggleDropdown('#dropdown2')" data-dropdown-toggle="dropdownDefaultCheckbox" class="text-2xl text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg  px-6 py-4 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                                <div class="price_sort">Giá</div><svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                                </svg>
                            </button>

                            <!-- Dropdown menu -->
                            <div id="dropdown2" class="radio dropdown absolute right-0 z-10 hidden w-48 bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700 dark:divide-gray-600">
                                <ul class=" space-y-3 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownCheckboxButton" id="type_radio_1">

                                    <li>
                                        <div class="flex items-center p-2">
                                            <input id="checkbox-item-a" type="radio" name="input_type_2" value="price-asc" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                            <label for="checkbox-item-a" class="ms-2 text-2xl font-medium text-gray-900 dark:text-gray-300">Tăng dần</label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="flex items-center p-2">
                                            <input id="checkbox-item-b" type="radio" name="input_type_2" value="price-desc" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                            <label for="checkbox-item-b" class="ms-2 text-2xl font-medium text-gray-900 dark:text-gray-300">Giảm dần</label>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- Sort by brand  -->
                        <div class=" g-nav-item_down">
                            <button id="dropdownCheckboxButton" onclick="toggleDropdown('#dropdown3')" data-dropdown-toggle="dropdownDefaultCheckbox" class="text-2xl text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg  px-6 py-4 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                                <div class="brand_sort">Thương hiệu</div><svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                                </svg>
                            </button>

                            <!-- Dropdown menu -->
                            <div id="dropdown3" class="radio dropdown absolute right-0 z-10 hidden w-48 bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700 dark:divide-gray-600">
                                <ul class=" space-y-3 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownCheckboxButton" id="type_radio_2">
                                    <?php
                                    foreach ($shop_brands as $key => $brand) {

                                        $brand = $brand['brand'];
                                        $html_brand = <<<EOT
                                        <li>
                                        <div class="flex items-center p-2">
                                            <input id="checkbox-item-$key" type="radio" name="input_type_3" value="$brand" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                            <label for="checkbox-item-$key" class="ms-2 text-2xl font-medium text-gray-900 dark:text-gray-300">$brand</label>
                                        </div>
                                        </li>
                                        EOT;
                                        echo $html_brand;
                                    }

                                    ?>
                                </ul>
                            </div>
                        </div>
                        <!-- Sort by type  -->
                        <div class=" g-nav-item_down">
                            <button id="dropdownCheckboxButton" onclick="toggleDropdown('#dropdown1')" data-dropdown-toggle="dropdownDefaultCheckbox" class="text-2xl text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg  px-6 py-4 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">Sắp xếp: <div class="sort_sort px-2"> Theo loại</div><svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                                </svg>
                            </button>

                            <!-- Dropdown menu -->
                            <div id="dropdown1" class="radio dropdown absolute right-0 z-10 hidden w-48 bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700 dark:divide-gray-600">
                                <ul class=" space-y-3 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownCheckboxButton" id="type_radio_3">
                                    <li>
                                        <div class="flex items-center p-2">
                                            <input id="checkbox-item-c" type="radio" name="input_type_1" value="New" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                            <label for="checkbox-item-c" class="ms-2 text-2xl font-medium text-gray-900 dark:text-gray-300">Mới nhất</label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="flex items-center p-2">
                                            <input id="checkbox-item-d" type="radio" name="input_type_1" value="Flash Sale" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                            <label for="checkbox-item-d" class="ms-2 text-2xl font-medium text-gray-900 dark:text-gray-300">Flash Sale</label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="flex items-center p-2">
                                            <input id="checkbox-item-f" type="radio" name="input_type_1" value="Hot" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                            <label for="checkbox-item-f" class="ms-2 text-2xl font-medium text-gray-900 dark:text-gray-300">Hot</label>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>



                    </div>
                    <div class="g-nav-right">
                        <div class="g-nav-page">
                            <span class="g-nav-current">1</span>
                            <span>/</span>
                            <span class="g-nav-total">9</span>
                        </div>
                        <div class="g-nav-btn-group">
                            <button class="g-nav-btn chevrons_page disabled" type="previous">
                                <i class="fa-solid fa-angle-left"></i>
                            </button>
                            <div class="flex list_number">
                                <?php
                                // $shop->test($shop_products_all->total);
                                for ($i = 0; $i < ceil($shop_products_all->total / 8); $i++) {
                                    $index = $i + 1;
                                    $active = $index == 1 ? 'active' : '';
                                    echo "<div class='g-nav-btn pagination_number $active'  data='$index'>$index</div>";
                                }

                                ?>
                            </div>
                            <button class="g-nav-btn chevrons_page" type="next">
                                <i class="fa-solid fa-angle-right"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <!-- list product -->
                <div class="g-list-product">
                    <!-- item -->
                    <?php
                    if (count($shop_products_all->result) > 0) {
                        foreach ($shop_products_all->result as $product) {
                            $slug = $product['slug'];

                            $brand = $product['brand'];
                            // $name = substr($product['name'], 0, 50);
                            $name = $product['name'];
                            $image_cover = $product['image_cover'];
                            $rating = $shop->get_rating_product($shop_info['id'], $product['id']);
                            $stars = $rating['stars'];
                            $html_stars = str_repeat('<i class="fa-solid fa-star"></i>', ceil($stars));
                            $html_no_stars = str_repeat('<i style="color:gray" class="fa-regular fa-star"></i>', 5);
                            $html_render_stars = $stars ? $html_stars : $html_no_stars;
                            // $shop->test($html_stars);
                            $votes = $rating['votes'] ? "(" . $rating['votes'] . ")" : "";
                            /* <?= $stars ? $html_stars : $html_no_stars ?> */
                            $price = $product['price'];
                            $percent_sale = $product['percent_sale'];
                            $price_sale = $price * (100 - $percent_sale) / 100;
                            $price_format = number_format((float)$price, 0, ',', '.');
                            $price_sale_format = number_format((float)$price_sale, 0, ',', '.');

                            $html_product = <<<EOT
                            <!-- item -->
                                    <div class="product ">
                                    <div class="product-wrapper">
                                        <a href="?mod=page&act=detail&product=$slug" class="product-info">
                                            <div class="product-sale-label">
                                            <svg width="48" height="50" viewBox="0 0 48 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <g filter="url(#filter0_d_604_13229)">
                                                    <path d="M4.49011 0C3.66365 0 2.99416 0.677946 2.99416 1.51484V11.0288V26.9329C2.99416 30.7346 5.01545 34.2444 8.28604 36.116L20.4106 43.0512C22.6241 44.3163 25.3277 44.3163 27.5412 43.0512L39.6658 36.116C42.9363 34.2444 44.9576 30.7346 44.9576 26.9329V11.0288V1.51484C44.9576 0.677946 44.2882 0 43.4617 0H4.49011Z" fill="#F5C144"></path>
                                                </g>
                                                <defs>
                                                    <filter id="filter0_d_604_13229" x="-1.00584" y="0" width="49.9635" height="52" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                                        <feFlood flood-opacity="0" result="BackgroundImageFix"></feFlood>
                                                        <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha"></feColorMatrix>
                                                        <feOffset dy="4"></feOffset>
                                                        <feGaussianBlur stdDeviation="2"></feGaussianBlur>
                                                        <feComposite in2="hardAlpha" operator="out"></feComposite>
                                                        <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0"></feColorMatrix>
                                                        <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_604_13229"></feBlend>
                                                        <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_604_13229" result="shape"></feBlend>
                                                    </filter>
                                                </defs>
                                            </svg>
                                            <span>-%$percent_sale</span>
                                        </div>
                                            <div class="product-img">
                                                <img src="./assest/upload/$image_cover" alt="$name">
                                            </div>
                                            <div class="product-brand">
                                                $brand
                                            </div>
                                            <div class="product-name">
                                                $name
                                            </div>
                                            <div class="product-stars">
                                                $html_render_stars
                                                <span>$votes</span>
                                            </div>
                                            <div class="product-price">
                                                <del class="product-price-old">đ$price_format</del>
                                            </div>
                                            <div class="product-price">
                                                <div class="product-price-sale">đ$price_sale_format</div>
                                            </div>
                                        </a>
                                        <div class="product-btn">
                                            <i class="fa-solid fa-cart-plus"></i>
                                            <span>Thêm giỏ hàng</span>
                                        </div>
                                    </div>
                                </div>
                            <!-- item -->
                        EOT;
                            echo $html_product;
                        }
                    } else {
                        echo "<div>Không có sản phẩm nào!</div>";
                    }
                    ?>
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

<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
<script src="./src/js/main.js" type="module"></script>
<!-- <script src="./src/js/slider.js"></script> -->

</body>

</html>