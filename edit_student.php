<?php
include 'db.php';
$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM students WHERE id=$id"));


if (isset($_POST['update'])) {
mysqli_query($conn, "UPDATE students SET name='{$_POST['name']}', marks='{$_POST['marks']}' WHERE id=$id");
header("Location: dashboard.php");
}
?>
<form method="post">
Name: <input name="name" value="<?php echo $data['name']; ?>"><br>
Marks: <input name="marks" value="<?php echo $data['marks']; ?>"><br>
<button name="update">Update</button>
</form>