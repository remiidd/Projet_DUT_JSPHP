<?php
  session_start();
  $mess = "<i class=\"fas fa-user-friends\"></i>";
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
  if($donnees['nb_demande']!= 0){
    $mess.="<span id=\"notification_count_menu_invit\">".$donnees['nb_demande']."</span>";
  }
  echo $mess;
?>
