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
      $req = $bdd->prepare('INSERT INTO `amis`(`id`, `id_amis`, `statut`)
        VALUES (:id, :id_amis, : statut)');
      $req->execute(array(
        'id' => 19,
        'id_amis' => 1,
        'statut' => "en attente"
      ));

      echo "fait";
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
