<?php
  session_start();
  if (isset($_SESSION['idcon']) && isset($_POST['message']) && isset($_SESSION['amis_conv'])) {
    echo $_POST['message'];
  }
?>
