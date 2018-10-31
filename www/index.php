<?php session_start(); ?>
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
        <form id="inscription" action="" method="post">
          <h1>Inscription</h1>
          <div id="nomprenom_insci">
            <div id="prenom_insci">
              <input class="inscriform" type="text" name="prenom" placeholder="Prénom">
            </div>
            <div id="nom_insci">
              <input class="inscriform" type="text" name="nom" placeholder="Nom">
            </div>
          </div>
          <div class="inscridiv">
            <input class="inscriform" type="email" name="email" placeholder="Email">
            </br>
            <input class="inscriform" type="password" name="mdp" placeholder="Mot de passe">
            </br>
            <input class="inscriform" type="password" name="mdprepeat" placeholder="Retapper votre mot de passe">
            </br>
            <div id="formSexe">
              <label>Sexe</label>
              <input type="radio" name="sexe" value="homme">Homme<br>
              <input type="radio" name="sexe" value="femme">Femme<br>
              <input type="radio" name="sexe" value="banana">BANANAAAAAAAA<br>
            </div>
          </div>
          <center>
            <input type="submit" name="inscribout" value="S'inscrire">
          </center>
        </form>
      </div>
      <img id="gauche" src="src/media/index.jpg" alt="">
    </div>
    <br/><a href="profil.php?id=1">Profil de Utili Le Test</a>
  </body>
</html>
