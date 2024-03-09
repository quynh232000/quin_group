<?php
include_once "lib/database.php";
include_once "helpers/tool.php";
include_once "model/entity.php";
include_once "lib/session.php";
?>
<?php
class Seller
{
    private $db;
    private $tool;
    private $response;

    public function __construct()
    {
        $this->db = new Database();
        $this->tool = new Tool();
    }
    public function check_seller(){
        if(!(Session::get('isLogin'))){
         header('location: ?mod=profile&act=login&redirect=seller');
        }
        $id = Session::get('id');
        $seller = $this->db->select("SELECT * FROM shop where user_id = '$id'")->fetchAll();
        if(count($seller) ==0){
            $name = Session::get('full_name');
            $icon = "shop_avatar.jpg";
            $user_id = Session::get('id');
            $this->db->insert("INSERT INTO shop(name,icon,user_id)
            VALUES('$name','$icon','$user_id')");
        }
    }
  

}



?>