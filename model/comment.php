<?php
include_once "lib/database.php";
include_once "helpers/tool.php";
include_once "model/entity.php";
include_once "lib/session.php";
?>
<?php
class Comment
{
    private $db;
    private $tool;
    private $response;

    public function __construct()
    {
        $this->db = new Database();
        $this->tool = new Tool();
    }
    public function getAllCommentById($productId,$page = 1)
    {
        $limit = $page *3;
        if (empty($productId)) {
            return new Response(false, "false", "", "");
        }

        $allCmt = $this->db->select("SELECT c.*,u.fullname, u.avatar
        from comment as c
        INNER JOIN
        user as u
        ON c.userId = u.id
        WHERE productId = '$productId'
        ORDER BY c.createdAt DESC
        LIMIT $limit
        ");
          $countCmt = $this->db->select("SELECT count(*) from comment where productId = '$productId'");
        if ($allCmt == false) {
            return new Response(false, "false", "", "");
        } else {
            return new Response(true, "success", ['data'=>$allCmt->fetchAll(),'count'=>$countCmt->fetchColumn()], "");
        }
    }
    public function createComment($productId,$content)
    {
        $isLogin = Session::get("isLogin");
        if ($isLogin != true) {
            return new Response(false, "Please login to comment!");
        }
        if(empty(!$productId) && empty($content)){
            return new Response(false, "Missing parameter!");
        }
        $userId = Session::get("id");
        $createCmt = $this->db->insert("INSERT INTO comment (productId, userId,content) VALUE
        ('$productId', '$userId','$content')");
        if($createCmt !=false){
            $getIdCmt = $this->db->select("SELECT LAST_INSERT_ID();");
            return new Response(true,'success',$getIdCmt->fetchColumn());
        }else{
            return new Response(false, "Create comment fail!");
        }
    }
   

}



?>