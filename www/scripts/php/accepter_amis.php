<?php
  session_start();
  if(isset($_SESSION['idcon']) && isset($_GET['id_amis'])){
    echo "fait";
    $moi = $_SESSION['idcon'];
    $lui = $_GET['id_amis'];
    try{
      $bdd = new PDO('mysql:host=lulipa.server.r-heberg.fr;dbname=derayalois;port=3306;charset=utf8', 'derayalois', 'testdebrayalois');
    }
    catch (Exception $e){
          die('Erreur : ' . $e->getMessage());
    }
    $req = $bdd->query("UPDATE amis SET statut=\"amis\" WHERE id=$moi ";

  }
  else {
    header("Location: accueil");
    exit();
  }
?>
