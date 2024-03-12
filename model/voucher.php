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
        if (strlen($code) != 10) {
            return new Response(false, 'Yêu cầu nhập 5 mã code!');
        }
        $check_code = $this->db->select("SELECT * from voucher where code ='$code'")->fetchAll();
        if (count($check_code) > 0) {
            return new Response(false, 'Mã code đã tồn tại! Vui lòng nhập mã khác.');
        }
        $user_id = Session::get('id');
        $shop_id = $this->db->select("SELECT id from shop where user_id = '$user_id'")->fetchColumn();

        $this->db->insert("INSERT voucher (label,code,type,date_start,date_end,discount_amount,quantity, minimum_price, shop_id)
         VALUES
        ('$label','$code','Shop','$date_start','$date_end','$discount_amount','$quantity','$minimum_price','$shop_id')
        ");


        return new Response(true, 'Bạn đã tạo voucher thành công!');

    }

    public function get_voucher($status = '',$page=1,$limit=20,$search="")
    {
        $isLogin = Session::get("isLogin");
        if ($isLogin != true) {
            return new Response(false, "Vui lòng đăng nhập", "", "");
        }

        $user_id = Session::get('id');
        $shop_id = $this->db->select("SELECT id from shop where user_id = '$user_id'")->fetchColumn();

        $sql_status = "";
        switch ($status) {
            case 'continuing':
                    $sql_status =" AND date_start <= now() AND date_end >= now()";
                break;
            case 'upcoming':
                $sql_status =" AND date_start > now() ";
                break;
            case 'finished':
                $sql_status =" AND  date_end < now()";
                break;

            default:
                # code...
                break;
        }
        if(!empty($search)){
            $search = " AND code like '%$search%'";
        }

        $result = $this->db->select("SELECT * FROM voucher where shop_id = '$shop_id' $sql_status $search order by created_at DESC ")->fetchAll();


        return new Response(true, "success", $result);

    }
    public function count_voucher_used($voucher_id)
    {
        return $this->db->select("SELECT count(*)  FROM user_voucher where voucher_id ='$voucher_id'")->fetchColumn();
    }
    public function delete_voucher($id){
        if(empty($id)){
            return new Response(false,'Missing parameter');
        }
        $this->db->delete("DELETE FROM user_voucher WHERE voucher_id = '$id'");
        $this->db->delete("DELETE FROM voucher where id = '$id'");
        return new Response(true,'Xóa voucher thành công!');
    }

}



?>