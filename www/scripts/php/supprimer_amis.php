<?php
  session_start();
  if (isset($_SESSION['idcon'])) {
    if(isset($_GET['id'])){
      try{
        $bdd = new PDO('mysql:host=lulipa.server.r-heberg.fr;dbname=derayalois;port=3306;charset=utf8', 'derayalois', 'testdebrayalois');
      }
      catch (Exception $e){
            die('Erreur : ' . $e->getMessage());
      }

      $moi = $_GET['id'];
      $lui = $_GET['id_amis'];
      

      header("Location:/accueil");
      exit();

    }
    else {
      header("Location:/accueil");
      exit();
    }
  }
  else {
    header("Location:/accueil");
    exit();
  }
?>
