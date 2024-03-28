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
   
    public function get_order_user($type = "")
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


    public function get_all_order($status = "", $page = 1, $limit = 5)

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
            ORDER BY o.created_at DESC
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
   
    // get link order
    public function get_link_order($id)  {
        $link ="";
        if($id){
            $link = $this->db->select("SELECT link FROM link_order_ship")->fetchColumn();
        }
        return $link;
    }
    public function check_link_order($id) {
        return $this->db->select("SELECT is_expired FROM link_order_ship")->fetchColumn();
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
       $this->db->update("UPDATE $this->db_name.order as o 
       SET o.status = '$status'
       WHERE id = '$id'
       ");
        $arrMessage = [
            'Processing'=>"Đã nhận đơn hàng đợi xử lý!",
            'Confirmed'=>"Đã xác nhận đơn hàng thành công!",
            "On_Delivery"=>"Đã nhận đơn hàng đến nơi vận chuyển!",
            'Completed'=>"Đã hoàn thành đơn hàng!",
            "Cancelled"=>"Đã hủy đơn hàng thành công!"
        ];
        return new Response(true, $arrMessage[$status], "", "");
    }
    // ===========new
    public function check_order_uuid($order_uuid,$status)  {
        if(Session::get('isLogin')==false){
            return new Response(false,'Vui lòng đăng nhập!');
        }
        $order = $this->db->select("SELECT * FROM $this->db_name.order WHERE uuid = '$order_uuid' AND status = 'New'")->fetchAll();
        if(count($order)>0){
            return true;
        }else{
            return false;
        }
    }
    // get order detail
    public function get_order_user_detail($order_uuid)  {
        if(Session::get('isLogin')==false){
            return new Response(false,'Vui lòng đăng nhập!');
        }
        $user_id = Session::get(('id'));
        $order_info = $this->db->select("SELECT o.*,u.email,
            shop.name shop_name, shop.uuid shop_uuid, shop.icon shop_icon,
            voucher.discount_amount,
            da.name_receiver address_name,da.phone_number address_phone, pr.name address_province,
            di.name address_district, wa.name address_ward
            FROM  $this->db_name.order as o
            INNER JOIN shop 
            ON shop.id = o.shop_id
            LEFT JOIN voucher 
            ON voucher.id = o.voucher_id
            INNER JOIN delivery_address as da
            ON da.id = o.delivery_address_id
            INNER JOIN user as u
            ON o.user_id = u.id

            INNER JOIN address_province as pr
            ON da.province = pr.matp
            INNER JOIN address_district as di
            ON da.district = di.maqh
            INNER JOIN address_ward as wa
            ON da.address_detail = wa.xaid


            WHERE o.uuid = '$order_uuid'
            AND o.user_id = '$user_id'
        ")->fetchAll();
        if(count($order_info)>0){
            $order_id = $order_info[0]['id'];
            $list_order = $this->db->select("SELECT order_detail.*,product.image_cover, product.name,product.origin,product.brand,c.name as categoryName
                FROM order_detail
                INNER JOIN product 
                ON product.id = order_detail.product_id
                INNER JOIN category as c
                ON product.category_id = c.id
                WHERE order_detail.order_id = '$order_id'
            ")->fetchAll();
            return new Response(true,'success',['order_info'=>$order_info[0],'list_order'=>$list_order]);
        }else{
            return new Response(false,'fail');
        }
    }
    // cacel order
    public function cancel_order_user($order_uuid) {
        if(Session::get('isLogin')==false){
            return new Response(false,'Vui lòng đăng nhập!');
        }
        $user_id = Session::get(('id')); 
        $this->db->update("UPDATE $this->db_name.order set status = 'Cancelled' WHERE uuid = '$order_uuid' AND user_id = '$user_id'");
        return new Response(true,'Đã hủy đơn hàng!');
    }
    // get list order user
    public function get_list_user_order($status="",$seach="",$page=1,$limit = 5) {
        if(Session::get('isLogin')==false){
            return new Response(false,'Vui lòng đăng nhập!');
        }
        $user_id = Session::get(('id'));
        $currentPage = ($page-1)*$limit; 
        $queryWhere ='';
        if(!empty($status)){
            if($status == 'Processing'){
                $queryWhere .= !empty($status) ? " AND (o.status = '$status' OR o.status = 'Confirmed' OR o.status = 'New') ":"";

            }else{
                $queryWhere .= !empty($status) ? " AND o.status = '$status' ":"";
            }
        }
        $queryWhere .= !empty($seach) ? " AND (o.id LIKE '%$seach%' OR shop.name LIKE '%$seach%' ) ":"";

        $orders = $this->db->select("SELECT  o.* 
                FROM $this->db_name.order as o
                INNER JOIN shop
                ON shop.id = o.shop_id
                WHERE o.user_id = '$user_id'
                $queryWhere
                ORDER BY o.updated_at DESC
                limit $currentPage,$limit
            ")->fetchAll();
        // total
        $total = $this->db->select("SELECT  count(*) 
                FROM $this->db_name.order as o
                INNER JOIN shop
                ON shop.id = o.shop_id
                WHERE o.user_id = '$user_id'
                $queryWhere
            ")->fetchColumn();
        return new Response(true,'success',$orders,'',$total);
    }
   
}

?>