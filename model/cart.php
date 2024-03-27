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
    private $db_name;

    public function __construct()
    {
        $this->db = new Database();
        $this->tool = new Tool();
        $this->db_name = DB_NAME;
    }
    //======= new =======

    public function get_cart_user_db($user_id)
    {
        $products = $this->db->select("
        SELECT 
            cart.quantity as cart_quantity,cart.is_check,product.*
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
            $data[$value['id']]['check'] = $value['is_check'];
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
            switch ($type) {
                case 'minus':
                    if ($checkCart == false) {
                        return new Response(false, "Thêm sản phẩm thất bại!", "", "");
                    } else {
                        if ($quantity >= $carts[0]['quantity']) {
                            return new Response(false, 'Cập nhật giỏ hàng thất bại', self::get_cart_user_db($user_id));
                        }
                        $this->db->update("UPDATE cart set quantity = quantity - $quantity where user_id  = '$user_id' AND product_id = '$product_id'");
                        return new Response(true, "Cập nhật giỏ hàng thành công!", self::get_cart_user_db($user_id), "");
                    }
                case 'delete':
                    if ($checkCart == false) {
                        return new Response(false, "Xóa sản phẩm thất bại!", "", "");
                    } else {
                         $this->db->delete("DELETE FROM cart where user_id  = '$user_id' AND product_id = '$product_id'");
                        return new Response(true, "Cập nhật giỏ hàng thành công!", self::get_cart_user_db($user_id), "");
                    }
                case 'check':
                    if ($checkCart == false) {
                        return new Response(false, "Check sản phẩm thất bại!", "", "");
                    } else {
                       $this->db->delete("UPDATE cart SET is_check = '1' where user_id  = '$user_id' AND product_id = '$product_id'");
                        return new Response(true, "Cập nhật giỏ hàng thành công!", self::get_cart_user_db($user_id), "");
                    }
                case 'uncheck':
                    if ($checkCart == false) {
                        return new Response(false, "Uncheck sản phẩm thất bại!", "", "");
                    } else {
                       $this->db->delete("UPDATE cart SET is_check = '0' where user_id  = '$user_id' AND product_id = '$product_id'");
                        return new Response(true, "Cập nhật giỏ hàng thành công!", self::get_cart_user_db($user_id), "");
                    }
                case 'plus':
                    $classProduct = new Product();
                    $remaining_product = $classProduct->get_remain_quantity($product_id);
                    if ($quantity > $remaining_product) {
                        return new Response(false, "Số lượng sản phẩm không đủ cho bạn mua");
                    }
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
                $total += $value['quantity'] * $value['price'];
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
    public function get_cart_user_buy($shop_uuid)
    {
        if (Session::get('isLogin') == false) {
            return new Response(false, "Vui lòng đăng nhập!");
        }
        $user_id = Session::get('id');
        $shop_id = $this->db->select("SELECT id from shop where uuid = '$shop_uuid'")->fetchColumn();
        if (empty ($shop_id))
            return new Response(false, 'Không tồn tại sản phẩm nào trong giỏ hàng');
        $value = $this->db->select("SELECT product.name,product.image_cover,product.price,product.brand,product.origin,product.slug,cart.quantity
            FROM cart
            INNER JOIN product
            ON product.id = cart.product_id
            WHERE cart.user_id = '$user_id'
            AND cart.is_check = 1
            AND product.shop_id = '$shop_id'
        ")->fetchAll();
        $total = $this->db->select("SELECT sum(cart.quantity) as count, sum(product.price*cart.quantity) as total
            FROM cart
            INNER JOIN product
            ON product.id = cart.product_id
            WHERE cart.user_id = '$user_id'
            AND cart.is_check = 1
            AND product.shop_id = '$shop_id'
        ")->fetch();
        ;
        return new Response(true, 'success', $value, "", ['total' => $total['total'], 'count' => $total['count'], 'shop_id' => $shop_id]);
    }
    public function check_out(
        $shop_uuid,
        $order_uuid,
        $sub_total,
        $total,
        $shipping_fee = 0,
        $delivery_address_id,
        $payment_method,
        $voucher_id = "",
        $note = "",
        $payment_status = ''
    ) {
        $isLogin = Session::get("isLogin");
        if ($isLogin != true) {
            return new Response(false, "Vui lòng đăng nhập", "", "");
        }
        $user_id = Session::get("id");
        $shop_id = $this->db->select("SELECT id from shop WHERE uuid = '$shop_uuid'")->fetchColumn();
        // create order
        if (empty ($voucher_id)) {
            $this->db->insert("INSERT INTO $this->db_name.order ( uuid, shipping_fee, sub_total, total, note, payment_status, delivery_address_id,  payment_method, user_id, shop_id)
            VALUES ('$order_uuid','$shipping_fee','$sub_total','$total','$note','$payment_status','$delivery_address_id','$payment_method','$user_id','$shop_id')
        ");
        } else {
            $this->db->insert("INSERT INTO $this->db_name.order ( uuid, shipping_fee, sub_total, total, note, payment_status, delivery_address_id, voucher_id, payment_method, user_id, shop_id)
            VALUES ('$order_uuid','$shipping_fee','$sub_total','$total','$note','$payment_status','$delivery_address_id','$voucher_id','$payment_method','$user_id','$shop_id')
        ");

        }

        $order_id = $this->db->get_lastest_id();

        // create order detail
        $this->db->insert("INSERT INTO order_detail (order_id, price, quantity,product_id)
            (SELECT '$order_id', product.price, cart.quantity, product.id
            FROM cart
            INNER JOIN product
            ON cart.product_id = product.id
            WHERE product.shop_id = '$shop_id' 
            AND cart.user_id = '$user_id'
            AND cart.is_check = 1)
        ");

        //  update quantity product
        $this->db->update("UPDATE product 
            INNER JOIN cart
            ON cart.product_id = product.id
            SET product.quantity_sold = product.quantity_sold + cart.quantity
            WHERE product.id in (
                SELECT  product_id 
                FROM cart
                WHERE user_id = '$user_id'
                AND is_check = 1
                ) 
        ");
        // delete cart user
        $this->db->delete("DELETE cart FROM cart
        INNER JOIN product
        ON product.id = cart.product_id
            WHERE cart.user_id = '$user_id'
            AND cart.is_check = 1 AND product.shop_id = '$shop_id'
        ");

        // is voucher create or update
        if (!empty ($voucher_id)) {
            $check_user_voucher = $this->db->select("SELECT count(*) FROM user_voucher WHERE user_id = '$user_id' AND voucher_id = '$voucher_id'")->fetchColumn() ?? 0;
            if ($check_user_voucher > 0) {
                $this->db->update("UPDATE user_voucher SET is_used = 1, use_at = CURRENT_TIMESTAMP() ,updated_at = CURRENT_TIMESTAMP() 
                    WHERE user_id ='$user_id' AND voucher_id = '$voucher_id'
                ");
            } else {
                $this->db->insert("INSERT INTO user_voucher (user_id,voucher_id,is_used,use_at)
                    VALUES ('$user_id','$voucher_id',1,CURRENT_TIMESTAMP())
                ");
            }
        }
        // notification
        $this->db->insert("INSERT INTO $this->db_name.notification 
            ($this->db_name.notification.type, $this->db_name.notification.message,
            $this->db_name.notification.data,$this->db_name.notification.user_id,$this->db_name.notification.shop_id)
            VALUES ('NEW_ORDER','Bạn đã đặt đơn hàng thành công! Mã đơn hàng $order_id đang chờ xác nhận.','$order_uuid','$user_id','$shop_id')
        ");
        ;
        // send mail=====
        

        return new Response(true, 'Đặt hàng thành công!', ['order_uuid' => $order_uuid,'order_id'=>$order_id]);
    }


}



?>