<?php
  session_start();
  if (isset($_SESION['idcon'])) {
    if(isset($_GET['id'])){
      echo $_GET['id'] . "       " . $_GET['id_amis'];
    }
    else {
      header("Location: ../../index.php");
      exit();
    }
  }
  else {
    header("Location: ../../index.php");
    exit();
  }
?>
