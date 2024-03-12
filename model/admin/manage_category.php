<?php
include_once "helpers/tool.php";
include_once "lib/database.php";
include_once "model/entity.php";

class CategoryAdmin
{
    private $tool;
    private $db;

    public function __construct()
    {
        $this->tool = new Tool();
        $this->db = new Database();
    }

    public function manageCategory($name_category = null, $icon = null, $id_parent, $type = null)
    {

        $link_img = $this->tool->uploadFile($icon, "category/");
        $query = "";

        $slug = $this->tool->slug($name_category);
        if ($type == "create") {
            $query = "INSERT INTO `category` (`name`, `icon`, `parent_id`, `slug`) VALUES ('$name_category', '$link_img', '$id_parent', '$slug');";
            $this->db->insert($query);
            return new Response(true, "Cập nhật danh mục thành công", "", "", "");
        } else if ($type == "update") {
            $queryImg = "";
            if ($link_img != false) {
                $queryImg = " ,icon='$link_img'";
            }
            $query = "UPDATE `category` SET name = '$name_category', slug = '$slug' $queryImg where id = '$id_parent' ";
            $this->db->insert($query);
            return new Response(true, "Cập nhật danh mục thành công", "", "", "");
        } else {
            $query = "UPDATE `category`
                    SET is_deleted = 1
                    WHERE id = '$id_parent';";
            $this->db->insert($query);
            return new Response(true, "Xóa danh mục thành công", "", "", "");
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
                WHERE c.is_deleted = 0 GROUP BY c.id
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
