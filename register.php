<?php
include 'db.php';
if (isset($_POST['register'])) {
$name = $_POST['name'];
$email = $_POST['email'];
$pass = $_POST['password'];
$cpass = $_POST['confirm_password'];


if ($pass == $cpass) {
$password = password_hash($pass, PASSWORD_DEFAULT);
mysqli_query($conn, "INSERT INTO users(name,email,password) VALUES('$name','$email','$password')");
header("Location: login.php");
} else {
echo "Passwords do not match";
}
}
?>
<form method="post">
Name: <input type="text" name="name" required><br>
Email: <input type="email" name="email" required><br>
Password: <input type="password" name="password" required><br>
Confirm Password: <input type="password" name="confirm_password" required><br>
<button name="register">Register</button>
</form>