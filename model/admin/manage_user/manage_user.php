<?php
include_once "lib/database.php";
include_once "helpers/tool.php";
class UserAdmin
{
    private $tool;
    private $db;

    public function __construct()
    {
        $this->tool = new Tool();
        $this->db = new Database();
    }

    public function getInputParam()
    {
        $entityBody = file_get_contents('php://input');
        return json_decode($entityBody);
    }

    public function countPages($role)
    {
        $whereStatement = "";
        $whereStatement = $role == "All" ? "" : " where role = '$role'";
        $query = "SELECT count(*) as total from quingroup.user $whereStatement;";
        return $this->db->selectOne($query);
    }

    public function selectUsers($role = "", $limit = "", $page = "", $uid = "")
    {

        $roleParam = "";

        $offset = $page == "" ? "" : ($page - 1) * $limit;
        $paginate = "";
        $whereUID = "";
        if (!empty($uid)) {
            $whereUID .= " where u.id = '$uid'";
        } else {
            if (!empty($role) && $role == "All") {
                $roleParam = "";
                $paginate .= " limit $limit offset $offset";
            } else {
                $roleParam .= " WHERE u.role = '$role'";
                $paginate .= " limit $limit offset $offset";
            }
        }

        $query = "SELECT u.id as user_id,
                    u.full_name as user_fullname,
                    u.email as user_email,
                    u.phone_number as user_phone,
                    u.avatar as user_avatar, 
                    u.address as user_address,
                    u.role as user_role,
                    u.created_at as user_created,
                    u.updated_at as user_updated
                    FROM quingroup.user u $whereUID $roleParam order by u.created_at desc $paginate;";
        return $this->db->selectMany($query);
    }

    public function updateUserWithParam($name = null, $email = null, $phone = null, $password = null, $avatar, $addr = null, $role = null, $id)
    {

        $link_img = $this->tool->uploadFile($avatar, "user/");
        $queryImg = "";

        if ($link_img != false) {
            $queryImg = " , avatar = '$link_img'";
        }

        $queryName = empty($name) ? "" : " full_name = '$name',";
        $queryEmail = empty($email) ? "" : " email = '$email',";
        $queryPhone = empty($phone) ? "" : " phone_number = '$phone',";
        $queryPassword = empty($password) ? "" : " password = '$password',";
        $queryAddr = empty($addr) ? "" : " address = '$addr',";
        $queryRole = empty($role) ? "" : " role = '$role',";

        $query = "UPDATE `quingroup`.`user` SET $queryName $queryEmail $queryPhone $queryPassword $queryImg $queryAddr $queryRole updated_at = CURRENT_TIMESTAMP() WHERE (id = '$id');";
        return $this->db->insert($query);
    }

    public function doingWithUser()
    {
        $dataParam = self::getInputParam();
        if (isset($dataParam->UID) && $dataParam->UID) {
            $dataUser = self::selectUsers("", "", "", $dataParam->UID);
            echo json_encode($dataUser);
        }
    }

    public function updateUser()
    {
        if (isset($_POST["userId"]) && $_POST["userId"]) {
            $result = self::updateUserWithParam(
                $_POST["name"],
                $_POST["email"],
                $_POST["phone"],
                $_POST["password"],
                $_FILES["img"],
                $_POST["address"],
                $_POST["role"],
                $_POST["userId"]
            );
            if ($result) {
                $changeRole = empty($_POST["role"]) ? "" : $_POST["role"];
                echo json_encode(["status" => true, "role" => $changeRole, "message" => "updated successful!"], JSON_PRETTY_PRINT);
            } else {
                echo json_encode(["status" => false, "message" => "Failure"], JSON_PRETTY_PRINT);
            }
        }
    }
}
