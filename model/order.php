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
    private $db_name;
    private $tool;
    private $response;

    public function __construct()
    {
        $this->db_name = DB_NAME;
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
    public function getAllInvoince($status = "")
    {
        $isLogin = Session::get("isLogin");
        if ($isLogin != true) {
            return new Response(false, "false", "", "");
        }
        $typeWhere = '';
        if ($status != "") {
            $typeWhere = " AND i.status = '" . $status . "'";
        }

        $user_id = Session::get('id');
        $shop_id = $this->db->select("SELECT id from shop where user_id = '$user_id'")->fetchColumn();
        if ($shop_id) {
            $shop_id = " AND shop_id = '$shop_id'";
        }
        $invoice = $this->db->select("SELECT o.*, ad.name_receiver, ad.phone_number
            FROM $this->db_name.order AS o
            INNER JOIN $this->db_name.delivery_address AS ad
            ON o.delivery_address_id = ad.id
            WHERE 1
            $typeWhere
            $shop_id
            ORDER BY o.created_at
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

        $listOrder = $this->db->select("SELECT i.* ,p.name, p.price,c.name as nameCate,p.image_cover
        FROM order_detail as i
        INNER JOIN product as p
        ON p.id = i.product_id 
        INNER JOIN category as c
        ON c.id = p.category_id
        WHERE i.order_id = '$id'
        ");


        $infoInvoince = $this->db->select("SELECT i.*, u.full_name, u.email, u.avatar, a.name_receiver, a.address_detail, a.phone_number, a.district,a.province
         FROM $this->db_name.order as i 
         INNER JOIN $this->db_name.user as u
         ON u.id = i.user_id
         INNER JOIN $this->db_name.delivery_address as a
         ON a.id = i.delivery_address_id
         WHERE i.id = '$id'
        ");


        return new Response(true, "success!", ['listpro' => $listOrder->fetchAll(), 'invoice' => $infoInvoince->fetchAll()], "");
    }
    // update status Order
    public function update_status_order($id, $type)
    {
        if ($id == "" || $type == "") {
            return new Response(false, "Missing parammeter", "", "");
        }
        $status = "";
        $data ="";
        switch ($type) {
            case 'accept':
                $status = 'Delivering';
                $idEncode = base64_encode($id);
                $data="?mod=verify&act=order&token=$idEncode";
                $this->db->insert("INSERT INTO link_order_ship (order_id,link)values($id,'$data')");

                break;
            case 'cancel':
                $status = 'Cancelled';
                break;

            default:
                # code...
                break;
        }
        $resultUpdate = $this->db->update("UPDATE $this->db_name.order 
            SET status = '$status' 
            WHERE id = '$id'
        ");
        if ($resultUpdate == false) {
            return new Response(false, "Something wrong from server!", "", "");
        }
        return new Response(true, "Cập nhật đơn hàng thành công!", $data, "");
    }

}



?>