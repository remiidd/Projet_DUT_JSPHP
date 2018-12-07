<?php
  session_start();
  $mess = "";
  if(isset($_SESSION['amis_conv'])){//VERIF
    $moi = $_SESSION['idcon'];
    $lui = $_SESSION['amis_conv'];
    try{
      $bdd = new PDO('mysql:host=lulipa.server.r-heberg.fr;dbname=derayalois;port=3306;charset=utf8', 'derayalois', 'testdebrayalois');
    }
    catch (Exception $e){
          die('Erreur : ' . $e->getMessage());
    }
    $reponse = $bdd->query("SELECT id_exp, id_dest, message FROM message WHERE id_exp=".$moi." AND id_dest=".$lui." OR id_dest=".$moi." AND id_exp=".$lui." order by id");

    //WHILE
  }

  echo $mess;
 ?>
