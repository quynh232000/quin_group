<?php

// include_once "lib/phpmailer/";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

include_once 'lib/phpmailer/src/Exception.php';
include_once 'lib/phpmailer/src/PHPMailer.php';
include_once 'lib/phpmailer/src/SMTP.php';
include_once "lib/database.php";
include_once "lib/database.php";
include_once "helpers/format.php";
include_once "helpers/tool.php";
include_once "model/entity.php";
?>
<?php
class Adminlogin
{
    private $db;
    private $fm;
    private $tool;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
        $this->tool = new Tool();
    }
    public function login_admin($email, $password,$redirect ="")
    {
        
        if (empty($email) || empty($email)) {
            $alert = "Vui lòng nhập đầy đủ thông tin!";
            return ["status" => false, "message" => $alert, "result" => [], "redirect" => ""];
        } else {
            $query = "SELECT * FROM user WHERE email ='$email' AND password = '$password' LIMIT 1";
            $user = $this->db->select($query);
            $result = $user->fetch();

            if ($result != false) {

                $value = $result;
                Session::set('isLogin', true);

                Session::set('id', $value['id']);
                Session::set('full_name', $value['full_name']);
                Session::set('email', $value['email']);
                Session::set('avatar', $value['avatar']);
                Session::set('role', $value['role']);
                Session::set('phone', $value['phone']);
                return ["status" => true, "message" => "Đăng nhập thành công!", "result" => [], "redirect" => $redirect];
            } else {
                $alert = "Tên đăng nhập hoặc tài khoản không đúng!";
                return ["status" => false, "message" => $alert, "result" => [], "redirect" => ""];
            }
        }
    }
    public function register_admin( $fullName, $email, $phone, $password, $confirmPassword)
    {


        if (empty($fullName)) {
            $alert = "Họ và tên không được để trống!";
            return ["status" => false, "message" => $alert, "result" => []];
        }
        if (empty($email)) {
            $alert = "Email không được để trống!";
            return ["status" => false, "message" => $alert, "result" => []];

        }
        if (empty($password) || empty($confirmPassword)) {
            $alert = "Mật khẩu không được để trống!!";
            return ["status" => false, "message" => $alert, "result" => []];

        }
        
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {

            return ["status" => false, "message" => 'Email không đúng định dạng!', "result" => []];
       }
        if ($password != $confirmPassword) {
            $alert = "Mật khẩu không khớp!";
            return ["status" => false, "message" => $alert, "result" => []];

        }
        if ( strlen($password)<8 ){
            return ["status" => false, "message" => 'Password phải từ 8 kí tự chở lên!', "result" => []];

        }
        $checkUser = $this->db->select("select * from user where email = '$email';");
        if (count($checkUser->fetchAll()) > 0) {
            return ["status" => false, "message" => "Email đã tồn tại!", "result" => []];
        }
        $avatar = '5EA63482-44B3-40C9-B3A8-1479DB08CCD4.jpg';
        $id = $this->tool->GUID();
        $pass = md5($password);
        $query = "INSERT INTO user (id,full_name,email,phone,password,avatar) VALUE
               ( '$id',
                 '$fullName',
                '$email',
                '$phone',
                '$pass',
                '$avatar')
            ";
        $this->db->insert($query);

                Session::set('isLogin', true);

                Session::set('id',$id);
                Session::set('full_name', $fullName);
                Session::set('email', $email);
                Session::set('avatar', $avatar);
                Session::set('role','member');
                Session::set('phone', $phone);
        // $this->login_admin($email,$password,"/");
        // return ["status" => true, "message" => "Đăng kí thành công!", "result" => [], "redirect" => "?mod=profile&act=login"];
        return ["status" => true, "message" => "Đăng kí thành công!", "result" => [], "redirect" => "./"];

    }
    public function updateProfile($fullName, $image, $phone, $email)
    {
        $isLogin = Session::get("isLogin");
        if ($isLogin != true) {
            return new Response(false, "false", "", "?mod=profile&act=login");
        }
        $userId = Session::get("id");
        $checkUser = $this->db->select("SELECT * FROM user WHERE id = '$userId'");
        if ($checkUser == false) {
            return new Response(false, "Thất bại!", "", "?mod=profile&act=login");
        }
        if (empty($fullName) || empty($email)) {
            return new Response(false, "Họ tên và Email không được để trống thông tin!", "", "");
        }
        // update user
        $queryUpdate = "";
        $fileResult = $this->tool->uploadFile($image);
        if ($fileResult) {
            $queryUpdate .= "u.avatar = '$fileResult',";
        }
        $queryUpdate .= "u.fullName = '$fullName',";
        $queryUpdate .= "u.phone = '$phone',";
        $queryUpdate .= "u.email = '$email',";
        $queryUpdate .= "u.updatedAt = NOW()";
        $updateUser = $this->db->update("UPDATE user u
            SET $queryUpdate
            WHERE u.id = '$userId'
        ");
        if ($updateUser == false) {
            return new Response(false, "Cập nhật thông tin tài khoản thất bại", "", "", "");
        }
        Session::set('fullName', $fullName);
        Session::set('email', $email);
        if ($fileResult) {
            Session::set('avatar', $fileResult);
        }
        Session::set('phone', $phone);
        return new Response(true, "Cập nhật thông tin thành công", "", "", "");

    }
    public function sendCodePassEmail($email)
    {
        
        if (empty($email)) {
            return new Response(false, "Missing parammeter: Email", "", "?mod=profile&act=forgotpassword");
        }
        $resultUser = $this->db->select("SELECT * FROM user WHERE email =  '$email'");
        $checkEmail =$resultUser->fetchAll();
        if (empty($checkEmail)) {
            return new Response(false, "Email không tồn tại trong hệ thống", "", "?mod=profile&act=forgotpassword");
        }
        $checkEmail =  $checkEmail[0];
        $id = $checkEmail['id'];

        $idEncode = base64_encode($id);
        
        $code = mt_rand(1000, 9999);
        // insert database
        $this->db->update("UPDATE user 
        set timeVerify = DATE_ADD(now(), INTERVAL 3 MINUTE) , codeVerify = '$code' 
        WHERE id = '$id'
        ");

        
        // mesage
        $mesage = '<div style="padding: 40px 40px; font-size: 20px; border: 4px solid rgb(8, 110, 234);">
            <div style="width: 100%; text-align: center;margin-bottom: 20px;">Hi, <span style="color: blue;font-weight: bold;">' . $checkEmail['fullName'] . '</span>!</div>
            <div style="text-align: center;">Here is the confirmation code:</div>
            <div style="font-size: 60px;letter-spacing: 10px;font-weight: bolder; text-align: center;margin: 20px 0;" >' . $code . '</div>
            <div style="color: rgb(72, 20, 141);text-align: center;">All you have to do is copy the confirmation code and paste it to your form to complete the email verification process</div>
        </div>';
        // mesage

        
        // send email
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'tranong600@gmail.com';
        $mail->Password = 'loxzmyaqqfuiupmj';
        $mail->SMTPSecure = 'tsl';
        $mail->SetLanguage("vi", 'lib/phpmailer/language');
        $mail->Port = 587; // TCP port to connect to 587
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );

        $mail->setFrom('tranong600@gmail.com');
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = "Code verify change password!";
        
        $mail->Body = $mesage;
        $mail->send();

        return new Response(true, "Send email successfully", "", "?mod=profile&act=forgotpassword&verifytoken=".$idEncode);
    }
    function checkToken($token) {
        $tokenDecode = base64_decode($token);

        $checkUser = $this->db->select("SELECT * FROM user WHERE id = '$tokenDecode'");
        if(empty($checkUser->fetchAll())){
            return new Response(false, "Đường dẫn không hợp lệ!", "", "?mod=profile&act=forgotpassword");
        }else{
            return new Response(true, "success",  $tokenDecode, "");
        }
        
    }
    function checkCode($code,$token)  {
        $checkTokenVerify = self::checkToken($token);
        if($checkTokenVerify->status ==false){
            return $checkTokenVerify;
        }
        $userId = $checkTokenVerify->result;
        $userInfoSelect = $this->db->select("SELECT * FROM user where id = '$userId' ");
        $userInfo = $userInfoSelect->fetchAll();
        if(empty($userInfo)){
            return new Response(false, "Người dùng không tồn tại",  "", "");
        }

        $userInfo = $userInfo[0];
        // print_r($userInfo);
        // return;
        if($userInfo['codeVerify'] != $code){
            return new Response(false, "Mã xác nhận không hợp lệ!",  "", "");
        }
        $timeVerify = $userInfo['timeVerify'];
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $timeNow = date('Y-m-d h:i:s');
        // if($timeNow > strtotime($timeVerify)){
        //     return new Response(false, "Mã xác thực đã hết hạn. Vui lòng thử lại!",  "", "");
        // }
        return new Response(true, "success",  "", "");
    }
    public function changePassword($pass, $token)  {
        $checkTokenVerify = self::checkToken($token);
        if($checkTokenVerify->status ==false){
            return $checkTokenVerify;
        }
        $userId = $checkTokenVerify->result;
        $userInfoSelect = $this->db->select("SELECT * FROM user where id = '$userId' ");
        $userInfo = $userInfoSelect->fetchAll();
        if(empty($userInfo)){
            return new Response(false, "Người dùng không tồn tại",  "", "");
        }
        // change pass
        $changePass = $this->db->update("UPDATE user set pass = '$pass'
        WHERE id = '$userId'
        ");
        return new Response(true, "success",  "", "");
    }
}

?>