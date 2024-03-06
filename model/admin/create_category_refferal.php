<?php
include_once "helpers/tool.php";
include_once "lib/database.php";

class Category
{
    private $tool;
    private $db;

    public function __construct()
    {
        $this->tool = new Tool();
        $this->db = new Database();
    }

    public function createParentCategory($file)
    {
        return $this->tool->uploadFile($file);
    }

    public function insertToDB($name_category, $icon)
    {
        $query = "INSERT INTO `category` (`name`, `icon`, `parent_id`, `is_deleted`) VALUES ('$name_category', '$icon', '0', '0');";
        $this->db->insert($query);
    }

    public function selectParentCategories()
    {
        $query = "SELECT * from category where parent_id = 0";
        $this->db->selectAll($query);
    }
}
