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

    <script src="scripts/js/req.js"></script>
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
    <?php if(isset($_POST["numerotel"])||isset($_POST["emploi"])){
      $url_refresh = "Location:settings.php?id=".$_GET["id"];
      header($url_refresh);
    } ?>
    <div class="content">
      <div class="wrapp">
        <div class="cover coverset" style="background-repeat: no-repeat;background-size: cover;background-position: center center;background-image:url(<?php if($data["photo_couv"]!=null) { echo $data["photo_couv"]; } else { ?>src/media/default_profil_cover.jpg<?php } ?>);">
          <h1 class="titre_param"> Paramètres généraux de <?php echo $data["prenom"];?></h1>
          <div class="cover_couche"></div>
        </div><br/>
        <p class="marge"><a href="profil.php?id=<?php echo $_GET["id"]; ?>">Revenir au profil</a></p>
        <h5><i class="fas fa-cog"></i> Paramètres du compte</h5>
        <p class="marge">Email : <?php echo $data["email"]; ?> <a class="modif_info_bouton_email modif_infos_boutons"><i class="fas fa-pencil-alt"></i> Modifier</a><i class="txt_modif_email">
          <form action="" method="post">
            <input required type="text" name="email"/>
            <input id="inscriBout" type="submit" value="Valider" onclick="modif()"/>
          </form></i></p>
        <?php if(isset($_POST["email"])){
          $req = $bdd->query('UPDATE profil SET email=\''.$_POST["email"].'\' WHERE id=\''.$_GET["id"].'\'');
          $req->closeCursor();
          $url_refresh = "Location:settings.php?id=".$_GET["id"];
          header($url_refresh);
        } ?>
        <p class="marge">Date de naissance : <?php $naissance = new DateTime($data["naissance"]); echo $naissance->format("d / m / Y"); ?> <a class="modif_info_bouton_naissance"><i class="fas fa-pencil-alt"></i> Modifier</a><i class="txt_modif_naissance">
          <form action="" method="post">
            <input required type="date" name="naissance"/>
            <input id="inscriBout" type="submit" value="Valider" onclick="modif()"/>
          </form></i></p>
        <?php if(isset($_POST["naissance"])){
          $req = $bdd->query('UPDATE profil SET naissance=\''.$_POST["naissance"].'\' WHERE id=\''.$_GET["id"].'\'');
          $req->closeCursor();
          $url_refresh = "Location:settings.php?id=".$_GET["id"];
          header($url_refresh);
        } ?>
        <p class="marge">Ville : <?php echo $data["ville"]; ?> <a class="modif_info_bouton_ville modif_infos_boutons"><i class="fas fa-pencil-alt"></i> Modifier</a><i class="txt_modif_ville">
          <form action="" method="post">
            <input required type="text" name="ville"/>
            <input id="inscriBout" type="submit" value="Valider" onclick="modif()"/>
          </form></i></p>
        <?php if(isset($_POST["ville"])){
          $req = $bdd->query('UPDATE profil SET ville=\''.$_POST["ville"].'\' WHERE id=\''.$_GET["id"].'\'');
          $req->closeCursor();
          $url_refresh = "Location:settings.php?id=".$_GET["id"];
          header($url_refresh);
        } ?>
        <p class="marge">Numéro de telephonne : <?php echo "+33".$data["numerotel"]; ?> <a class="modif_info_bouton_tel modif_infos_boutons"><i class="fas fa-pencil-alt"></i> Modifier</a><i class="txt_modif_tel">
          <form action="" method="post">
            <input required type="tel" name="numerotel"/>
            <input id="inscriBout" type="submit" value="Valider" onclick="modif()"/>
          </form></i></p>
        <?php if(isset($_POST["numerotel"])){
          $req = $bdd->query('UPDATE profil SET numerotel=\''.$_POST["numerotel"].'\' WHERE id=\''.$_GET["id"].'\'');
          $req->closeCursor();
          $url_refresh = "Location:settings.php?id=".$_GET["id"];
          header($url_refresh);
        } ?>
        <hr>
        <h5><i class="fas fa-cog"></i> Informations personnelles du profil</h5>
        <p class="marge">Photo de profil :</p>
        <p class="marge">Photo de couverture :</p>
        <p class="marge">Emplois : </p>
        <ul class="marge3x">
          <?php $rep = $bdd->query('SELECT * FROM emploi WHERE profil=\''.$_GET['id'].'\'');
          while($emploi = $rep->fetch()) { ?>
            <li><?php echo $emploi["travail"]; ?> <a class="suppr_taff modif_infos_boutons" href="" onclick=""><i class="fas fa-trash"></i></a></li>
          <?php } ?>
        </ul>
          <p class="marge"><a class="modif_info_bouton_emploi modif_infos_boutons"><i class="fas fa-plus"></i> Ajouter</a><i class="txt_modif_emploi">
            <form action="" method="post">
              <input required type="text" name="emploi"/>
              <input id="inscriBout" type="submit" value="Valider" onclick="modif()"/>
            </form></i></p>
          <?php if(isset($_POST["emploi"])){
            $req = $bdd->query('INSERT INTO emploi (id,travail,profil) VALUES (NULL, \''.$_POST["emploi"].'\',\''.$_GET["id"].'\')');
            $url_refresh = "Location:settings.php?id=".$_GET["id"];
            header($url_refresh);
          } ?>
        <p class="marge">Etudes :</p>
      </div>
    </div>
    <script src="scripts/js/animations.js"></script>
  </body>
</html>
