<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <title>Profil de <?php echo "";?></title>
  </head>
  <body>
    <p>Utilisateur avec l'id : <?php echo $_GET["id"]; ?></p>
    <?php
      $bdd = new PDO('mysql:host=91.216.107.164;dbname=debra756602_19tfmd;charset=utf8', 'debra756602_19tfmd', 'root');
    ?>
  </body>
</html>
