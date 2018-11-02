<!DOCTYPE html>
<?php session_start();
if((!isset($_SESSION["idcon"]))||($_SESSION["idcon"]!=$_GET["id"])){
  header("Location: index.php");
}
?>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <title>Paramètres du compte de</title>
  </head>
  <body>

  </body>
</html>
