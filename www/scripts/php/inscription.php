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


  //test si mail existe
  while ($donnees = $reponse->fetch())
  {
    if($donnees['email'] == $email){
      $emailexiste = true;
    }
  }

  if ($emailexiste == false) {
    $_SESSION['prenom'] = $_POST['prenom'];
    $_SESSION['nom'] = $_POST['nom'];
    $_SESSION['email'] = $_POST['email'];
    $_SESSION['password'] = md5($_POST['mdp']);
    $_SESSION['naissance'] = $_POST['naissance'];
    $_SESSION['sexe'] = $_POST['sexe'];
    header('Location: ../../inscription2.php');
    exit();
  }
  else {
    $_SESSION['exist'] = true;
    header('Location: /accueil');
    exit();
  }
?>
