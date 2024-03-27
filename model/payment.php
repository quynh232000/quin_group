<?php
include_once "lib/database.php";
include_once "helpers/tool.php";
include_once "model/entity.php";
include_once "model/cart.php";
include_once "model/transaction.php";
include_once "lib/session.php";
?>
<?php
class Payment
{
    private $db;
    private $tool;
    private $response;

    public function __construct()
    {
        $this->db = new Database();
        $this->tool = new Tool();
    }
    public function payment_vnp($data)
    {
        $vnp_Url = VNP_URL;
        $vnp_Returnurl = $data['vnp_returnurl'];
        $vnp_TmnCode = "RIIFM9FX";
        $vnp_HashSecret = VNP_HASHSECRET;
        $startTime = date("YmdHis");
        $expire = date('YmdHis', strtotime('+15 minutes', strtotime($startTime)));

        $vnp_TxnRef = $data['vnp_TxnRef'];
        $vnp_Amount = $data['amount'];
        $vnp_Locale = 'vn';
        $vnp_BankCode = $data['bank_code'];
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
        $order_uuid = $data['order_uuid'];

        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount * 100,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => "Thanh toan GD:" . $vnp_TxnRef . '-' . $order_uuid,
            "vnp_OrderType" => "other",
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
            "vnp_ExpireDate" => $expire
        );

        if (isset ($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        // return $inputData;
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset ($vnp_HashSecret)) {
            $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);//  
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        $returnData = array(
            'code' => '00'
            ,
            'message' => 'success'
            ,
            'data' => $vnp_Url
        );
        return new Response(true, 'sucess', $vnp_Url);

    }
    // check result payment vnp
    public function result_payment_vnpay($inputData, $vnp_SecureHash,$data)
    {
        $vnp_HashSecret = VNP_HASHSECRET;
        $i = 0;
        $hashData = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashData = $hashData . '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashData = $hashData . urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
        }

        $secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);
        if ($secureHash == $vnp_SecureHash) {
            if ($_GET['vnp_ResponseCode'] == '00') {
                $classCart = new Cart();
                $shipping_fee = isset ($data['shipping_fee']) ? $data['shipping_fee'] : 0;
                $result_checkout = $classCart->check_out(
                    $data['shop_uuid'],
                    $data['order_uuid'],
                    $data['sub_total'],
                    $data['total'],
                    $shipping_fee,
                    $data['delivery_address_id'],
                    'Banking',
                    $data['voucher_id'] ??"",
                    '',
                    '1'
                );
                if($result_checkout->status){
                    $classTransaction = new Transaction();
                    $order_id = $result_checkout->result['order_id'];
                    $classTransaction->create_transaction($inputData['vnp_TransactionNo'],$order_id,$inputData['vnp_Amount'] / 100,$inputData['vnp_BankCode'],$inputData['vnp_OrderInfo']);
                }
                return new Response(true,'Đặt hàng thành công!',['order_uuid'=> $data['order_uuid']]);
            } else {
                return new Response(false, "Giao dịch không thành công!");
            }
        } else {
            return new Response(false, "Giao dịch không thành công! Chữ kí không hợp lệ.");
        }
    }


}


?>