<link rel="stylesheet" href="src/css/checkout_cussess.css">
<div class="checkout_result">
    <div class="checkout_result-body">
        <div class="checkout_result-icon">
            <i class="fa-solid fa-check"></i>
            <span>Đặt hàng thành công!</span>
            <p class="c_text1">Cảm ơn quý khách hàng đã mua  hàng tại <strong>QuinShop</strong></p>
            <p class="c_text2">Đơn hàng của bạn sẽ được sử lý trong thời gian sớm nhất.
                    Trong trường hợp có bất kì thắc mắc nào thì bạn liên hệ số điện thoại <strong>0358723520</strong>. </p>
        </div>
        <div class="checkout_result-btn-wrapper">
            <a href="?mod=profile&act=order_detail&order=<?=isset($_GET['order_uuid'])?$_GET['order_uuid']:""?>" class="checkout_result-btn order">
                <i class="fa-solid fa-truck"></i>
                <span>Theo dõi đơn hàng</span>
            </a>
            <a href="?mod=page&act=home" class="checkout_result-btn">
                <i class="fa-solid fa-house"></i>
                <span>Chở về trang chủ</span>
            </a>
        </div>
    </div>
</div>