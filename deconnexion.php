<?php 
session_start();
unset($_SESSION['user']); 
unset($_SESSION['id']);
unset($_SESSION['pass']);
unset($_SESSION['email']);
unset($_SESSION['type']);
unset($_SESSION['tele']);
header("Location:index.php");

?>