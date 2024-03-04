<?php
include_once "lib/database.php";
include_once "helpers/tool.php";
include_once "model/entity.php";
include_once "lib/session.php";
?>
<?php
class Order
{
    private $db;
    private $tool;
    private $response;

    public function __construct()
    {
        $this->db = new Database();
        $this->tool = new Tool();
    }
    public function getAllOrder($type = "")
    {
        $isLogin = Session::get("isLogin");
        if ($isLogin != true) {
            return new Response(false, "false", "", "");
        }
        $userId = Session::get("id");

        $oders = $this->db->select("SELECT de.*, i.status,i.total,i.subTotal ,i.id as 'sku', p.namePro,p.image,p.price
            FROM invoicedetail as de
            INNER JOIN invoice as i
            ON de.invoinceId = i.id
            INNER JOIN product as p
            ON de.productId = p.id
            WHERE i.userId = '$userId'
        ");
        if ($oders == false) {
            return new Response(false, "false", "", "");
        }

        return new Response(true, "success", $oders->fetchAll(), "");
    }
    public function getAllInvoince($type = "")
    {
        $isLogin = Session::get("isLogin");
        if ($isLogin != true) {
            return new Response(false, "false", "", "");
        }
        $typeWhere = '';
        if ($type != "") {
            $typeWhere = "WHERE i.status = '" . $type . "'";
        }
        $invoice = $this->db->select("SELECT i.*,ad.nameReceiver, ad.phone
            FROM invoice AS i
            INNER JOIN quin.address as ad
            ON i.addressId = ad.id
            $typeWhere
            ORDER BY i.createdAt
        ");
        if ($invoice == false) {
            return new Response(false, "false", "", "");
        }
        return new Response(true, "success", $invoice->fetchAll(), "");
    }
    public function updateInvoice($status, $listId)
    {
        if ($status == "" || $listId == "") {
            return new Response(false, "Missing parammeter", "", "");
        }
        $queryId = "";
        foreach ($listId as $key => $value) {
            $queryId .= $value . ",";
        }
        $queryId = rtrim($queryId, ",");
        $resultUpdate = $this->db->update("UPDATE invoice as i  
            SET i.status = '$status' 
            WHERE i.id in ($queryId)
        ");
        if ($resultUpdate == false) {
            return new Response(false, "Something wrong from server!", "", "");
        }
        return new Response(true, "Cập nhật đơn hàng thành công!", "", "");
    }
    // get detail ordder
    public function getOrderDetail($id)
    {
        $listOrder = $this->db->select("SELECT i.* ,p.namePro, p.price,c.nameCate,p.image
        FROM invoicedetail as i
        INNER JOIN product as p
        ON p.id = i.productId 
        INNER JOIN category as c
        ON c.id = p.categoryId
        WHERE i.invoinceId = '$id'
        ");


        $infoInvoince = $this->db->select("SELECT i.*, u.fullName, u.email, u.avatar, a.nameReceiver, a.addressDetail, a.phone, a.city,a.province
         FROM invoice as i 
         INNER JOIN user as u
         ON u.id = i.userId
         INNER JOIN address as a
         ON a.id = i.addressId
         WHERE i.id = '$id'
        ");
      

        return  new Response(true, "success!", ['listpro'=>$listOrder->fetchAll(),'invoice'=>$infoInvoince->fetchAll()], "");
    }

}



?>