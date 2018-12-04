<?php
  session_start();
  echo $_POST('message');
  if (isset($_SESSION['idcon']) && isset($_POST['message']) && isset($_SESSION['amis_conv'])) {

  }
?>
