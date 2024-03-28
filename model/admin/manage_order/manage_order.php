<?php
include_once "lib/database.php";

class OrderAdmin
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getInputParam()
    {
        $entityBody = file_get_contents('php://input');
        return json_decode($entityBody);
    }

    public function getCountAllOrder($status = "")
    {
        $statusParam = "";
        if ($status == "All" || $status == "") {
            $statusParam = "";
        } else {
            $statusParam = isset($status) ? " WHERE status = '$status'" : "";
        }
        $query = "SELECT count(*) as totalOrders from quingroup.order $statusParam;";
        return $this->db->selectMany($query);
    }

    public function selectAllOrder($status = "", $offset)
    {
        $statusParam = "";
        if ($status == "All" || $status == "") {
            $statusParam = "";
        } else {
            $statusParam = isset($status) ? " AND o.status = '$status'" : "";
        }
        $query = "SELECT DISTINCT
                        o.id as order_id,
                        o.shop_id as shop_id,
                        o.status as order_status,
                        o.total as order_total,
                        o.user_id as buyer_id,
                        u.full_name as buyer_name,
                        u.avatar as buyer_avatar,
                        s.name as shop_name,
                        s.icon as shop_icon,
                        o.created_at as createdAt,
                        ap.name as ap_province,
                        ad.name as ad_district,
                        aw.name as aw_ward
                    FROM
                        quingroup.order o
                    JOIN 
                        shop s ON o.shop_id = s.id
                    JOIN
                        user u ON o.user_id = u.id
                    JOIN
                        delivery_address da ON o.delivery_address_id = da.id
                    JOIN
                        address_province ap ON da.province = ap.matp
                    JOIN
                        address_district ad ON da.district = ad.maqh
                    JOIN
                        address_ward aw ON da.address_detail = aw.xaid
                    JOIN
                        order_detail od ON o.id = od.order_id
                    WHERE
                        od.order_id = o.id $statusParam
                    limit 5 offset $offset;";

        return $this->db->selectMany($query);
    }

    public function getOrders()
    {
        $dataParam = self::getInputParam();
        if (isset($dataParam->order_status) && $dataParam->order_status) {
            $offset = ($dataParam->page - 1) * 5;
            $result = self::selectAllOrder($dataParam->order_status, $offset);
            $total = self::getCountAllOrder($dataParam->order_status);
            echo json_encode(["order-status" => $dataParam->order_status, "result" => $result, "totalOrder" => $total]);
        }
    }

    public function selectOrderDetail($order_id)
    {
        $query = "SELECT od.*, p.name, p.image_cover, p.category_id FROM
                    order_detail od
                    JOIN product p ON p.id = od.product_id
                    where od.order_id = '$order_id';";
        return $this->db->selectMany($query);
    }

    public function orderDetail()
    {
        $dataParam = self::getInputParam();
        if (isset($dataParam->orderId) && $dataParam->orderId) {
            $result = self::selectOrderDetail($dataParam->orderId);
            echo json_encode(["orderId-orderDetail" => $dataParam->orderId, "result" => $result]);
        }
    }
}
