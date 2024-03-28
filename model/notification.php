<?php
include_once "lib/database.php";
include_once "helpers/tool.php";
include_once "model/entity.php";
include_once "lib/session.php";
?>
<?php
class Notification
{
    private $db;
    private $tool;
    private $db_name;
    private $response;

    public function __construct()
    {
        $this->db = new Database();
        $this->tool = new Tool();
        $this->db_name = DB_NAME;
    }
    public function get_notification_user($page = 1, $limit = 20)
    {
        if (Session::get('isLogin') == false) {
            return new Response(false, 'Vui lòng đăng nhập!');
        }
        $user_id = Session::get('id');
        $current_page = ($page - 1) * $limit;
        $data = $this->db->select("SELECT n.*,s.id shop_id,s.name shop_name, s.icon shop_icon, s.uuid shop_uuid 
            FROM $this->db_name.notification as n
            INNER JOIN shop as s
            ON n.shop_id = s.id
            WHERE n.user_id = '$user_id'
            ORDER BY created_at DESC
            limit $current_page, $limit
            ")->fetchAll();
        $total = $this->db->select("SELECT count(*)
          FROM $this->db_name.notification as n
          WHERE n.user_id = '$user_id'
          ")->fetchColumn();
          return new Response(true,'success',$data,'',$total);
    }
    public function read_notify_user() {
        if (Session::get('isLogin') == false) {
            return new Response(false, 'Vui lòng đăng nhập!');
        }
        $user_id = Session::get('id');
        $this->db->update("UPDATE notification set is_read = 1 WHERE user_id = '$user_id'");
        return new Response(true,'success');
    }
    public function count_noti_not_read()  {
        if (Session::get('isLogin') == false) {
            return 0;
        }
        $user_id = Session::get('id');
        return $this->db->select("SELECT count(*) FROM notification WHERE user_id = '$user_id' AND is_read = 0 ")->fetchColumn() ??0;
    }
}



?>