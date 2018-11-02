<?php session_start();
  if(!(isset($_SESSION['prenom']))){
    header("Location:../../index.php");
    exit();
  }
  else {
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Inscription</title>
    <?php  include 'scripts/html/head.html';?>
  </head>
  <body>
    <?php
      include 'bar_navigation/connexion.php'
    ?>
    <div class="content">
      <div>
        <img id="img_gauche" src="src/media/hochet-banane.jpg" />
      </div>
      <div>
        <img id="img_droite" src="src/media/deguisement-banane.jpg" />
      </div>
      <center id="center_inscri">
        <form id="inscription2" action="scripts/php/inscription2.php" method="post" enctype="multipart/form-data">
          <label>Prenom : </label>
          <input type="text" name="prenom" value="<?php echo $_SESSION['prenom']; ?>" readonly>
          <br>
          <label>Nom : </label>
          <input type="text" name="nom" value="<?php echo $_SESSION['nom']; ?>" readonly>
          <br>
          <label>Email : </label>
          <input type="text" name="email" value="<?php echo $_SESSION['email']; ?>" readonly>
          <br>
          <label>Date de naissance : </label>
          <input type="date" name="naissance" value="<?php echo $_SESSION['naissance']; ?>" readonly>
          <br>
          <?php
            if($_SESSION['sexe'] == "Homme"){
              ?>
              <div id="formSexe2">
                <label>Sexe : </label>
                <input readonly required type="radio" name="sexe" value="homme" checked>Homme
                <input readonly required type="radio" name="sexe" value="femme" disabled>Femme
                <input readonly required type="radio" name="sexe" value="banana" disabled>BANANAAAAAAAA<br>
              </div>
              <?php
            }
            elseif ($_SESSION['sexe'] == "Femme") {
              ?>
              <div id="formSexe2">
                <label>Sexe : </label>
                <input readonly required type="radio" name="sexe" value="homme" disabled>Homme
                <input readonly required type="radio" name="sexe" value="femme" checked>Femme
                <input readonly required type="radio" name="sexe" value="banana" disabled>BANANAAAAAAAA<br>
              </div>
              <?php
            }
            else{
              ?>
              <div id="formSexe2">
                <label>Sexe : </label>
                <input readonly required type="radio" name="sexe" value="homme" disabled>Homme
                <input readonly required type="radio" name="sexe" value="femme" disabled>Femme
                <input readonly required type="radio" name="sexe" value="banana" checked>BANANAAAAAAAA<br>
              </div>
              <?php
            }
          ?>
          <label>Téléphone : </label>
          <input type="tel" name="tel" placeholder="Téléphone">
          <br>
          <label>Ville : </label>
          <input type="text" name="ville" placeholder="Ville">
          <br>
          <label>Photo de profil : </label>
          <input type="file" name="pp" id="pp">
          <br>
          <label>Photo de couverture : </label>
          <input type="file" name="cover" id="pp">
          <br>
          <input type="submit" name="inscri" value="S'inscrire">
        </form>
      </center>
    </div>
  </body>
</html>
<?php
  }
?>
