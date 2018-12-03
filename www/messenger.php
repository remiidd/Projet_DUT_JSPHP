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
            <div class="historique">
              <?php
              $moi = $_SESSION['idcon'];
                try{
                  $bdd = new PDO('mysql:host=lulipa.server.r-heberg.fr;dbname=derayalois;port=3306;charset=utf8', 'derayalois', 'testdebrayalois');
                }
                catch (Exception $e){
                      die('Erreur : ' . $e->getMessage());
                }
                $reponse = $bdd->query("SELECT DISTINCT(profil.id), profil.nom, profil.prenom, MAX(message.id) as id_message
                                        FROM profil
                                        LEFT JOIN message ON profil.id = message.id_exp
                                        WHERE message IS NOT NULL AND message.id_dest=\"$moi\"
                                        GROUP BY profil.id
                                        ORDER BY MAX(message.id) DESC ");
                $histo[] = "";
                while ($donnees = $reponse->fetch()){
                  $id = intval($donnees['id_message']);
                  $histo[$id]=$donnees['nom'];
                }
                echo array_pop(array_keys($histo));
                for($i = 0; $i<sizeof($histo); $i++){
                  if(isset($histo[$i])){
                    echo $histo[$i];
                  }
                }
                echo "ici";
                echo $histo[6];
              ?>
            </div>
            <div class="discution">
              <div class="message">
                <?php
                /*  $moi = $_SESSION['idcon'];
                  try{
                    $bdd = new PDO('mysql:host=lulipa.server.r-heberg.fr;dbname=derayalois;port=3306;charset=utf8', 'derayalois', 'testdebrayalois');
                  }
                  catch (Exception $e){
                        die('Erreur : ' . $e->getMessage());
                  }
                  $reponse = $bdd->query("SELECT id_exp, id_dest, message FROM message WHERE id_exp=".$moi." OR id_dest=".$moi." order by id ASC LIMIT 15");

                  while ($donnees = $reponse->fetch()){
                    if ($donnees['id_exp'] == $_SESSION['idcon']) {
                      echo "<div class=\"bulle-moi\">
                              <p>".$donnees['message']."</p>
                            </div>";
                    }
                    else{
                      echo "<div class=\"bulle-ami\">
                              <p>".$donnees['message']."</p>
                            </div>";
                    }
                  }*/
                 ?>
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
