<?php
include ("db.php");
if (!$_SESSION['id']) {
    header("Location: login.php");
}

if (@$_POST['action'] == "add_product") {
    $product_type = $_POST["product_type"];
    $product_name = $_POST["product_name"];
    $product_code = $_POST["product_code"];
    $product_price = $_POST["product_price"];
    $product_desc = $_POST["product_desc"];

    $select_product = $con->prepare("SELECT * FROM `products` WHERE `product_code`=?");
    $select_product->bind_param("i", $product_code);
    $select_product->execute();
    $product_result = $select_product->get_result();
    if ($product_result->num_rows > 0) {
        echo "<p style='color:red'>Product Already exist</p>";
    } else {
        $insert_query = $con->prepare("INSERT INTO `products` (`product_type`, `product_name`, `product_code`, `product_price`, `product_desc`) VALUES(?,?,?,?,?)");
        $insert_query->bind_param('ssiis', $product_type, $product_name, $product_code, $product_price, $product_desc);
        if ($insert_query->execute()) {
            header('Location: index.php');
            exit();
        } else {
            echo "<p style='color:red'>Error in updating product</p>";
        }
    }

}

?>




<head>
    <link rel="stylesheet" href="	https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container" class="col-25">
        <div class="row vh-100 ">
            <div class="col-12 align-self-center">
                <div class="auth-page">
                    <div class="card auth-card shadow-lg">
                        <div class="card-body">
                            <div class="px-3">
                                <form action="" class="form_" method="POST">
                                    <input type="hidden" id="action" name="action" value="add_product" />
                                    <label class="form-label">Product Type</label>
                                    <input  class="form-control" type="text" id="product_type" name="product_type"
                                        required placeholder="Enter the product type">
                                    <div>
                                        <br>
                                        <label>Product Name</label>

                                        <input  class="form-control" type="text" id="product_name"
                                            name="product_name" required placeholder="Enter the product name">
                                    </div>
                                    <br>
                                    <div>
                                        <label>Product Code</label>
                                        <input  class="form-control" type="number" id="product_code"
                                            name="product_code" required placeholder="Enter the product code">
                                    </div>
                                    <br>
                                    <div>
                                        <label>Product Price</label>
                                        <input  class="form-control" type="number" id="product_price"
                                            name="product_price" required placeholder="Enter the product price">
                                    </div>
                                    <br>
                                    <div>
                                        <label>Product Description</label>
                                        <input  class="form-control" type="text" id="product_desc"
                                            name="product_desc" required placeholder="Enter the product description">
                                    </div>
                                    <br>
                                    <button type="submit" class="btn btn-success">Submit</button>
                                    <button onclick="location.href='index.php'" class="btn btn-info">Back</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

