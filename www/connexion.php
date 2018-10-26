<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <title>Connexion</title>
    <?php  include 'scripts/html/head.html';?>
  </head>
  <body>
    <?php include 'bar_navigation/connexion.php'; ?>
    <div class="content">
      <div id="connexion">
        <center>
          <form class="form_connexion" action="scripts/php/connexion.php" method="post">
            <p>
              <label>Identifiant</label>
              </br>
              <input type="text" name="id">
            </p>
            <p>
              <label>Mot de passe</label>
              </br>
              <input type="password" name="mdp">
            </p>
            <input type="submit" value="Connexion">
          </form>
          <p>
            <a href="">Inscrivez-vous</a>
          </p>
        </center>
      </div>
    </div>
  </body>
</html>
