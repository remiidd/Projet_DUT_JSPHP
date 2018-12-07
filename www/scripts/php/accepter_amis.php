<?php
  session_start();
  if(isset($_SESSION['idcon']) && isset($_GET['id_amis'])){
    $moi = $_SESSION['idcon'];
    $lui = $_GET['id_amis'];
    try{
      $bdd = new PDO('mysql:host=lulipa.server.r-heberg.fr;dbname=derayalois;port=3306;charset=utf8', 'derayalois', 'testdebrayalois');
    }
    catch (Exception $e){
          die('Erreur : ' . $e->getMessage());
    }
    echo "fait";
  else {
    header("Location: accueil");
    exit();
  }
?>
