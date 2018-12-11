<?php
  session_start();
  $_SESSION['nv_conv'] = $_GET['id_amis'];
  header("Location: /messenger");
  exit();
?>
