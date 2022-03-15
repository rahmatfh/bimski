<?php
session_start();
include 'inc/functions.php';
unset($_SESSION['login']);
unset($_SESSION['id']);
unset($_SESSION['hak_akses']);
unset($_SESSION['nama']);
session_destroy();
header("location: ".base_url('login.php'));
exit();
?>
