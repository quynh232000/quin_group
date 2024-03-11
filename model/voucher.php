<?php
include_once "lib/database.php";
include_once "helpers/tool.php";
include_once "model/entity.php";
include_once "lib/session.php";
?>
<?php
class Voucher
{
    private $db;
    private $tool;
    private $response;

    public function __construct()
    {
        $this->db = new Database();
        $this->tool = new Tool();
    }
    public function create_voucher(
        $label,
        $code,
        $date_start,
        $date_end,
        $discount_amount,
        $quantity,
        $minimum_price
    ) {
        
        if (empty($label) || empty($code) || empty($date_start) || empty($date_end) || empty($discount_amount) || empty($quantity) || empty($minimum_price)) {
            return new Response(false, 'Vui lòng nhập đầy đủ thông tin');
        }
        $user_id = Session::get('id');
        $shop_id = $this->db->select("SELECT id from shop where user_id = '$user_id'")->fetchColumn();

        $this->db->insert("INSERT voucher (label,code,type,date_start,date_end,discount_amount,quantity, minimum_price, shop_id)
         VALUES
        ('$label','$code','Shop','$date_start','$date_end','$discount_amount','$quantity','$minimum_price','$shop_id')
        ");

        return new Response(true,'Bạn đã tạo voucher thành công!');

    }



}



?>