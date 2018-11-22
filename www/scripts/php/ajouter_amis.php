<?php
  session_start();
  if (isset($_SESSION['idcon'])) {
    if(isset($_GET['id'])){
      echo $_GET['id'] . "  zzz     " . $_GET['id_amis'];
      try{
        $bdd = new PDO('mysql:host=lulipa.server.r-heberg.fr;dbname=derayalois;port=3306;charset=utf8', 'derayalois', 'testdebrayalois');
      }
      catch (Exception $e){
            die('Erreur : ' . $e->getMessage());
      }
      $req = $bdd->prepare('INSERT INTO `amis`(`id`, `id_amis`, `status`)
        VALUES (:id, :id_amis, : status)');
      $req->execute(array(
        'id' => $_GET['id'],
        'id_amis' => $_GET['id_amis'],
        'status' => "en attente"
      ));

      $req = $bdd->prepare('INSERT INTO `amis`(`id`, `id_amis`, `status`)
        VALUES (:id, :id_amis, : status)');
      $req->execute(array(
        'id' => $_GET['id_amis'],
        'id_amis' => $_GET['id'],
        'status' => "demande"
      ));
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
