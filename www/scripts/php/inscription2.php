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
          <input type="text" name="nom" value="<?php echo $_SESSION['prenom']; ?>" readonly>
        </form>
      </center>
    </div>
  </body>
</html>
