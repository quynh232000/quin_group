<?php
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header("Expires: Sat, 26 Jul 2030 05:00:00 GMT");
header("Cache-Control:max-age=2592000");


if (empty($viewTitle)) {
    $viewTitle = "ADMIN";
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta property="og:image" content="./assest/images/logo-no-text.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="./assest/images/logo-no-text.png">
    <title>QUIN -
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
    <link rel="stylesheet" href="src/css/base.css">
    <link rel="stylesheet" href="src/css/style.css">
    <link rel="stylesheet" href="src/css/shopcustom.css">
    <link rel="stylesheet" href="src/css/shopdashboard.css">
    <link rel="stylesheet" href="src/css/shopmanageproduct.css">
    <link rel="stylesheet" href="src/css/shopaddproduct.css">
    <link rel="stylesheet" href="src/css/shopmanageorder.css">
    <link rel="stylesheet" href="src/css/shopdelivery.css">
    <link rel="stylesheet" href="./src/css/profile.css">
    <!-- <link rel="stylesheet" href="./src/css/nhung.css"> -->
    <!-- <link rel="stylesheet" href="./src/js/define.js"> -->
    <script src="./src/js/seller.js"></script>

    <!-- swiper -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <!-- toast -->

</head>

<body>
    <div class="app admin">
        <!--header-->
        <header class="header header-no-show">
            <!-- sidebar -->
            <div class="sidebar">
                <div class="sidebar-wrapper">
                    <div class="sidebar-close">
                        <i class="fa-solid fa-xmark"></i>
                        <a href="/shop" class="sidebar-img">
                            <img src="assest/images/UNIDI_LOGO-FINAL 2.svg" alt="logo">

                        </a>
                    </div>
                    <div class="sidebar-body">

                        <a href="/profile.html" class="sidebar-item-account">
                            <div class="m-user-img">
                                <img src="https://yt3.googleusercontent.com/-CFTJHU7fEWb7BYEb6Jh9gm1EpetvVGQqtof0Rbh-VQRIznYYKJxCaqv_9HeBcmJmIsp2vOO9JU=s900-c-k-c0x00ffffff-no-rj"
                                    alt="">
                            </div>
                            <span>Hi, Mr Bin</span>
                        </a>

                        <a href="/" class="sidebar-item">
                            <i class="fa-solid fa-house"></i>
                            Home
                        </a>
                        <a href="/" class="sidebar-item">
                            <i class="fa-solid fa-cart-plus"></i>
                            Shopping
                        </a>
                        <a href="#partner" class="sidebar-item">
                            <i class="fa-solid fa-handshake"></i>
                            Partner
                        </a>
                        <a href="/shop.html" class="sidebar-item">
                            <i class="fa-solid fa-shop-lock"></i>
                            My shop
                        </a>
                        <!-- not login -->
                        <!-- <div class="sidebar-bottom">
                        <a href="/login" class="sidebar-item action">
                            <i class="fa-solid fa-arrow-right-to-bracket"></i>
                            Sign in
                        </a>
                        <a href="/register" class="sidebar-item action">
                            <i class="fa-solid fa-registered"></i>
                            Register
                        </a>
                    </div> -->
                        <!-- is login -->
                        <div class="sidebar-bottom">
                            <a href="/logout" class="sidebar-item action">
                                <i class="fa-solid fa-arrow-right-to-bracket"></i>
                                Logout
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
                                Language:
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
                                Notifycations
                            </div>
                        </a>
                        <a href="?mod=admin&act=dashboard" class="header-top-item">
                            <div class="header-top-item-body">
                                <i class="fa-regular fa-circle-question"></i>

                            </div>
                            <div class="header-top-item-title">
                                Admin
                            </div>
                        </a>
                        <a href="./shopowner" class="header-top-item">
                            <div class="header-top-item-body">
                                <i class="fa-regular fa-circle-down"></i>
                            </div>
                            <div class="header-top-item-title">
                                Download
                            </div>
                        </a>



                    </div>

                </div>
            </div>
            <div class="header-body">
                <div class="wrapper">
                    <a href="<?php
                    if ($mod == "seller" && $act == "dashboard") {
                        echo "./";
                    } else {
                        echo "?mod=seller&act=dashboard";
                    }
                    ?>" class="header-logo">
                        <img src="assest/images/UNIDI_LOGO-FINAL 2.svg" alt="">
                        <div class="shop-header-name">SELLER </div>
                    </a>
                    <!-- ?mod=<?=$mod?>&act=<?=$act?> -->
                    <form method="POST" action="<?= $_SERVER['REQUEST_URI'] ?>" class="header-search-body">
                        <div class="header-search">
                            <input type="text" placeholder="Tìm kiếm..." name="search" value="<?=$_POST['search'] ??""?>">
                            <div class="header__search-history">
                                <h3 class="header__search-history-header">History</h3>
                                <ul class="header__search-history-list">
                                    <li class="header__search-history-item">
                                        <a href="">Kem dưỡng da</a>
                                    </li>
                                    <li class="header__search-history-item">
                                        <a href="">Giày sneaker</a>
                                    </li>
                                </ul>
                            </div>
                            <input type="submit" id="inputsearch" name="submitsearch" value="search" hidden>
                            <label for="inputsearch">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </label>
                        </div>
                    </form>

                    <div class="header-search-right">
                        <div class="m-header-search">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </div>
                        <div class="header-search-item header-search-account">
                            <div class="header-search-item-icon">
                                <img src="<?php echo "./assest/upload/" . $shop_info->result['icon']; ?>"
                                    class="img-user" alt="">
                            </div>
                            <a href="?mod=profile&act=profile" class="header-search-info">

                                <span>Shop,
                                    <?php
                                    echo $shop_info->result['name'];
                                    ?>
                                </span>
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
                                <a href="?mod=seller&act=dashboard&action=logout" class="account-more-item">
                                    <i class="fa-solid fa-arrow-right-from-bracket"></i>
                                    <span>Đăng xuất</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="header-menu" id="menumobile">
                        <i class="fa-solid fa-bars"></i>
                    </div>
                </div>
            </div>

        </header>
        <div class="shop">
            <div class="wrapper">