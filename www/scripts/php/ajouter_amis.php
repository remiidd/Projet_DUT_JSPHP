<?php
  session_start();
  if (isset($_SESSION['idcon'])) {
    echo "ici";
    if(isset($_GET['id'])){
      echo $_GET['id'] . "  zzz     " . $_GET['id_amis'];
    }
    else {
      echo "pas de donnéee";
    }
  }
  else {
    header("Location: ../../index.php");
    exit();
  }
?>
