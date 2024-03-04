<!-- main -->
<main class="orderhistory">
    <div class="h-wrapper">
        <div class="h-title">
            Thông tin đơn hàng đã mua
        </div>
        <div class="h-report">
            <div class="h-report-left">
                <i class="fa-solid fa-info"></i>
                <span>
                    Danh sách đơn hàng đã mua từ 12/8/2023 - 30/12/2023
                </span>
            </div>
            <div class="h-report-right">
                Phản hổi/ Đóng góp ý kiến
            </div>
        </div>
        <div class="h-contain">
            <div class="h-nav">
                <div class="h-item">
                    <div class="h-item-left">
                        <div class="h-item-id">
                            <div class="h-item-title">
                                Mã đơn hàng
                            </div>
                        </div>
                        <div class="h-item-pro">
                            <div class="h-item-title">
                                Sản phẩm
                            </div>
                        </div>
                    </div>
                    <div class="h-item-right">
                        <div class="h-item-price">
                            <div class="h-item-title">
                                Giá
                            </div>
                        </div>
                        <div class="h-item-date">
                            <div class="h-item-title">
                                Ngày đặt mua
                            </div>
                        </div>
                        <div class="h-item-status">
                            <div class="h-item-title">
                                Trạng thái
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="h-list">
                <?php
                if (isset($allOrder) && $allOrder->status) {
                    if (count($allOrder->result) > 0) { 
                        $status =['new'=>["s1"=>"Chờ xác nhận",'s2'=>'Chưa thanh toán'],'confirmed'=>["s1"=>"Đang giao hàng",'s2'=>'Chưa thanh toán'],'success'=>['s1'=>"Đã giao hàng",'s2'=>'Đã thanh toán'],'cancel'=>['s1'=>"Đã hủy",'s2'=>"Đã hoàn tiền"]];
                        foreach ($allOrder->result as $key => $value) {
                            # code...
                        ?>
                        <div class="h-item">
                            <div class="h-item-left">
                                <div class="h-item-id">
                                    #00<?=$value['sku'] ?>
                                </div>
                                <div class="h-item-pro">
                                    <div class="h-item-img">
                                        <img src="./assest/upload/<?=$value['image'] ?>"
                                            alt="">

                                    </div>
                                    <div class="h-item-info">
                                        <div class="h-item-name"><?=$value['namePro'] ?></div>
                                        <div class="h-item-payment <?=$value['status'] ?>">
                                            <?=$status[$value['status']]['s2'] ?>
                                        </div>
                                        <a href="?mod=page&act=detail&id=<?=$value['productId'] ?>">Xem chi tiết</a>
                                    </div>
                                </div>
                            </div>
                            <div class="h-item-right">
                                <div class="h-item-price ">
                                    
                                    <div class="fm-price"><?=($value['price']*$value['quantity']) ?></div>
                                    <div>x<?=$value['quantity'] ?></div>
                                </div>
                                <div class="h-item-date"><?=explode(" ",$value['createdAt'])[0] ?></div>
                                <div class="h-item-status <?=$value['status'] ?>"><?php 
                                    echo $status[$value['status']]['s1']
                                ?></div>
                            </div>
                        </div>
                    <?php } }
                } else {
                    echo '<div class="no-orders">Không có đơn hàng nào!</div>';
                }
                ?>
               

            </div>
        </div>
    </div>
</main>
<!-- main -->
</div>
</div>
</main>