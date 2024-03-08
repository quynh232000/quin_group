<?php
include_once "helpers/tool.php";
include_once "lib/database.php";

class CategoryAdmin
{
    private $tool;
    private $db;

    public function __construct()
    {
        $this->tool = new Tool();
        $this->db = new Database();
    }

    public function createImg($file)
    {
        return $this->tool->uploadFile($file);
    }

    public function insertToDB($name_category, $icon)
    {
        $query = "INSERT INTO `category` (`name`, `icon`, `parent_id`, `is_deleted`) VALUES ('$name_category', '$icon', '0', '0');";
        $this->db->insert($query);
    }

    // public function getAllCate($idCate = 0)
    // {
    //     $query = "SELECT * from category where parent_id = $idCate";
    //     $result = $this->db->select($query)->fetchAll();
    //     // $tree = buildCategoryTree($categories);
    //     // print_r($this->buildCategoryTree($result));
    //     // echo json_encode($this->buildCategoryTree($result), JSON_PRETTY_PRINT);
    //     // return;
    //     return $result;
    // }


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
        return ($this->buildCategoryTree($result, $idCate));
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
}
