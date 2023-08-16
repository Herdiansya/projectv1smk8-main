<?php
session_start();
session_unset();
session_destroy();

// Redirect to the login page or any other desired page
header("Location: ../../index.php");
exit;
?>
