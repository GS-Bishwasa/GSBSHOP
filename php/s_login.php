<?php
require "db.php";

$email = $_POST['email'];
$input_password = $_POST['password'];

// Step 1: Check if email exists
$result = $db->query("SELECT email, password FROM register WHERE email = '$email'");
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $hashed_password = $row['password'];

    // Step 2: Verify password
    if (password_verify($input_password, $hashed_password)) {
        $c_email = base64_encode($email);
        $c_time  = time() + (60 * 60 * 24 * 365); // 1 year
        setcookie("_aut_ui", $c_email, $c_time, '/');
        echo "success";
    } else {
        echo "wrong password";
    }
} else {
    echo "you are not a registered user";
}
?>
