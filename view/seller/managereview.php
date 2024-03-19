<link rel="stylesheet" href="src/css/shopreview.css">
<main class="shop-main">
    <!-- content -->
    <div class="shop-main-content">
        <div class="shop-top">
            <div class="shop-title">Quản lí đánh giá sản phẩm</div>
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
                <a href="?mod=seller&act=manage_review"
                    class="show-pro-show-item <?= (!isset($_GET['star'])) ? 'active' : "" ?>">
                    Tât cả
                    <span>(<?=$allProduct->total ??0 ?>)</span>
                </a>
                <a href="?mod=seller&act=manage_review&star=5"
                    class="show-pro-show-item <?= (isset($_GET['star']) && $_GET['star'] == 5) ? 'active' : "" ?>">
                    Đánh giá 5 sao
                    <span>(0)</span>
                </a>
                <a href="?mod=seller&act=manage_review&star=4"
                    class="show-pro-show-item <?= (isset($_GET['star']) && $_GET['star'] == 4) ? 'active' : "" ?>">
                    Đánh giá 4 sao
                    <span>(0)</span>
                </a>
                <a href="?mod=seller&act=manage_review&star=3"
                    class="show-pro-show-item <?= (isset($_GET['star']) && $_GET['star'] == 3) ? 'active' : "" ?>">
                    Đánh giá 3 sao
                    <span>(0)</span>
                </a>
                <a href="?mod=seller&act=manage_review&star=2"
                    class="show-pro-show-item <?= (isset($_GET['star']) && $_GET['star'] == 2) ? 'active' : "" ?>">
                    Đánh giá 2 sao
                    <span>(0)</span>
                </a>
                <a href="?mod=seller&act=manage_review&star=1"
                    class="show-pro-show-item <?= (isset($_GET['star']) && $_GET['star'] == 1) ? 'active' : "" ?>">
                    Đánh giá 1 sao
                    <span>(0)</span>
                </a>



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
                    <a href="?mod=seller&act=manage_review&page=<?= isset($_GET['page']) ? $_GET['page'] > 1 ? $_GET['page'] - 1 : 1 : 1 ?>"
                        class="<?php if (!isset($_GET['page']) || $_GET['page'] == 1)
                            echo "disabled"; ?> p-pagination-item previous-page">
                        <i class="fa-solid fa-angles-left"></i>
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
                            echo '<a href="?mod=seller&act=manage_review&page=' . $i . '" class="p-pagination-item ' . $active . '">' . $i . '</a>';
                        }
                    } else {
                        echo "";
                    }
                    ?>

                    <a href="?mod=seller&act=manage_review&page=<?php
                    if (isset($_GET['page']) && ($_GET['page'] < ceil($allProduct->total / 10))) {
                        echo $_GET['page'] + 1;
                    } else {
                        echo ceil($allProduct->total / 10);
                    } ?>" class="p-pagination-item next-page <?php
                     if (isset($_GET['page']) && (($_GET['page'] == ceil($allProduct->total / 10)))) {
                         echo "disabled";
                     }
                     ?>"><i class="fa-solid fa-angles-right"></i></a>
                </div>
            </div>
            <div class="shop-pro-body">
                <div class="shop-pro-body-wrapper">
                    <div class="shop-pro-nav">
                        <div class="shop-pro-item">
                            <div class="review-left">
                                <div class="shop-pro-info">
                                    <div class="shop-pro-info-wrapper">
                                        <div class="shop-pro-nav-title">Thông tin sản phẩm</div>
                                    </div>
                                </div>

                                <div class="shop-pro-type">
                                    <div class="shop-pro-nav-title">Xếp hạng</div>
                                </div>
                            </div>

                            <div class="review-right">
                                <div class="shop-pro-quantity">
                                    <div class="shop-pro-nav-title">Đánh giá</div>
                                </div>
                                <div class="shop-pro-balance">
                                    <div class="shop-pro-nav-title">Người dùng</div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="shop-pro-list">
                        <?php if (isset($allProduct) && isset($allProduct->status) && count($allProduct->result) > 0) {

                            foreach ($allProduct->result as $key => $value) { ?>
                            <?php $review = $classReview->get_random_review_product($value['id']) ?>
                                <!-- item -->
                                <div class="shop-pro-item">
                                    <div class="review-left">
                                        <div class="shop-pro-info">

                                            <div class="shop-pro-info-wrapper">
                                                <div class="shop-pro-info-img">
                                                    <img src="assest/upload/<?= $value['image_cover'] ?>" alt="">
                                                </div>
                                                <div class="shop-pro-info-right">
                                                    <div class="shop-pro-info-name">
                                                        <?= $value['name'] ?>
                                                    </div>
                                                    <div class="shop-pro-info-sku">
                                                        No. <span>
                                                            <?= $value['id'] ?>
                                                        </span>
                                                    </div>
                                                    <div class="shop-pro-info-action">
                                                        <a href="?mod=seller&act=review_detail&id=<?= $value['id'] ?>"
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

                                        <div class="shop-pro-type star">
                                            <?php $avg_rate = $classPro->get_star_product($value['id']) ?? 0 ;  ?>
                                            (<?=$avg_rate ?> / 5)
                                            <div class="list-star">
                                                <?php
                                                if($avg_rate ==0){
                                                    echo 'Chưa có đánh giá nào';
                                                }
                                                for ($i = 0; $i < floor($avg_rate); $i++) {
                                                    echo '<i class="fa-solid fa-star"></i>';
                                                }
                                                if (($avg_rate - floor($avg_rate)) > 0) {
                                                    echo '<i class="fa-regular fa-star-half-stroke"></i>';
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="review-right">
                                        <div class="shop-pro-price review-content">
                                            <?=(($review))? $review['content'] :"Chưa có đánh giá nào"  ?>
                                        </div>
                                        <div class="shop-pro-quantity">
                                        <?=(($review) )? $review['full_name'] :"Chưa có đánh giá nào"  ?>
                                        </div>
                                    </div>

                                </div>
                            <?php }
                        } else {
                            echo '<div class="no-data">Không tìm thấy sản phẩm nào!</div>';
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
            $.ajax('?mod=seller&act=manageproduct&do=swap');
        });
    });
</script>