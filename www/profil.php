<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <title>Profil de <?php $data["prenom"];?></title>
  </head>
  <body>
    <?php
    try {
      $bdd = new PDO('mysql:host=lulipa.server.r-heberg.fr;dbname=derayalois;charset=utf8', 'derayalois', 'testdebrayalois');
    } catch (\Exception $e) {
      die('Erreur :'.$e->getMessage());
    }
      $reponse = $bdd->query('SELECT * FROM profil WHERE id=\''.$_GET['id'].'\'');
      $data = $reponse->fetch();
      if($data["prenom"]==null) {
        header('Location:index.php');
      }
    ?>
    <p>Utilisateur avec l'id : <?php echo $_GET["id"]; ?> s'appelle <?php echo $data["prenom"]." ".$data["nom"]; ?></p>
    <?php $reponse->closeCursor(); ?>
  </body>
</html>
