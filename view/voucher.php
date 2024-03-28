<link rel="stylesheet" href="src/css/custom_profile.css">
<div class="address-main address voucher">

    <!-- <div class="pro-b-r-top address-title">
        <p class="pro-title">Voucher của tôi</p>

    </div> -->
    <div class="pro-b-r-body voucher_container">
        <form method="POST" action="?mod=profile&act=voucher<?=(isset($_GET['type'])?"&type=".$_GET['type']:"")?>" class="voucher_search">
            <div class="voucher_search_titel">Mã voucher</div>
            <input type="text" placeholder="Nhập mã voucher tại đây" name="search_voucher" value="<?=isset($_POST['search_voucher']) ?$_POST['search_voucher'] :"" ?>" class="voucher_search_input">
            <input type="submit" class="voucher_search_btn" name="btn_submit_search" value="Tìm kiếm"></input>
        </form>
        <div class="voucher_nav">
            <a href="?mod=profile&act=voucher" class="voucher_nav_item <?= $type == 'all' ? "active" : "" ?>">Tất
                cả <?=($type=='all')? "(".count($all_voucher->result).")" :""?></a>
            <a href="?mod=profile&act=voucher&type=not_use"
                class="voucher_nav_item <?= $type == 'not_use' ? "active" : "" ?>">Chưa dùng <?=($type=='not_use')? "(".count($all_voucher->result).")" :""?></a>
            <a href="?mod=profile&act=voucher&type=used"
                class="voucher_nav_item <?= $type == 'used' ? "active" : "" ?>">Đã
                dùng <?=($type=='use')? "(".count($all_voucher->result).")" :""?></a>
            <a href="?mod=profile&act=voucher&type=expired"
                class="voucher_nav_item <?= $type == 'expired' ? "active" : "" ?>">Đã hết hạn <?=($type=='expired')? "(".count($all_voucher->result).")" :""?></a>
        </div>
        <div class="voucher_body">
            <div class="shop-voucher">
                <div class="shop-voucher-body">
                    <?php
                    if (count($all_voucher->result) > 0) {
                        foreach ($all_voucher->result as $key => $value) { ?>
                            <div class="shop-voucher-item">
                                <div class="shop-voucher-wrapper">
                                    <div class="shop-voucher-boder">
                                        <div class="shop-voucher-left">
                                            <div class="shop-voucher-text1"><?= $value['label']?></div>
                                            <div class="shop-voucher-text2" style="display:flex">Đơn tối thiểu: <div class="fm-price"><?= $value['minimum_price']?></div></div>
                                            <div class="shop-voucher-text3" style="display:flex !importaint" >Giảm đến: <div class="fm-price"><?= $value['discount_amount']?></div></div>
                                            <div class="shop-voucher-text1"style="margin:4px 0" >Code: <?= $value['code']?></div>
                                            <div class="shop-voucher-text4">HSD: <?= explode(" ",$value['date_end'])[0]?></div>
                                        </div>
                                        <div class="shop-voucher-right">
                                            <div class="shop-voucher-btn"><?= $value['status']?></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php }
                    } else {
                        echo '<div class="no-product">Không có voucher nào!</div>';
                    }

                    ?>

                </div>
            </div>
        </div>
    </div>



</div>
<!-- ===== -->
</div>
</div>
</main>