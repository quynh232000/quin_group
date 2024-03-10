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
    public function getAllInvoince($status = "", $page = 1, $limit = 5)
    {
        $isLogin = Session::get("isLogin");
        if ($isLogin != true) {
            return new Response(false, "Vui lòng đăng nhập", "", "");
        }
        // page
        if ($page < 1)
            $page = 1;
        $currentPage = ($page - 1) * $limit;

        $statusWhere = '';
        if ($status != "") {
            $statusWhere = " AND o.status = '" . $status . "'";
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
            $statusWhere
            $shop_id
            ORDER BY o.created_at
            LIMIT $currentPage, $limit
        ");
        // count total
        $count = $this->db->select("SELECT count(*) as total
            FROM $this->db_name.order as o
            WHERE 1
            $statusWhere
            $shop_id
        ")->fetchColumn();
        if ($invoice == false) {
            return new Response(false, "false", "", "");
        }
        return new Response(true, "success", $invoice->fetchAll(), "", $count);
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
    public function get_order_detail($id){
        if($id =="")  new Response(false, "Missing parameter", "", "", "");
        $order = $this->db->select("SELECT o.*, ad.name_receiver, ad.phone_number ,s.id as shop_id 
        FROM $this->db_name.order as o
        INNER JOIN delivery_address as ad
        ON ad.id = o.delivery_address_id
        INNER JOIN shop as s
        ON s.id = o.shop_id
        Where o.uuid = '$id'
        ")->fetchAll();
        if(count($order) >0){
            return new Response(true, "Thành công!", $order[0], "", "");
        }else{
            return new Response(false, "Đơn hàng không tồn tại", "", "", "");
        }

    }
    
    public function update_status_order_all($status) {
        $isLogin = Session::get("isLogin");
        if ($isLogin != true) {
            return new Response(false, "Vui lòng đăng nhập", "", "");
        }
        if ($status == "") {
            return new Response(false, "Missing parammeter", "", "");
        }
        $user_id = Session::get('id');
        $shop_id = $this->db->select("SELECT id from shop where user_id = '$user_id'")->fetchColumn();

        $order_ids = $this->db->select("SELECT o.id 
        FROM $this->db_name.order as o
        WHERE o.status = 'New'
        AND o.shop_id = '$shop_id'
        ")->fetchAll();

        $listId = [];
        foreach ($order_ids as $key => $value) {
            $id_order =  $value['id'];
            $listId[] = $id_order;
            // create link delivery
            $idEncode = base64_encode($id_order);
            $link = "?mod=verify&act=order&token=$idEncode";
            $this->db->insert("INSERT INTO link_order_ship (order_id,link)values($id_order,'$link')");
        }
        if(count($listId)>0){
            $inList = implode(',', $listId);
            $this->db->update("UPDATE $this->db_name.order as o 
            SET o.status = '$status', o.updated_at =now()
            WHERE o.id in ($inList)
            ");
            $arrMessage=[
                'Confirmed'=>"Đã xác nhận tất cả sản phẩm thành công!",
                "On_Delivery"=>"Tất cả sản phẩm đang được vận chuyển!"
            ];
            return new Response(true, $arrMessage[$status], "", "");
        }else{
            return new Response(false, "Chưa có đơn hàng nào để vận chuyển!", "", "");
            
        }
         
    }
    // get status order
    public function get_status_order($uuid) {
        $status = $this->db->select(("SELECT o.status from $this->db_name.order as o WHERE o.uuid = '$uuid' "))->fetchColumn();
        return ['status'=>$status];
    }
    // update status Order
    public function update_status_order($id, $status)
    {
        // $isLogin = Session::get("isLogin");
        // if ($isLogin != true) {
        //     return new Response(false, "Vui lòng đăng nhập", "", "");
        // }

        // if ($id == "" || $status == "") {
        //     return new Response(false, "Missing parammeter", "", "");
        // }
        // if ($status == 'Confirmed') {
        //     $idEncode = base64_encode($id);
        //     $link = "?mod=verify&act=order&token=$idEncode";
        //     $this->db->insert("INSERT INTO link_order_ship (order_id,link)values($id,'$link')");
        // }
        // if($status =='Completed'){
        //     $this->db->update("UPDATE link_order_ship SET is_expired = 1 WHERE order_id = '$id'");

        // }
       $this->db->update("UPDATE $this->db_name.order as o 
       SET o.status = '$status'
       WHERE id = '$id'
       ");
        $arrMessage = [
            'Processing'=>"Đã nhận đơn hàng đợi xử lý!",
            'Confirmed'=>"Đã xác nhận đơn hàng thành công!",
            "On_Delivery"=>"Đã nhân đơn hàng đến nơi vận chuyển!",
            'Completed'=>"Đơn hoàn thành đơn hàng!",
            "Cancelled"=>"Đã hủy đơn hàng thành công!"
        ];
        return new Response(true, $arrMessage[$status], "", "");
    }
    // get link order
    public function get_link_order($id)
    {
        $link = "";
        if ($id) {
            $link = $this->db->select("SELECT link FROM link_order_ship")->fetchColumn();
        }
        return $link;
    }
    public function check_link_order($id)
    {
        return $this->db->select("SELECT is_expired FROM link_order_ship")->fetchColumn();
    }
}

?>