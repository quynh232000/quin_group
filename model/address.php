<?php
include_once "lib/database.php";
include_once "helpers/tool.php";
include_once "model/entity.php";
include_once "lib/session.php";
?>
<?php
class Address
{
    private $db;
    private $tool;
    private $response;

    public function __construct()
    {
        $this->db = new Database();
        $this->tool = new Tool();
    }
    public function get_all_province()
    {
        return $this->db->select(("SELECT * from address_province"))->fetchAll();
    }
    public function get_district($id){
        return $this->db->select("SELECT * FROM address_district where matp = '$id'")->fetchAll();
    }
    public function get_ward($id){
        return $this->db->select("SELECT * FROM address_ward where maqh = '$id'")->fetchAll();
    }
}



?>