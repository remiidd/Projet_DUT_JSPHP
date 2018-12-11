<?php
  $code =  $_GET['code'];
  try{
    $bdd = new PDO('mysql:host=lulipa.server.r-heberg.fr;dbname=derayalois;port=3306;charset=utf8', 'derayalois', 'testdebrayalois');
  }
  catch (Exception $e){
        die('Erreur : ' . $e->getMessage());
  }
  $reponse = $bdd->query("SELECT id FROM profil WHERE verif_email='$code'");
  $donnees = $reponse->fetch();
  $id = $donnees['id'];
  $bdd->exec("UPDATE profil SET verif_email=NULL WHERE id=$id");
  $reponse = $bdd->query("SELECT verif_email FROM profil WHERE id=$id");
  $donnees = $reponse->fetch();
  if ($donnees['verif_email'] == NULL) {
    echo "<script>
            alert(\"Votre compte à été validé, tu peux te connecter\");
            window.location.href='/connexion';
          </script>" ;
  }
  else {
    echo "<script>
            alert(\"Votre compte n'a pas pu être validé, réessayer...\");
            window.location.href='/';
          </script>" ;
  }


?>
