<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <title>Mot de passe oublié</title>
    <?php  include 'scripts/html/head.html';?>
  </head>
  <body>
    <?php include 'bar_navigation/connexion.php'; ?>
    <div class="content">
      <div id="mdpoublié">
        <center>
          <form class="form_mdpo" action="scripts/php/mdpoublie1.php" method="post">
            <p>
              <label>Email</label>
              </br>
              <input type="email" name="email">
            </p>
            <input type="submit" value="Envoyé un mail de recupération">
          </form>
        </center>
      </div>
    </div>
  </body>
</html>
