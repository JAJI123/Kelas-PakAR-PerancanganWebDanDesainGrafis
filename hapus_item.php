<?php
session_start();
$index = $_POST['index'];
unset($_SESSION['keranjang'][$index]);
$_SESSION['keranjang'] = array_values($_SESSION['keranjang']);
header("Location: keranjang.php");
