<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <title>Profil de <?php echo $data["prenom"];?></title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <!--Fin des fichiers bootstrap-->

    <link rel="stylesheet" href="css/styles.css"/>
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
      } else {
        ?>
        <script>
          window.parent.document.title = 'Profil de <?php echo $data["prenom"]; ?>'
        </script>
        <?php
      }
    ?>
    <?php include 'bar_navigation/nonco.php' ?>
    <!-- CONTENU DANS CETTE DIV -->
    <div class="content">
      <div id="presentation">
        <div class="cover"><img class="profilcover" src="src/media/default_profil_cover.jpg" alt="Default profil cover"/></div>
        <div class="pp"></div>
        <img class="profilpicture" src="src/media/default_profil_picture.jpg" alt="Default profil picture"/>

      </div>
      <div id="infos"></div>





      <p>Utilisateur avec l'id : <?php echo $_GET["id"]; ?> s'appelle <?php echo $data["prenom"]." ".$data["nom"]; ?></p>
    </div>
    <?php $reponse->closeCursor(); ?>
  </body>
</html>
