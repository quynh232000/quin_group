<?php
    include "../inc/headerAdmin.php";
?>

        
        <div class="shop shop-no-bg delivery-main">
            <div class="wrapper">
                 <!-- main sidebar -->
                 <?php 
                    include "../inc/sidebarAdmin.php";
                ?>
                <!-- main -->
                <main class="shop-main">
                    <!-- content -->
                    <div class="shop-main-content">
                        <div class="shop-top">
                            <div class="shop-title">Manage delivery</div> 
                            <div class="shop-delivery-top">
                                <div class="shop-delivery-top-select">
                                    <select name="" id="">
                                        <option value="">Vietnamese</option>
                                        <option value="">Vietnamese</option>
                                    </select>
                                </div>
                                <div class="shop-delivery-top-add">
                                    Add shipping unit
                                </div>
                            </div>
                        </div>
                        <div class="shop-delivery">
                           <div class="s-delivery-nav">
                                <div class="s-delivery-item">
                                    <div class="s-delivery-no">No.</div>
                                    <div class="s-delivery-name">Name shipping</div>
                                    <div class="s-delivery-fee-in">Fee in</div>
                                    <div class="s-delivery-fee-out">Fee out</div>
                                    <div class="s-delivery-weight">Max weight</div>
                                    <div class="s-delivery-view">Detail</div>
                                </div>
                           </div>
                           <div class="s-dellivery-list">
                                <!-- item -->
                                <div class="s-delivery-item">
                                    <div class="s-delivery-no">01 </div>
                                    <div class="s-delivery-name">GHTK </div>
                                    <div class="s-delivery-fee-in">$10</div>
                                    <div class="s-delivery-fee-out">$20</div>
                                    <div class="s-delivery-weight">3kg</div>
                                    <a href="./deliverydetail.php" class="s-delivery-view">Detail</a>
                                </div>
                                <!-- item -->
                                <div class="s-delivery-item">
                                    <div class="s-delivery-no">02 </div>
                                    <div class="s-delivery-name">GHTK </div>
                                    <div class="s-delivery-fee-in">$10</div>
                                    <div class="s-delivery-fee-out">$20</div>
                                    <div class="s-delivery-weight">3kg</div>
                                    <a href="./deliverydetail.php" class="s-delivery-view">Detail</a>
                                </div>
                                 <!-- item -->
                                 <div class="s-delivery-item">
                                    <div class="s-delivery-no">03 </div>
                                    <div class="s-delivery-name">GHTK </div>
                                    <div class="s-delivery-fee-in">$10</div>
                                    <div class="s-delivery-fee-out">$20</div>
                                    <div class="s-delivery-weight">3kg</div>
                                    <a href="./deliverydetail.php" class="s-delivery-view">Detail</a>
                                </div>
                                 <!-- item -->
                                 <div class="s-delivery-item">
                                    <div class="s-delivery-no">04 </div>
                                    <div class="s-delivery-name">GHTK </div>
                                    <div class="s-delivery-fee-in">$10</div>
                                    <div class="s-delivery-fee-out">$20</div>
                                    <div class="s-delivery-weight">3kg</div>
                                    <a href="./deliverydetail.php" class="s-delivery-view">Detail</a>
                                </div>
                                 <!-- item -->
                                 <div class="s-delivery-item">
                                    <div class="s-delivery-no">05</div>
                                    <div class="s-delivery-name">GHTK </div>
                                    <div class="s-delivery-fee-in">$10</div>
                                    <div class="s-delivery-fee-out">$20</div>
                                    <div class="s-delivery-weight">3kg</div>
                                    <a href="./deliverydetail.php" class="s-delivery-view">Detail</a>
                                </div>
                                 <!-- item -->
                                 <div class="s-delivery-item">
                                    <div class="s-delivery-no">06 </div>
                                    <div class="s-delivery-name">GHTK </div>
                                    <div class="s-delivery-fee-in">$10</div>
                                    <div class="s-delivery-fee-out">$20</div>
                                    <div class="s-delivery-weight">3kg</div>
                                    <a href="./deliverydetail.php" class="s-delivery-view">Detail</a>
                                </div>
                                 <!-- item -->
                                 <div class="s-delivery-item">
                                    <div class="s-delivery-no">07 </div>
                                    <div class="s-delivery-name">GHTK </div>
                                    <div class="s-delivery-fee-in">$10</div>
                                    <div class="s-delivery-fee-out">$20</div>
                                    <div class="s-delivery-weight">3kg</div>
                                    <a href="./deliverydetail.php" class="s-delivery-view">Detail</a>
                                </div>
                           </div>
                        </div>
                    </div>
                    <div class="modal-delivery">
                        <div class="modal-delivery-wrapper">
                            <div class="m-deli-btn-close">
                                <i class="fa-solid fa-circle-xmark"></i>
                            </div>
                            <div class="m-deli-row">
                                <div class="m-deli-group">
                                    <label for=" ">Name delivery unit</label>
                                    <div class="m-deli-input">
                                        <input type="text" placeholder="$10">
                                    </div>
                                </div>
                            </div>
                            <div class="m-deli-row">
                                <div class="m-deli-group w-50">
                                    <label for=" ">Inner city prices</label>
                                    <div class="m-deli-input">
                                        <input type="text" placeholder="$10">
                                    </div>
                                </div>
                                <div class="m-deli-group w-50">
                                    <label for=" ">Max weight</label>
                                    <div class="m-deli-input">
                                        <input type="text" placeholder="3kg">
                                    </div>
                                </div>
                                <div class="m-deli-group">
                                    <div class="m-deli-input">
                                        <input type="text" placeholder="Detail">
                                    </div>
                                </div>
 
                            </div>
                            <div class="m-deli-row">
                                <div class="m-deli-group w-50">
                                    <label for=" ">Outer city prices</label>
                                    <div class="m-deli-input">
                                        <input type="text" placeholder="$10">
                                    </div>
                                </div>
                                <div class="m-deli-group w-50">
                                    <label for=" ">Max weight</label>
                                    <div class="m-deli-input">
                                        <input type="text" placeholder="3kg">
                                    </div>
                                </div>
                                <div class="m-deli-group">
                                    <div class="m-deli-input">
                                        <input type="text" placeholder="Detail">
                                    </div>
                                </div>
                            </div>
                            <div class="m-deli-group">
                                <div class="m-deli-btn">
                                    Add shipping unit
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
<?php
    include "../inc/footerAdmin.php";
?>