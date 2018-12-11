<?php
  session_start();
  $moi = $_SESSION['idcon'];
  try{
    $bdd = new PDO('mysql:host=lulipa.server.r-heberg.fr;dbname=derayalois;port=3306;charset=utf8', 'derayalois', 'testdebrayalois');
  }
  catch (Exception $e){
        die('Erreur : ' . $e->getMessage());
  }
  $moi = $_SESSION['idcon'];
  $reponse = $bdd->query("SELECT COUNT(*) as nb_demande FROM amis WHERE `id`=$moi AND statut=\"demande\"");
  $donnees = $reponse->fetch();
  if($donnees['notif']!= 0){
    echo $donnees['notif'];
  }
?>
