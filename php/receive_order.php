<?php
require "db.php";

// print_r($_GET);

// Get product ID and payment mode
$p_id = (int) $_GET['p_id'];
$product_mode = $_GET['p_mode'];
$product_qty = (int) $_GET['p_qty'];

// Fetch product details
$pro_sql = $db->query("SELECT * FROM product WHERE id='$p_id'");
$aa = $pro_sql->fetch_assoc();

$product_name = $aa["product_name"];
$product_amount = $aa["product_amount"];
$tp_amount = $product_qty * $product_amount;

// Get customer details from cookie and database
$user_email = base64_decode($_COOKIE['_aut_ui']);
$user_response = $db->query("SELECT * FROM register WHERE email = '$user_email'");
$user_aa = $user_response->fetch_assoc();

$c_name = $user_aa["fullname"];
$c_address = $user_aa["address"];
$c_mobile = $user_aa["mobile"];

// Check if receive_order table exists
$check = $db->query("SHOW TABLES LIKE 'receive_order'");

if ($check->num_rows == 0) {
    // Table does not exist, create it
    $create_table = $db->query("CREATE TABLE receive_order (
        id INT(11) NOT NULL AUTO_INCREMENT,
        p_name VARCHAR(200),
        p_amount VARCHAR(200),
        tp_amount VARCHAR(200),
        p_qty VARCHAR(200),
        c_name VARCHAR(200),
        c_mobile VARCHAR(100),
        c_email VARCHAR(200),
        c_address MEDIUMTEXT,
        payment_mode VARCHAR(50),
        payment_status VARCHAR(200) DEFAULT 'pending',
        order_status VARCHAR(200) DEFAULT 'pending',
        PRIMARY KEY(id)
    )");

    if (!$create_table) {
        die("Table creation failed.");
    }
}

// Insert order into receive_order
$stmt = $db->prepare("INSERT INTO receive_order 
    (p_name, p_amount, tp_amount, p_qty, c_name, c_mobile, c_email, c_address, payment_mode) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

$stmt->bind_param(
    "sssssssss",
    $product_name,
    $product_amount,
    $tp_amount,
    $product_qty,
    $c_name,
    $c_mobile,
    $user_email,
    $c_address,
    $product_mode
);

if ($stmt->execute()) {
    echo "success";
    // header("Location: ../thank_you.php");
} else {
    echo "failed";
}
?>