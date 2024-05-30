<?php
include ("db.php");
if (!$_SESSION['id']) {
    header("Location:login.php");
}

$product_id = $_GET['id'];
$select_product = $con->prepare("SELECT * FROM `products` WHERE `id`=?");
$select_product->bind_param("i", $product_id);
$select_product->execute();
$product_result = $select_product->get_result();
$product_data = $product_result->fetch_assoc();
?>
<?php
if (@$_POST['action'] == "edit_product") {
    $product_type = $_POST["product_type"];
    $product_name = $_POST["product_name"];
    $product_price = $_POST["product_price"];
    $product_desc = $_POST["product_desc"];

    $update_query = $con->prepare("UPDATE `products` SET `product_type`=?,`product_name`=?,`product_price`=?,`product_desc`=? WHERE `id`=?");
    $update_query->bind_param('ssisi', $product_type, $product_name, $product_price, $product_desc, $product_id);
    if ($update_query->execute()) {
        header('Location: index.php');
        exit();
    } else {
        echo 'Error in updating product';
    }
}


?>


<html>

<head>
    <link rel="stylesheet" href="add_product.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>

<body>

<div class="container">
        <div class="row vh-100 ">
            <div class="col-12 align-self-center">
                <div class="auth-page">
                    <div class="card auth-card shadow-lg">
                        <div class="card-body">
                            <div class="px-3">
    <form action="" class="form_" method="POST">

        <input type="hidden" id="action" name="action" value="edit_product" />
        <label>Product Type</label>
        <input class="form-control" type="text" name="product_type" value="<?php echo $product_data['product_type']; ?>">
        <div>
            <br>
            <label>Product Name</label>

            <input class="form-control"  type="text" id="product_name" name="product_name"
                value="<?php echo $product_data['product_name']; ?>">
        </div>
        <br>
        <div>
            <label>Product Code</label>
            <input class="form-control"  type="text" id="product_code" disabled name="product_code"
                value="<?php echo $product_data['product_code']; ?>">
        </div>
        <br>
        <div>
            <label>Product Price</label>
            <input class="form-control"  type="text" id="product_price" name="product_price"
                value="<?php echo $product_data['product_price']; ?>">
        </div>
        <br>
        <div>
            <label>Product Description</label>
            <input class="form-control"  type="text" id="product_desc" name="product_desc"
                value="<?php echo $product_data['product_desc']; ?>">
        </div>
        <br>
        <button type="submit">Submit</button>
        <button onclick="location.href='index.php'">Back</button>
    </form>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    
</body>
</html>