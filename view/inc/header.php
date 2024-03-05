<?php

if (empty($viewTitle)) {
    $viewTitle = "HOME";
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="./assest/images/logo-no-text.png">
    <title>QUIN-
        <?= $viewTitle ?>
    </title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;600;700&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://code.jquery.com/jquery-2.2.4.min.js"
        integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./src/css/base.css">
    <link rel="stylesheet" href="./src/css/style.css">
    <link rel="stylesheet" href="./src/css/home.css">
    <link rel="stylesheet" href="./src/css/collections.css">
    <link rel="stylesheet" href="./src/css/detail.css">
    <link rel="stylesheet" href="./src/css/cart.css">
    <link rel="stylesheet" href="./src/css/checkout.css">
    <link rel="stylesheet" href="./src/css/profile.css">
    <link rel="stylesheet" href="./src/css/shop.css">
    <link rel="stylesheet" href="./src/css/shopcustom.css">
    <link rel="stylesheet" href="./src/css/shopdashboard.css">
    <link rel="stylesheet" href="./src/css/orderhistory.css">

    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->

    <!-- swiper -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
</head>

<body>
    <div id="toastjs"></div>
    <div class="app">
        <!--header-->
        <header class="header header-no-show">
            <!-- sidebar -->
            <div class="sidebar">
                <div class="sidebar-wrapper">
                    <div class="sidebar-close">
                        <i class="fa-solid fa-xmark"></i>
                        <a href="./" class="sidebar-img">
                            <img src="./assest/images/UNIDI_LOGO-FINAL 2.svg" alt="logo">

                        </a>
                    </div>
                    <div class="sidebar-body">

                        <a href="?mod=profile&act=profile" class="sidebar-item-account">
                            <div class="m-user-img">
                                <img src="<?php echo "./assest/upload/" . Session::get("avatar"); ?>" alt="">
                            </div>
                            <span>Hi,
                                <?php echo Session::get("fullName") ?>
                            </span>

                        </a>

                        <a href="./" class="sidebar-item">
                            <i class="fa-solid fa-house"></i>
                            Trang chủ
                        </a>
                        <a href="?mod=seller&act=dashboard" class="sidebar-item">
                            <i class="fa-solid fa-cart-plus"></i>
                            Quản trị
                        </a>
                        <div class="sidebar-bottom">
                           


                            <a href="?mod=page&act=home&action=logout" class="sidebar-item action">
                                <i class="fa-solid fa-arrow-right-to-bracket"></i>
                                Đăng xuất
                            </a>

                        </div>
                    </div>
                </div>

            </div>
            <!-- sidebar -->
            <div class="header-top">
                <div class="wrapper">
                    <div class="header-top-left">
                        <div class="header-top-item">
                            <div class="header-top-item-title">
                                Ngôn ngữ:
                            </div>
                            <div class="header-top-item-body">
                                <div class="header-top-iem-img">
                                    <img src="./assest/images/vietnam.svg" alt="">
                                </div>
                                <div class="header-top-item-content">Tiếng Việt</div>
                                <div class="header-more">
                                    <div class="header-more-item">
                                        <div class="header-top-iem-img">
                                            <img src="./assest/images/vietnam.svg" alt="">
                                        </div>
                                        <div class="header-top-item-content">Tiếng Việt</div>
                                    </div>
                                    <div class="header-more-item">
                                        <div class="header-top-iem-img">
                                            <img src="./assest/images/vietnam.svg" alt="">
                                        </div>
                                        <div class="header-top-item-content">English</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="m-header-top-space"></div>

                    </div>
                    <div class="m-header-top-menu">
                        <i class="fa-solid fa-gear"></i>
                    </div>
                    <div class="header-top-right">
                        <a href="./" class="header-top-item">
                            <div class="header-top-item-body">
                                <i class="fa-regular fa-bell"></i>


                            </div>
                            <div class="header-top-item-title">
                                Thông báo
                            </div>
                        </a>
                        <a href="?mod=seller&act=dashboard" class="header-top-item">
                            <div class="header-top-item-body">
                                <i class="fa-regular fa-circle-question"></i>

                            </div>
                            <div class="header-top-item-title">
                                Người bán hàng
                            </div>
                        </a>
                        <a href="./shopowner" class="header-top-item">
                            <div class="header-top-item-body">
                                <i class="fa-regular fa-circle-down"></i>
                            </div>
                            <div class="header-top-item-title">
                                Tải xuống
                            </div>
                        </a>



                    </div>

                </div>
            </div>
            <div style="color:black">


            </div>
            <div class="header-body">
                <div class="wrapper">
                    <a href="./" class="header-logo">
                        <img src="./assest/images/UNIDI_LOGO-FINAL 2.svg" alt="">
                    </a>

                    <div class="header-search-body">
                        <!-- <div class="header-search-menu"><i class="fa-solid fa-bars"></i></div> -->
                        <div class="header-search">
                            <div class="header-search-left">
                                <span>Danh mục</span>
                                <i class="fa-solid fa-chevron-down"></i>
                            </div>
                            <input type="text" class="search-input-product" placeholder="Tìm kiếm sản phẩm...">
                            <div class="header__search-history">
                                <h3 class="header__search-history-header">Kết quả tìm kiếm</h3>
                                <ul class="header__search-history-list">

                                    <div class="no-product">Không có sản phẩm nào</div>

                                </ul>
                                <div class="h-s-bottom">
                                    <span><strong class="search-totel">0</strong> Sản phẩm</span>
                                    <span>Xem thêm</span>
                                </div>
                            </div>
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </div>
                    </div>

                    <div class="header-search-right">
                        <div class="m-header-search">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </div>
                        <!-- <div class="header-search-item header-contact">
                            <div class="header-search-item-icon">
                                <i class="fa-solid fa-phone"></i>
                            </div>
                            <div class="header-search-info">
                                <span>(+800) 09..</span>
                                <div class="header-search-text-s">
                                    (Liên hệ)
                                </div>
                            </div>
                        </div> -->
                        <!-- not login -->
                        <?php if (Session::get("isLogin") == true) { ?>
                            <!-- login -->
                            <div class="header-search-item header-search-account">
                                <div class="header-search-item-icon">
                                    <img src="<?php echo "./assest/upload/" . Session::get("avatar"); ?>" class="img-user"
                                        alt="">
                                </div>
                                <!-- if (str_contains(Session::get("avatar"), "http")) {
                                        echo Session::get('avatar');
                                    } else {
                                        echo "./assest/upload/" . Session::get("avatar");
                                    } -->
                                <a href="?mod=profile&act=profile" class="header-search-info">
                                    <div class="fullname">Hi,
                                        <?php echo Session::get("full_name") ?>
                                    </div>
                                    <div class="header-search-text-s">
                                        Hồ sơ
                                    </div>
                                </a>
                                <div class="account-more">
                                    <a href="?mod=profile&act=profile" class="account-more-item">
                                        <i class="fa-solid fa-user"></i>
                                        <span>Hồ sơ</span>
                                    </a>
                                    <?php
                                    if (isset($_GET['action']) && $_GET["action"] == 'logout') {
                                        echo Session::destroy();
                                    }
                                    ?>
                                    <a href="?mod=page&act=home&action=logout" class="account-more-item">
                                        <i class="fa-solid fa-arrow-right-from-bracket"></i>
                                        <span>Đăng xuất</span>
                                    </a>
                                </div>
                            </div>
                        <?php } else { ?>
                            <div class="header-search-item header-search-account">
                                <div class="header-search-item-icon">
                                    <i class="fa-solid fa-user"></i>
                                </div>
                                <a href="?mod=profile&act=login" class="header-search-info">
                                    <span>Đăng nhập</span>
                                    <div class="header-search-text-s">
                                        Tài khoản

                                    </div>
                                </a>
                                <div class="account-more">
                                    <a href="?mod=profile&act=login" class="account-more-item">
                                        <i class="fa-solid fa-arrow-right-to-bracket"></i>
                                        <span>Đăng nhập</span>
                                    </a>
                                    <a href="?mod=profile&act=register" class="account-more-item">
                                        <i class="fa-solid fa-user-plus"></i>
                                        <span>Đăng kí</span>

                                    </a>
                                </div>
                            </div>
                        <?php } ?>

                        <div class="header-search-item header-cart">
                            <div class="header-search-item-icon icon-cart">
                                <i class="fa-solid fa-cart-plus"></i>
                                <div class="cart-count view-total-count"
                                    view-total-count="<?= ($getCartInfo->result['total']) ?>">
                                    <?php
                                    if (empty(($getCartInfo->result['total']))) {
                                        echo "0";

                                    } else {
                                        echo $getCartInfo->result['total'];
                                    }
                                    ?>
                                </div>
                            </div>
                            <a href="?mod=page&act=cart" class="header-search-info">
                                <span>Giỏ hàng</span>
                                <div class="header-search-text-s fm-price view-total-cart"
                                    view-total-cart=" <?= ($getCartInfo->result['totalPrice']) ?>">
                                    <?= ($getCartInfo->result['totalPrice']) ?>
                                </div>
                            </a>
                            <!-- no cart :: header__cart-list--no-cart -->
                            <div class="header__cart-list ">



                                <p class="header__cart-heading">Sản phẩm đã thêm</p>
                                <ul class="header__cart-list-item">
                                    <?php
                                    if ($cartResult->status && count($cartResult->result) > 0) {
                                        foreach ($cartResult->result as $key => $value) { ?>
                                            <li class="header__cart-item">
                                                <img src="./assest/upload/<?= $value['image'] ?>" alt=""
                                                    class="header__cart-img">
                                                <div class="header__cart-item-info">
                                                    <div class="header__cart-item-head">
                                                        <h5 class="header__cart-item-name">
                                                            <?= $value['namePro'] ?>
                                                        </h5>
                                                        <div class="header__cart-item-price-wrap">
                                                            <span class="header__cart-item-price fm-price">
                                                                <?= $value['price'] ?>
                                                            </span>
                                                            <span class="header__cart-item-multiple">x</span>
                                                            <span class="header__cart-item-qnt">
                                                                <?= $value['count'] ?>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="header__cart-item-body">
                                                        <span class="header__cart-item-description">
                                                            <?= $value['brand'] ?> -
                                                            <?= $value['origin'] ?>
                                                        </span>
                                                        <span class="header__cart-item-remmove">Delete</span>
                                                    </div>
                                                </div>
                                            </li>

                                        <?php }
                                    }
                                    ?>
                                </ul>
                                <a href="?mod=page&act=cart" class="header__cart-view-cart btn btn--primary">Xem giỏ
                                    hàng</a>
                            </div>
                        </div>
                    </div>
                    <div class="header-menu" id="menumobile">
                        <i class="fa-solid fa-bars"></i>
                    </div>
                </div>
            </div>

        </header>