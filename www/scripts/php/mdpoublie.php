<?php
  if(isset($_GET['code'])){

    $id = "";

    try{
      $bdd = new PDO('mysql:host=lulipa.server.r-heberg.fr;dbname=derayalois;port=3306;charset=utf8', 'derayalois', 'testdebrayalois');
    }
    catch (Exception $e){
          die('Erreur : ' . $e->getMessage());
    }

    $reponse = $bdd->query('SELECT * FROM mdpoublie');

    while ($donnees = $reponse->fetch())
    {
      if ($donnees['chaine_id'] == $_GET['code']) {
        $id = $donnees['utilisateur'];
      }
    }

    if ($id != "") {
      // chaine connu
      ?>
        <!DOCTYPE html>
        <html lang="fr">
          <head>
            <meta charset="utf-8">
            <title>Réinitialiser votre mot de passe</title>
            <?php  include 'head.html';?>
          </head>
          <body>
            <?php include '../../bar_navigation/connexion.php'; ?>
            <div class="content">
              <div id="mdpoublié">
                <center>
                  <form class="form_mdpo" action="scripts/php/resetmdp.php" method="post">
                    <p>
                      <a id="passerrorr">Le s mots de passe ne correspondent pas</a>
                      <br>
                      <input id="mdpr" required class="inscriform" type="password" name="mdp" placeholder="Mot de passe">
                      </br>
                      <input id="mdpr1" required class="inscriform" type="password" name="mdprepeat" placeholder="Retapper votre mot de passe">
                      </br>
                    </p>
                    <input type="submit" value="Changer mon mot de passe">
                  </form>
                </center>
              </div>
            </div>
          </body>
          <script src="scripts/js/reset.js"></script>
        </html>
      <?php
    }
    else {
      //chaine non-reconnue
      header("Location: ../../index.php");
      exit();
    }

  }
  else {
    header("Location: ../../index.php");
    exit();
  }

?>
