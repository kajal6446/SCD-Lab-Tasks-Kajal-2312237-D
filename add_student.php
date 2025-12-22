<?php
include 'db.php';
if (isset($_POST['add'])) {
mysqli_query($conn, "INSERT INTO students(name,roll_no,email,marks,department)
VALUES('{$_POST['name']}','{$_POST['roll']}','{$_POST['email']}','{$_POST['marks']}','{$_POST['dept']}')");
header("Location: dashboard.php");
}
?>
<form method="post">
Name: <input name="name"><br>
Roll No: <input name="roll"><br>
Email: <input name="email"><br>
Marks: <input name="marks"><br>
Dept: <input name="dept"><br>
<button name="add">Add</button>
</form>