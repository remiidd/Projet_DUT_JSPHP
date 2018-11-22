<?php
  session_start();
  if (isset($_SESION['idcon'])) {
    if(isset($_DATA['id'])){
      echo $_DATA['id'] . "       " . $_DATA['id_amis'];
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
