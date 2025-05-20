<?php
require("db.php");

$category = $_POST['category'];
$product_name = $_POST['product_name'];
$product_description = $_POST['product_description'];
$product_quantity = $_POST['product_quantity'];
$product_amount = $_POST['product_amount'];
$product_pic = $_FILES['product_pic'];


$pro_pic_name = $product_pic['name'];
$location = $product_pic['tmp_name'];

// Check if the table exists
$table_exists = $db->query("SHOW TABLES LIKE 'product'");
if ($table_exists->num_rows == 0) {
    // Create the table if it does not exist
    $create_table = $db->query('
        CREATE TABLE product (
            id INT(11) NOT NULL AUTO_INCREMENT,
            category VARCHAR(100),
            product_pic VARCHAR(200),
            product_name VARCHAR(200),
            product_description MEDIUMTEXT,
            product_quantity VARCHAR(100),
            product_amount VARCHAR(100),
            PRIMARY KEY(id)
        )');

}

// Check if the file already exists
$file_check = file_exists('../../product_pic/' . $pro_pic_name);
if ($file_check) {
    echo "File Already Exists";
} else {
    if (move_uploaded_file($location, "../../product_pic/" . $pro_pic_name)) {
        $stmt = $db->prepare("INSERT INTO product (category, product_pic, product_name, product_description, product_quantity, product_amount) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $category, $pro_pic_name, $product_name, $product_description, $product_quantity, $product_amount);

        if ($stmt->execute()) {
            echo "Success";
        } else {
            echo "Failed to store data";
        }
    } else {
        echo "File Not Uploaded";
    }
}
?>
