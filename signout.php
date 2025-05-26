<?php
if (isset($_COOKIE['_auth_ui'])) {
    setcookie("_auth_ui", "", time() - 3600, "/");
}
header('Location: index.php');
exit; // Optional but good practice to stop script after redirect
?>
