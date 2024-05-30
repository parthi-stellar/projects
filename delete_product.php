<?php
include("db.php");
if(!$_SESSION['id']){
    header("Location:login.php");
}

$product_id = $_GET['id'];

if ($product_id > 0) {
    $stmt = $con->prepare("DELETE FROM products WHERE id = ?");
    $stmt->bind_param("i", $product_id);

    if ($stmt->execute()) {
        echo "Product deleted successfully.";
    } else {
        echo "Error deleting product: " . $stmt->error;
    }


}
?>