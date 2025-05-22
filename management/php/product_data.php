<?php
require "db.php";
$id  = $_POST['id'];

$get_data = $db->query("SELECT * FROM product WHERE id  = '$id'");
$aa  = $get_data->fetch_assoc();
echo json_encode($aa);
?>