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

        if (empty ($label) || empty ($code) || empty ($date_start) || empty ($date_end) || empty ($discount_amount) || empty ($quantity) || empty ($minimum_price)) {
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

    public function get_voucher($status = '', $page = 1, $limit = 20, $search = "")
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
                $sql_status = " AND date_start <= now() AND date_end >= now()";
                break;
            case 'upcoming':
                $sql_status = " AND date_start > now() ";
                break;
            case 'finished':
                $sql_status = " AND  date_end < now()";
                break;

            default:
                # code...
                break;
        }
        if (!empty ($search)) {
            $search = " AND code like '%$search%'";
        }

        $result = $this->db->select("SELECT * FROM voucher where shop_id = '$shop_id' $sql_status $search order by created_at DESC ")->fetchAll();


        return new Response(true, "success", $result);

    }
    public function count_voucher_used($voucher_id)
    {
        return $this->db->select("SELECT count(*)  FROM user_voucher where voucher_id ='$voucher_id'")->fetchColumn();
    }
    public function delete_voucher($id)
    {
        if (empty ($id)) {
            return new Response(false, 'Missing parameter');
        }
        $this->db->delete("DELETE FROM user_voucher WHERE voucher_id = '$id'");
        $this->db->delete("DELETE FROM voucher where id = '$id'");
        return new Response(true, 'Xóa voucher thành công!');
    }
    public function get_voucher_user($type = 'all', $search = "", $shop_id = "")
    {
        if (Session::get('isLogin') == false) {
            return new Response(false, "Vui lòng đăng nhập!");
        }
        $user_id = Session::get('id');
        if ($search != "") {
            $search = " AND voucher.code like  '%" . $search . "%' ";
        }
        $name_status = "Hết hạn";
        switch ($type) {
            case 'not_use':
                $type = " AND user_voucher.is_used = 0 ";
                break;
            case 'used':
                $type = " AND user_voucher.is_used = 1 ";
                $name_status = "Đã dùng";

                break;
            case 'expired':
                $type = " AND now() > voucher.date_end ";
                break;
            case 'can_use':
                $type = " AND now() <= voucher.date_end AND now() >= voucher.date_start AND user_voucher.is_used =0 ";
                break;
            case 'can_use_by_shop':
                $type = " AND now() <= voucher.date_end AND now() >= voucher.date_start AND user_voucher.is_used =0 AND voucher.shop_id = '$shop_id' ";
                break;

            default:
                $type = "";
                break;
        }
        $result = $this->db->select("SELECT voucher.*,
            CASE 
                WHEN now() > voucher.date_end Then '$name_status'
                WHEN now() < voucher.date_start Then '$name_status'
                WHEN (now() > voucher.date_end || now() < voucher.date_start) && user_voucher.is_used = 1 Then 'Đã dùng'
            ELSE 'Đã lưu'
            END AS status
        FROM user_voucher
        INNER JOIN voucher
        on user_voucher.voucher_id = voucher.id
        WHERE user_id = '$user_id' $type $search")->fetchAll();

        return new Response(true, "success", $result);

    }
    function check_code_voucher($code, $shop_id)
    {
        if (Session::get('isLogin') == false) {
            return new Response(false, "Vui lòng đăng nhập!");
        }
        $user_id = Session::get('id');
        if (empty ($code) || empty ($code))
            return new Response(false, 'Vui lòng nhập mã code');
        $check_voucher = $this->db->select("SELECT user_voucher.is_used ,voucher.discount_amount, voucher.minimum_price, voucher.quantity,voucher.id FROM user_voucher 
            INNER JOIN voucher
            ON voucher.id = user_voucher.voucher_id
            WHERE voucher.code = '$code'
            AND user_voucher.user_id ='$user_id'
            AND voucher.shop_id ='$shop_id'
        ")->fetchAll();
        if (count($check_voucher) > 0) {
            if ($check_voucher[0]['is_used']) {
                return new Response(false, "Mã voucher này bạn đã sử dụng");
            } else {
                // check minimum_price and pantity voucher
                $voucher_id = $check_voucher[0]['id'];
                $quantity = $check_voucher[0]['quantity'];
                $minimum_price = $check_voucher[0]['minimum_price'];
                $discount_amount = $check_voucher[0]['discount_amount'];

                $count_voucher_quantity = $this->db->select("SELECT count(*)
                FROM user_voucher
                WHERE voucher_id ='$voucher_id'
                AND is_used = 1
                ")->fetchColumn() ?? 0;
                if ($count_voucher_quantity >= $quantity) {
                    return new Response(false, "Voucher đã hết lượt sử dụng", $code);
                }
                // check price cart with minimum_price
                $total_price_cart = $this->db->select("SELECT
                    SUM(product.price * cart.quantity)
                    FROM cart
                    INNER JOIN product
                    ON product.id = cart.product_id
                    INNER JOIN shop
                    ON product.shop_id = shop.id
                    WHERE cart.user_id = '$user_id'
                    AND shop.id = '$shop_id'
                    AND cart.is_check =1
                ")->fetchColumn();
                if( $total_price_cart < $minimum_price){
                    return new Response(false, "Vui lòng mua đơn hàng trên $minimum_price để sử dụng voucher này", $code);
                }
                return new Response(true, "Mã voucher $code đã được á dụng", ['code'=>$code,'discount_amount'=>$discount_amount,'id'=>$voucher_id]);
            }
        } else {
            $voucher_not_save = $this->db->select("SELECT * FROM voucher
                WHERE id not in (SELECT voucher_id from user_voucher where user_id = '$user_id')
                AND code = '$code'
                AND now() >= date_start
                AND now() <= date_end 
            ")->fetchAll();
            if(count($voucher_not_save) >0){
                return new Response(true, "Mã voucher $code đã được á dụng", ['code'=>$code,'discount_amount'=>$voucher_not_save[0]['discount_amount']]);
            }else{
                return new Response(false, "Mã voucher không hợp lệ");
            }
        }

    }
   

}



?>