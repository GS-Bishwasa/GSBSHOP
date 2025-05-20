<?php
$db = new mysqli("localhost","root","","gsbshop");
if ($db->connect_error) {
    echo( "connection not established");
}
?>