<?php
include_once "lib/database.php";
include_once "helpers/tool.php";
include_once "model/entity.php";
include_once "lib/session.php";
?>
<?php
class Cart
{
    private $db;
    private $tool;
    private $response;

    public function __construct()
    {
        $this->db = new Database();
        $this->tool = new Tool();
    }
    public function getCartUser($type ="")
    {
        $isLogin = Session::get("isLogin");
        if ($isLogin != true) {
            return new Response(false, "false", "", "");
        }
        $userId = Session::get("id");
        if( $type =="checked"){
            $type = "AND c.check = '1'";
        }else{
            $type = "";
        }
        $cartUser = $this->db->select("SELECT c.*,
        p.name, p.image_cover, p.brand, p.price, p.quantity, p.origin
        from cart AS c INNER JOIN product AS p  ON c.product_id = p.id WHERE c.user_id = '$userId'  $type");
        if ($cartUser == false) {
            return new Response(false, "false", "", "");
        } else {
            // $result = [];
            // while ($row = mysqli_fetch_array($cartUser)) {
            //     $result[] = $row;
            // }
            return new Response(true, "success", $cartUser->fetchAll(), "");
        }
    }
    public function getCartView()
    {
        $isLogin = Session::get("isLogin");
        if ($isLogin != true) {
            return new Response(true, "success", ["total" => "0", "totalPrice" => 0], "");
        }
        $userId = Session::get("id");
        $checkCart = $this->db->select("SELECT * FROM cart WHERE user_id = '$userId' ");
        if ($checkCart == false) {
            return new Response(true, "success", ["total" => "0", "totalPrice" => 0], "");
        }
        $query = "select SUM(c.quantity * p.price) as totalPrice, SUM(c.quantity) as total from cart as c inner join product as p on c.product_id = p.id where c.user_id = '$userId' AND c.check = '1';";
        $resultGetCart = $this->db->select($query);
        if ($resultGetCart == false) {
            return new Response(true, "success", ["total" => "0", "totalPrice" => 0], "");
        } else {

            $result = $resultGetCart->fetchAll()[0];

            return new Response(true, "success", $result, "");
        }
    }
    public function updateCart($key = "", $value = "", $count)
    {
        $isLogin = Session::get("isLogin");
        if ($isLogin == false) {
            return new Response(false, "Vui lòng đăng nhập!", "", "");
        }
        $userId = Session::get("id");
        $carts = $this->db->select("SELECT * from cart  as c WHERE c.userId = '$userId' AND c.productId = '$value'");
        $checkCart = count($carts->fetchAll())>0 ?true:false;
        // return new Response(true, "Đã thêm sản phẩm vào giỏ hàng thành công!", "", "");
        switch ($key) {
            case 'minus':
                if ($checkCart == false) {
                    return new Response(false, "Thêm sản phẩm thất bại!", "", "");
                } else {
                    $updateCart = $this->db->update("UPDATE cart set count = count -1 where userId = '$userId' AND productId = '$value'");
                    if ($updateCart == false) {
                        return new Response(false, "Cập nhật giỏ hàng thất bại thất bại!", "", "");
                    } else {
                        return new Response(true, "Cập nhật giỏ hàng thành công!", "", "");
                    }
                }
            case 'delete':
                if ($checkCart == false) {
                    return new Response(false, "Xóa sản phẩm thất bại!", "", "");
                } else {
                    $updateCart = $this->db->delete("DELETE FROM cart where userId = '$userId' AND productId = '$value'");
                    if ($updateCart == false) {
                        return new Response(false, "Cập nhật giỏ hàng thất bại thất bại!", "", "");
                    } else {
                        return new Response(true, "Cập nhật giỏ hàng thành công!", "", "");
                    }
                }
            case 'check':
                if ($checkCart == false) {
                    return new Response(false, "Check sản phẩm thất bại!", "", "");
                } else {
                    $updateCart = $this->db->delete("UPDATE cart SET cart.check = '1' where userId = '$userId' AND productId = '$value'");
                    if ($updateCart == false) {
                        return new Response(false, "Cập nhật giỏ hàng thất bại thất bại!", "", "");
                    } else {
                        return new Response(true, "Cập nhật giỏ hàng thành công!", "", "");
                    }
                }
            case 'uncheck':
                if ($checkCart == false) {
                    return new Response(false, "Uncheck sản phẩm thất bại!", "", "");
                } else {
                    $updateCart = $this->db->delete("UPDATE cart SET cart.check = '0' where userId = '$userId' AND productId = '$value'");
                    if ($updateCart == false) {
                        return new Response(false, "Cập nhật giỏ hàng thất bại thất bại!", "", "");
                    } else {
                        return new Response(true, "Cập nhật giỏ hàng thành công!", "", "");
                    }
                }

            default:
                if ($checkCart == false) {
                    if(empty($count)){
                        $createCart = $this->db->insert("INSERT INTO cart (userId,productId) VALUE ('$userId', '$value')");

                    }else{
                        $createCart = $this->db->insert("INSERT INTO cart (userId,productId,count) VALUE ('$userId', '$value', '$count')");
                    }
                    if ($createCart == false) {
                        return new Response(false, "Thêm sản phẩm thất bại123!", "", "");
                    } else {
                        return new Response(true, "Đã thêm sản phẩm vào giỏ hàng thành công!", "", "");
                    }
                } else {
                    if(empty($count)){
                        $updateCart = $this->db->update("UPDATE cart set count = count +1 where userId = '$userId' AND productId = '$value'");
                    }else{
                        $updateCart = $this->db->update("UPDATE cart set count = count + $count where userId = '$userId' AND productId = '$value'");
                    }
                    if ($updateCart == false) {
                        return new Response(false, "Thêm sản phẩm thất bại!", "", "");
                    } else {
                        return new Response(true, "Đã thêm sản phẩm vào giỏ hàng thành công!", "", "");
                    }
                }

        }

    }
    public function checkout($nameReceiver,$city,$province,$addressDetail,$phone,$note,$subtotal,$total,$fee)
    {
        $isLogin = Session::get("isLogin");
        if ($isLogin != true) {
            return new Response(true, "success", ["total" => 0, "totalPrice" => 0], "");
        }
        $userId = Session::get("id");
        $newAddress = $this->db->insert("INSERT INTO quin.address (userId, nameReceiver, addressDetail, phone, city, province) VALUES
            ('$userId','$nameReceiver','$addressDetail','$phone','$city','$province');
        ");
        if ($newAddress == false) {
            return new Response(false, "Create new address fail!","", "");
        }
        $getIdAddress = $this->db->select("SELECT LAST_INSERT_ID();");
        $idAddress =$getIdAddress->fetchColumn();
        // creeate invoice
        $invoince = $this->db->insert("INSERT INTO invoice (userId,subTotal,total,addressId,note,fee) VALUES
            ('$userId','$subtotal','$total','$idAddress','$note','$fee');
        ");
        if ($invoince == false) {
            return new Response(false, "Create new invoice fail!","", "");
        }
        $getIdInvoice = $this->db->select("SELECT LAST_INSERT_ID();");
        $idInvoice = $getIdInvoice->fetchColumn();
        // create invoicedetail
        $invoiceDetail = $this->db->insert("INSERT INTO invoicedetail (invoinceId,productId,quantity)
            SELECT  '$idInvoice' ,c.productId, c.count FROM cart AS c
            WHERE c.userId = '$userId' AND c.check = '1'
        ");
        if ($invoiceDetail == false) {
            return new Response(false, "Create new invoice detail fail!","", "");
        }
        $cartinfo = self::getCartUser("checked");
        foreach ($cartinfo->result as $key => $value) {
            $rowsId[] = $value["id"];
        }
        $rowsId = implode(",",$rowsId);
        $deleteCart = $this->db->delete("DELETE FROM cart WHERE id IN  ($rowsId)");
        if ($deleteCart == false) {
            return new Response(false, "Delete cart detail fail!","", "");
        }
        return new Response(true, "Đặt hàng thành công!", "", "?mod=profile&act=orderhistory");
    }
    
}



?>