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
    public function get_address_by_shop($id) {
       
        return $this->db->select("SELECT pr.name as province, di.name as district, wa.name as ward
        FROM shop as s
        INNER JOIN address_province as pr
        ON s.province = pr.matp
        INNER JOIN address_district as di
        ON s.district = di.maqh
        INNER JOIN address_ward as wa
        ON s.address_detail = wa.xaid
        WHERE s.id = '$id';
        ")->fetch();
        
    }
    public function get_addres_by_delivery($id) {
        return$this->db->select("SELECT pr.name as province, di.name as district, wa.name as ward
        FROM delivery_address as s
        INNER JOIN address_province as pr
        ON s.province = pr.matp
        INNER JOIN address_district as di
        ON s.district = di.maqh
        INNER JOIN address_ward as wa
        ON s.address_detail = wa.xaid
        WHERE s.id = '$id';
        ")->fetch();
        
    }
}



?>