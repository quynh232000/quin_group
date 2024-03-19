<!-- main -->
<main class="shop-main">
    <!-- content -->
    <div class="shop-main-content">
        <div class="shop-top">
            <div class="shop-title">Quản lý doanh thu</div>

            <!--  -->

            <!--  -->
            <div class="dash-top">
                <!-- item -->
                <div class="card work">
                    <div class="card-header">
                        <div class="card-desc-icon">
                            <i class="fa-solid fa-money-bills"></i>
                        </div>
                        <div class="card-title">Tổng danh thu tháng</div>
                    </div>
                    <div class="card-desc">
                        <div class="card-time fm-price"> <?php
                                                            if (isset($resultData)) {
                                                                echo $resultData->result['totalBalance'];
                                                            }
                                                            ?></div>
                    </div>
                </div>
                <!-- item -->
                <div class="card work">
                    <div class="card-header">
                        <div class="card-desc-icon">
                            <i class="fa-solid fa-clipboard"></i>
                        </div>
                        <div class="card-title">Tổng số đơn hàng</div>
                    </div>
                    <div class="card-desc">
                        <div class="card-time"> <?php
                                                if (isset($resultData)) {
                                                    echo $resultData->result['totalOrder'];
                                                }
                                                ?></div>
                    </div>
                </div>
                <!-- item -->
                <div class="card work">
                    <div class="card-header">
                        <div class="card-desc-icon">
                            <i class="fa-solid fa-clipboard"></i>
                        </div>
                        <div class="card-title">Đơn chưa thanh toán</div>
                    </div>
                    <div class="card-desc">
                        <div class="card-time"> <?php
                                                if (isset($resultData)) {
                                                    echo $resultData->result['totalOrder'];
                                                }
                                                ?></div>
                    </div>
                </div>
                <!-- item -->
                <div class="card work">
                    <div class="card-header">
                        <div class="card-desc-icon">
                            <i class="fa-solid fa-clipboard"></i>
                        </div>
                        <div class="card-title">Đã thanh toán</div>
                    </div>
                    <div class="card-desc">
                        <div class="card-time"> <?php
                                                if (isset($resultData)) {
                                                    echo $resultData->result['totalOrder'];
                                                }
                                                ?></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="manage-revenue-content">
            <div class="manage-revenue-search">
                <div class="manage-revenue-search-name">Chi tiết</div>
                <div class="manage-revenue-search-input">
                    <input type="text" placeholder="Tìm kiếm đơn hàng theo mã đơn hàng...">
                    <div class="manage-revenue-search-icon">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </div>
                </div>
            </div>
            <div class="s-orders-top">
                <div class="s-order-nav">
                    <a href="#" class="s-order-nav-item active">Chưa thanh toán</a>
                    <a href="#" class="s-order-nav-item">Đã thanh toán</a>
                </div>
            </div>
            <div class="shop-pro-body-wrapper">
                <div class="shop-pro-nav">
                    <div class="shop-pro-item manage-revenue-orders-nav">
                        <div class="shop-pro-info">
                            <input type="checkbox">
                            <div class="shop-pro-info-wrapper">
                                <div class="shop-pro-nav-title">Đơn hàng</div>
                            </div>
                        </div>
                        <div class="shop-pro-sku">
                            <div class="shop-pro-nav-title">Mã đơn</div>
                        </div>
                        <div class="shop-pro-type">Trạng thái</div>
                        <div class="shop-pro-price">
                            <div class="shop-pro-nav-title">Phương thức thanh toán</div>
                        </div>
                        <div class="shop-pro-price fm-price">
                            <div class="shop-pro-nav-title">Số tiền chưa thanh toán</div>
                        </div>
                    </div>
                </div>
                <div class="shop-pro-list">
                    <!-- item -->
                    <div class="shop-pro-item manage-revenue-orders">
                        <div class="shop-pro-info">
                            <input type="checkbox">
                            <!-- input -->
                            <!-- <label class="checkbox-container">
                                            <input type="checkbox" checked="checked">
                                            <div class="checkbox-checkmark"></div>
                                        </label> -->
                            <!-- input -->
                            <div class="shop-pro-info-wrapper">
                                <div class="shop-pro-info-img">
                                    <img src="assest/upload/775E9AC0-8CD8-4EBC-8A78-3816399013D8.3" alt="">
                                </div>
                                <div class="shop-pro-info-right">
                                    <div class="shop-pro-info-name">
                                        Apple MacBook Air M1 256GB 2020 </div>
                                    <div class="shop-pro-info-sku">
                                        Mã <span>
                                            64 </span>
                                    </div>
                                    <div class="shop-pro-info-action">
                                        <a href="?mod=page&amp;act=detail&amp;id=64" class="shop-pro-info-view" title="View detail">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>
                                        <div class="shop-pro-info-heart">
                                            <i class="fa-regular fa-heart"></i>
                                            <span>8</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="shop-pro-sku">
                            64 </div>
                        <div class="shop-pro-type">
                            Chờ lấy hàng </div>
                        <div class="shop-pro-payment">
                            Tiền mặt</div>
                        <div class="shop-pro-price fm-price">
                            18990000 </div>

                    </div>
                    <!-- item -->
                    <div class="shop-pro-item manage-revenue-orders">
                        <div class="shop-pro-info">
                            <input type="checkbox">
                            <!-- input -->
                            <!-- <label class="checkbox-container">
                                            <input type="checkbox" checked="checked">
                                            <div class="checkbox-checkmark"></div>
                                        </label> -->
                            <!-- input -->
                            <div class="shop-pro-info-wrapper">
                                <div class="shop-pro-info-img">
                                    <img src="assest/upload/22FA2AC4-E9F2-47E0-B061-A7D728E6C5F7.1" alt="">
                                </div>
                                <div class="shop-pro-info-right">
                                    <div class="shop-pro-info-name">
                                        Laptop Acer Nitro 5 Gaming AN515 57 5669 i5 </div>
                                    <div class="shop-pro-info-sku">
                                        Mã <span>
                                            65 </span>
                                    </div>
                                    <div class="shop-pro-info-action">
                                        <a href="?mod=page&amp;act=detail&amp;id=65" class="shop-pro-info-view" title="View detail">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>
                                        <div class="shop-pro-info-heart">
                                            <i class="fa-regular fa-heart"></i>
                                            <span>8</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="shop-pro-sku">
                            65 </div>
                        <div class="shop-pro-type">
                           Đang giao </div>
                        <div class="shop-pro-payment">
                            Tiền mặt</div>
                        <div class="shop-pro-price fm-price">
                            16990000 </div>
                    </div>
                </div>
                <!-- item -->
                <div class="shop-pro-item manage-revenue-orders">
                    <div class="shop-pro-info">
                        <input type="checkbox">
                        <!-- input -->
                        <!-- <label class="checkbox-container">
                                            <input type="checkbox" checked="checked">
                                            <div class="checkbox-checkmark"></div>
                                        </label> -->
                        <!-- input -->
                        <div class="shop-pro-info-wrapper">
                            <div class="shop-pro-info-img">
                                <img src="assest/upload/2DCB7A97-AA39-460C-8477-05AECF6B4C75.1" alt="">
                            </div>
                            <div class="shop-pro-info-right">
                                <div class="shop-pro-info-name">
                                    Laptop Asus Vivobook X415EA i3 </div>
                                <div class="shop-pro-info-sku">
                                    Mã <span>
                                        66 </span>
                                </div>
                                <div class="shop-pro-info-action">
                                    <a href="?mod=page&amp;act=detail&amp;id=66" class="shop-pro-info-view" title="View detail">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                    <div class="shop-pro-info-heart">
                                        <i class="fa-regular fa-heart"></i>
                                        <span>8</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="shop-pro-sku">
                        66 </div>
                    <div class="shop-pro-type">
                        Chờ lấy hàng </div>
                    <div class="shop-pro-payment">
                        Tiền mặt</div>
                    <div class="shop-pro-price fm-price">
                        77 </div>
                </div>
                <!-- item -->
                <div class="shop-pro-item manage-revenue-orders">
                    <div class="shop-pro-info">
                        <input type="checkbox">
                        <!-- input -->
                        <!-- <label class="checkbox-container">
                                            <input type="checkbox" checked="checked">
                                            <div class="checkbox-checkmark"></div>
                                        </label> -->
                        <!-- input -->
                        <div class="shop-pro-info-wrapper">
                            <div class="shop-pro-info-img">
                                <img src="assest/upload/4C2814A2-3665-4894-90FF-2F6AE213B684.1" alt="">
                            </div>
                            <div class="shop-pro-info-right">
                                <div class="shop-pro-info-name">
                                    Laptop Asus TUF Gaming F15 FX506HF </div>
                                <div class="shop-pro-info-sku">
                                    Mã <span>
                                        73 </span>
                                </div>
                                <div class="shop-pro-info-action">
                                    <a href="?mod=page&amp;act=detail&amp;id=73" class="shop-pro-info-view" title="View detail">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                    <div class="shop-pro-info-heart">
                                        <i class="fa-regular fa-heart"></i>
                                        <span>8</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="shop-pro-sku">
                        73 </div>
                    <div class="shop-pro-type">
                       Đang giao </div>
                    <div class="shop-pro-payment">
                        Tiền mặt</div>
                    <div class="shop-pro-price fm-price">
                        100 </div>
                </div>
                <!-- item -->
                <div class="shop-pro-item manage-revenue-orders">
                    <div class="shop-pro-info">
                        <input type="checkbox">
                        <!-- input -->
                        <!-- <label class="checkbox-container">
                                            <input type="checkbox" checked="checked">
                                            <div class="checkbox-checkmark"></div>
                                        </label> -->
                        <!-- input -->
                        <div class="shop-pro-info-wrapper">
                            <div class="shop-pro-info-img">
                                <img src="assest/upload/C433E398-BC2D-4645-9B59-871EADCB8577.jpg" alt="">
                            </div>
                            <div class="shop-pro-info-right">
                                <div class="shop-pro-info-name">
                                    Laptop Apple MacBook Air 15 inch </div>
                                <div class="shop-pro-info-sku">
                                    Mã <span>
                                        74 </span>
                                </div>
                                <div class="shop-pro-info-action">
                                    <a href="?mod=page&amp;act=detail&amp;id=74" class="shop-pro-info-view" title="View detail">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                    <div class="shop-pro-info-heart">
                                        <i class="fa-regular fa-heart"></i>
                                        <span>8</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="shop-pro-sku">
                        74 </div>
                    <div class="shop-pro-type">
                        Chờ lấy hàng </div>
                    <div class="shop-pro-payment">
                        Tiền mặt</div>
                    <div class="shop-pro-price fm-price">
                        56 </div>
                </div>
                <!-- item -->
                <div class="shop-pro-item manage-revenue-orders">
                    <div class="shop-pro-info">
                        <input type="checkbox">
                        <!-- input -->
                        <!-- <label class="checkbox-container">
                                            <input type="checkbox" checked="checked">
                                            <div class="checkbox-checkmark"></div>
                                        </label> -->
                        <!-- input -->
                        <div class="shop-pro-info-wrapper">
                            <div class="shop-pro-info-img">
                                <img src="assest/upload/73A62ED9-19E4-468B-AA8D-CD871126EC02.1" alt="">
                            </div>
                            <div class="shop-pro-info-right">
                                <div class="shop-pro-info-name">
                                    Laptop HP Gaming VICTUS 15 </div>
                                <div class="shop-pro-info-sku">
                                    Mã <span>
                                        75 </span>
                                </div>
                                <div class="shop-pro-info-action">
                                    <a href="?mod=page&amp;act=detail&amp;id=75" class="shop-pro-info-view" title="View detail">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                    <div class="shop-pro-info-heart">
                                        <i class="fa-regular fa-heart"></i>
                                        <span>8</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="shop-pro-sku">
                        75 </div>
                    <div class="shop-pro-type">
                        Chờ lấy hàng </div>
                    <div class="shop-pro-payment">
                        Tiền mặt</div>
                    <div class="shop-pro-price fm-price">
                        78 </div>
                </div>
                <!-- item -->
                <div class="shop-pro-item manage-revenue-orders">
                    <div class="shop-pro-info">
                        <input type="checkbox">
                        <!-- input -->
                        <!-- <label class="checkbox-container">
                                            <input type="checkbox" checked="checked">
                                            <div class="checkbox-checkmark"></div>
                                        </label> -->
                        <!-- input -->
                        <div class="shop-pro-info-wrapper">
                            <div class="shop-pro-info-img">
                                <img src="assest/upload/B4C70670-4FEF-40BB-A73A-2E322518E703.jpg" alt="">
                            </div>
                            <div class="shop-pro-info-right">
                                <div class="shop-pro-info-name">
                                    Laptop Acer Aspire 5 Gaming A515 58GM </div>
                                <div class="shop-pro-info-sku">
                                    Mã <span>
                                        76 </span>
                                </div>
                                <div class="shop-pro-info-action">
                                    <a href="?mod=page&amp;act=detail&amp;id=76" class="shop-pro-info-view" title="View detail">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                    <div class="shop-pro-info-heart">
                                        <i class="fa-regular fa-heart"></i>
                                        <span>8</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="shop-pro-sku">
                        76 </div>
                    <div class="shop-pro-type">
                        Chờ lấy hàng </div>
                    <div class="shop-pro-payment">
                        Tiền mặt</div>
                    <div class="shop-pro-price fm-price">
                        95 </div>
                </div>
                <!-- item -->
                <div class="shop-pro-item manage-revenue-orders">
                    <div class="shop-pro-info">
                        <input type="checkbox">
                        <!-- input -->
                        <!-- <label class="checkbox-container">
                                            <input type="checkbox" checked="checked">
                                            <div class="checkbox-checkmark"></div>
                                        </label> -->
                        <!-- input -->
                        <div class="shop-pro-info-wrapper">
                            <div class="shop-pro-info-img">
                                <img src="assest/upload/59FDFC5A-AC91-499C-9102-CDB7DB51162D.4" alt="">
                            </div>
                            <div class="shop-pro-info-right">
                                <div class="shop-pro-info-name">
                                    Laptop Apple MacBook Pro 16 inch M2 </div>
                                <div class="shop-pro-info-sku">
                                    Mã <span>
                                        77 </span>
                                </div>
                                <div class="shop-pro-info-action">
                                    <a href="?mod=page&amp;act=detail&amp;id=77" class="shop-pro-info-view" title="View detail">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                    <div class="shop-pro-info-heart">
                                        <i class="fa-regular fa-heart"></i>
                                        <span>8</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="shop-pro-sku">
                        77 </div>
                    <div class="shop-pro-type">
                       Đang giao </div>
                    <div class="shop-pro-payment">
                        Tiền mặt</div>
                    <div class="shop-pro-price fm-price">
                        30 </div>
                </div>
                <!-- item -->
                <div class="shop-pro-item manage-revenue-orders">
                    <div class="shop-pro-info">
                        <input type="checkbox">
                        <!-- input -->
                        <!-- <label class="checkbox-container">
                                            <input type="checkbox" checked="checked">
                                            <div class="checkbox-checkmark"></div>
                                        </label> -->
                        <!-- input -->
                        <div class="shop-pro-info-wrapper">
                            <div class="shop-pro-info-img">
                                <img src="assest/upload/8F50F255-6CB6-411E-9302-3CF2B7388C9B.1" alt="">
                            </div>
                            <div class="shop-pro-info-right">
                                <div class="shop-pro-info-name">
                                    Laptop Asus Vivobook 15 OLED A1505ZA </div>
                                <div class="shop-pro-info-sku">
                                    Mã <span>
                                        79 </span>
                                </div>
                                <div class="shop-pro-info-action">
                                    <a href="?mod=page&amp;act=detail&amp;id=79" class="shop-pro-info-view" title="View detail">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                    <div class="shop-pro-info-heart">
                                        <i class="fa-regular fa-heart"></i>
                                        <span>8</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="shop-pro-sku">
                        79 </div>
                    <div class="shop-pro-type">
                        Chờ lấy hàng </div>
                    <div class="shop-pro-payment">
                        Tiền mặt</div>
                    <div class="shop-pro-price fm-price">
                        63 </div>
                </div>
                <!-- item -->
                <div class="shop-pro-item manage-revenue-orders">
                    <div class="shop-pro-info">
                        <input type="checkbox">
                        <!-- input -->
                        <!-- <label class="checkbox-container">
                                            <input type="checkbox" checked="checked">
                                            <div class="checkbox-checkmark"></div>
                                        </label> -->
                        <!-- input -->
                        <div class="shop-pro-info-wrapper">
                            <div class="shop-pro-info-img">
                                <img src="assest/upload/4B7E91B7-A76E-46B6-89EA-088C92A7355B." alt="">
                            </div>
                            <div class="shop-pro-info-right">
                                <div class="shop-pro-info-name">
                                    Laptop HP Pavilion 15 eg2086TU i3 </div>
                                <div class="shop-pro-info-sku">
                                    Mã <span>
                                        80 </span>
                                </div>
                                <div class="shop-pro-info-action">
                                    <a href="?mod=page&amp;act=detail&amp;id=80" class="shop-pro-info-view" title="View detail">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                    <div class="shop-pro-info-heart">
                                        <i class="fa-regular fa-heart"></i>
                                        <span>8</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="shop-pro-sku">
                        80 </div>
                    <div class="shop-pro-type">
                        Chờ lấy hàng </div>
                    <div class="shop-pro-payment">
                        Tiền mặt</div>
                    <div class="shop-pro-price fm-price">
                        52 </div>
                </div>
            </div>
            <div class="p-pagination pagination-manage-revenue">
                <div class="p-pagination-left">
                    <span>
                        (<span class="count-product">
                            10                        </span>/10)
                        sản phẩm
                    </span>
                    <div>|</div>
                    <span>
                        (<span class="current-page">
                            1                        </span>/
                        <span class="total-page">
                            5                        </span>) trang
                    </span>
                </div>
                <div class="p-pagination-right">
                    <a href="?mod=seller&amp;act=manageproduct&amp;page=1" class="disabled p-pagination-item previous-page">
                        <i class="fa-solid fa-angles-left"></i>
                    </a>
                    <a href="?mod=seller&amp;act=manageproduct&amp;page=1" class="p-pagination-item active">1</a><a href="?mod=seller&amp;act=manageproduct&amp;page=2" class="p-pagination-item ">2</a><a href="?mod=seller&amp;act=manageproduct&amp;page=3" class="p-pagination-item ">3</a><a href="?mod=seller&amp;act=manageproduct&amp;page=4" class="p-pagination-item ">4</a><a href="?mod=seller&amp;act=manageproduct&amp;page=5" class="p-pagination-item ">5</a>
                    <a href="?mod=seller&amp;act=manageproduct&amp;page=5" class="p-pagination-item next-page "><i class="fa-solid fa-angles-right"></i></a>
                </div>
            </div>
        </div>
    </div>
    </div>
</main>
</div>
</div>