<?php
  //BASE DE DONNEE
  try{
    $bdd = new PDO('mysql:host=91.216.107.164;dbname=debra756602_19tfmd;charset=utf8', 'debra756602_19tfmd', 'root');
  }
  catch (Exception $e){
        die('Erreur : ' . $e->getMessage());
  }

  //$reponse = $bdd->query('SELECT * FROM profil');
?>
