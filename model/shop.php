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

    /**--------------------------------------------------VINH CAO--------------------------------------------------------------------------- */

    // function test


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

    // shop info: name, icon

    public function get_info_shop($uuid)
    {
        $result = $this->db->select("select * from shop where uuid = '$uuid'")->fetch();
        // $this->test($result);
        if ($result) {
            return new Response(true, 'success', $result);
        } else {
            return new Response(false, 'fail');
        }
    }

    public function get_brands_shop($uuid)
    {
        $result = $this->db->select("
        select distinct p.brand 
        from product p 
        inner join category c 
        on p.category_id = c.id 
        inner join shop s 
        on p.shop_id = s.id
        where s.uuid = '$uuid'
        order by p.brand asc
        ")->fetchAll();
        // $this->test($result);
        if ($result) {
            return new Response(true, 'success', $result);
        } else {
            return new Response(false, 'fail');
        }
    }

    // products

    public function get_product_count_shop($id)
    {
        $result = $this->db->select("select count(*) from product where shop_id = '$id'")->fetchColumn();
        // $this->test($result);
        return $result;
    }

    /* DROP FUNCTION FOLLOWING BECAUSE OF THE LACK OF FOLLOW FIELD IN TABLES USER, SHOP.
    // following

    public function get_following_shop($id)
    {
        $result = $this->db->select("select count(*) from shop_follow where shop_id = '$id'")->fetchColumn();
        return $result;
    }
    */

    // followers

    public function get_followers_shop($id)
    {
        $result = $this->db->select("select count(*), user_id from shop_follow where shop_id = '$id' group by user_id")->fetchAll();
        // $this->test($result);
        return $result;
    }

    // Rating shop (based on product_review)

    public function get_rating_shop($id)
    {
        $result = $this->db->select("select avg(level) as stars, count(*) as votes from product_review pr 
inner join product p on pr.product_id = p.id
inner join shop s on p.shop_id = s.id
where shop_id = '$id';")->fetch();
        // $this->test($result);
        return $result;
    }
    public function get_rating_product($id, $pro_id)
    {
        $result = $this->db->select("select avg(level) as stars, count(*) as votes from product_review pr 
inner join product p on pr.product_id = p.id
inner join shop s on p.shop_id = s.id
where shop_id = '$id' and product_id = '$pro_id'")->fetch();
        // $this->test($result);
        return $result;
    }

    // Voucher

    public function get_voucher_shop($id)
    {
        $result = $this->db->select("select * from voucher where current_timestamp() between date_start and date_end and shop_id = '$id' and quantity > 0 and is_deleted = 0")->fetchAll();
        return $result;
    }

    // Products

    public function get_products_shop($id, $is_sale = false)
    {
        $column_name = "id, name, price, percent_sale, quantity, quantity_sold, status, is_show, type, image_cover, brand, origin, slug, reason, category_id, shop_id";
        if ($is_sale) {
            $query = <<<EOT
            select $column_name from product where quantity > 0 and is_show = 1 and shop_id = '$id' order by percent_sale desc limit 5       
            EOT;
        } else {
            $query = <<<EOT
            select $column_name from product where quantity > 0 and is_show = 1 and shop_id = '$id' order by quantity_sold desc limit 8       
            EOT;
        }
        $result = $this->db->select($query)->fetchAll();
        return $result;
    }
    public function get_products_shop_response($id, $is_sale = false, $query_where = "", $page = 1, $limit = 10, $type_price = "")
    {
        $currentPage = ($page - 1) * $limit;
        $column_name = "id, name, price, percent_sale, quantity, quantity_sold, status, is_show, type, image_cover, brand, origin, slug, reason, category_id, shop_id";
        if ($type_price == 'price-asc') {
            $type_price = ' ,p.price asc ';
        }
        if ($type_price == 'price-desc') {
            $type_price = ' ,p.price desc ';
        }
        if ($is_sale) {
            $query = <<<EOT
            select $column_name from product p where quantity > 0 and is_show = 1 and shop_id = '$id' $query_where order by percent_sale desc $type_price limit $currentPage, $limit       
            EOT;
        } else {
            $query = <<<EOT
            select $column_name from product p where quantity > 0 and is_show = 1 and shop_id = '$id' $query_where order by quantity_sold desc $type_price limit $currentPage, $limit       
            EOT;
        }
        $count_query = "select count(*) from product p where quantity > 0 and is_show = 1 and shop_id = '$id' $query_where";


        $result = $this->db->select($query)->fetchAll();
        $total = $this->db->select($count_query)->fetchColumn();
        return new Response(true, 'success', $result, '', $total);
    }

    // Categories

    public function get_categories_shop($id)
    {
        $result = $this->db->select("
select p.shop_id shop_id, c.name category_name from product p cross join category c where shop_id = '$id' order by  p.quantity_sold desc limit 4")->fetchAll();
        return $result;
    }


    public function get_category_menus_shop($id)
    {
        $this->db->select("SET sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''));");
        $query = "select p.brand, p.category_id, c.parent_id, c.name from product p left join category c on p.category_id = c.id where p.shop_id = '$id' and c.is_deleted = 0 group by c.name order by  p.quantity_sold desc ";
        $result = $this->db->select($query)->fetchAll();
        // $this->test($result);
        return $result;
    }

    // ----------------

    public function get_filtered_products_shop($uuid, $list_id_post = [], $type = "", $brand = "", $price_from = "", $price_to = "", $page = 1, $limit = 8, $type_price = "")
    {
        $currentPage = ($page - 1) * $limit;

        $queryWhere = "";
        if (!empty($type)) $queryWhere .= " AND p.type like '$type' ";
        if (!empty($brand)) $queryWhere .= " AND p.brand like '$brand' ";
        if (!empty($price_from)) $queryWhere .= " AND p.price >= '$price_from' ";
        if (!empty($price_to)) $queryWhere .= " AND p.price <= '$price_to' ";
        if (count($list_id_post) <= 0) {
            $shop_id = $this->db->select("select id from shop where uuid = '$uuid'")->fetchColumn();
            return self::get_products_shop_response($shop_id, false, $queryWhere, $page, $limit, $type_price);
        }

        $list_id_post_string = implode(', ', $list_id_post);
        $query_list_id = $this->db->select("
        WITH RECURSIVE CTE AS (
            SELECT id, parent_id, name
            FROM category
            WHERE parent_id in ($list_id_post_string)  -- Start with the root node ID
            UNION ALL
            SELECT t.id, t.parent_id, t.name
            FROM category t
            INNER JOIN CTE ON t.parent_id = CTE.id
        )
        SELECT * FROM CTE;
        ")->fetchAll();
        foreach ($query_list_id as $item) {
            $list_id_post[] = $item['id'];
        }
        $list_id_post = implode(', ', $list_id_post);
        $id_shop = $this->db->select("select id from shop where uuid = '$uuid'")->fetchColumn();
        if ($type_price == 'price-asc') {
            $type_price = ' ,p.price asc ';
        } else if ($type_price == 'price-desc') {
            $type_price = ' ,p.price desc ';
        } else {
            $type_price = '';
        }

        $query = "
        select 
            p.*, 
            (select avg(pr.level) 
            from product_review pr 
            where pr.product_id = p.id)
        as pro_avg_level 
        from product p inner join category c 
        on p.category_id = c.id 
        where p.shop_id = '$id_shop' 
        and p.category_id in ($list_id_post) 
         $queryWhere
        order by p.quantity_sold desc $type_price limit $currentPage,$limit";



        $count = $this->db->select("select 
            count(*)
        from product p
        where p.shop_id = '$id_shop' 
        and p.category_id in ($list_id_post) 
         $queryWhere ")->fetchColumn();


        return new Response(true, "success", $this->db->select($query)->fetchAll(), '', $count);
    }
    public function get_products_byCate($uuid, $list_id_post = [])
    {
        if (count($list_id_post) <= 0) {
            $shop_id = $this->db->select("select id from shop where uuid = '$uuid'")->fetchColumn();
            return self::get_products_shop_response($shop_id);
        }
        $list_id_post_string = implode(', ', $list_id_post);
        $query_list_id = $this->db->select("
WITH RECURSIVE CTE AS (
    SELECT id, parent_id, name
    FROM category
    WHERE parent_id in ($list_id_post_string)  -- Start with the root node ID
    UNION ALL
    SELECT t.id, t.parent_id, t.name
    FROM category t
    INNER JOIN CTE ON t.parent_id = CTE.id
)
SELECT * FROM CTE;
")->fetchAll();
        foreach ($query_list_id as $item) {
            $list_id_post[] = $item['id'];
        }
        $list_id_post = implode(', ', $list_id_post);
        $id_shop = $this->db->select("select id from shop where uuid = '$uuid'")->fetchColumn();
        $query = "
        select 
            p.*, 
            (select avg(pr.level) 
            from product_review pr 
            where pr.product_id = p.id)
        as pro_avg_level 
        from product p inner join category c 
        on p.category_id = c.id 
        where p.shop_id = '$id_shop' 
        and p.category_id in ($list_id_post) 
        order by  p.quantity_sold desc";
        return new Response(true, "success", $this->db->select($query)->fetchAll());
    }
    // FOLLOW

    public function follow_shop($uuid, $type)
    {
        if (Session::get('isLogin') == false) {
            return new Response(false, 'Vui lòng đăng nhập');
        }
        $user_id = Session::get('id');
        $shop_info = $this->db->select("select id, name from shop where uuid = '$uuid'")->fetch();
        $shop_id = $shop_info['id'];
        $shop_name = $shop_info['name'];
        $check_follow = $this->db->select("select * from shop_follow where shop_id = '$shop_id' and user_id = '$user_id'")->fetchAll();
        if ($type == 'follow') {
            if (count($check_follow) > 0) {
                return new Response(false, 'Something wrong happened!');
            }
            $this->db->insert("INSERT INTO shop_follow(user_id, shop_id) VALUES ('$user_id', '$shop_id')");
            return new Response(true, "Đã theo dõi shop $shop_name");
        } else {
            if (count($check_follow) > 0) {
                $this->db->delete("DELETE FROM shop_follow WHERE shop_id = '$shop_id' and user_id = '$user_id'");
                return new Response(true, "Đã bỏ theo dõi shop $shop_name!");
            } else {
                return new Response(false, 'Something wroong!!');
            }
        }
    }

    public function check_follow_shop($uuid)
    {
        if (Session::get('isLogin') == false) {
            return false;
        }
        $user_id = Session::get('id');
        $shop_id = $this->db->select("select id from shop where uuid = '$uuid'")->fetchColumn();
        $check_follow = $this->db->select("select * from shop_follow where shop_id = '$shop_id' and user_id = '$user_id'")->fetchAll();
        if (count($check_follow) > 0) {
            return true;
        } else {
            return false;
        }
    }

    // VOUCHER

    function check_voucher_user($voucher_id)
    {
        if (Session::get('isLogin') == false) {
            return new Response(false, 'Vui lòng đăng nhập!!!');
        }
        $user_id = Session::get('id');
        $voucher = $this->db->select("select * from user_voucher where voucher_id = '$voucher_id' and user_id = '$user_id'")->fetchAll();
        if (count($voucher) > 0) {
            return new Response(true, 'Success', ['is_used' => $voucher[0]['is_used']]);
        } else {
            return new Response(false, 'Fail');
        }
    }
    function save_voucher($voucher_id)
    {
        if (Session::get('isLogin') == false) {
            return new Response(false, 'Vui lòng đăng nhập!!!');
        }
        $user_id = Session::get('id');
        $voucher = $this->db->select("select * from user_voucher where voucher_id = '$voucher_id' and user_id = '$user_id'")->fetchAll();
        if (count($voucher) > 0) {

            return new Response(false, 'Fail');
        } else {
            $this->db->insert("INSERT INTO user_voucher(user_id, voucher_id) VALUES('$user_id', '$voucher_id')");
            return new Response(true, 'Đã lưu voucher thành công');
        }
    }

    public function get_shop_cart_by_product_id($product_id) {
        return $this->db->select("SELECT shop.id,shop.uuid,shop.name,shop.icon from product 
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



/**--------------------------------------------------VINH CAO--------------------------------------------------------------------------- */


?>