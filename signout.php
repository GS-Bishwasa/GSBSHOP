<?php
// No output before this point!

// Delete the cookie by setting its expiration time in the past
setcookie("_aut_ui", "", time() - 3600, "/"); // or match path/domain if applicable

// Optional — forcefully unset it from PHP superglobal
unset($_COOKIE['_auth_ui']);

header('Location: index.php');
exit;
?>
