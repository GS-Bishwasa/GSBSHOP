<?php
require("db.php");
$cat_id = $_POST['cat_id'];
$res = $db->query("SELECT * FROM category WHERE id = '$cat_id'");
$aa = $res->fetch_assoc();
echo json_encode($aa);
?>