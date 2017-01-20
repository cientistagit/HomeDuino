<?php
session_start();
if (!isset($_SESSION['usuario'])) {
  readfile('../index.php');
}
session_destroy();
header('location:../index.php');
?>
