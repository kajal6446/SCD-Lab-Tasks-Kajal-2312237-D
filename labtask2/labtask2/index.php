<!DOCTYPE html>
<html>
<head>
    <title>Dynamic Student Information Processor</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h2>Student Information Report</h2>

<?php
// Include the function file
include("functions.php");

// ---------- Step 1: Define Students ----------

// Student 1
$student1_marks_str = "78,65,90,55,88";
$student1_marks = explode(",", $student1_marks_str);

// Student 2
$student2_marks_str = "90,85,92,80,88";
$student2_marks = explode(",", $student2_marks_str);
$student2_age = "21 years";
$student2_age_int = (int)$student2_age;

// Student 3
$student3_marks_str = "30,45,28,40,35";
$student3_marks = explode(",", $student3_marks_str);

// All Students
$students = [
    ["name" => "Ali", "age" => 20, "marks" => $student1_marks],
    ["name" => "Ayesha", "age" => $student2_age_int, "marks" => $student2_marks],
    ["name" => "Bilal", "age" => 21, "marks" => $student3_marks]
];

// ---------- Step 2: Process ----------
foreach ($students as &$student) {
    processStudent($student);
}

// ---------- Step 3: Display Table ----------
echo "<table>";
echo "<tr>
        <th>Name</th>
        <th>Age</th>
        <th>Marks</th>
        <th>Average</th>
        <th>Status</th>
        <th>Message</th>
      </tr>";

foreach ($students as $s) {
    echo "<tr>
            <td>{$s['name']}</td>
            <td>{$s['age']}</td>
            <td>" . implode(", ", $s['marks']) . "</td>
            <td>{$s['average']}</td>
            <td>{$s['status']}</td>
            <td>{$s['message']}</td>
          </tr>";
}
echo "</table>";
?>

</body>
</html>
