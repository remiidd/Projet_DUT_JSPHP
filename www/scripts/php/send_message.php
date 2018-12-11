<?php
  session_start();
  if (isset($_SESSION['idcon']) && isset($_POST['message']) && isset($_SESSION['amis_conv'])) {
    try{
      $bdd = new PDO('mysql:host=lulipa.server.r-heberg.fr;dbname=derayalois;port=3306;charset=utf8', 'derayalois', 'testdebrayalois');
    }
    catch (Exception $e){
          die('Erreur : ' . $e->getMessage());
    }

    $req = $bdd->prepare('INSERT INTO `message`(`id`, `id_exp`, `id_dest`, `message`)
      VALUES (:id, :id_exp, :id_dest, :message)');
    $req->execute(array(
      'id' => NULL,
      'id_exp' => $_SESSION['idcon'],
      'id_dest' => $_SESSION['amis_conv'],
      'message' => $_POST['message']
    ));
  }
  header("Location: /messenger");
  exit();
?>
