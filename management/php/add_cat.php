<?php
require "db.php";

// Sanitize and prepare category name and URL
$cat_name = trim($_POST['category_name']);
$cat_url = strtolower($cat_name);
$cat_url = str_replace(" ", "-", $cat_url);

    // Check if the 'category' table exists
    $check_table = $db->query("SHOW TABLES LIKE 'category'");
    
    if ($check_table->num_rows === 0) {
        // Table does not exist, so create it
        $create_table = $db->query("
            CREATE TABLE category (
                id INT(11) NOT NULL AUTO_INCREMENT,
                category_name VARCHAR(255),
                category_url VARCHAR(255),
                PRIMARY KEY(id)
            )
        ");
        if (!$create_table) {
            throw new Exception("Table creation failed");
        }
        echo "Table Created Successfully. ";
    }

    // Insert data into the 'category' table using prepared statements
    $data_store = $db->prepare("INSERT INTO category (category_name, category_url) VALUES (?, ?)");
    $data_store->bind_param("ss", $cat_name, $cat_url);

    if ($data_store->execute()) {
        echo "Success";
    } else {
       echo"Data insertion failed";
    }
    
?>
