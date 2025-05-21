<?php
require "db.php";

        $id = intval($_POST['id']);
        // $query = "DELETE FROM product WHERE `product`.`id` = $id";
        $result = $db->query("DELETE FROM product WHERE `product`.`id` = $id");

        if ($result) {
            echo "Product deleted successfully.";
        } else {
            echo "Error deleting product" ;
        }
    

?>
