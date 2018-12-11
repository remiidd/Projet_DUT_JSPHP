<?php session_start(); ?>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Bananafeed</title>
    <link rel="icon" href="src/img/banana.ico" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.2/css/all.css" integrity="sha384-/rXc/GQVaYpyDdyxK+ecHPVYJSN9bmVFBvjA/9eOB+pb3F2w2N6fc5qB9Ew5yIns" crossorigin="anonymous">

    <link rel="stylesheet" href="css/styles.css"/>

  </head>
  <body>
    <?php include 'bar_navigation/nonco.php' ?>
    <?php
    try {
      $bdd = new PDO('mysql:host=lulipa.server.r-heberg.fr;dbname=derayalois;charset=utf8', 'derayalois', 'testdebrayalois');
    } catch (\Exception $e) {
      die('Erreur :'.$e->getMessage());
    }
      $reponse = $bdd->query('SELECT * FROM profil WHERE id=\''.$_GET['id'].'\'');
      $data = $reponse->fetch();
      if($data["prenom"]==null) {
        header('Location: accueil');
      } else {
        ?>
        <script>
          window.parent.document.title = 'Liste d\'amis de <?php echo $data["prenom"]; ?>'
        </script>
        <?php
      }
    ?>
    <div class="content">
      <div class="wrapp">
        <h3>Amis de <?php echo $data["prenom"]; ?></h3>
        <hr>
        <?php $res = $bdd->query('SELECT * from amis WHERE id=\''.$_GET['id'].'\'');
        while($amitie = $res->fetch()) {
          $res2 = $bdd->query('SELECT * from profil WHERE id=\''.$amitie["id_amis"].'\'');
          $ami = $res2->fetch();
          ?>
          <div><p><?php echo $ami["prenom"]; ?></p></div>
          <?php
        } ?>
      </div>
    </div>
  </body>
</html>
