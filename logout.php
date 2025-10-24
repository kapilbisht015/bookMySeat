<?php
session_start();
session_unset();   // saare session variables clear
session_destroy(); // session destroy
header("Location: index.php"); // wapas home page bhej do
exit();
?>
