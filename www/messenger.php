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
                <div class="bulle-ami"></div>
                <div class="bulle-moi"></div>
                <div class="bulle-ami"></div>
                <div class="bulle-ami"></div>
                <div class="bulle-moi"></div>
                <div class="bulle-moi"></div>
                <div class="bulle-moi"></div>
                <div class="bulle-ami"></div>
                <div class="bulle-moi"></div>
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
