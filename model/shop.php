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
    public function update_shop($name, $phone_number, $address, $icon = "")
    {
        // echo $name;
        // return;
        if (($name == "") || ($phone_number == "") || ($address == "")) {
            return new Response(false, "Vui lòng nhập đầy đủ thông tin!", "", "");
        }
        $queryicon = "";
        $fileResult = $this->tool->uploadFile($icon, 'shop/');
        if ($fileResult) {
            $queryicon .= " , icon = '$fileResult'";
        }
        $user_id = Session::get('id');
        $shopinfo = $this->db->select("SELECT * FROM shop WHERE user_id = '$user_id'")->fetch();
        $shop_id =$shopinfo['id'];
        $shop_update = $this->db->update("UPDATE shop SET name ='$name' , phone_number='$phone_number' , address='$address' , updated_at =now() $queryicon WHERE id = '$shop_id' ");
        if($shop_update ==false){
            return new Response(false, "Cập nhật thông tin shop thất bại", "", "", "");
        }
        return new Response(true, "Cập nhật thông tin shop thành công!", "", "", "");
    }
    public function check_shop_info()  {
        $user_id = Session::get('id');
        $shop = $this->db->select("SELECT * from shop where user_id ='$user_id'")->fetch();
        if (($shop['phone_number'] == '') || ($shop['address'] == '') || ($shop['name'] == '')) {
            Session::set('checkshop','Vui lòng cập nhật đầy đủ thông tin!');
            header("location: ?mod=seller&act=setting");
        }
    }



}



?>