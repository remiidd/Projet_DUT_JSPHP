<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <title>Profil de <?php echo "";?></title>
  </head>
  <body>
    <?php
      $bdd = new PDO('mysql:host=91.216.107.164;dbname=debra756602;charset=utf8','debra756602','hj32095D');

      //$reponse = $bdd->query('SELECT * FROM profil WHERE id=\''.$_GET['id'].'\'');
      //$data = $reponse->fetch();
    ?>
  <!--  <p>Utilisateur avec l'id : <?php //echo $_GET["id"]; ?> s'appelle <?php //echo $data["prenom"]." ".$data["nom"]; ?></p> -->
    <?php// $reponse->closeCursor(); ?>
  </body>
</html>
