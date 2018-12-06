<?php
  session_start();
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
              <?php
                if(isset($_GET['err'])){
                  ?>
                    <p id="error_connexion">Identifiants incorrects</p>
                  <?php
                }
              ?>
              <label>Identifiant</label>
              </br>
              <?php
                if(isset($_GET['err'])){
                  ?>
                    <input type="text" name="id" value="<?php echo $_GET['user']?>">
                  <?php
                }
                else{
                  ?>
                    <input type="text" name="id">
                  <?php
                }
              ?>
            </p>
            <p>
              <label>Mot de passe</label>
              </br>
              <input type="password" name="mdp">
            </p>
            <input type="submit" value="Connexion" id="connexionBout">
          </form>
          <p>
            <a href="mdpoublie.php?">Mot de passe oublié ?</a>
          </p>
          <p>
            <a href="index.php">Inscrivez-vous</a>
          </p>
        </center>
      </div>
    </div>
  </body>
</html>
<?php
  }
?>
