<?php
$db = new mysqli("localhost", "root", "", "gsbshop", 3307); // note port 3307

if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}
// echo "✅ Connected to XAMPP MySQL on port 3307";
?>
