<?php 
session_start(); //to ensure you are using same session
session_destroy(); //destroy the session
unset($_SESSION['userid']);
unset($_SESSION['success']);
unset($_SESSION['username']);
unset($_SESSION['useridno']);
header('location: login.php');
die();
?>