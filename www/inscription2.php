<?php session_start(); ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Inscription</title>
  </head>
  <body>
    <div class="contenu">
      <center>
        <form id="inscription2" action="" method="post">
          <input type="text" name="prenom" placeholder="<?php echo $_SESSION['prenom']; ?>" readonly>
          <br>
          <input type="text" name="nom" placeholder="<?php echo $_SESSION['nom']; ?>" readonly>
          <br>
          <input type="text" name="email" placeholder="<?php echo $_SESSION['email']; ?>" readonly>
          <br>
          <input type="date" name="nom" value="<?php echo $_SESSION['naissance']; ?>" readonly>
          <br>
          <?php
            if($_SESSION['sexe'] == "Homme"){
              ?>
              <div id="formSexe2">
                <input readonly required type="radio" name="sexe" placeholder="homme" checked>Homme
                <input readonly required type="radio" name="sexe" placeholder="femme" disabled>Femme
                <input readonly required type="radio" name="sexe" placeholder="banana" disabled>BANANAAAAAAAA<br>
              </div>
              <?php
            }
            elseif ($_SESSION['sexe'] == "Femme") {
              ?>
              <div id="formSexe2">
                <input readonly required type="radio" name="sexe" placeholder="homme" disabled>Homme
                <input readonly required type="radio" name="sexe" placeholder="femme" checked>Femme
                <input readonly required type="radio" name="sexe" placeholder="banana" disabled>BANANAAAAAAAA<br>
              </div>
              <?php
            }
            else{
              ?>
              <div id="formSexe2">
                <input readonly required type="radio" name="sexe" placeholder="homme" disabled>Homme
                <input readonly required type="radio" name="sexe" placeholder="femme" disabled>Femme
                <input readonly required type="radio" name="sexe" placeholder="banana" checked>BANANAAAAAAAA<br>
              </div>
              <?php
            }
          ?>
          <input type="tel" name="tel" placeholder="Téléphone">
          <br>
          <input type="file" name="" value="photo">
        </form>
      </center>
    </div>
  </body>
</html>
