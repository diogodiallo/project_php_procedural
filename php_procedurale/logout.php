<?php 
session_start();
unset($_SESSION['connected']);
unset($_SESSION['notif']);
$_SESSION = [];
session_destroy();
header("Location:/index.php");