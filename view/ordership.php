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
    <link rel="stylesheet" href="./src/css/ordership.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="./src/js/seller.js"></script>

</head>

<body>
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


                    <div class="header-search-item header-cart">
                        <div class="header-search-item-icon icon-cart">
                            <i class="fa-solid fa-cart-plus"></i>
                            <div class="cart-count view-total-count" view-total-count="0">
                                0
                            </div>
                        </div>
                        <a href="?mod=page&act=cart" class="header-search-info">
                            <span>Giỏ hàng</span>
                            <div class="header-search-text-s fm-price view-total-cart" view-total-cart=" 0">
                                0
                            </div>
                        </a>
                        <!-- no cart :: header__cart-list--no-cart -->
                        <div class="header__cart-list ">



                            <p class="header__cart-heading">Sản phẩm đã thêm</p>
                            <ul class="header__cart-list-item">

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
    <!-- main -->
    <main class="ordership">
        <div class="wrapper">
            <div class="ordership-title">
                Thông tin đơn hàng
            </div>
            <?php
            if (isset($order) && ($order->status == true) && (($order->result['status'] == 'Confirmed') || ($order->result['status'] == 'On_Delivery'))) { ?>

                <!-- table -->
                <div class="table">
                    <div class="table-nav">
                        <div class="table-item">
                            <div class="table-left">
                                <div class="table-item-info">
                                    <div class="table-label">Thông tin giao hàng</div>
                                </div>
                                <div class="table-item-address">
                                    <div class="table-label">Địa chỉ</div>
                                </div>
                            </div>
                            <div class="table-right">
                                <div class="table-item-payment">
                                    <div class="table-label">Thanh toán</div>
                                </div>
                                <div class="table-item-action">
                                    <div class="table-label">Hành động</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-body">
                        <!-- item -->
                        <div class="table-item">
                            <div class="table-left">
                                <div class="table-item-info">
                                    <div class="itme-code">
                                        <?= "#000" . $order->result['id'] ?>
                                    </div>
                                    <div class="item-user">
                                        <?= $order->result['name_receiver'] ?> -
                                        <?= $order->result['phone_number'] ?>
                                    </div>
                                    <div class="item-count-items">Số lượng sản phẩm: 3</div>
                                    <div class="item-count-items">Ngày :
                                        <?= $format->diffForHumans($order->result['updated_at']) ?>
                                    </div>
                                </div>
                                <div class="table-item-address">
                                    <div class="table-item-address-item">
                                        <i class="fa-solid fa-location-dot"></i>
                                        From:
                                        <span>
                                            <?= $classAddress->get_address_by_shop($order->result['shop_id'])['province'] ?>-
                                            <?= $classAddress->get_address_by_shop($order->result['shop_id'])['district'] ?>-
                                            <?= $classAddress->get_address_by_shop($order->result['shop_id'])['ward'] ?>
                                        </span>
                                    </div>
                                    <div class="table-item-address-item">
                                        <i class="fa-solid fa-location-dot"></i>
                                        To:
                                        <span>
                                            <?= $classAddress->get_addres_by_delivery($order->result['delivery_address_id'])['province'] ?>-
                                            <?= $classAddress->get_addres_by_delivery($order->result['delivery_address_id'])['district'] ?>-
                                            <?= $classAddress->get_addres_by_delivery($order->result['delivery_address_id'])['ward'] ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="table-right">
                                <div class="table-item-payment ">
                                    <?php
                                    if ($order->result['payment_status'] == 0) {
                                        echo '<div>Thu hộ</div> <div class="fm-price" >' . $order->result['total'] . '</div>';
                                    } else {
                                        echo '<div>Đã thanh toán</div>';
                                        ;
                                    }
                                    ?>

                                </div>
                                <div class="table-item-action">
                                    <?php
                                    if ($order->result['status'] == 'Confirmed') { ?>

                                        <div class="table-item-btn on_delivery"
                                            onclick="update_status_order(<?= $order->result['id'] ?>,'On_Delivery')">Nhận đơn
                                        </div>
                                    <?php } else { ?>
                                        <div class="table-item-btn on_delivery"
                                            onclick="update_status_order(<?= $order->result['id'] ?>,'Completed')">Đã nhận

                                        </div>
                                    <?php }
                                    ?>
                                    <div class="table-item-btn cancelled"
                                        onclick="update_status_order(<?= $order->result['id'] ?>,'Cancelled')">Hủy đơn</div>
                                    <!-- <form method="POST" action="<?= $_SERVER['REQUEST_URI'] ?>">
                                        <input type="submit" value="Xác nhận đã giao" name="submit">
                                    </form> -->
                                    <!-- <div class="table-item-btn completed">Hoàn thành</div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ordership-qr">
                        <div id="create_qr"><i class="fa-solid fa-qrcode"></i>Get QrCode</div>
                    </div>
                    <div class="ordership-showqr">
                        <div id="qrcode"></div>
                    </div>
                </div>
                <!-- table -->
                <!-- qr code -->
                <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"
                    integrity="sha512-CNgIRecGo7nphbeZ04Sc13ka07paqdeTu0WR1IM4kNcpmBAUSHSQX0FslNhTDadL4O5SAGapGt4FodqL8My0mA=="
                    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
                <script>
                    var qrcode = new QRCode("qrcode");
                    function makeCode() {
                        var elText = document.getElementById("text");

                        if (!elText.value) {
                            alert("Input a text");
                            elText.focus();
                            return;
                        }
                        qrcode.makeCode(elText.value);
                    }
                    const btn = document.getElementById('create_qr')
                    btn.onclick = () => {
                        document.getElementById('qrcode').style = 'height:140px;margin-bottom:20px'
                        makeCode();
                    }
                    $("#text").
                        on("blur", function () {
                            makeCode();
                        }).
                        on("keydown", function (e) {
                            if (e.keyCode == 13) {
                                makeCode();
                            }
                        });
                </script>
                <!-- qr code -->

            <?php } else {
                if (($order->result['status'] == 'Cancelled') || $order->result['status'] == 'Completed') {

                    echo ' <div class="table-not-fund"><i class="fa-solid fa-bolt"></i> Đơn hàng này đã hoàn thành! </div>';
                    echo '<div class="container">
                                <svg xmlns="http://www.w3.org/2000/svg" class="svg-success" viewBox="0 0 24 24">
                                    <g stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10">
                                        <circle class="success-circle-outline" cx="12" cy="12" r="11.5" />
                                        <circle class="success-circle-fill" cx="12" cy="12" r="11.5" />
                                        <polyline class="success-tick" points="17,8.5 9.5,15.5 7,13" />
                                    </g>
                                </svg>
                        
                            </div>';

                } else { ?>
                    <div class="table-not-fund"><i class="fa-solid fa-bolt"></i> Đơn hàng không tồn tại trên hệ thống! </div>
                <?php }
            } ?>

        </div>
    </main>
    <!-- qr code -->
    <input id="text" hidden type="text" value="<?= $_SERVER['REQUEST_URI'] ?>&qrcode=true" style="width:80%" /><br />

    <div id="snackbar"></div>
    <!-- qr code -->

    <script>
        const VND = new Intl.NumberFormat("vi-VN", {
            style: "currency",
            currency: "VND",
        });
        const prices = document.querySelectorAll(".fm-price")
        prices.forEach(item => {
            item.textContent = VND.format(item.textContent)
        })
        // get params
        const uuid = get_param('code')
        if (uuid) {
            $.ajax({
                url: `?mod=request&act=get_status_order&uuid=${uuid}`,
            }).done((data) => {
                data = JSON.parse(data);
                console.log(data);
                if ((data.status == "Confirmed") || data.status == "On_Delivery") {
                    loop(uuid)
                } 
            });
            function loop(uui) {
                let id = setInterval(() => {
                    $.ajax({
                        url: `?mod=request&act=get_status_order&uuid=${uuid}`,
                    }).done((data) => {
                        data = JSON.parse(data);
                        console.log(data);
                        if ((data.status == "Confirmed") || data.status == "On_Delivery") {
                        } else {
                            window.location.href ="?mod=verify&act=order&code="+uuid
                            clearInterval(id)
                        }

                    });
                }, 2500)

            }

        }
    </script>

</body>

</html>