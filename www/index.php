<?php session_start();
  if(isset($_SESSION['idcon'])){
    $id = $_SESSION['idcon'];
    header("Location:profil-$id");
    exit();
  }
  else {?>
<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <title>BananaBook</title>

    <?php  include 'scripts/html/head.html';?>
  </head>
  <body>
    <?php include 'bar_navigation/nonco.php' ?>
    <div class="content">
      <div id="droite">
        <form id="inscription" action="scripts/php/inscription.php" method="post">
          <h1>Inscription</h1>
          <div id="nomprenom_insci">
            <div id="prenom_insci">
              <input required class="inscriform" type="text" name="prenom" placeholder="Prénom">
            </div>
            <div id="nom_insci">
              <input required class="inscriform" type="text" name="nom" placeholder="Nom">
            </div>
          </div>
          <div class="inscridiv">
            <input id="email" required class="inscriform" type="email" name="email" placeholder="Email">
            </br>
            <a id="mailinvalide">Adresse Email invalide</a>
            <a id="mailerror">L'email utilisé existe deja</a>
            <a id="passerror">Les mots de passe ne correspondent pas</a>
            <input id="mdp" required class="inscriform" type="password" name="mdp" placeholder="Mot de passe">
            </br>
            <input id="mdp1" required class="inscriform" type="password" name="mdprepeat" placeholder="Retapper votre mot de passe">
            </br>
            <label>Date de naissance</label>
            <br>
            <input required type="date" name="naissance" value="2018-10-24">
            <div id="formSexe">
              <input required type="radio" name="sexe" value="homme">Homme
              <input required type="radio" name="sexe" value="femme">Femme
              <input required type="radio" name="sexe" value="banana">BANANAAAAAAAA<br>
            </div>
          </div>
          <div id="condigene">
            En cliquant sur s'inscrire, vous accepter les thermes du contract.
              Vous donnez l'accès à toutes vos informations personnelles. BananaBook
              sera en droit de revendre vos informations personelles ainsi que vos
              photos. Vous donnez aussi accès à BananaBook de lire vos messages, de regarder
              et enregistrer vos photos/vidéos/nudes.
          </div>
          <center>
            <input id="inscriBout" type="submit" name="inscribout" value="S'inscrire">
          </center>
        </form>
      </div>
      <img id="gauche" src="src/media/index.jpg" alt="">
    </div>
    <br/><a href="profil.php?id=1">Profil de Utili Le Test</a>
  </body>
  <script src="scripts/js/inscription.js"></script>
  <?php
    if(isset($_SESSION['exist'])){
      if($_SESSION['exist'] == true){
        echo "<script type=text/javascript>
                emailexiste();
              </script>";
        $_SESSION['exist'] = false;
      }
    }
  ?>
</html>
<?php
}
?>
