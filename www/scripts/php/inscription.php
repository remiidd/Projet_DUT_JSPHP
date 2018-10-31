<?php
  session_start();

  $email = $_POST['email'];
  $emailexiste=false;

  try{
    $bdd = new PDO('mysql:host=lulipa.server.r-heberg.fr;dbname=derayalois;port=3306;charset=utf8', 'derayalois', 'testdebrayalois');
  }
  catch (Exception $e){
        die('Erreur : ' . $e->getMessage());
  }

  //variables
  $reponse = $bdd->query('SELECT * FROM profil');
  $util = $_POST['id'];
  $mdp = md5($_POST['mdp']);


  //test si id == OK
  while ($donnees = $reponse->fetch())
  {
    if($reponse['email'] = $email){
      $emailexiste = true;
    }
  }

  echo "apres boucle";

  if ($emailexiste == false) {
    echo "ok";
  }
  else {
    echo "pasok";
  }
?>
