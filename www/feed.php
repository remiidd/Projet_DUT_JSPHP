<?php session_start(); ?>
<?php
if(!isset($_SESSION["idcon"])){
  header("Location: index.php");
}
?>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Bananafeed</title>
    <link rel="icon" href="src/img/banana.ico" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.2/css/all.css" integrity="sha384-/rXc/GQVaYpyDdyxK+ecHPVYJSN9bmVFBvjA/9eOB+pb3F2w2N6fc5qB9Ew5yIns" crossorigin="anonymous">

    <link rel="stylesheet" href="css/styles.css"/>

    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <script>
     (adsbygoogle = window.adsbygoogle || []).push({
          google_ad_client: "ca-pub-2486327099541957",
          enable_page_level_ads: true
     });
   </script>
  </head>
  <body>
    <?php include 'bar_navigation/nonco.php' ?>
    <div class="content">
      <div class="wrapp">
        <h3>Bananafeed</h3>
        <?php if(!isset($_SESSION["feedd"])){
          $_SESSION["feedd"] = 0;
          $_SESSION["stop_pub"] = false;
        } ?>
        <?php if($_GET["feed"]!=100){ include "scripts/php/feed_defilement.php"; } else { include "scripts/php/suggestion_profil.php";}?>
      </div>
    </div>
    <script src="scripts/js/feed.js"></script>
    <script src="scripts/js/req.js"></script>
  </body>

</html>
