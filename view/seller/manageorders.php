<!-- main -->
<main class="shop-main">
    <!-- content -->
    <div class="shop-main-content">
        <div class="shop-top">
            <div class="shop-title">Quản lý đơn hàng</div>
        </div>
        <div class="shop-orders">
            <div class="s-orders-top">
                <div class="s-orders-filter">
                    <div class="s-orders-filter-left">
                        <div class="s-orders-filter-select">
                            <input type="text" placeholder="Tìm kiếm...">
                        </div>
                        <div class="s-orders-filter-select">
                            <select name="" id="">
                                <option value="">Mã đơn hàng</option>
                                <option value="">SKU</option>
                            </select>
                        </div>
                        <div class="s-orders-filter-select">
                            <select name="" id="">
                                <option value="">Mã đơn hàng</option>
                                <option value="">SKU</option>
                            </select>
                        </div>
                    </div>
                    <div class="s-orders-filter-right">
                        <div class="s-orders-filter-btn order-btn-search">
                            <i class="fa-solid fa-magnifying-glass"></i>
                            <span>Tìm kiếm</span>
                        </div>
                        <div class="s-orders-filter-btn order-btn-reset">
                            <span>Đặt lại</span>
                        </div>
                    </div>
                </div>
                <div class="s-orders-option">
                    <div class="s-orders-option-item" type="confirmed">
                        <span>Xác nhận đơn hàng</span>
                        <!-- <i class="fa-solid fa-angle-down"></i> -->
                    </div>
                    <div class="s-orders-option-item" type="success">
                        <span>Xác nhận đã giao</span>
                        <!-- <i class="fa-solid fa-angle-down"></i> -->
                    </div>
                    <div class="s-orders-option-item" type="cancel">
                        <span>Hủy đơn hàng</span>
                        <!-- <i class="fa-solid fa-angle-down"></i> -->
                    </div>
                    
                </div>
            </div>
           
            <div class="s-orders-body">
                <div class="s-ordes-nav">
                    <div class="s-order-item" >
                        <div class="s-order-left">
                            <div class="s-orders-input">
                                <input type="checkbox">
                                <div class="s-orders-view">
                                    <div class="s-orders-title">Chi tiết</div>
                                </div>
                            </div>
                            <div class="s-orders-time">
                                <div class="s-orders-title">Ngày</div>
                            </div>
                            
                            <div class="s-orders-code">
                                <div class="s-orders-title">Code</div>
                            </div>

                        </div>
                        <div class="s-order-right">
                            <!-- <div class="s-orders-user">
                                <div class="s-orders-title">Tên</div>
                            </div>
                            <div class="s-orders-phone">
                                <div class="s-orders-title">Số ĐT</div>
                            </div> -->
                            <div class="s-orders-payment">
                                <div class="s-orders-title">Thanh toán</div>
                            </div>
                            <div class="s-orders-status">
                                <div class="s-orders-title">Trạng thái</div>
                            </div>
                          
                            <div class="s-orders-status">
                            <!-- s-orders-total-price  -->
                                <div class="s-orders-title">Tổng</div>
                            </div>
                            <div class="s-orders-phone">
                                <div class="s-orders-title">Hành động</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="s-orders-list">
                    <?php
                    if (isset($resultOrder) && is_array($resultOrder->result)) {
                        $status =['Order Placed'=>["s1"=>"Chờ xác nhận",'s2'=>'Chưa thanh toán'],'Delivering'=>["s1"=>"Đang giao hàng",'0'=>'Chưa thanh toán'],'To Rate'=>['s1'=>"Đã giao hàng",'s2'=>'Đã thanh toán'],'cancel'=>['s1'=>"Đã hủy",'s2'=>"Đã hủy"]];
                        foreach ($resultOrder->result as $key => $value) { ?>
                            <div class="s-order-item">
                                <div class="s-order-left">
                                    <div class="s-orders-input">
                                        <input type="checkbox" class="order-input-check" orderid ="<?=$value['id'] ?>" >
                                        <div class="s-orders-view">
                                            <a href="?mod=seller&act=detailorder&id=<?=$value['id'] ?>" class="s-orders-view-wrapper">
                                                <i class="fa-solid fa-eye"></i>
                                                <span>View</span>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="s-orders-time"><?=explode(" ",$value['created_at'])[0] ?></div>
                                    
                                    <div class="s-orders-code">#000<?=$value['id'] ?></div>

                                </div>
                                <div class="s-order-right">
                                    <!-- <div class="s-orders-user"><?=$value['name_receiver'] ?></div> -->
                                    <!-- <div class="s-orders-phone"><?=$value['phone_number'] ?></div> -->
                                    <div class="s-orders-payment <?=$value['payment_status']==1?'green':"confirmed" ?>"><?=$value['payment_status']==1?"Đã thanh toán":"Chưa thanh toán" ?></div>
                                    <div class="s-orders-status <?=$value['status'] ?>">
                                    <?=$status[$value['status']]['s1'] ?>
                                    </div>
                                    
                                    <div class="s-orders-total-price s-orders-status fm-price"><?=$value['total'] ?></div>
                                    <div class="s-orders-user btn-or-action-wrapper">
                                        <?php
                                        if($value['status']=='Order Placed'){
                                            echo '<button class="btn-or-action" onclick="order_accept('.$value['id'].')">Xác nhận</button>
                                            <button class="btn-or-action" onclick="order_cancel('.$value['id'].')">Hủy</button>';

                                        }elseif($value['status']=='Cancelled'){
                                            echo '<button class="btn-or-action" disabled>Đã hủy</button>';
                                        }
                                        elseif($value['status']=='Delivering'){
                                            echo '<button title="Xem link" class="btn-or-action"><i class="fa-solid fa-link"></i></button>';
                                        }
                                        elseif($value['status']=='To Rate'){
                                            // '
                                            echo '<button class="btn-or-action" disabled>Đã Giao</button>';
                                        }
                                        else{
                                            echo '<button title="Xem link" class="btn-or-action"><i class="fa-solid fa-link"></i></button>';
                                        }
                                        ?>
                                        
                                        <!-- // <i class="fa-solid fa-ban"></i> -->
                                        <!-- <button class="btn-or-action"><i class="fa-solid fa-link"></i></button> -->
                                        
                                    </div>
                                </div>
                            </div>
                        <?php }
                    }else{
                        echo '<div class="no-orders">Không có đơn hàng nào!</div>';
                    }
                    ?>
                   
                 
                </div>
                <!-- <div class="p-pagination" style="margin-top:40px">
                    <div class="p-pagination-left">
                        <span>
                            (<span class="count-product">0</span>/20)
                            sản phẩm
                        </span>
                        <div>|</div>
                        <span>
                            (<span class="current-page">1</span>/
                            <span class="total-page">6</span>) trang
                        </span>
                    </div>
                    <div class="p-pagination-right">
                        <div class="p-pagination-item previous-page">
                            Trước
                        </div>
                        <div class="p-pagination-item">1</div>
                        <div class="p-pagination-item">2</div>
                        <div class="p-pagination-item">3</div>
                        <div class="p-pagination-item next-page">Sau</div>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
</main>
</div>
</div>