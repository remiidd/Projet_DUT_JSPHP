<?php
  $code =  $_GET['code'];
  try{
    $bdd = new PDO('mysql:host=lulipa.server.r-heberg.fr;dbname=derayalois;port=3306;charset=utf8', 'derayalois', 'testdebrayalois');
  }
  catch (Exception $e){
        die('Erreur : ' . $e->getMessage());
  }

  $bdd->exec("UPDATE profil SET verif_email=NULL WHERE verif_email=".$code);

  echo "<script>
          alert(\"Votre compte à été validé, tu peux te connecter\");
          window.location.href='/connexion';
        </script>" ;
?>
