<?php
include_once "lib/database.php";
include_once "helpers/tool.php";
include_once "model/entity.php";
include_once "lib/session.php";
?>
<?php
class Traffic
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
  
    public function set_traffic($ip,$location,$type)  {
        if(!isset($_SESSION['SET_TRAFFICT'])){
            $this->db->insert("INSERT INTO traffic (type,ip_address,location) values('$type','$ip','$location')");
            $_SESSION['SET_TRAFFICT'] = true;
            return new Response(true,'success');
        }else{
            return new Response(false,'fail');
        }
    }
}



?>