<?php
$passwords = ["hello", "Hello123", "Abc!2024", "test", "Pass@Word99"];
function check_password(string $pwd): array {
    $length_ok = strlen($pwd) >= 8;
    $has_upper = preg_match('/[A-Z]/', $pwd);
    $has_digit = preg_match('/\d/', $pwd);
    $has_special = preg_match('/[^A-Za-z0-9]/', $pwd);

    $score = $length_ok + $has_upper + $has_digit + $has_special;

    return [
        "length_ok" => (bool)$length_ok,
        "has_upper" => (bool)$has_upper,
        "has_digit" => (bool)$has_digit,
        "has_special" => (bool)$has_special,
        "score" => $score
    ];
}
function get_strength_label($score) {
    if ($score <= 1) return "Weak";
    elseif ($score == 2) return "Medium";
    else return "Strong";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Password Results</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h2>Password Strength Results</h2>
    <table>
        <tr>
            <th>Password</th>
            <th>Score (out of 4)</th>
            <th>Strength</th>
        </tr>

        <?php
        foreach ($passwords as $pwd) {
            $result = check_password($pwd);
            $strength = get_strength_label($result["score"]);
            echo "<tr>
                    <td>\"$pwd\"</td>
                    <td>{$result['score']}/4</td>
                    <td>$strength</td>
                  </tr>";
        }
        ?>
    </table>

    <a href="index.html" class="back-btn">Back</a>
</div>
</body>
</html>
