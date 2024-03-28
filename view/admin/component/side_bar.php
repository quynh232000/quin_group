<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">

    <li class="nav-item">
      <a class="nav-link" href="?mod=admin&act=dashboard">
        <i class="menu-icon mdi mdi-floor-plan"></i>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>

    <!-- <li class="nav-item nav-category">Quản lí danh mục</li>
    <li class="nav-item">
      <a class="nav-link" href="?mod=admin&act=mn_settings_cat">
        <i class="mdi mdi-grid-large menu-icon"></i>
        <span class="menu-title">Danh mục</span>
      </a>
    </li> -->

    <li class="nav-item nav-category">Quản lí danh mục</li>
    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
        <i class="mdi mdi-grid-large menu-icon"></i>
        <span class="menu-title">Danh mục</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="ui-basic">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="?mod=admin&act=mn_settings_cat">Cài đặt danh mục</a></li>
          <li class="nav-item"> <a class="nav-link" href="?mod=admin&act=mn_deleted_cat">Danh mục đã xóa</a></li>
        </ul>
      </div>
    </li>


    <li class="nav-item nav-category">Quản lí đơn hàng</li>


    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="#order-elements" aria-expanded="false" aria-controls="order-elements">
        <i class="menu-icon mdi mdi-card-text-outline"></i>
        <span class="menu-title">Đơn hàng</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="order-elements">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"><a class="nav-link" href="?mod=admin&act=mn_all_order">Tất cả đơn hàng</a></li>
          <li class="nav-item"><a class="nav-link" href="?mod=admin&act=mn_processcing_order">Đơn hàng chờ duyệt</a></li>
          <li class="nav-item"><a class="nav-link" href="?mod=admin&act=mn_delivered_order">Đơn hàng đã giao</a></li>
          <li class="nav-item"><a class="nav-link" href="?mod=admin&act=mn_returned_order">Đơn hàng đã trả hàng</a></li>
        </ul>
      </div>
    </li>


    <li class="nav-item nav-category">Quản lí sản phẩm</li>

    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="#product-elements" aria-expanded="false" aria-controls="product-elements">
        <i class="menu-icon mdi mdi mdi-barcode"></i>
        <span class="menu-title">Sản phẩm</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="product-elements">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"><a class="nav-link" href="?mod=admin&act=mn_all_products&page=1">Tất cả sản phẩm</a></li>
          <li class="nav-item"><a class="nav-link" href="?mod=admin&act=mn_inventory_products">Sản phẩm tồn kho</a></li>
          <li class="nav-item"><a class="nav-link" href="?mod=admin&act=mn_circulating_product">Sản phẩm đang lưu hành</a></li>
          <li class="nav-item"><a class="nav-link" href="?mod=admin&act=mn_trending_product">Sản phẩm bán chạy nhất</a></li>
        </ul>
      </div>
    </li>


    <li class="nav-item nav-category">Quản lí Voucher</li>

    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="#voucher-basic" aria-expanded="false" aria-controls="voucher-basic">
        <i class="menu-icon mdi mdi-gift"></i>
        <span class="menu-title">Ưu đãi, Voucher</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="voucher-basic">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="?mod=admin&act=mn_all_cat">Tất cả voucher</a></li>
          <li class="nav-item"> <a class="nav-link" href="?mod=admin&act=mn_addNew_cat">Thêm voucher</a></li>
          <li class="nav-item"> <a class="nav-link" href="?mod=admin&act=mn_deleted_cat">Quản lí voucher seller</a></li>
        </ul>
      </div>
    </li>

    <li class="nav-item nav-category">Quản lí User</li>
    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="#form-elements" aria-expanded="false" aria-controls="form-elements">
        <i class="menu-icon mdi mdi-account-circle-outline"></i>
        <span class="menu-title">User</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="form-elements">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"><a class="nav-link" href="?mod=admin&act=mn_all_user&role=All&page=1">Tất cả user</a></li>
          <li class="nav-item"><a class="nav-link" href="?mod=admin&act=mn_user_detail">Chi tiết User</a></li>
        </ul>
      </div>
    </li>

    <li class="nav-item nav-category">Lưu lượng truy cập</li>

    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="#traffic-elements" aria-expanded="false" aria-controls="traffic-elements">
        <i class="menu-icon mdi mdi-traffic-light"></i>
        <span class="menu-title">Traffic</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="traffic-elements">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"><a class="nav-link" href="?mod=admin&act=mn_all_traffic">Tổng lưu lượng truy cập</a></li>
          <li class="nav-item"><a class="nav-link" href="?mod=admin&act=mn_traffic_detail">Lưu lượng truy cập hôm nay</a></li>
        </ul>
      </div>
    </li>

  </ul>
</nav>