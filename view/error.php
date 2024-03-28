<?php
// session_start();
include_once "lib/session.php";
// Session::checkSession();
include_once "model/cart.php";

$classCart = new Cart();
$cart_user = $classCart->get_cart_user();
include_once 'view/inc/header.php';
?>
<link rel="stylesheet" href="./src/css/error.css">
<section class="page_404">
    <div class="">
        <div class="">
            <div class="col-sm-12 ">
                <div class="col-sm-10 col-sm-offset-1  text-center">
                    <div class="four_zero_four_bg">
                        <h1 class="text-center er-404">404</h1>
                    </div>
                    <div class="contant_box_404">
                        <h3 class="h2">
                            Look like you're lost
                        </h3>
                        <p>the page you are looking for not avaible!</p>
                        <a href="./" class="link_404">Go to Home</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
include_once 'view/inc/footer.php';
?>