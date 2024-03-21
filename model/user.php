<?php
include_once "lib/database.php";
include_once "helpers/tool.php";
include_once "model/entity.php";
include_once "lib/session.php";
?>
<?php
class User
{
    private $db;
    private $tool;
    private $response;

    public function __construct()
    {
        $this->db = new Database();
        $this->tool = new Tool();
    }
    public function getAllUser()
    {
        $isLogin = Session::get("isLogin");
        if ($isLogin != true) {
            return new Response(false, "false", "", "");
        }
        $user = $this->db->select("SELECT * from user WHERE isDelete = '0'");
        if ($user == false) {
            return new Response(false, "false", "", "");
        }
        return new Response(true, "success", $user->fetchAll(), "");

    }
    public function getUserById($id)
    {
        if ($id == "") {
            return new Response(false, "false", "", "");
        }
        $allRole = $this->db->select("SELECT u.role   FROM user as u group by u.role");
        // $getAllRole = [];
        // if ($allRole != false) {
        //     while ($row = mysqli_fetch_assoc($allRole)) {
        //         $getAllRole[] = $row;
        //     }

        // }
        $user = $this->db->select("SELECT * FROM user Where id = '$id'");
        if ($user == false) {
            return new Response(false, "Tài khoản không tồn tại!", "", "");
        }
        // $user = $user->fetch_assoc();
        return new Response(true, "success", $user->fetch(), "", $allRole->fetchAll());

    }
    public function updateUser($fullName, $image, $phone, $email, $role, $id)
    {
        $isLogin = Session::get("isLogin");
        $userId = Session::get("id");
        if ($isLogin != true) {
            return new Response(false, "false", "", "?mod=profile&act=login");
        }
        $checkRoleAdmin = Session::get("role");
        if ($checkRoleAdmin != "adminall") {
            return new Response(false, "Bạn không có quyền chỉnh sửa thông tin tài khoản!", "", "?mod=profile&act=login");
        }

        if (empty($fullName) || empty($email) || empty($id)) {
            return new Response(false, "Hành động có vấn đề!", "", "");
        }

        // update user
        $queryUpdate = "";
        $fileResult = $this->tool->uploadFile($image);
        if ($fileResult) {
            $queryUpdate .= "u.avatar = '$fileResult',";
        }
        $queryUpdate .= "u.fullName = '$fullName',";
        $queryUpdate .= "u.phone = '$phone',";
        if ($role != "") {
            if ($userId == $id) {
                return new Response(false, "Bạn không thể đổi quyền của chính mình!", "", "?mod=profile&act=login");
            }
            $queryUpdate .= "u.role = '$role',";

        }
        $queryUpdate .= "u.email = '$email',";
        $queryUpdate .= "u.updatedAt = NOW()";
        $updateUser = $this->db->update("UPDATE user u
            SET $queryUpdate
            WHERE u.id = '$id'
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
        header("Location: ?mod=admin&act=manageuser");
        return new Response(true, "Cập nhật thông tin thành công", "", "?mod=admin&act=manageuser", "");

    }
    public function deleteUser($id) {
        $isLogin = Session::get("isLogin");
        if ($isLogin != true) {
            return new Response(false, "false", "", "?mod=profile&act=login");
        }
        $checkRoleAdmin = Session::get("role");
        if ($checkRoleAdmin != "adminall") {
            return new Response(false, "Bạn không có quyền xóa thông tin tài khoản!", "", "?mod=profile&act=login",'');
        }
        if($id == ""){
            return new Response(false, "Missing parammeter!", "Missing parammeter!", "?mod=admin&act=manageuser", "");
        }
        $this->db->delete("DELETE FROM user WHERE id = '$id' ");
        return new Response(true, "Xóa tài khoản thành công", "Xóa tài khoản thành công", "?mod=admin&act=manageuser", "");
    }
    public function checkPass($pass)  {
        $isLogin = Session::get("isLogin");
        $userId = Session::get("id");
        if ($isLogin != true) {
            return new Response(false, "Something wrong! Your are not login", "", "?mod=profile&act=login");
        }

        $checkPassSql = $this->db->select("SELECT * from user where id = '$userId' and password = '$pass'");
        $user = $checkPassSql->fetchAll();
        if(empty($user)){
            return new Response(false, "Mật khẩu cũ không chính xác. Vui lòng nhập lại!", "", "");
        }
        return new Response(true, "success", "", "");

    }
    public function changeNewPass($newPass) {
        $isLogin = Session::get("isLogin");
        $userId = Session::get("id");
        if ($isLogin != true) {
            return new Response(false, "Something wrong! Your are not login", "", "?mod=profile&act=login");
        }
        $this->db->update("UPDATE  user SET user.password = '$newPass', user.updated_at = CURRENT_TIMESTAMP WHERE id = '$userId'");

        return new Response(true, "success", "", "");
    }

    public function getAddress() {
        $isLogin = Session::get("isLogin");
        $userId = Session::get("id");
        if ($isLogin != true) {
            return new Response(false, "Something wrong! Your are not login", "", "?mod=profile&act=login");
        }
        $addressSql = $this->db->select("SELECT * FROM address WHERE userId = '$userId' limit 1");
        $address = $addressSql->fetchAll();
        if(empty($address)){
            return new Response(false, "Empty", "", "");
        }
        return new Response(true, "success", $address[0], "");
    }
  

}



?>