<?php
// session_start();
include_once "lib/session.php";
include_once "model/cart.php";
include_once "model/product.php";
include_once "model/order.php";
include_once "model/comment.php";

extract($_REQUEST);
if (isset($act)) {
    switch ($act) {
        case 'cart':
            $classCart = new Cart();
            if (isset($_GET['type']) && isset($_GET['idpro']) && !empty($_GET['type']) && !empty($_GET['idpro'])) {
                $type = $_GET['type'];
                $idPro = $_GET['idpro'];
                $count = isset($_GET['count']) ? $_GET['count'] : "";
                $resultUpdateCart = $classCart->updateCart($type, $idPro, $count);
                $json = json_encode($resultUpdateCart, JSON_PRETTY_PRINT);
                echo $json;
                return;
            }
        case 'searchproduct':
            $classProduct = new Product();
            if (isset($_GET['keysearch'])) {
                $valueSearch = $classProduct->seachProduct($_GET['keysearch']);
                echo json_encode($valueSearch, JSON_PRETTY_PRINT);
                return;
            }
            break;
        case 'updateinvoice':
            $entityBody = file_get_contents('php://input');
            if (isset($entityBody)) {
                $entityBody = json_decode($entityBody, true);
                if ($entityBody["status"] != "") {
                    $classOrders = new Order();
                    $result = $classOrders->updateInvoice($entityBody["status"], $entityBody["listId"]);
                    echo json_encode($result, JSON_PRETTY_PRINT);
                    return;
                } else {
                    echo json_encode($entityBody, JSON_PRETTY_PRINT);
                    return;
                }
            } else {
                echo json_encode($entityBody, JSON_PRETTY_PRINT);
                return;
            }
        case 'createcomment':
            $entityBody = file_get_contents('php://input');
            if (isset($entityBody)) {
                $entityBody = json_decode($entityBody, true);
                if ($entityBody["productId"] != "") {
                    $classOrders = new Comment();
                    $result = $classOrders->createComment($entityBody["productId"], $entityBody["content"]);
                    echo json_encode($result, JSON_PRETTY_PRINT);
                    return;
                } else {
                    echo json_encode($entityBody, JSON_PRETTY_PRINT);
                    return;
                }
            } else {
                echo json_encode($entityBody, JSON_PRETTY_PRINT);
                return;
            }
        case 'fillterproduct':
            if(isset($_GET['id']) && $_GET['id']){
                $classProduct = new Product();
                $result = $classProduct->filterProduct('category',$_GET['id']);
                echo json_encode($result, JSON_PRETTY_PRINT);
            }
            
            return;
        default:
            break;

    }
}

?>