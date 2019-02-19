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
    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({
          google_ad_client: "ca-pub-2486327099541957",
          enable_page_level_ads: true
     });
</script>
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
              <input required id="prenom_input" class="inscriform" type="text" name="prenom" placeholder="Prénom">
            </div>
            <div id="nom_insci">
              <input required id="nom_input" class="inscriform" type="text" name="nom" placeholder="Nom">
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
            En cliquant sur s'inscrire, vous acceptez les termes du contrat.
              Vous donnez l'accès à toutes vos informations personnelles. BananaBook
              sera en droit de revendre vos informations personelles ainsi que vos
              photos. Vous donnez aussi accès à BananaBook de lire vos messages, de regarder
              et enregistrer vos photos/vidéos.
          </div>
          <center>
            <input id="inscriBout" type="submit" name="inscribout" value="S'inscrire">
          </center>
        </form>
      </div>
      <img id="gauche" src="src/media/index.jpg" alt="">
    </div>
    <br/>
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
