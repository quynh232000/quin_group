<?php
include_once "lib/database.php";
include_once "helpers/tool.php";
include_once "model/entity.php";
include_once "model/product.php";
include_once "model/shop.php";
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
    public function getCartUser($type = "")
    {
        $isLogin = Session::get("isLogin");
        if ($isLogin != true) {
            return new Response(false, "false", "", "");
        }
        $userId = Session::get("id");
        if ($type == "checked") {
            $type = "AND c.is_check = '1'";
        } else {
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
        if ($isLogin == true) {
            //    get cart login
            $userId = Session::get("id");
            $checkCart = $this->db->select("SELECT * FROM cart WHERE user_id = '$userId' ");
            if ($checkCart == false) {
                return new Response(true, "success", ["total" => "0", "totalPrice" => 0], "");
            }
            $query = "select SUM(c.quantity * p.price) as totalPrice, SUM(c.quantity) as total from cart as c inner join product as p on c.product_id = p.id where c.user_id = '$userId' AND c.is_check = '1';";
            $resultGetCart = $this->db->select($query);
            if ($resultGetCart == false) {
                return new Response(true, "success", ["total" => "0", "totalPrice" => 0], "");
            } else {

                $result = $resultGetCart->fetchAll()[0];

                return new Response(true, "success", $result, "");
            }
        } else {
            //  get cart not login

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
        $checkCart = count($carts->fetchAll()) > 0 ? true : false;
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
            case 'is_check':
                if ($checkCart == false) {
                    return new Response(false, "Check sản phẩm thất bại!", "", "");
                } else {
                    $updateCart = $this->db->delete("UPDATE cart SET cart.is_check = '1' where userId = '$userId' AND productId = '$value'");
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
                    $updateCart = $this->db->delete("UPDATE cart SET cart.is_check = '0' where userId = '$userId' AND productId = '$value'");
                    if ($updateCart == false) {
                        return new Response(false, "Cập nhật giỏ hàng thất bại thất bại!", "", "");
                    } else {
                        return new Response(true, "Cập nhật giỏ hàng thành công!", "", "");
                    }
                }

            default:
                if ($checkCart == false) {
                    if (empty ($count)) {
                        $createCart = $this->db->insert("INSERT INTO cart (userId,productId) VALUE ('$userId', '$value')");

                    } else {
                        $createCart = $this->db->insert("INSERT INTO cart (userId,productId,count) VALUE ('$userId', '$value', '$count')");
                    }
                    if ($createCart == false) {
                        return new Response(false, "Thêm sản phẩm thất bại123!", "", "");
                    } else {
                        return new Response(true, "Đã thêm sản phẩm vào giỏ hàng thành công!", "", "");
                    }
                } else {
                    if (empty ($count)) {
                        $updateCart = $this->db->update("UPDATE cart set count = count +1 where userId = '$userId' AND productId = '$value'");
                    } else {
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
    public function checkout($nameReceiver, $city, $province, $addressDetail, $phone, $note, $subtotal, $total, $fee)
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
            return new Response(false, "Create new address fail!", "", "");
        }
        $getIdAddress = $this->db->select("SELECT LAST_INSERT_ID();");
        $idAddress = $getIdAddress->fetchColumn();
        // creeate invoice
        $invoince = $this->db->insert("INSERT INTO invoice (userId,subTotal,total,addressId,note,fee) VALUES
            ('$userId','$subtotal','$total','$idAddress','$note','$fee');
        ");
        if ($invoince == false) {
            return new Response(false, "Create new invoice fail!", "", "");
        }
        $getIdInvoice = $this->db->select("SELECT LAST_INSERT_ID();");
        $idInvoice = $getIdInvoice->fetchColumn();
        // create invoicedetail
        $invoiceDetail = $this->db->insert("INSERT INTO invoicedetail (invoinceId,productId,quantity)
            SELECT  '$idInvoice' ,c.productId, c.count FROM cart AS c
            WHERE c.userId = '$userId' AND c.is_check = '1'
        ");
        if ($invoiceDetail == false) {
            return new Response(false, "Create new invoice detail fail!", "", "");
        }
        $cartinfo = self::getCartUser("checked");
        foreach ($cartinfo->result as $key => $value) {
            $rowsId[] = $value["id"];
        }
        $rowsId = implode(",", $rowsId);
        $deleteCart = $this->db->delete("DELETE FROM cart WHERE id IN  ($rowsId)");
        if ($deleteCart == false) {
            return new Response(false, "Delete cart detail fail!", "", "");
        }
        return new Response(true, "Đặt hàng thành công!", "", "?mod=profile&act=orderhistory");
    }
    //======= new =======

    public function get_cart_user_db($user_id)
    {
        $products = $this->db->select("
        SELECT 
            cart.quantity as cart_quantity,product.*
        FROM cart 
        INNER JOIN product 
        ON product.id = cart.product_id
        WHERE cart.user_id = '$user_id'
        ")->fetchAll();

        $data = [];
        $classShop = new Shop();
        foreach ($products as $key => $value) {
            $data[$value['id']]['product_info'] = $value;
            $data[$value['id']]['quantity'] = $value['cart_quantity'];
            $data[$value['id']]['check'] = $value['cart_quantity'];
            $data[$value['id']]['shop_info'] = $classShop->get_shop_cart_by_product_id($value['id']);

        }
        return $data;
    }
    public function update_cart_user($type, $product_id, $quantity = "")
    {
        $isLogin = Session::get("isLogin");
        // is login
        if ($isLogin == true) {
            // is login============================== 
            $user_id = Session::get("id");
            $carts = $this->db->select("SELECT * from cart  as c WHERE c.user_id = '$user_id' AND c.product_id = '$product_id'")->fetchAll();
            $checkCart = count($carts) > 0 ? true : false;



            // return new Response(true, "Đã thêm sản phẩm vào giỏ hàng thành công!", "", "");
            switch ($type) {
                case 'minus':
                    if ($checkCart == false) {
                        return new Response(false, "Thêm sản phẩm thất bại!", "", "");
                    } else {
                        if($quantity >= $carts[0]['quantity'] ){
                            return new Response(false,'Cập nhật giỏ hàng thất bại');
                        }
                        $this->db->update("UPDATE cart set quantity = quantity - $quantity where user_id  = '$user_id' AND product_id = '$product_id'");
                        return new Response(true, "Cập nhật giỏ hàng thành công!", self::get_cart_user_db($user_id), "");
                    }
                case 'delete':
                    if ($checkCart == false) {
                        return new Response(false, "Xóa sản phẩm thất bại!", "", "");
                    } else {
                        $updateCart = $this->db->delete("DELETE FROM cart where user_id  = '$user_id' AND product_id = '$product_id'");
                        return new Response(true, "Cập nhật giỏ hàng thành công!", self::get_cart_user_db($user_id), "");
                    }
                case 'check':
                    if ($checkCart == false) {
                        return new Response(false, "Check sản phẩm thất bại!", "", "");
                    } else {
                        $updateCart = $this->db->delete("UPDATE cart SET cart.is_check = '1' where user_id  = '$user_id' AND product_id = '$product_id'");
                        return new Response(true, "Cập nhật giỏ hàng thành công!", self::get_cart_user_db($user_id), "");
                    }
                case 'uncheck':
                    if ($checkCart == false) {
                        return new Response(false, "Uncheck sản phẩm thất bại!", "", "");
                    } else {
                        $updateCart = $this->db->delete("UPDATE cart SET cart.is_check = '0' where user_id  = '$user_id' AND product_id = '$product_id'");
                        return new Response(true, "Cập nhật giỏ hàng thành công!", self::get_cart_user_db($user_id), "");
                    }
                case 'plus':
                    if ($checkCart == false) {
                         $this->db->insert("INSERT INTO cart (user_id, product_id, quantity) values ('$user_id', '$product_id','$quantity')");
                        return new Response(true, "Đã thêm sản phẩm vào giỏ hàng thành công!", self::get_cart_user_db($user_id), "");
                    } else {
                        $updateCart = $this->db->update("UPDATE cart set quantity = quantity + $quantity where user_id  = '$user_id' AND product_id = '$product_id'");
                        return new Response(true, "Đã thêm sản phẩm vào giỏ hàng thành công!", self::get_cart_user_db($user_id), "");
                    }
                default:
                    return new Response(false, "Thêm sản phẩm thất bại!", "", "");
                   
            }

            // is login==============================
        } else {
            // not login
            switch ($type) {
                case 'plus':
                    // unset($_SESSION['CART']);
                    $classProduct = new Product();
                    $classShop = new Shop();
                    $remaining_product = $classProduct->get_remain_quantity($product_id);
                    if ($quantity > $remaining_product) {
                        return new Response(false, "Số lượng sản phẩm không đủ cho bạn mua");
                    }
                    if (isset ($_SESSION['CART'][$product_id])) {
                        $_SESSION['CART'][$product_id]['quantity'] += $quantity;
                    } else {
                        $_SESSION['CART'][$product_id]['quantity'] = $quantity;
                    }
                    $_SESSION['CART'][$product_id]['product_info'] = $classProduct->get_product_by_id($product_id);
                    $_SESSION['CART'][$product_id]['shop_info'] = $classShop->get_shop_cart_by_product_id($product_id);

                    $_SESSION['CART'][$product_id]['check'] = true;
                    return new Response(true, "Đã thêm sản phẩm vào giỏ hàng!", $_SESSION['CART']);
                case 'minus':
                    if ($_SESSION['CART'][$product_id]['quantity'] > 1) {
                        $_SESSION['CART'][$product_id]['quantity'] -= $quantity;
                    } else {
                        return new Response(false, "Số lượng không đúng!");
                    }
                    break;
                case "delete":
                    unset($_SESSION['CART'][$product_id]);
                    break;
                case "check":
                    $_SESSION['CART'][$product_id]['check'] = true;
                case "uncheck":
                    $_SESSION['CART'][$product_id]['check'] = false;
                default:
                    return new Response(false, "Something wrong!");
            }
            return new Response(true, "Cập nhật giỏ hàng thành công!", ($_SESSION['CART']));
        }
    }
    public function get_cart_user()
    {
        $isLogin = Session::get('isLogin');
        if ($isLogin == true) {
            $count = 0;
            $total = 0;
            $user_id = Session::get('id');

            $cart = $this->db->select("SELECT cart.*,product.price FROM cart 
            INNER JOIN product
            ON product.id = cart.product_id
            WHERE user_id ='$user_id'
            ")->fetchAll();

            foreach ($cart as $key => $value) {
                $count += $value['quantity'];
                $total += $value['quantity']*$value['price'];
            }
            return new Response(true, "success", self::get_cart_user_db($user_id), '', ['total' => $total, 'count' => $count]);
        } else {
            //  not login
            $count = 0;
            $total = 0;
            $cart = isset ($_SESSION['CART']) ? $_SESSION['CART'] : [];
            if (count($cart) > 0) {
                foreach ($cart as $key => $value) {
                    $count += $value['quantity'];
                    $total += $value['quantity'] * $value['product_info']['price'];
                }
            }
            return new Response(true, "success", $cart, '', ['total' => $total, 'count' => $count]);
        }
    }
    //======= new =======


}



?>