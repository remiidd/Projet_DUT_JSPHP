<?php
  session_start();

  if(isset($_SESSION['idcon'])){
    ?>
      <!DOCTYPE html>
      <html lang="en" dir="ltr">
        <head>
          <meta charset="utf-8">
          <title>Recherche</title>
          <script src="scripts/js/messenger.js" charset="utf-8"></script>
          <?php include 'scripts/html/head.html'; ?>
        </head>
        <body onresize="resize_msg()" onload="resize_msg()">
          <?php include 'bar_navigation/nonco.php'?>
          <div class="content">
            <div class="historique"></div>
            <div class="discution">
              <div class="message">
                <?php
                  try{
                    $bdd = new PDO('mysql:host=lulipa.server.r-heberg.fr;dbname=derayalois;port=3306;charset=utf8', 'derayalois', 'testdebrayalois');
                  }
                  catch (Exception $e){
                        die('Erreur : ' . $e->getMessage());
                  }
                  $reponse = $bdd->query("SELECT id_exp, id_dest, message FROM message WHERE id_exp=$_SESSION[\'idcon\'] OR id_dest=$_SESSION[\'idcon\'] order by id DESC LIMIT 15");


                 ?>

                <div class="bulle-moi"></div><br>
                <div class="bulle-ami"></div><br>
                <div class="bulle-ami"></div><br>
                <div class="bulle-moi"></div><br>
                <div class="bulle-moi"></div><br>
                <div class="bulle-moi"></div><br>
                <div class="bulle-ami"></div><br>
                <div class="bulle-moi"></div><br>
              </div>
              <div class="zone_message">
                <form class="" action="index.html" method="post">
                  <textarea class="message_area" name="message"></textarea>
                  <button type="submit" class="envoie_msg" name="button"></button>
                </form>
              </div>
            </div>
          </div>
        </body>

      </html>
    <?php
  }
  else {
    header("Location: accueil");
    exit();
  }
?>
