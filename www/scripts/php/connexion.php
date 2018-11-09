<?php
  session_start();

  //BASE DE DONNEE
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
  $tel = $chaine = substr($util,1);


  //test si id == OK
  while ($donnees = $reponse->fetch())
  {
    if(($donnees['password'] == $mdp && $donnees['email'] == $util) || ($donnees['password'] == $mdp && $donnees['numerotel'] == $util)){
      $id = $donnees['id'];
      $_SESSION['idcon'] = $id;
      header("Location:../../profil.php?id=$id");
      exit();
    }
    else {
      echo "pas succes";
    }
  }


?>
