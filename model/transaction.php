<?php
include_once "lib/database.php";
include_once "helpers/tool.php";
include_once "model/entity.php";
include_once "lib/session.php";
?>
<?php
class Transaction
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
    public function create_transaction($transaction_no,$order_id,$amount,$bank_code,$content){
        $this->db->insert("INSERT INTO $this->db_name.transaction (transaction_no,order_id,status,amount,bank_code,content)
            VALUES ('$transaction_no','$order_id','success','$amount','$bank_code','$content')
        ");
    }
}



?>