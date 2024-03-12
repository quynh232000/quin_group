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
        updated_at = now() 
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
             updated_at = now()
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
    // function test
    public function test($any)
    {
        echo "<pre>";
        var_dump($any);
        die();
    }

    public function get_info_shop($uuid)
    {
        $result = $this->db->select("select * from shop where uuid = '$uuid'")->fetch();
        if ($result) {
            return new Response(true, 'success', $result);
        } else {
            return new Response(false, 'fail');
        }
    }
}



?>