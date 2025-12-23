<?php
include('db_connect.php');
$sql = "SELECT products.product_id, products.name AS product_name, categories.category_name, products.price
        FROM products
        JOIN categories ON products.category_id = categories.category_id";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Products</title>zdc 
    <style>
        body { font-family: Arial; background: #f8f9fa; text-align: center; }
        h1 { color: #28a745; }
        table { margin: 20px auto; border-collapse: collapse; width: 80%; }
        th, td { border: 1px solid #ddd; padding: 10px; }
        th { background: #28a745; color: white; }
    </style>
</head>
<body>
    <h1>Product List</h1>
    <table>
        <tr><th>ID</th><th>Name</th><th>Category</th><th>Price (PKR)</th></tr>
        <?php while($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?= $row['product_id'] ?></td>
            <td><?= $row['product_name'] ?></td>
            <td><?= $row['category_name'] ?></td>
            <td><?= $row['price'] ?></td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>
