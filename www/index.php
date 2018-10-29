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
              <input class="insciform" type="text" name="prenom" value="Prénom">
            </div>
            <div id="nom_insci">
              <input class="insciform" type="text" name="nom" value="Nom">
            </div>
          </div>
          <div class="inscriform">
            <input type="email" name="email" value="Email">
            </br>
            <label>Mot de passe</label>
            </br>
            <input type="password" name="mdp" value="">
            </br>
            <label>Confirmer le mot de passe</label>
            </br>
            <input type="password" name="mdprepeat" value="">
          </div>
        </form>
      </div>
      <img id="gauche" src="src/media/index.jpg" alt="">
    </div>
    <br/><a href="profil.php?id=1">Profil de Utili Le Test</a>
  </body>
</html>
