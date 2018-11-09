<?php
  session_start();
  $password = md5($_POST['mdp']);
  $id =  $_SESSION['idmdpo'];

  try{
    $bdd = new PDO('mysql:host=lulipa.server.r-heberg.fr;dbname=derayalois;port=3306;charset=utf8', 'derayalois', 'testdebrayalois');
  }
  catch (Exception $e){
        die('Erreur : ' . $e->getMessage());
  }

  $bdd->exec("UPDATE `profil` SET `password` = '$password' WHERE `id` = $id");

  echo "ok";
  //$bdd->exec("DELETE FROM `mdpoublie` WHERE `chaine_id` = $_SESSION['idmdpo']");


?>
