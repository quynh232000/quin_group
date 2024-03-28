<?php
include_once "lib/database.php";
class UserDetailAdmin
{
    private $db;
    public function __construct()
    {
        $this->db = new Database();
    }

    public function getInputParam()
    {
        $entityBody = file_get_contents('php://input');
        return json_decode($entityBody);
    }

    public function getInfoUser($uid)
    {
        $query = "SELECT * from quingroup.user where id = '$uid'";
        return $this->db->selectOne($query);
    }

    public function selectMinAndMaxDate()
    {
        $query = "SELECT 
                        DATE_FORMAT(MIN(created_at), '%Y-%m') AS min_created_at,
                        DATE_FORMAT(MAX(created_at), '%Y-%m') AS max_created_at
                    FROM quingroup.order;";
        return $this->db->selectOne($query);
    }

    public function getStatistic($uid, $viewMode)
    {
        $dateFormat = "";
        $viewModeParam = "";
        switch ($viewMode) {
            case "7d":
                $viewModeParam .= " DATE_SUB(NOW(), INTERVAL 7 DAY) ";
                $dateFormat .= " DATE(quingroup.order.created_at) ";
                break;
            case "30d":
                $viewModeParam .= " DATE_SUB(NOW(), INTERVAL 30 DAY) ";
                $dateFormat .= " DATE(quingroup.order.created_at) ";
                break;
            case "12M":
                $viewModeParam .= " DATE_SUB(NOW(), INTERVAL 12 MONTH) ";
                $dateFormat .= " DATE_FORMAT(quingroup.order.created_at, '%Y-%m') ";
                break;
            case "All":
                $viewModeParam .= " (SELECT MIN(created_at) FROM quingroup.order) ";
                $dateFormat .= " DATE_FORMAT(quingroup.order.created_at, '%Y-%m') ";
                break;
        }

        $query = "SELECT $dateFormat AS order_date, COUNT(*) AS order_count
                    FROM quingroup.order
                    INNER JOIN quingroup.user ON quingroup.order.user_id = quingroup.user.id
                    WHERE quingroup.order.created_at BETWEEN $viewModeParam AND NOW()
                    AND quingroup.user.id = '$uid'
                    GROUP BY order_date
                    ORDER BY order_date DESC;";
        // AND quingroup.order.status = 'Completed'
        return $this->db->selectMany($query);
    }

    public function getDataStatistic()
    {
        $minAndMAxDate = self::selectMinAndMaxDate();
        $dataBody = self::getInputParam();
        if ((isset($dataBody->uid) && $dataBody->uid) && (isset($dataBody->viewMode) && $dataBody->viewMode)) {
            $value = self::getStatistic($dataBody->uid, $dataBody->viewMode);
            if (!empty($value)) {
                echo json_encode(["status" => true, "result" => $value, "type" => $dataBody->viewMode, "min_max_date" => $minAndMAxDate], JSON_PRETTY_PRINT);
            } else {
                echo json_encode(["status" => true, "result" => [], "type" => $dataBody->viewMode], JSON_PRETTY_PRINT);
            }
        }
    }

    public function searchUserByEmail($email)
    {
        $query = " SELECT id FROM quingroup.user WHERE email = '$email';";
        return $this->db->selectOne($query);
    }
}
