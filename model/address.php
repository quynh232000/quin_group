<?php
include_once "lib/database.php";
include_once "helpers/tool.php";
include_once "model/entity.php";
include_once "lib/session.php";
?>
<?php
class Address
{
    private $db;
    private $tool;
    private $response;

    public function __construct()
    {
        $this->db = new Database();
        $this->tool = new Tool();
    }
    public function get_all_province()
    {
        return $this->db->select(("SELECT * from address_province"))->fetchAll();
    }
    public function get_district($id)
    {
        return $this->db->select("SELECT * FROM address_district where matp = '$id'")->fetchAll();
    }
    public function get_ward($id)
    {
        return $this->db->select("SELECT * FROM address_ward where maqh = '$id'")->fetchAll();
    }

    public function get_address_by_shop($id)
    {

        return $this->db->select("SELECT pr.name as province, di.name as district, wa.name as ward
        FROM shop as s
        INNER JOIN address_province as pr
        ON s.province = pr.matp
        INNER JOIN address_district as di
        ON s.district = di.maqh
        INNER JOIN address_ward as wa
        ON s.address_detail = wa.xaid
        WHERE s.id = '$id';
        ")->fetch();
    }
    public function get_addres_by_delivery($id)
    {
        return $this->db->select("SELECT pr.name as province, di.name as district, wa.name as ward
        FROM delivery_address as s
        INNER JOIN address_province as pr
        ON s.province = pr.matp
        INNER JOIN address_district as di
        ON s.district = di.maqh
        INNER JOIN address_ward as wa
        ON s.address_detail = wa.xaid
        WHERE s.id = '$id';
        ")->fetch();
    }
    public function update_address_user($type = "", $id = "", $name_receiver = "", $phone_number = "", $province = "", $district = "", $address_detail = "", $is_default = "")
    {

        if (Session::get('isLogin') == false) {
            return new Response(false, "Vui lòng đăng nhập!");
        }
        $user_id = Session::get('id');
        if ($type == 'set_default') {
            $this->db->update("UPDATE delivery_address
                SET is_default = 0
                WHERE id IN (
                    SELECT id
                    FROM (
                        SELECT id
                        FROM delivery_address
                        WHERE user_id = '$user_id'
                        AND is_default = 1
                        LIMIT 1
                    ) tmp
                );
            ");
            $this->db->update("UPDATE delivery_address set is_default = 1 where id = '$id'");
            return new Response(true, 'Cài đặt làm địa chỉ mặc định thành công');
        } elseif ($type == 'create') {
            if($is_default == 'default'){
                $this->db->update("UPDATE delivery_address
                    SET is_default = 0
                    WHERE id IN (
                        SELECT id
                        FROM (
                            SELECT id
                            FROM delivery_address
                            WHERE user_id = '$user_id'
                            AND is_default = 1
                            LIMIT 1
                        ) tmp
                    );
                ");
                $is_default = 1;
            }else{
                $is_default = 0;
            }
            $this->db->insert("INSERT INTO delivery_address (name_receiver,province,district,address_detail,phone_number,user_id, is_default)
            values ('$name_receiver','$province','$district','$address_detail','$phone_number','$user_id',$is_default)
            ");
            return new Response(true, 'Tạo địa chỉ mới thành công!');
        } elseif ($type == 'delete') {
            $delete_address = $this->db->delete("DELETE FROM delivery_address where id = '$id'");
            if($delete_address !==false){
                return new Response(true, 'Xóa địa chỉ thành công!');
            }else{
                return new Response(false, 'Bạn không thể xóa địa chỉ này! Vì đã sử dụng trong đơn hàng');
            }
        }elseif($type == 'update'){
            $this->db->update("UPDATE delivery_address set  
            name_receiver = '$name_receiver',
            province = '$province',
            district = '$district',
            address_detail = '$address_detail',
            phone_number = '$phone_number'
            WHERE id = '$id'
            ");
             return new Response(true, 'Câp nhật địa chỉ thành công!');
        }
    }

    public function get_all_address_user(){
        if (Session::get('isLogin') == false) {
            return new Response(false, "Vui lòng đăng nhập!");
        }
        $user_id = Session::get('id');
        return $this->db->select("SELECT pr.name as province, s.is_default,s.id,s.phone_number,s.id,s.name_receiver,
            di.name as district,
            wa.name as address_detail
            FROM delivery_address as s
            INNER JOIN address_province as pr
            ON s.province = pr.matp
            INNER JOIN address_district as di
            ON s.district = di.maqh
            INNER JOIN address_ward as wa
            ON s.address_detail = wa.xaid
            WHERE s.user_id = '$user_id' order by created_at DESC;
        ")->fetchAll() ??[];
    }
    public function get_address_by_id($address_id){
        if (Session::get('isLogin') == false) {
            return new Response(false, "Vui lòng đăng nhập!");
        }
        $user_id = Session::get('id');
        $address = $this->db->select("SELECT * FROM delivery_address WHERE id = '$address_id' AND user_id = '$user_id' ")->fetchAll();
        if(count(($address))==0){
            return new Response(false, "Something wrong!");
        }else{
            return new Response(true,"success",$address[0]);
        }
    }
    public function get_address_user_default(){
        if (Session::get('isLogin') == false) {
            return new Response(false, "Vui lòng đăng nhập!");
        }
        $user_id = Session::get('id');
        $result =  $this->db->select("SELECT pr.name as province, s.is_default,s.id,s.phone_number,s.id,s.name_receiver,pr.matp,pr.area,
            di.name as district,
            wa.name as address_detail
            FROM delivery_address as s
            INNER JOIN address_province as pr
            ON s.province = pr.matp
            INNER JOIN address_district as di
            ON s.district = di.maqh
            INNER JOIN address_ward as wa
            ON s.address_detail = wa.xaid
            WHERE s.user_id = '$user_id' AND  s.is_default = 1;
        ")->fetchAll();
        if(count($result)>0){
            return new Response(true,'success',$result[0]);
        }else{
            return new Response(false,'fail',"");
        }
        
    }
    public function get_ship_by_area($area,$shop_uuid)  {
        $shop_id =$this->db->select("SELECT id from shop where uuid = '$shop_uuid'")->fetchColumn();
        return $this->db->select("SELECT ship_$area from shop_shipping_setting WHERE shop_id = '$shop_id'")->fetchColumn();
    }
}



?>