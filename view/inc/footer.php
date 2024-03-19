<!-- footer -->
<footer>
    <div class="l-footer">
        <div class="l-footer-wrapper">
            <div class="l-footer-item">
                <div class="l-footer-title">
                    Thông tin liên hệ
                </div>
                <div class="l-footer-child">
                    <i class="fa-solid fa-headset"></i>
                    <div class="l-footer-child-info">
                        <span>0358723520</span>
                        <span>Call on Order/ Call us 24/7</span>
                    </div>
                </div>
                <div class="l-footer-child">
                    <i class="fa-solid fa-location-dot"></i>
                    <div class="l-footer-child-info">
                       Cv phần mềm Quang Trung, Q.12, HCM, VN
                    </div>
                </div>
                <div class="l-footer-child">
                    <i class="fa-regular fa-envelope"></i>
                    <div class="l-footer-child-info">
                        quynh232000@gmail.com
                    </div>
                </div>
            </div>

            <div class="l-footer-item">
                <div class="l-footer-title">
                    Điều khoản
                </div>
                <a href="#" class="l-footer-child">
                    Trợ giúp
                </a>
                <a href="#" class="l-footer-child">
                    Contact
                </a>
                <a href="#" class="l-footer-child">
                    Chính sách - Bảo mật
                </a>
                <a href="#" class="l-footer-child">
                    Tin tức
                </a>
               
            </div>
            <div class="l-footer-item">
                <div class="l-footer-title">
                    Cộng đồng
                </div>
                <div class="l-list-community" style="display:flex">
                    <a href="https://www.facebook.com/quynh232000/" class="l-footer-child">
                        <i class="fa-brands fa-facebook"></i>
                    </a>
                    <a href="https://mr-quynh.com/" class="l-footer-child">
                        <i class="fa-brands fa-instagram"></i>
                    </a>
                    <a href="https://mr-quynh.com/" class="l-footer-child">
                        <i class="fa-brands fa-twitter"></i>
                    </a>
                    <a href="https://mr-quynh.com/" class="l-footer-child">
                        <i class="fa-brands fa-google"></i>
                    </a>
                    <a href="https://mr-quynh.com/" class="l-footer-child">
                        <i class="fa-brands fa-youtube"></i>
                    </a>
                </div>

            </div>

        </div>
        <div class="footer-copy">
            Copyright © 2024 <a href="https://www.facebook.com/quynh232000/">Mr Quynh</a>
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
    const prices =document.querySelectorAll(".fm-price")
    prices.forEach(item=>{
      item.textContent =VND.format(item.textContent)
    })
</script>
<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
<script src="./src/js/main.js" type="module"></script>
<script src="./src/js/slider.js"></script>

</body>

</html>