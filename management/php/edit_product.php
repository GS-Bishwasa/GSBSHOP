<?php
require("db.php");
$category = $_POST['category'];
$product_name = $_POST['product_name'];
$product_description = $_POST['product_description'];
$product_quantity = $_POST['product_quantity'];
$product_amount = $_POST['product_amount'];
$id = $_POST['id'];
$product_pic = $_FILES['product_pic'];
$old_pic = $_POST['old_pic'];

$pro_pic_name = $product_pic['name'];
$location = $product_pic['tmp_name'];

if ($pro_pic_name === "") {
    $update_product = $db->query("UPDATE product SET category='$category',product_name = '$product_name',product_description = '$product_description',product_quantity = '$product_quantity',product_amount='$product_amount' WHERE id = '$id'");
    if ($update_product) {
        echo "Success";
    } else {
        echo "Failed";
    }
} else {
    $check_file = file_exists("../../product_pic/" . $pro_pic_name);
    if ($check_file) {
        echo "File already exists";
    } else {
        $delete = unlink("../../product_pic/" . $old_pic);
        if ($delete) {
            $upload_file = move_uploaded_file($location, "../../product_pic/" . $pro_pic_name);
            if ($upload_file) {
                $update_product = $db->query("UPDATE product SET category='$category',product_pic='$pro_pic_name',product_name = '$product_name',product_description = '$product_description',product_quantity = '$product_quantity',product_amount='$product_amount' WHERE id = '$id'");
                echo "Success";
            } else {
                echo "file Deleted";
            }
        } else {
            echo "Old Pic Not Deleted";
           
        }
       
    }
}
?>