<?php
include "./config/config.php";
?>
<?php
class Database
{

    //     public $host   = DB_HOST;
    // public $user   = DB_USER;
    // public $pass   = DB_PASS;
    // public $dbname = DB_NAME;

 public $host = "localhost";
    public $user = "quingroup";
    public $pass = "Quingroup123.";
    
    // public $dbname = "quinshop";
    public $dbname = "quingroup";




    public $link;
    public $error;

    public function __construct()
    {
        $this->connectDB();
    }
    // ----------------pddo ------------
    private function connectDB()
    {
        try {
            $conn = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->user, $this->pass);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->link = $conn;
        } catch (PDOException $e) {
            return false;
        }
    }

    // select or read data
    public function select($query)
    {
        $stmt = $this->link->prepare($query);
        $stmt->execute();
        // $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);


        return $stmt;
    }

    public function selectMultiple($query) {
        $stmt = $this->link->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function selectOne($query) {
        $stmt = $this->link->prepare($query);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function insert($query)
    {
        return $this->link->exec($query);
    }
    public function update($query)
    {
        $stmt = $this->link->prepare($query);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return true;
        } else {
            return false;
        }

    }
    public function delete($query)
    {
        return $this->link->exec($query);
    }
}

?>
