<?php
require "db.php";

$oid = $_POST['oid'] ?? null;
$btn_type = $_POST['btn_type'] ?? null;



    if ($btn_type == "payment_status") {
        $update = $db->query("UPDATE receive_order SET payment_status = 'completed' WHERE id = $oid");
    } elseif ($btn_type == "order_status") {
        $update = $db->query("UPDATE receive_order SET order_status = 'delivered' WHERE id = $oid");
    }

if ($update) {
    echo "success";
}else{
    echo "failed";
}
?>
