<?php
  session_start();
  if(isset($_SESSION['idcon']) && isset($_GET['id_amis'])){
    echo "fait";
    
  }
  else {
    header("Location: accueil");
    exit();
  }
?>
