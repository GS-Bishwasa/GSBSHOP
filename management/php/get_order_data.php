<?php
require "db.php";

$ods = $_POST['ods'];
$o_date = $_POST['o_date'];
$all_data = [];

$response = $db->query("SELECT * FROM receive_order WHERE order_date = '$o_date' AND order_status = '$ods' ");

while ($data = $response->fetch_assoc()) {
   array_push($all_data,$data);

}

echo json_encode($all_data);
?>