<?php
include_once "lib/database.php";
include_once "helpers/format.php";
include_once "helpers/tool.php";
include_once "model/entity.php";
?>
<?php
class Product
{
    private $db;
    private $fm;
    private $tool;
    private $response;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
        $this->tool = new Tool();
    }
    public function updateProduct(
        $name = '',
        $description = '',
        $categoryId = '',
        $quantity = '',
        $origin = '',
        $brand = '',
        $price = '',
        $salePercent = '',
        $image = '',
        $listImage = '',
        $unit = '',
        $type = '',
        $id = ''
    ) {
        // edit

        if ($type == 'edit' && $id != '') {
            $queryUpdate = '';
            $queryUpdate .= "p.namePro = '$name',";
            $queryUpdate .= "p.description = '$description',";
            $queryUpdate .= "p.categoryId = '$categoryId',";
            $queryUpdate .= "p.quantity = '$quantity',";
            $queryUpdate .= "p.origin = '$origin',";
            $queryUpdate .= "p.brand = '$brand',";
            $queryUpdate .= "p.price = '$price',";
            $queryUpdate .= "p.salePercent = '$salePercent',";
            $queryUpdate .= "p.price = '$price',";
            // upload img
            $fileResult = $this->tool->uploadFile($image);
            if ($fileResult) {
                $queryUpdate .= "p.image = '$fileResult',";
            }
            $queryUpdate .= 'updatedAt = NOW()';
            $resultEditPro = $this->db->update("UPDATE product AS p
                        SET $queryUpdate
                        WHERE p.id = $id
            ");
            if ($resultEditPro == false) {
                return new Response(false, "Cập nhật sản phẩm thất bại", "", "", "");
            }
            return new Response(true, "Cập nhật sản phẩm thành công", "", "", "");
        } else {
            // create
            $slug = $this->tool->slug($name, '-');
            $fileResult = $this->tool->uploadFile($image);
            $query = "INSERT INTO product (product.namePro, product.description, product.categoryId,product.status,
            product.quantity,product.brand,product.image,origin,price,
            salePercent,slug,unit,createdAt,sold) VALUES
                (
                    '$name',
                    '$description',
                    '$categoryId',
                    'active',
                    '$quantity',
                    '$brand',
                    '$fileResult',
                    '$origin',
                    '$price',
                    '$salePercent',
                    '$slug',
                    '$unit',
                    NOW(),
                    0
                )
            ";
            $result = $this->db->insert($query);
            if ($result == false) {
                $alert = "Create new product error! Wrong from server!";
                return $alert;

            }
            // get id product
            $getIdPro = $this->db->select("SELECT LAST_INSERT_ID();");
            $idPro = $getIdPro->fetchColumn();
            // list img
            $totalFile = count($listImage['name']);
            $querylistImg = "";
            for ($i = 0; $i < $totalFile; $i++) {
                $fileDir = "./assest/upload/";
                if (isset($listImage['error'][$i]) && $listImage['error'][$i] == 0) {
                    $fileName = basename($listImage['name'][$i]);
                    if (!file_exists($fileDir)) {
                        mkdir($fileDir, 0, true);
                    }
                    $fileNameNew = $this->tool->GUID() . "." . (explode(".", $fileName)[1]);
                    $fileDir = $fileDir . $fileNameNew;
                    if (move_uploaded_file($listImage['tmp_name'][$i], $fileDir)) {
                        $querylistImg .= "('$idPro', '$fileNameNew',NOW()),";
                    }
                }
            }
            $querylistImg = rtrim($querylistImg, ",");
            $queryImg = "INSERT into listimage (productId,imagePro,createdAt) values
                $querylistImg ";
            $resulltListImage = $this->db->insert($queryImg);
            if ($resulltListImage == false) {
                return new Response(false, "Đăng sản phẩm thất bại", "", "", "");
            } else {
                return new Response(true, "Đăng sản phẩm thành công", "", "", "");
            }
        }
    }
    public function getAllProduct($page = 1, $limit = 10, $type = "")
    {
        if ($type) {
            $type = "WHERE pr.status = '$type'";
        }
        $getTotal = $this->db->select("SELECT COUNT(*) AS total from product AS pr $type");
        $total = $getTotal->fetchAll()[0];
        $total = $total == false ? 0 : $total['total'];
        if ($page < 1) {
            $page = 1;
        }
        $currentPage = ($page - 1) * $limit;
        $query = "SELECT pr.*, cate.nameCate as nameCategory from product as pr 
            INNER JOIN category as cate on pr.categoryId = cate.id 
            $type
            ORDER BY pr.createdAt DESC 
            limit $currentPage,$limit
        ";
        $result = $this->db->select($query);
        if ($result != false) {
            return new Response(true, "success", $result->fetchAll(), "", $total);
        } else {

            return "something wrong from server!";
        }
    }
    public function filterProduct($key = "", $value = "", $limit = 20, $page = 1)
    {
        if ($limit == "all") {
            $limit = "0,18446744073709551615";
        }
        if ($page < 1) {
            $page = 1;
        }
        $currentPage = ($page - 1) * $limit;
        $query = "";
        $total = 0;
        switch ($key) {
            case 'random':
                $query = "SELECT pr.id, pr.brand, pr.namePro ,pr.categoryId, pr.quantity , pr.image, pr.origin, pr.price, pr.salePercent, pr.slug,
                 cate.nameCate as nameCategory from product as pr INNER JOIN category as cate on pr.categoryId = cate.id  ORDER BY RAND() LIMIT $limit";
                break;
            case 'detail':
                $query = "SELECT pr.*,
                 cate.nameCate as nameCategory from product as pr INNER JOIN category as cate on pr.categoryId = cate.id  WHERE pr.id = $value";

                break;
            case 'category':

                $sqlTotal = $this->db->select("SELECT count(*) from product where categoryId = '$value'");
                $total = $sqlTotal->fetchColumn();

                $query = "SELECT pr.id, pr.brand, pr.namePro ,pr.categoryId, pr.quantity, pr.image, pr.origin, pr.price, pr.salePercent, pr.slug,
                 cate.nameCate as nameCategory from product as pr INNER JOIN category as cate on pr.categoryId = cate.id  WHERE pr.categoryId = $value  limit $currentPage,$limit";
                break;

            default:
                $sqlTotal = $this->db->select("SELECT count(*) from product ");
                $total = $sqlTotal->fetchColumn();
                $query = "SELECT pr.id, pr.brand, pr.namePro ,pr.categoryId, pr.quantity, pr.image, pr.origin, pr.price, pr.salePercent, pr.slug,
                 cate.nameCate as nameCategory from product as pr INNER JOIN category as cate on pr.categoryId = cate.id  ORDER BY pr.createdAt limit $currentPage,$limit";
                break;
        }
        // ================================
        $response = $this->db->select($query);
        if ($response == false) {

            return new Response(false, "Error", "", "");
        } else {
            $result = [];
            if ($key == "detail") {
                $result = $response->fetchAll();
                $listImg = $this->db->select("SELECT imagePro as link FROM listimage WHERE productId = $value ");
                if ($listImg != false) {
                    array_push($result, $listImg->fetchAll());
                }
            } else {
                $result = $response->fetchAll();
            }
            return new Response(true, "Successcully", $result, "", $total);
        }
    }
    public function deleteProduct($id)
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
            // return "Id product cannot be empty";
            return new Response(false, "Hành động không hợp lệ! Vui lòng thử lại!", "", "?mod=admin&act=manageproduct");
        }
        $query = "DELETE FROM product WHERE id='$id'";
        $result = $this->db->delete($query);
        if ($result != false) {
            return new Response(true, "Xóa sản phẩm thành công", "", "?mod=admin&act=manageproduct");
        } else {
            return new Response(false, "Hành động không hợp lệ! Vui lòng thử lại!", "", "?mod=admin&act=manageproduct");
        }
    }
    public function seachProduct($value = "")
    {
        $resultSql = $this->db->select("SELECT p.id, p.namePro, p.brand,p.image FROM product AS p 
                WHERE p.namePro 
                LIKE '%$value%'
                ORDER BY p.createdAt
                LIMIT 10
        ");
        if ($resultSql == false) {
            return new Response(false, "Fail", [], "");
        }
        $result = $resultSql->fetchAll();
        return new Response(true, "Successcully", $result, "");

    }
    public function dashboard()
    {
        $result = [];
        $totalProduct = $this->db->select("SELECT count(*) as total FROM product");

        if ($totalProduct == false) {
            $result['totalPro'] = 0;
        } else {
            $totalProduct = $totalProduct->fetchAll()[0];
            $result['totalPro'] = $totalProduct['total'];
        }
        $totalSold = $this->db->select("SELECT sum(i.quantity) as total FROM invoicedetail as i");
        if ($totalSold == false) {
            $result['totalSold'] = 0;
        } else {
            $totalSold = $totalSold->fetchAll()[0];
            $result['totalSold'] = $totalSold['total'];
        }
        $totalOut = $this->db->select("SELECT count(p.id) as total FROM product as p where p.id < 1");
        if ($totalOut == false) {
            $result['totalOut'] = 0;
        } else {
            $totalOut = $totalOut->fetchAll()[0];
            $result['totalOut'] = $totalOut['total'];
        }
        // totalHidden
        $totalHidden = $this->db->select("SELECT count(p.id) as total FROM product as p where p.status ='hidden'");
        if ($totalHidden == false) {
            $result['totalHidden'] = 0;
        } else {
            $totalHidden = $totalHidden->fetchAll()[0];
            $result['totalHidden'] = $totalHidden['total'];
        }
        // totalOrder
        $totalOrder = $this->db->select("SELECT count(*) as total FROM invoice");
        if ($totalOrder == false) {
            $result['totalOrder'] = 0;
        } else {
            $totalOrder = $totalOrder->fetchAll()[0];
            $result['totalOrder'] = $totalOrder['total'];
        }
        // totalOrderNew
        $totalOrderNew = $this->db->select("SELECT count(*) as total FROM invoice  where invoice.status ='new'");
        if ($totalOrderNew == false) {
            $result['totalOrderNew'] = 0;
        } else {
            $totalOrderNew = $totalOrderNew->fetchAll()[0];
            $result['totalOrderNew'] = $totalOrderNew['total'];
        }
        // totalOrderSuccess
        $totalOrderSuccess = $this->db->select("SELECT count(*) as total FROM invoice  where invoice.status ='confirmed'");
        if ($totalOrderSuccess == false) {
            $result['totalOrderSuccess'] = 0;
        } else {
            $totalOrderSuccess = $totalOrderSuccess->fetchAll()[0];
            $result['totalOrderSuccess'] = $totalOrderSuccess['total'];
        }
        // totalOrderCancel
        $totalOrderCancel = $this->db->select("SELECT count(*) as total FROM invoice  where invoice.status ='cancel'");
        if ($totalOrderCancel == false) {
            $result['totalOrderCancel'] = 0;
        } else {
            $totalOrderCancel = $totalOrderCancel->fetchAll()[0];
            $result['totalOrderCancel'] = $totalOrderCancel['total'];
        }
        //  total balance
        $totalBalance = $this->db->select("SELECT sum(invoice.total) as total FROM invoice  where invoice.status ='confirmed'");
        if ($totalBalance == false) {
            $result['totalBalance'] = 0;
        } else {
            $totalBalance = $totalBalance->fetchAll()[0];
            $result['totalBalance'] = $totalBalance['total'];
        }
        return new Response(true, "Thành công!", $result, "");

    }

}

?>