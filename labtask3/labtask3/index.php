<?php
include('db_connect.php');
$result = $conn->query("SELECT * FROM customers");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Online Shopping Management System</title>
    <style>
        body { font-family: Arial; background: #f8f9fa; text-align: center; }
        h1 { color: #007bff; }
        table { margin: 20px auto; border-collapse: collapse; width: 80%; }
        th, td { border: 1px solid #ddd; padding: 10px; }
        th { background: #007bff; color: white; }
        tr:hover { background-color: #f1f1f1; }
        .btn {
            background: #007bff; color: white; padding: 10px 20px;
            text-decoration: none; margin: 10px; border-radius: 5px;
        }
        .btn:hover { background: #0056b3; }
    </style>
</head>
<body>
    <h1>Welcome to Online Shopping Management System</h1>
    <table>
        <tr><th>ID</th><th>Name</th><th>Email</th><th>Phone</th></tr>
        <?php while($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?= $row['customer_id'] ?></td>
            <td><?= $row['name'] ?></td>
            <td><?= $row['email'] ?></td>
            <td><?= $row['phone'] ?></td>
        </tr>
        <?php } ?>
    </table>
    <div>
        <a class="btn" href="orders.php">View Orders</a>
        <a class="btn" href="products.php">View Products</a>
        <a class="btn" href="suppliers.php">View Suppliers</a>
    </div>
</body>
</html>
