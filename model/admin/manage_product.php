<?php

include_once "lib/database.php";

class ProductAdmin
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getProducts($status = "", $limit = 10, $page = 1)
    {
        $pagination = "";
        if (!empty($status)) {
            $status = " AND p.status = '$status'";
        }
        $offset = ($page - 1) * $limit;
        $pagination = " LIMIT $offset, $limit";
        if ($page == 0) {
            $pagination = "";
        }
        $query = "    SELECT
                            p.id,
                            p.name AS product_name,
                            p.brand,
                            p.image_cover,
                            s.id AS shop_id,
                            s.name AS shop_name,
                            c.id AS category_id,
                            c.name AS category_name,
                            p.status,
                            p.created_at,
                            u.full_name as shop_owner,
                            u.id as user_id,
                            p.reason as reason,
                            p.updated_at as updated
                        FROM
                            product p
                        JOIN
                            shop s ON p.shop_id = s.id
                        JOIN 
                            category c ON p.category_id = c.id
                        JOIN
                            user u ON s.user_id = u.id
                        WHERE
                            u.role = 'Seller' $status $pagination";

        return $this->db->selectMultiple($query);
    }

    public function updateProduct($status, $idProduct, $reason = "")
    {
        if (!empty($reason)) {
            $reason = ", reason = '$reason'";
        }
        $query = "UPDATE `product` SET status = '$status', updated_at = CURRENT_TIMESTAMP() $reason where id = '$idProduct'";
        $this->db->insert($query);
    }
}
