<?php
require "db.php";

// Sanitize and fetch POST data
$fullname = trim($_POST['fullname']);
$mobile = trim($_POST['mobile']);
$email = trim($_POST['email']);
$password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Better than md5
$cd = date("Y-m-d");

// Check if 'register' table exists (more reliable method)
$tableExists = $db->query("SHOW TABLES LIKE 'register'");
if ($tableExists->num_rows == 0) {
    $create_table = $db->query("CREATE TABLE register(
        id INT(11) NOT NULL AUTO_INCREMENT,
        fullname VARCHAR(225),
        mobile VARCHAR(100),
        email VARCHAR(200) UNIQUE,
        password VARCHAR(255),
        date DATE,
        PRIMARY KEY(id)
    )");

    if (!$create_table) {
        echo "table not created";
        exit;
    }
}

// Check if user already exists
$stmt = $db->prepare("SELECT id FROM register WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    echo "user already exists";
} else {
    // Insert new user
    $stmt = $db->prepare("INSERT INTO register (fullname, mobile, email, password, date) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $fullname, $mobile, $email, $password, $cd);

    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "failed";
    }
}
?>
