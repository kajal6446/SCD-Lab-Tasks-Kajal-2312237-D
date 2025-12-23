<?php
// ---------- processStudent Function ----------
function processStudent(&$student) {
    $total = array_sum($student['marks']);
    $average = $total / count($student['marks']);

    // Determine status
    if ($average >= 80) {
        $status = "Excellent";
    } elseif ($average >= 60) {
        $status = "Good";
    } elseif ($average >= 40) {
        $status = "Pass";
    } else {
        $status = "Fail";
    }

    // Assign message using switch
    switch ($status) {
        case "Excellent":
            $message = "Awarded Scholarship";
            break;
        case "Good":
            $message = "Can Apply for Internship";
            break;
        case "Pass":
            $message = "Needs Improvement";
            break;
        default:
            $message = "Repeat Semester";
            break;
    }

    // Update student data
    $student['average'] = round($average, 1);
    $student['status'] = $status;
    $student['message'] = $message;
}
?>
