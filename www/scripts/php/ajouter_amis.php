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
      $req = $bdd->prepare('INSERT INTO `amis`(`id`, `id_amis`, `statut`)
        VALUES (:id, :id_amis, :statut)');
      $req->execute(array(
        'id' => (int)$_GET['id'],
        'id_amis' => (int)$_GET['id_amis'],
        'statut' => "en attente"
      ));

      $req = $bdd->prepare('INSERT INTO `amis`(`id`, `id_amis`, `statut`)
        VALUES (:id, :id_amis, :statut)');
      $req->execute(array(
        'id' => (int)$_GET['id_amis'],
        'id_amis' => (int)$_GET['id'],
        'statut' => "demande"
      ));

      header("Location: accueil");
      exit();

    }
    else {
      header("Location: accueil");
      exit();
    }
  }
  else {
    header("Location: accueil");
    exit();
  }
?>
