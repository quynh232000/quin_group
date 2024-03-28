<?php
include_once "lib/database.php";
include_once "helpers/tool.php";
include_once "model/entity.php";
include_once "lib/session.php";
?>
<?php
class LikeProduct
{
    private $db;
    private $tool;
    private $response;

    public function __construct()
    {
        $this->db = new Database();
        $this->tool = new Tool();
    }
    public function dem_like_product($product_id) {
        return $this->db->select("SELECT count(*) FROM like_product WHERE product_id = '$product_id'")->fetchColumn() ?? 0;
    }
    public function check_is_like_product($product_id, $user_id)  {
        $check = $this->db->select("SELECT * FROM like_product WHERE user_id ='$user_id' AND product_id = '$product_id'")->fetchAll();
        return (count($check) >0) ? true : false;
    }
   public function like_product($product_id){
        if(Session::get('isLogin') ==false){
            return new Response(false, "Vui lòng đăng nhập!");
        }
        $user_id = Session::get('id');
        $check_like = $this->db->select("SELECT * FROM like_product WHERE user_id ='$user_id' AND product_id = '$product_id'")->fetchAll();
        if(count($check_like) >0){
            return new Response(false, "You cannot like");
        }
        $this->db->insert("INSERT INTO like_product (user_id, product_id) value('$user_id','$product_id')");
        return new Response(true, "success");
   }
   public function unlike_product($product_id){
    if(Session::get('isLogin') ==false){
        return new Response(false, "Vui lòng đăng nhập!");
    }
    $user_id = Session::get('id');
    $check_like = $this->db->select("SELECT * FROM like_product WHERE user_id ='$user_id' AND product_id = '$product_id'")->fetchAll();
    if(count($check_like) >0){
        $this->db->delete("DELETE FROM like_product where user_id ='$user_id' AND product_id ='$product_id'");
        return new Response(true, "success");
    }
    return new Response(false, "You cannot do it!");
}
    

}



?>