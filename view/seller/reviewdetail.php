<link rel="stylesheet" href="src/css/shopreview_detail.css">
<main class="shop-main">
    <!-- content -->
    <div class="shop-main-content">
        <div class="shop-top">
            <div class="shop-title">Thông tin đánh giá</div>

        </div>
        <div class="shop-pro-content">
            <div class="shop-pro-body">
                <div class="shop-pro-body-wrapper">
                    <div class="shop-pro-nav">
                        <div class="shop-pro-item">
                            <div class="shop-pro-info">
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
                                <div class="shop-pro-nav-title">Số review</div>
                            </div>
                        </div>
                    </div>
                    <div class="shop-pro-list">
                        <?php if (isset($product) && count($product) > 0) { ?>
                            <!-- item -->
                            <div class="shop-pro-item">
                                <div class="shop-pro-info">
                                    <div class="shop-pro-info-wrapper">
                                        <div class="shop-pro-info-img">
                                            <img src="assest/upload/<?= $product['image_cover'] ?>" alt="">
                                        </div>
                                        <div class="shop-pro-info-right">
                                            <div class="shop-pro-info-name">
                                                <?= $product['name'] ?>
                                            </div>
                                            <div class="shop-pro-info-sku">
                                                SKU: <span>
                                                    <?= $product['id'] ?>
                                                </span>
                                            </div>
                                            <div class="shop-pro-info-action">
                                                <a href="?mod=page&act=detail&id=<?= $product['id'] ?>"
                                                    class="shop-pro-info-view" title="View detail">
                                                    <i class="fa-solid fa-eye"></i>
                                                </a>
                                                <div class="shop-pro-info-heart">
                                                    <i class="fa-regular fa-heart"></i>
                                                    <span>
                                                        <?= $listReview->total ?>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="shop-pro-sku">
                                    <?= $product['id'] ?>
                                </div>
                                <div class="shop-pro-type">
                                    <?= $product['nameCategory'] ?>
                                </div>
                                <div class="shop-pro-price fm-price">
                                    <?= $product['price'] ?>
                                </div>
                                <div class="shop-pro-quantity">
                                    <?= $product['quantity'] ?>
                                </div>
                                <div class="shop-pro-balance">
                                    <?= $product['price'] * $product['quantity_sold'] ?>
                                </div>
                                <div class="shop-pro-status" title="Waiting">
                                    <?php
                                    if ($product['status'] == 'New') {
                                        echo '<i  title="Pedding" class="fa-regular fa-clock" ></i>';
                                    } elseif ($product['status'] == 'Activated') {
                                        echo '<i title="Actived" class="fa-regular fa-circle-check" style="color:green"></i>';
                                    } else {
                                        echo '<i title="Rejected" class="fa-regular fa-circle-xmark"></i>';
                                    }
                                    ?>

                                </div>
                                <div class="shop-pro-action">
                                    <?= $listReview->total ?>
                                </div>
                            </div>

                        <?php } else {
                            echo '<div class="no-data">Không tìm thấy sản phẩm nào!</div>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="shop-pro-content r-body">
            <div class="review-title">Đánh giá sản phẩm</div>
            <div class="review-rate">
                <div class="r-count-rate">
                    <span>(</span>

                    <span>
                        <?= $avg_rate ?>
                    </span>
                    <span>/</span>
                    <span>5</span>
                    <span>)</span>
                </div>
                <div class="list-star">
                    <?php
                    for ($i = 0; $i < floor($avg_rate); $i++) {
                        echo '<i class="fa-solid fa-star"></i>';
                    }
                    if (($avg_rate - floor($avg_rate)) > 0) {
                        echo '<i class="fa-regular fa-star-half-stroke"></i>';
                    }
                    ?>
                </div>
            </div>

            <div class="shop-pro-show">
                <a href="?mod=seller&act=review_detail&id=<?= $_GET['id'] ?>"
                    class="show-pro-show-item <?= (!isset($_GET['star'])) ? 'active' : "" ?>">
                    Tất cả
                    <span>(<?=$listReview->total ?>)</span>
                </a>
                <a href="?mod=seller&act=review_detail&id=<?= $_GET['id'] ?>&star=5"
                    class="show-pro-show-item <?= (isset($_GET['star']) && $_GET['star'] == 5) ? 'active' : "" ?>">
                    Đánh giá 5 sao
                    <span>(
                        <?= $clasReview->count_star_by_level($product['id'], 5) ?>)
                    </span>
                </a>
                <a href="?mod=seller&act=review_detail&id=<?= $_GET['id'] ?>&star=4"
                    class="show-pro-show-item <?= (isset($_GET['star']) && $_GET['star'] == 4) ? 'active' : "" ?>">
                    Đánh giá 4 sao
                    <span>(
                        <?= $clasReview->count_star_by_level($product['id'], 4) ?>)
                    </span>
                </a>
                <a href="?mod=seller&act=review_detail&id=<?= $_GET['id'] ?>&star=3"
                    class="show-pro-show-item <?= (isset($_GET['star']) && $_GET['star'] == 3) ? 'active' : "" ?>">
                    Đánh giá 3 sao
                    <span>(
                        <?= $clasReview->count_star_by_level($product['id'], 3) ?>)
                    </span>
                </a>
                <a href="?mod=seller&act=review_detail&id=<?= $_GET['id'] ?>&star=2"
                    class="show-pro-show-item <?= (isset($_GET['star']) && $_GET['star'] == 2) ? 'active' : "" ?>">
                    Đánh giá 2 sao
                    <span>(
                        <?= $clasReview->count_star_by_level($product['id'], 2) ?>)
                    </span>
                </a>
                <a href="?mod=seller&act=review_detail&id=<?= $_GET['id'] ?>&star=1"
                    class="show-pro-show-item <?= (isset($_GET['star']) && $_GET['star'] == 1) ? 'active' : "" ?>">
                    Đánh giá 1 sao
                    <span>(
                        <?= $clasReview->count_star_by_level($product['id'], 1) ?>)
                    </span>
                </a>



            </div>

            <div class="review-list">
                <?php
                if ($listReview->status && (count($listReview->result) > 0)) {
                    foreach ($listReview->result as $key => $value) { ?>
                        <div class="review-item">
                            <div class="r-item-info">
                                <img src="assest/upload/<?= $value['avatar'] ?>" alt="" class="r-item-img">
                                <div class="r-item-right">
                                    <div class="r-item-name">
                                        <?= $value['full_name'] ?>
                                    </div>
                                    <div class="r-item-rate">
                                        <div class="r-teim-star">
                                            <?php
                                            for ($i = 0; $i < floor($value['level']); $i++) {
                                                echo '<i class="fa-solid fa-star"></i>';
                                            }
                                            if (($value['level'] - floor($value['level'])) > 0) {
                                                echo '<i class="fa-regular fa-star-half-stroke"></i>';
                                            }
                                            ?>
                                        </div>
                                        <div class="r-item-date">
                                            <?= explode(' ', $value['updated_at'])[0] ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="r-item-content">
                                <?= $value['content'] ?>
                            </div>
                        </div>
                    <?php }

                } else {
                    echo '<div class="no-product">Chưa có bình luận nào về sản phẩm này</div>';
                }
                ?>
            </div>

            <div class="r-pagination-body">
                <a href="?mod=seller&act=manage_review" class="btn-back">Trở về</a>

                <div class="r-pagination">
                    <?php $starurl = isset($_GET['star']) ? "&star=" . $_GET['star'] : "" ?>
                    <!-- ==== -->
                    <a href="?mod=seller&act=review_detail&id=<?= $_GET['id'] ?><?= $starurl ?>&page=<?= isset($_GET['page']) ? $_GET['page'] > 1 ? $_GET['page'] - 1 : 1 : 1 ?>"
                        class="<?php if (!isset($_GET['page']) || $_GET['page'] == 1)
                            echo "disabled"; ?> r-pagination-item previous-page">
                        <i class="fa-solid fa-angles-left"></i>
                    </a>
                    <?php if (isset($listReview) && isset($listReview->status)) {
                        for ($i = 1; $i < ceil($listReview->total / $limit) + 1; $i++) {
                            $active = "";
                            if (isset($_GET['page']) && $_GET['page'] == $i) {
                                $active = "active";
                            } else {
                                if (!isset($_GET['page']) && $i == 1) {
                                    $active = "active";
                                }
                            }
                            echo '<a href="?mod=seller&act=review_detail&id=' . $_GET['id'] . $starurl . '&page=' . $i . '" class="r-pagination-item '.$active.' ">' . $i . '</a>';
                        }
                    } else {
                        echo "";
                    }
                    ?>
                    <a href="?mod=seller&act=review_detail&id=<?= $_GET['id'] ?><?= $starurl ?>&page=<?php
                    if (isset($_GET['page']) && ($_GET['page'] < ceil($listReview->total / $limit))) {
                        echo $_GET['page'] + 1;
                    } else {
                        echo ceil($listReview->total / $limit);
                    } ?>" class="r-pagination-item next-page <?php
                     if (isset($_GET['page']) && (($_GET['page'] == ceil($listReview->total / $limit)))) {
                         echo "disabled";
                     }
                     ?>"><i class="fa-solid fa-angles-right"></i></a>

                    <!-- === -->

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