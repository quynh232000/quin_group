<!-- footer -->
<footer>
    <div class="l-footer">
        <div class="l-footer-wrapper">
            <div class="l-footer-item">
                <div class="l-footer-title">
                    THÔNG TIN LIÊN HỆ
                </div>
                <div class="l-footer-child l-footer-child-edit">
                    <i class="fa-solid fa-headset"></i>
                    <div class="l-footer-child-info l-footer-child-info-edit">
                        <span>+84999999901</span>
                    </div>
                </div>
                <div class="l-footer-child l-footer-child-edit">
                    <i class="fa-solid fa-location-dot"></i>
                    <div class="l-footer-child-info l-footer-child-info-edit">
                        1307 Nguyễn Văn Quin, Phường Linh Xuân, Tp.Thủ Đức
                    </div>
                </div>
                <div class="l-footer-child l-footer-child-edit">
                    <i class="fa-solid fa-envelope"></i>
                    <div class="l-footer-child-info l-footer-child-info-edit">
                        quynh232000@gmail.com
                    </div>
                </div>
            </div>

            <div class="l-footer-item">
                <div class="l-footer-title">
                    CHÍNH SÁCH QUIN
                </div>
                <a href="#" class="l-footer-child l-footer-child-edit">
                    Phương thức thanh toán
                </a>
                <a href="#" class="l-footer-child l-footer-child-edit">
                    Chính sách giao hàng
                </a>
                <a href="#" class="l-footer-child l-footer-child-edit">
                    Chính sách đổi trả
                </a>
                <a href="#" class="l-footer-child l-footer-child-edit">
                    Chính sách bảo mật
                </a>
                <a href="#" class="l-footer-child l-footer-child-edit">
                    Điều khoản mua bán
                </a>
                <a href="#" class="l-footer-child l-footer-child-edit">
                    Chính sách giảm giá
                </a>

            </div>

            <div class="l-footer-item">
                <div class="l-footer-title">
                    VỀ CHÚNG TÔI
                </div>
                <a href="#" class="l-footer-child l-footer-child-edit">
                    Câu chuyện của Quin
                </a>
                <a href="#" class="l-footer-child l-footer-child-edit">
                    Tin tức
                </a>
                <a href="#" class="l-footer-child l-footer-child-edit">
                    Tuyển dụng
                </a>
                <a href="#" class="l-footer-child l-footer-child-edit">
                    Sản phẩm
                </a>
                <a href="#" class="l-footer-child l-footer-child-edit">
                    Chương trình Flash Sale
                </a>

            </div>
            <div class="l-footer-item">
                <div class="l-footer-title">
                    THEO DÕI CHÚNG TÔI TRÊN
                </div>
                <div class="l-list-community l-list-community-edit">
                    <a href="#" class="l-footer-child l-footer-child-edit">
                        <i class="fa-brands fa-instagram"></i>
                        <span>QuinShop</span>
                    </a>
                    <a href="#" class="l-footer-child l-footer-child-edit">
                        <i class="fa-brands fa-facebook"></i>
                        <span>Facebook QuinShop</span>
                    </a>
                    <a href="#" class="l-footer-child l-footer-child-edit">
                        <i class="fa-brands fa-tiktok"></i>
                        <span>QuinShop123</span>
                    </a>
                </div>

            </div>

        </div>
        <div class="footer-copy">
            Copyright © 2024 QuinShop
        </div>
    </div>
</footer>
</div>



<div id="snackbar"></div>


<script>
    const VND = new Intl.NumberFormat("vi-VN", {
        style: "currency",
        currency: "VND",
    });
    const prices = document.querySelectorAll(".fm-price")
    prices.forEach(item => {
        item.textContent = VND.format(item.textContent)
    })
</script>
<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
<script src="./src/js/main.js" type="module"></script>
<script src="./src/js/slider.js"></script>

</body>

</html>