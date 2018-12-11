<?php
  session_start();
  $mess="<i class=\"fas fa-comments\"></i>";
  try{
    $bdd = new PDO('mysql:host=lulipa.server.r-heberg.fr;dbname=derayalois;port=3306;charset=utf8', 'derayalois', 'testdebrayalois');
  }
  catch (Exception $e){
        die('Erreur : ' . $e->getMessage());
  }
  $moi = $_SESSION['idcon'];
  $reponse = $bdd->query("SELECT COUNT(*) as notif
                          FROM message
                          WHERE id_dest=$moi AND vu=0");
  $donnees = $reponse->fetch();
  if($donnees['notif']!= 0){
    $mess.="<span id=\"notification_count_menu\">".$donnees['notif']."</span>";
  }
  echo $mess;
?>
