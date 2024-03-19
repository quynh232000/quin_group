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
    private $db_name;

    public function __construct()
    {
        $this->db = new Database();
        $this->tool = new Tool();
        $this->db_name = DB_NAME;
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
    ///////Nhung====================================================//
    public function get_review_product_detail($product_id,$page =1,$limit =10)
    {
        // kiểm tra user đã đăng nhập chưa
        //session là có sẵn khi đằn nhập sẽ lưu vào đó
        $get_author_review = [];
        $allow_review = false;
        if ((Session::get('isLogin') == true)) {
            $user_id = Session::get('id');
            $get_author_review = $this->db->select("SELECT *
            from product_review
            where product_id = '$product_id' 
            and user_id = '$user_id'
            ")->fetchAll();
            // Kiểm tra xem user đã review chưa
            if (count($get_author_review) <= 0) {
                $count_order = $this->db->select("SELECT count(*) from order_detail
                INNER JOIN $this->db_name.order 
                ON order_detail.order_id = order.id
                where  order_detail.product_id = '$product_id' 
                and order.status like 'Completed'
                AND order.user_id = '$user_id'
                ")->fetchColumn();
                if (($count_order) > 0) {
                    $allow_review = true;
                }
            } else {
                $allow_review = true;
            }
        }

        $currentPage = ($page -1)*$limit;

        $list_review = $this->db->select("SELECT product_review.*, user.avatar, user.full_name, user.address
        from product_review
        INNER JOIN user 
        ON user.id = product_review.user_id
        where product_review.product_id = '$product_id' 
        order by product_review.created_at DESC
         limit $currentPage,$limit")->fetchAll();
        $data['reviews'] = $list_review;
        $data['allow_review'] = $allow_review;
        // lấy tổng review
        $total = $this->db->select("SELECT count(*) as total
        from product_review
        INNER JOIN user 
        ON user.id = product_review.user_id
        where product_review.product_id = '$product_id'")->fetchColumn();
        return new Response(true, 'success', $data,"",$total);
    }
    public function create_review($level, $content, $product_id, $id_review = "")
    {
        // kiểm tra nếu dữ liệu chưa nhập và chưa chọn sao
        if (empty($level)) {
            return new Response(false, 'Vui lòng đánh giá sao');
        }
        if (empty($content)) {
            return new Response(false, 'Vui lòng nhập đánh giá của bạn');
        }
        $user_id = Session::get('id');
        // nếu có id_review thì cập nhật,, không có thì tạo mới
        if ($id_review != "") {
            $this->db->update("UPDATE product_review set level ='$level', content = '$content' where id = '$id_review'");
        } else {
            $this->db->insert("INSERT INTO product_review (level,content,product_id,user_id)
        values ('$level','$content','$product_id','$user_id')
        ");
        }
        return new Response(true, 'Bạn đã gửi đánh giá thành công!');
    }
    ///////Nhung====================================================//

}



?>