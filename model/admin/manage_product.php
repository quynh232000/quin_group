<?php

include_once "lib/database.php";

class ProductAdmin
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getProducts($status = "", $limit = "", $offset = "")
    {
        $pagination = "";
        if (!empty($status)) {
            $status = " AND p.status = '$status'";
        }

        if (!empty($limit) && !empty($offset)) {
            $pagination = " LIMIT $limit OFFSET $offset";
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
                            p.reason as reason
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
        $query = "UPDATE `product` SET status = '$status' $reason where id = '$idProduct'";
        $this->db->insert($query);
    }
}
