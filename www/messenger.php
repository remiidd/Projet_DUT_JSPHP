<?php
  session_start();

  if(isset($_SESSION['idcon'])){
    $nouv_conv = true;
    ?>
      <!DOCTYPE html>
      <html lang="fr" dir="ltr">
        <head>
          <meta charset="utf-8">
          <title>Messenger</title>
          <?php include 'scripts/html/head.html'; ?>
        </head>
        <body onresize="resize_msg()" onload="resize_msg()">
          <?php include 'bar_navigation/nonco.php'?>
          <div class="content">
            <div id="historique">
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
                                        ORDER BY MAX(message.id) ASC ");
                while ($donnees = $reponse->fetch()){
                  $id = intval($donnees['id_message']);
                  $histo[$id]=array($donnees['id'], $donnees['prenom'] ." " . $donnees['nom']);
                }

                $reponse = $bdd->query("SELECT DISTINCT(profil.id), profil.nom, profil.prenom, MAX(message.id) as id_message
                                        FROM profil
                                        LEFT JOIN message ON profil.id = message.id_dest
                                        WHERE message IS NOT NULL AND message.id_exp=\"$moi\"
                                        GROUP BY profil.id
                                        ORDER BY MAX(message.id) ASC ");

                while ($donnees = $reponse->fetch()){
                  $existe = false;
                  foreach($histo as $key => $value){
                    if($histo[$key][0] == $donnees['id']){
                      $existe = true;
                      if($key < $donnees['id_message']){
                        unset($histo[$key]);
                        $id = intval($donnees['id_message']);
                        $histo[$id]=array($donnees['id'], $donnees['prenom'] . " " . $donnees['nom']);
                      }
                    }
                  }
                  if($existe == false){
                    $id = intval($donnees['id_message']);
                    $histo[$id]=array($donnees['id'], $donnees['prenom'] . " " . $donnees['nom']);
                  }
                }

                if(!(isset($histo)) && isset($_SESSION['amis_conv'])){
                  $_SESSION['nv_conv'] = $_SESSION['amis_conv'];
                }

                if(isset($_SESSION['nv_conv'])){
                  if(isset($histo)){
                    for($i = max(array_keys($histo)); $i>=array_shift(array_keys($histo)); $i--){
                        if($histo[$i][0] == $_SESSION['nv_conv']){
                          $_SESSION['amis_conv'] = $_SESSION['nv_conv'];
                          $nouv_conv = false;
                        }
                    }
                  }


                  if($nouv_conv == true){
                    $_SESSION['amis_conv'] = $_SESSION['nv_conv'];
                    $id_nouveau = $_SESSION['nv_conv'];
                    $reponse = $bdd->query("SELECT profil.nom, profil.prenom
                                            FROM profil
                                            WHERE id=$id_nouveau");
                    $donnees = $reponse->fetch();
                    ?>
                      <a class="histo_perso_href" href="scripts/php/messenger.php?amis=<?php echo $_donnees['id']?>">
                        <div class="histo_perso_selection">
                          <?php
                            echo $donnees['prenom'] . " " . $donnees['nom'];
                          ?>
                        </div>
                      </a>
                    <?php
                  }
                }

                if(isset($histo)){
                  for($i = max(array_keys($histo)) + 1; $i>=min(array_keys($histo)); $i--){

                    if(isset($histo[$i])){
                      ?>
                        <a class="histo_perso_href" href="scripts/php/messenger.php?amis=<?php echo $histo[$i][0]?>">

                      <?php
                      if(isset($_SESSION['amis_conv'])){
                        if($histo[$i][0] == $_SESSION['amis_conv']){
                          ?>
                            <div class="histo_perso_selection">
                          <?php
                        }
                        else{
                          ?>
                            <div class="histo_perso" href="scripts/php/messenger.php?amis=<?php echo $histo[$i][0]?>">
                          <?php
                        }
                      }
                      else {
                        ?>
                          <div class="histo_perso" href="scripts/php/messenger.php?amis=<?php echo $histo[$i][0]?>">
                        <?php
                      }
                            echo $histo[$i][1];
                            $moi = $_SESSION['idcon'];
                            $lui = $histo[$i][0];
                            $reponse = $bdd->query("SELECT COUNT(*) as notif
                                                    FROM message
                                                    WHERE id_exp=$lui AND id_dest=$moi AND vu=0");
                            $donnees = $reponse->fetch();
                            if($donnees['notif']!= 0){
                              ?>
                                <span class="notification_count"><?php echo $donnees['notif']; ?></span>
                              <?php
                            }
                              ?>
                          </div>
                        </a>
                      <?php
                    }
                  }
                }
              ?>
            </div>
            <div class="discution">
              <div id="message">
                <?php
                  if(isset($_SESSION['amis_conv'])){
                    $moi = $_SESSION['idcon'];
                    $lui = $_SESSION['amis_conv'];
                    try{
                      $bdd = new PDO('mysql:host=lulipa.server.r-heberg.fr;dbname=derayalois;port=3306;charset=utf8', 'derayalois', 'testdebrayalois');
                    }
                    catch (Exception $e){
                          die('Erreur : ' . $e->getMessage());
                    }
                    $reponse = $bdd->query("SELECT id_exp, id_dest, message FROM message WHERE id_exp=".$moi." AND id_dest=".$lui." OR id_dest=".$moi." AND id_exp=".$lui." order by id ASC");

                    while ($donnees = $reponse->fetch()){
                      if ($donnees['id_exp'] == $_SESSION['idcon']) {
                        echo "<div class=\"bulle-moi\">
                                <p>".htmlentities($donnees['message'])."</p>
                              </div>";
                      }
                      else{
                        echo "<div class=\"bulle-ami\">
                                <p>".htmlentities($donnees['message'])."</p>
                              </div>";
                      }
                    }
                    $bdd->exec("UPDATE message SET vu=1 WHERE id_exp=".$lui." AND id_dest=".$moi);
                  }

                 ?>
              </div>
              <?php
                if(isset($_SESSION['amis_conv'])){
                  ?>
                    <div class="zone_message">
                      <form class="" action="scripts/php/send_message.php" method="post">
                        <textarea class="message_area" name="message"></textarea>
                        <button type="submit" class="envoie_msg" name="button">Envoyer</button>
                      </form>
                    </div>
                  <?php
                }
                else {
                  ?>
                  <div class="pas_d_amis">
                  </div>
                  <?php
                }
              ?>

            </div>
          </div>
          <script src="scripts/js/messenger.js"></script>
        </body>
      </html>
    <?php
  }
  else {
    header("Location: accueil");
    exit();
  }
?>
