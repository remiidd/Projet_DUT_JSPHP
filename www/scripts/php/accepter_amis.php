<?php
  session_start();
  if(isset($_SESSION['idcon']) && isset($_GET['id_amis'])){
    echo "fait";
    $moi = $_SESSION['idcon'];
    $lui = $_GET['id_amis'];
    

  }
  else {
    header("Location: accueil");
    exit();
  }
?>
