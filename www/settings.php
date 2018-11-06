<!DOCTYPE html>
<?php session_start();
if((!isset($_SESSION["idcon"]))||($_SESSION["idcon"]!=$_GET["id"])){
  header("Location: index.php");
}
?>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <title>Paramètres du compte de</title>

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
          window.parent.document.title = 'Paramètres de <?php echo $data["prenom"]; ?>'
        </script>
        <?php
      }
    ?>
    <?php include 'bar_navigation/nonco.php'?>
    <div class="content">
      <div class="wrapp">
        <div class="cover coverset" style="background-repeat: no-repeat;background-size: cover;background-position: center center;background-image:url(<?php if($data["photo_couv"]!=null) { echo $data["photo_couv"]; } else { ?>src/media/default_profil_cover.jpg<?php } ?>);">
          <h1 class="titre_param"> Paramètres généraux de <?php echo $data["prenom"];?></h1>
          <div class="cover_couche"></div>
        </div><br/>
        <p class="marge"><a href="profil.php?id=<?php echo $_GET["id"]; ?>">Revenir au profil</a></p>
        <h5><i class="fas fa-cog"></i> Paramètres du compte</h5>
        <p class="marge">Email : <?php echo $data["email"]; ?> <i class="txt_modif_email"><form action="modif()"><input type="text" name="email"/><input type="submit" value="modifier"/></form></i> <a class="modif"><i class="fas fa-pencil-alt"></i> Modifier</a></p>
        <p class="marge">Numéro de telephone : <?php echo "+33".$data["numerotel"]; ?></p>
        <hr>
        <h5><i class="fas fa-cog"></i> Informations personnelles du profil</h5>
        <p class="marge">Photo de profil :</p>
        <p class="marge">Photo de couverture :</p>
        <p class="marge">Date de naissance : <?php $naissance = new DateTime($data["naissance"]); echo $naissance->format("d / m / Y"); ?></p>
        <p class="marge">Ville : <?php echo $data["ville"]; ?></p>
        <p class="marge">Emploi :</p>
        <p class="marge">Etudes :</p>
      </div>
    </div>
    <script src="scripts/js/animations.js"></script>
  </body>
</html>
