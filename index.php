<?php
include("db.php");
if(!$_SESSION['id']){
    header("Location: login.php");
}

?>
<head>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <link rel="stylesheet" href="index.css">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
</head>
<body>
<br>
<br>
            <table id="producttable">
                <thead>
                    <tr>
                        <td align="left" width="14%"><b>Product Type</b></td>
                        <td align="left" width="15%"><b>Product Name</b> </td>
                        <td align="left" width="15%"><b>Product Code </b></td>
                        <td align="left" width="23%"><b>Product Price</b></td>
                        <td align="left" width="18%"><b>Description</b></td>
                        <td align="left" width="18%"><b>Edit</b></td>
                        <td align="left" width="18%"><b>Delete</b></td>
                    </tr>
                </thead>
                <?php
                    $get_product_details = $con->prepare("SELECT * FROM products");
                    $get_product_details->execute();
                    $product_result = $get_product_details->get_result();
                    while($product_details = $product_result->fetch_assoc())
                    {
                ?> 
                <tr>
                <td align="left" width="15%">
																<?php echo $product_details['product_type'] ? $product_details['product_type'] : "-";?>
																</td>
									  	 	        			<td align="left" width="15%">
																<?php echo $product_details['product_name'] ? $product_details['product_name'] : "-";?>
																</td>
																<td align="left" width="15%">
																	<?php echo $product_details['product_code'] ? $product_details['product_code'] : "-";?>
																</td>
																<td align="left" width="23%">
																	<?php echo $product_details['product_price'] ? $product_details['product_price'] : "-";?>
																</td>
																<td align="left" width="18%">
																	<?php echo $product_details['product_desc'] ? $product_details['product_desc'] : "-";?>
																</td>
                                                                <td align="left" width="18%">                                         
                                                                    <button onclick="window.location.href='edit_product.php?id=<?php echo $product_details['id']; ?>'">Edit</button>
                                                                </td>
                                                                <td align="left" width="18%">
                                                                    <button onclick="deleteProduct(<?php echo $product_details['id']; ?>, this)">Delete</button>
                                                                </td>

																
															</tr>
                                                            <?php
                    }
                    ?>
            </table>

             <script>
function deleteProduct(id, button) {
    if (confirm('Are you sure you want to delete this product?')) {
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'delete_product.php?id=' + id, true);
        xhr.onload = function() {
            if (xhr.status === 200) {
                var row = button.parentElement.parentElement;
                row.parentElement.removeChild(row);
                alert('Product deleted successfully.');
            } else {
                alert('Error deleting product.');
            }
        };
        xhr.send();
    }
}
</script>
<script>
$(document).ready( function () {
    $('#producttable').DataTable();
} );
</script> 
<br>
<button class="btn btn-primary "  onclick="location.href='add_product.php'">Add Product</button>

</body>
</html>