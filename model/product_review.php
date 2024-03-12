<?php
include_once "lib/database.php";
include_once "helpers/tool.php";
include_once "model/entity.php";
include_once "lib/session.php";
?>
<?php
class ProductReview
{
    private $db;
    private $tool;
    private $response;

    public function __construct()
    {
        $this->db = new Database();
        $this->tool = new Tool();
    }
    public function get_all_review_product($product_id, $level, $page = 1, $limit = 20)
    {
        if ($page < 1) {
            $page = 1;
        }
        $currentPage = ($page - 1) * $limit;

        $queryLevel = '';
        if (!empty($level)) {
            $queryLevel = " AND level = '$level'";
        }
        $count = $this->db->select("SELECT count(*) as count from product_review  where product_id = '$product_id'")->fetchColumn();
        
        $list = $this->db->select("SELECT r.* ,u.avatar, u.full_name
        from product_review as r 
        INNER JOIN user as u 
        ON u.id = r.user_id
        where product_id = '$product_id'
        $queryLevel
        order by created_at DESC
        limit $currentPage,$limit
        ")->fetchAll();
        return new Response(true, 'success', $list, '', $count);

    }
    public function count_star_by_level($product_id, $level)
    {
        return($this->db->select("SELECT count(*) as count from product_review where product_id ='$product_id' and level = '$level'")->fetch())['count'] ?? 0;
    }
    public function get_random_review_product($product_id)  {
        return $this->db->select("SELECT r.* ,u.avatar, u.full_name
        from product_review as r 
        INNER JOIN user as u 
        ON u.id = r.user_id
        where r.product_id = '$product_id'
        order by RAND()
        ")->fetch() ??[];
    }

}



?>