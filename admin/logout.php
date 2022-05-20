<?php
session_start();
//session_unset($_SESSION['usrid']);
session_destroy();
header("location:index.php");
?>
