<?php
session_start();
include 'db.php';
if (!isset($_SESSION['user'])) header("Location: login.php");


$search = $_GET['search'] ?? '';
$sort = $_GET['sort'] ?? 'name';


$query = "SELECT * FROM students WHERE name LIKE '%$search%' OR roll_no LIKE '%$search%' ORDER BY $sort";
$result = mysqli_query($conn, $query);
?>


<h2>Welcome <?php echo $_SESSION['user']; ?></h2>
<a href="add_student.php">Add Student</a> |
<a href="logout.php">Logout</a>


<form method="get">
<input type="text" name="search" placeholder="Search">
<select name="sort">
<option value="name">Sort by Name</option>
<option value="marks">Sort by Marks</option>
</select>
<button>Search</button>
</form>


<table border="1">
<tr>
<th>Name</th><th>Roll No</th><th>Email</th><th>Marks</th><th>Dept</th><th>Action</th>
</tr>
<?php while ($row = mysqli_fetch_assoc($result)) { ?>
<tr>
<td><?php echo $row['name']; ?></td>
<td><?php echo $row['roll_no']; ?></td>
<td><?php echo $row['email']; ?></td>
<td><?php echo $row['marks']; ?></td>
<td><?php echo $row['department']; ?></td>
<td>
<a href="edit_student.php?id=<?php echo $row['id']; ?>">Edit</a>
<a href="delete_student.php?id=<?php echo $row['id']; ?>">Delete</a>
</td>
</tr>
<?php } ?>
</table>