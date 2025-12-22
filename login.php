<?php
session_start();
include 'db.php';


if (isset($_POST['login'])) {
$email = $_POST['email'];
$password = $_POST['password'];


$result = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
$user = mysqli_fetch_assoc($result);


if ($user && password_verify($password, $user['password'])) {
$_SESSION['user'] = $user['name'];
header("Location: dashboard.php");
} else {
echo "Invalid login";
}
}
?>
<form method="post">
Email: <input type="email" name="email"><br>
Password: <input type="password" name="password"><br>
<button name="login">Login</button>
</form>