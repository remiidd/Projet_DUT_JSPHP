<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <title>Projet DUT</title>
    <?php  include 'scripts/html/head.html';?>
  </head>
  <body>
    <?php include 'bar_navigation/nonco.php' ?>
    <div class="content">
      <div id="gauche"></div>
      <div id="droite">
        <form id="inscription" action="" method="post">
          <div id="nomprenom_insci">
            <div id="prenom_insci">
              <input type="text" name="id" value="prénom">
            </div>
            <div id="nom_insci"></div>
          </div>
        </form>
      </div>
    </div>
    <h1>index serveur Wamp coucou</h1>
    <p>test test test test<p>
    <?php echo "test php";?></p>
    <script src="scripts/js/script.js"></script>
    <?php include 'scripts/php/script.php'; ?>
    <a href="phtml/connexion.php">Connexion</a>
    <br/><a href="profil.php?id=1">Profil de Utili Le Test</a>
  </body>
</html>
