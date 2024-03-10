<?php
include_once "lib/database.php";
include_once "helpers/format.php";
include_once "helpers/tool.php";
include_once "model/entity.php";
?>
<?php
class Category
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
    public function createNewCate($name, $file, $type = "", $id = "")
    {
        $name = $this->fm->validation($name);
        if (empty($name)) {
            $alert = "Name and file image must no be empty!";
            return $alert;
        } else {
            $slug = $this->tool->slug($name, '-');
            $fileResult = $this->tool->uploadFile($file);
            if (($type && $type == 'update') && $id != "") {
                if ($fileResult) {
                    $sqlFile = "imageCate = '$fileResult',";
                }
                $resultUpdate = $this->db->update("UPDATE category 
                    SET nameCate = '$name',slug ='$slug',$sqlFile createdAt = NOW()
                    WHERE id = '$id'
                ");
                if ($resultUpdate == false) {
                    return "Update category fail!";
                } else {
                    return "Update category successfully!";
                }
            } else {
                if ($fileResult == false) {
                    return 'Something arong from your file!';
                }
                $query = "INSERT INTO category (nameCate, slug, imageCate) VALUES
                        (
                            '$name',
                            '$slug',
                            '$fileResult'
                        )
                    ";
                $result = $this->db->insert($query);
                if ($result != false) {
                    return "Create new category successfully!";
                } else {
                    $alert = "Wrong from server!";
                    return $alert;
                }
            }
        }
    }
    function buildCategoryTree($categories, $parentId = 0)
    {
        $branch = [];
        foreach ($categories as $key => $category) {
            if ($category['parent_id'] == $parentId . "") {
                $children = $this->buildCategoryTree($categories, $category['id']);
                if ($children) {
                    $category['children'] = $children;
                }
                $branch[] = $category;
            }
        }

        return $branch;
    }

    public function getAllCate($idCate = 0)
    {
        $query = "SELECT c.*, COUNT(p.category_id) as count
                from  category as c
                LEFT JOIN product AS p
                ON p.category_id = c.id
                GROUP BY c.id
        ";
        $result = $this->db->select($query)->fetchAll();
        // $tree = buildCategoryTree($categories);
        // print_r($this->buildCategoryTree($result));
        // echo json_encode($this->buildCategoryTree($result), JSON_PRETTY_PRINT);
        // return;

        return($this->buildCategoryTree($result, $idCate));


    }


    public function getInfoCate($id)
    {
        if ($id) {
            $result = $this->db->select("SELECT * FROM category WHERE id = '$id'");
            $result = $result->fetchAll()[0];
            // return new Response(true, "Thành công!", $result, "", "");
            return $result;
        }
    }


    public function deleteCate($id)
    {
        $isLogin = Session::get("isLogin");
        if ($isLogin != true) {
            return new Response(true, "success", ["total" => 0, "totalPrice" => 0], "");
        }
        $role = Session::get("role");
        if ($role != "adminall") {
            return new Response(false, "Bạn không có quyền cho hành động này!", "", "");
        }
        if (empty($id)) {
            return "Idcategory cannot be empty";
        }
        $query = "DELETE FROM category WHERE id = '$id'";
        $result = $this->db->delete($query);
        if ($result != false) {
            return new Response(true, "Xóa danh mục thành công!", "", "");
        } else {
            return new Response(false, "Xóa danh mục thất bại!", "", "");
        }
    }
}

?>