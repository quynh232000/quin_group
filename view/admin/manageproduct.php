<main class="shop-main">
    <!-- content -->
    <div class="shop-main-content">
        <div class="shop-top">
            <div class="shop-title">Quản lí sản phẩm</div>
            <!-- <div class="shop-pro-filter">
                <div class="shop-pro-filter-item">
                    <div class="shop-pro-filter-input">
                        <select name="" id="" class="shop-pro-filter-search">
                            <option value="" selected>Tên sản phẩm</option>
                            <option value="">SKU</option>
                        </select>
                        <input type="text" placeholder="Tìm kiếm...">
                    </div>
                </div>
                <div class="shop-pro-filter-item">
                    <label for="">Danh mục</label>
                    <div class="shop-pro-filter-input">
                        <select name="" id="">
                            <option value="" selected>--Chọn sanh mục--</option>

                            <?php foreach ($allCategory as $key => $value) { ?>
                                <option value="<?= $value['id'] ?>">
                                    <?= $value['nameCate'] ?>
                                </option>
                            <?php }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="shop-pro-filter-item">
                    <label for="">Kho hàng</label>
                    <div class="shop-pro-filter-input">
                        <input type="text" placeholder="Min...">
                    </div>
                    -
                    <div class="shop-pro-filter-input">
                        <input type="text" placeholder="Max...">
                    </div>
                </div>
                <div class="shop-pro-filter-item">
                    <label for="">Doanh số</label>
                    <div class="shop-pro-filter-input">
                        <input type="text" placeholder="Min...">
                    </div>
                    -
                    <div class="shop-pro-filter-input">
                        <input type="text" placeholder="Max...">
                    </div>
                </div>
            </div> -->
        </div>
        <div class="shop-pro-content">
            <div class="shop-pro-show">
                <div class="show-pro-show-item">
                    Tất cả:
                    <span>
                        <?php if (isset($allProduct) && isset($allProduct->status)) {
                            echo $allProduct->total;
                        } else {
                            echo "0";
                        }
                        ?>
                    </span>
                </div>
                <div class="show-pro-show-item">
                    Hết hàng:
                    <span>0</span>
                </div>
                <div class="show-pro-show-item">
                    Ẩn:
                    <span>0</span>
                </div>

            </div>
            <div class="shop-pro-add" style="padding:0 20px">
                <div class="shop-pro-add-title">
                    <?php if (isset($allProduct) && isset($allProduct->status))
                        echo $allProduct->total; ?> Sản phẩm
                </div>
                <!-- btn create -->
                <a href="?mod=admin&act=addproduct" class="btn-add-pro">
                    +Tạo sản phẩm
                    <div class="star-1">
                        <svg xmlns="http://www.w3.org/2000/svg" xml:space="preserve" version="1.1"
                            style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd"
                            viewBox="0 0 784.11 815.53" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <defs></defs>
                            <g id="Layer_x0020_1">
                                <metadata id="CorelCorpID_0Corel-Layer"></metadata>
                                <path class="fil0"
                                    d="M392.05 0c-20.9,210.08 -184.06,378.41 -392.05,407.78 207.96,29.37 371.12,197.68 392.05,407.74 20.93,-210.06 184.09,-378.37 392.05,-407.74 -207.98,-29.38 -371.16,-197.69 -392.06,-407.78z">
                                </path>
                            </g>
                        </svg>
                    </div>
                    <div class="star-2">
                        <svg xmlns="http://www.w3.org/2000/svg" xml:space="preserve" version="1.1"
                            style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd"
                            viewBox="0 0 784.11 815.53" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <defs></defs>
                            <g id="Layer_x0020_1">
                                <metadata id="CorelCorpID_0Corel-Layer"></metadata>
                                <path class="fil0"
                                    d="M392.05 0c-20.9,210.08 -184.06,378.41 -392.05,407.78 207.96,29.37 371.12,197.68 392.05,407.74 20.93,-210.06 184.09,-378.37 392.05,-407.74 -207.98,-29.38 -371.16,-197.69 -392.06,-407.78z">
                                </path>
                            </g>
                        </svg>
                    </div>
                    <div class="star-3">
                        <svg xmlns="http://www.w3.org/2000/svg" xml:space="preserve" version="1.1"
                            style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd"
                            viewBox="0 0 784.11 815.53" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <defs></defs>
                            <g id="Layer_x0020_1">
                                <metadata id="CorelCorpID_0Corel-Layer"></metadata>
                                <path class="fil0"
                                    d="M392.05 0c-20.9,210.08 -184.06,378.41 -392.05,407.78 207.96,29.37 371.12,197.68 392.05,407.74 20.93,-210.06 184.09,-378.37 392.05,-407.74 -207.98,-29.38 -371.16,-197.69 -392.06,-407.78z">
                                </path>
                            </g>
                        </svg>
                    </div>
                    <div class="star-4">
                        <svg xmlns="http://www.w3.org/2000/svg" xml:space="preserve" version="1.1"
                            style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd"
                            viewBox="0 0 784.11 815.53" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <defs></defs>
                            <g id="Layer_x0020_1">
                                <metadata id="CorelCorpID_0Corel-Layer"></metadata>
                                <path class="fil0"
                                    d="M392.05 0c-20.9,210.08 -184.06,378.41 -392.05,407.78 207.96,29.37 371.12,197.68 392.05,407.74 20.93,-210.06 184.09,-378.37 392.05,-407.74 -207.98,-29.38 -371.16,-197.69 -392.06,-407.78z">
                                </path>
                            </g>
                        </svg>
                    </div>
                    <div class="star-5">
                        <svg xmlns="http://www.w3.org/2000/svg" xml:space="preserve" version="1.1"
                            style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd"
                            viewBox="0 0 784.11 815.53" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <defs></defs>
                            <g id="Layer_x0020_1">
                                <metadata id="CorelCorpID_0Corel-Layer"></metadata>
                                <path class="fil0"
                                    d="M392.05 0c-20.9,210.08 -184.06,378.41 -392.05,407.78 207.96,29.37 371.12,197.68 392.05,407.74 20.93,-210.06 184.09,-378.37 392.05,-407.74 -207.98,-29.38 -371.16,-197.69 -392.06,-407.78z">
                                </path>
                            </g>
                        </svg>
                    </div>
                    <div class="star-6">
                        <svg xmlns="http://www.w3.org/2000/svg" xml:space="preserve" version="1.1"
                            style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd"
                            viewBox="0 0 784.11 815.53" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <defs></defs>
                            <g id="Layer_x0020_1">
                                <metadata id="CorelCorpID_0Corel-Layer"></metadata>
                                <path class="fil0"
                                    d="M392.05 0c-20.9,210.08 -184.06,378.41 -392.05,407.78 207.96,29.37 371.12,197.68 392.05,407.74 20.93,-210.06 184.09,-378.37 392.05,-407.74 -207.98,-29.38 -371.16,-197.69 -392.06,-407.78z">
                                </path>
                            </g>
                        </svg>
                    </div>
                </a>

                <!-- btn create -->
                <!-- <a href="?mod=admin&act=addproduct" class="show-pro-add-btn">
                    + Tạo sản phẩm
                </a> -->
            </div>
            <div class="p-pagination">
                <div class="p-pagination-left">
                    <span>
                        (<span class="count-product">
                            <?php if (isset($allProduct) && isset($allProduct->status)) {
                                echo count($allProduct->result);
                            } else {
                                echo "0";
                            }
                            ?>
                        </span>/10)
                        sản phẩm
                    </span>
                    <div>|</div>
                    <span>
                        (<span class="current-page">
                            <?= isset($_GET['page']) ? $_GET['page'] : 1 ?>
                        </span>/
                        <span class="total-page">
                            <?php if (isset($allProduct) && isset($allProduct->status)) {
                                echo ceil($allProduct->total / 10);
                            } else {
                                echo "0";
                            } ?>
                        </span>) trang
                    </span>
                </div>
                <div class="p-pagination-right">
                    <a href="?mod=admin&act=manageproduct&page=<?= isset($_GET['page']) ? $_GET['page'] > 1 ? $_GET['page'] - 1 : 1 : 1 ?>"
                        class="<?php if (!isset($_GET['page']) || $_GET['page'] == 1)
                            echo "disabled"; ?> p-pagination-item previous-page">
                        Trước
                    </a>
                    <?php if (isset($allProduct) && isset($allProduct->status)) {
                        for ($i = 1; $i < ceil($allProduct->total / 10) + 1; $i++) {
                            $active = "";
                            if (isset($_GET['page']) && $_GET['page'] == $i) {
                                $active = "active";
                            } else {
                                if (!isset($_GET['page']) && $i == 1) {
                                    $active = "active";
                                }
                            }
                            echo '<a href="?mod=admin&act=manageproduct&page=' . $i . '" class="p-pagination-item ' . $active . '">' . $i . '</a>';
                        }
                    } else {
                        echo "";
                    }
                    ?>

                    <a href="?mod=admin&act=manageproduct&page=<?php
                    if (isset($_GET['page']) && ($_GET['page'] < ceil($allProduct->total / 10))) {
                        echo $_GET['page'] + 1;
                    } else {
                        echo ceil($allProduct->total / 10);
                    } ?>" class="p-pagination-item next-page <?php
                     if (isset($_GET['page']) && (($_GET['page'] == ceil($allProduct->total / 10)))) {
                         echo "disabled";
                     }
                     ?>">Sau</a>
                </div>
            </div>
            <div class="shop-pro-body">
                <div class="shop-pro-body-wrapper">
                    <div class="shop-pro-nav">
                        <div class="shop-pro-item">
                            <div class="shop-pro-info">
                                <input type="checkbox">
                                <div class="shop-pro-info-wrapper">
                                    <div class="shop-pro-nav-title">Tên</div>
                                </div>
                            </div>
                            <div class="shop-pro-sku">
                                <div class="shop-pro-nav-title">SKU</div>
                            </div>
                            <div class="shop-pro-type">
                                <div class="shop-pro-nav-title">Loại</div>
                            </div>
                            <div class="shop-pro-price">
                                <div class="shop-pro-nav-title">Giá</div>
                            </div>
                            <div class="shop-pro-quantity">
                                <div class="shop-pro-nav-title">Số lượng</div>
                            </div>
                            <div class="shop-pro-balance">
                                <div class="shop-pro-nav-title">Doanh số</div>
                            </div>
                            <div class="shop-pro-status">
                                <div class="shop-pro-nav-title">Trạng thái</div>
                            </div>
                            <div class="shop-pro-action">
                                <div class="shop-pro-nav-title">Hành động</div>
                            </div>
                        </div>
                    </div>
                    <div class="shop-pro-list">
                        <?php if (isset($allProduct) && isset($allProduct->status) && is_array($allProduct->result) > 0) {

                            foreach ($allProduct->result as $key => $value) { ?>
                                <!-- item -->
                                <div class="shop-pro-item">
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
                                                <img src="assest/upload/<?= $value['image'] ?>" alt="">
                                            </div>
                                            <div class="shop-pro-info-right">
                                                <div class="shop-pro-info-name">
                                                    <?= $value['namePro'] ?>
                                                </div>
                                                <div class="shop-pro-info-sku">
                                                    SKU: <span>
                                                        <?= $value['id'] ?>
                                                    </span>
                                                </div>
                                                <div class="shop-pro-info-action">
                                                    <a href="?mod=page&act=detail&id=<?= $value['id'] ?>"
                                                        class="shop-pro-info-view" title="View detail">
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
                                        <?= $value['id'] ?>
                                    </div>
                                    <div class="shop-pro-type">
                                        <?= $value['nameCategory'] ?>
                                    </div>
                                    <div class="shop-pro-price fm-price">
                                        <?= $value['price'] ?>
                                    </div>
                                    <div class="shop-pro-quantity">
                                        <?= $value['quantity'] ?>
                                    </div>
                                    <div class="shop-pro-balance">
                                        <?= $value['price'] * $value['sold'] ?>
                                    </div>
                                    <div class="shop-pro-status" title="Waiting">
                                        <i class="fa-regular fa-clock"></i>
                                        <!-- <i class="fa-regular fa-circle-check"></i> -->
                                        <!-- <i class="fa-regular fa-circle-xmark"></i> -->
                                    </div>
                                    <div class="shop-pro-action">
                                        <a href="?mod=admin&act=addproduct&type=edit&idPro=<?= $value['id'] ?>"
                                            class="shop-pro-edit" title="Edit">
                                            <i class="fa-regular fa-pen-to-square"></i>
                                        </a>
                                        <a href="?mod=admin&act=manageproduct&type=delete&idPro=<?= $value['id'] ?>"
                                            class="shop-pro-delete delete-product" title="Delete">
                                            <i class="fa-regular fa-trash-can"></i>
                                        </a>
                                    </div>
                                </div>
                            <?php }
                        } else {
                            echo '<div class="no-data">No product found!</div>';
                        }
                        ?>



                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
</div>
</div>
<script>
    $(function () {
        $("#spanLink").click(function () {
            console.log("okok")
            $.ajax('?mod=admin&act=manageproduct&do=swap');
        });
    });
</script>