<?php
include_once "lib/database.php";
include_once "helpers/tool.php";
include_once "model/entity.php";
include_once "lib/session.php";
?>
<?php
class Shop
{
    private $db;
    private $tool;
    private $response;

    public function __construct()
    {
        $this->db = new Database();
        $this->tool = new Tool();
    }
    public function get_shop_info($shop_id = null)
    {
        if ($shop_id) {
            $shop = $this->db->select("SELECT * FROM shop WHERE id = '$shop_id'")->fetch();
            return new Response(true, "success", $shop);
        } else {
            $user_id = Session::get('id');
            $shop = $this->db->select("SELECT * FROM shop WHERE user_id = '$user_id'")->fetch();
            return new Response(true, "success", $shop);
        }
    }
    public function update_shop(
        $name,
        $phone_number,
        $address_detail,
        $icon = "",
        $province,
        $district,
        $ship_south,
        $ship_north,
        $ship_mid_north,
        $ship_mid_south
    ) {

        if (
            ($name == "") || ($phone_number == "") || ($address_detail == ""
                || ($province == "")
                || ($district == "")
            )
        ) {

            return new Response(false, "Vui lòng nhập đầy đủ thông tin!", "", "");
        }
        $queryicon = "";
        $fileResult = $this->tool->uploadFile($icon, 'shop/');
        if ($fileResult) {
            $queryicon .= " , icon = '$fileResult'";
        }
        $user_id = Session::get('id');
        $shopinfo = $this->db->select("SELECT * FROM shop WHERE user_id = '$user_id'")->fetch();
        $shop_id = $shopinfo['id'];

        $shop_update = $this->db->update("UPDATE shop 
        SET name ='$name' , 
        phone_number = '$phone_number' , 
        address_detail = '$address_detail' ,
        province = '$province',
        district = '$district',
        updated_at = CURRENT_TIMESTAMP
        $queryicon 
        WHERE id = '$shop_id' ");

        if ($shop_update == false) {
            return new Response(false, "Cập nhật thông tin shop thất bại", "", "", "");
        }
        // update fee shipping
        $shopship = $this->db->select("SELECT * FROM shop_shipping_setting where shop_id = '$shop_id'")->fetchAll();
        if (count($shopship) > 0) {

            $this->db->update("UPDATE shop_shipping_setting 
            SET ship_north = '$ship_north',
             ship_south = '$ship_south',
            ship_mid_north = '$ship_mid_north',
             ship_mid_south = '$ship_mid_south',
             updated_at = CURRENT_TIMESTAMP()
            WHERE shop_id = '$shop_id'
            ");
        } else {
            $this->db->insert("INSERT INTO shop_shipping_setting
            (ship_north, ship_south, ship_mid_north, ship_mid_south, shop_id) VALUES
            ('$ship_north','$ship_south','$ship_mid_north','$ship_mid_south','$shop_id')
            ");
        }


        return new Response(true, "Cập nhật thông tin shop thành công!", "", "", "");
    }
    public function check_shop_info()
    {
        $user_id = Session::get('id');
        $shop = $this->db->select("SELECT * from shop where user_id ='$user_id'")->fetch();
        $shop_id = $shop['id'];
        $shopship = $this->db->select("SELECT * FROM shop_shipping_setting WHERE shop_id ='$shop_id'")->fetchAll();
        if (count($shopship) > 0) {
            $shopship = $shopship[0];
            if (
                ($shopship['ship_north'] == "") || ($shopship['ship_mid_north'] == "") || ($shopship['ship_south'] == "") ||
                ($shopship['ship_mid_south'] == "")
            ) {
                Session::set('checkshop', 'Vui lòng cập nhật đầy đủ thông tin!');
                header("location: ?mod=seller&act=setting");
            }
        } else {
            Session::set('checkshop', 'Vui lòng cập nhật đầy đủ thông tin!');
            header("location: ?mod=seller&act=setting");
        }
        if (($shop['phone_number'] == '') || ($shop['address_detail'] == '') || ($shop['name'] == '')) {
            Session::set('checkshop', 'Vui lòng cập nhật đầy đủ thông tin!');
            header("location: ?mod=seller&act=setting");
        }
    }
    // get shipping shop setting
    public function get_shipping_shop()
    {
        $user_id = Session::get('id');
        $shop_id = $this->db->select("SELECT id from shop where user_id ='$user_id'")->fetchColumn();
        $shopship = $this->db->select("SELECT * FROM shop_shipping_setting WHERE shop_id ='$shop_id'")->fetchAll();
        if (count($shopship) > 0) {
            return new Response(true, 'success', $shopship[0]);
        } else {
            return new Response(false, 'fail');
        }
    }

    // get star shop
    public function get_star_shop($shop_id = '')
    {
        if (empty ($id)) {
            $user_id = Session::get('id');
            $shop_id = $this->db->select("SELECT avg(r.level) FROM shop where user_id = '$user_id'")->fetchColumn();
        }
        return $this->db->select("SELECT avg(r.level) 
        FROM product_review  r
        INNER JOIN product p
        on p.id = r.product_id
        where p.shop_id = '$shop_id'")->fetchColumn();
    }

    public function get_info_shop($uuid)
    {
        $result = $this->db->select("select * from shop where uuid = '$uuid'")->fetch();
        // $this->test($result);
        // return $result;
        if ($result) {
            return new Response(true, 'success', $result);
        } else {
            return new Response(false, 'fail');
        }
    }
    public function get_shop_cart_by_product_id($product_id) {
        return $this->db->select("SELECT shop.id,shop.name,shop.icon from product 
        INNER JOIN shop 
        ON product.shop_id = shop.id
        WHERE product.id = '$product_id'
        ")->fetch();
    }
    // ================================ NHUNG ====================================//
    public function get_shop_by_id_product($product_id)
    {
        // Tìm và lấy id shop từ sản phẩm chuyền vào product_id
        $shop_id = $this->db->select("SELECT shop_id FROM product WHERE id = '$product_id'")->fetchColumn();
        // select thông tin shop
        $shop_info = $this->db->select("SELECT * from shop where id = '$shop_id'")->fetch();
        // lấy số lượng sản phẩm của shop
        // self:: là thuộc tính gọi lại các function nằm trong cùng 1 class (ở đây là class Shop) (self:: giống this)
        $count_product = self::dem_san_pham_shop($shop_id);
        // tính xếp hạng sao
        $tb_sao = self::dem_sao_shop($shop_id);
        // người theo dõi
        $follow = self::dem_nguoi_theo_doi_shop($shop_id);
        //  dán nó vòa biến data với các tên tương ứng
        $data['shop_info'] = $shop_info;
        $data['count_product'] = $count_product;
        $data['tb_sao'] = $tb_sao;
        $data['follow'] = $follow;
        // sau đó trả về theo định dạng response cùng với biến data
        return new Response(true, 'success', $data);

    }
    public function dem_san_pham_shop($shop_id)
    {
        //  đếm tất cả sản phẩm có shop_id = shop_id. Nếu không có thì trả về đếm số sản phẩm là 0
        // ?? 0: nếu câu lệnh select không có kết quả thì gán mặc định bằng 0
        return $this->db->select("SELECT count(*) FROM product where shop_id = '$shop_id' AND is_deleted = 0 ")->fetchColumn() ?? 0;
    }
    public function dem_sao_shop($shop_id)
    {
        // tính trung bình sao đánh giá level trong bảng product_preview join với bản product với điều kiện shop_id trong product = $shop_id
        return $this->db->select("SELECT avg(product_review.level)
        FROM product_review
        INNER JOIN product
        ON product.id = product_review.product_id
        WHERE product.shop_id = '$shop_id'
        ")->fetchColumn() ?? 0;
    }
    public function dem_nguoi_theo_doi_shop($shop_id)
    {
        return $this->db->select("SELECT count(*)
        FROM shop_follow
        WHERE shop_follow.shop_id = '$shop_id'
        ")->fetchColumn() ?? 0;
    }
    // ================================ NHUNG ====================================//

}



?>