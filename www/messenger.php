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
                    echo $key . " " . $histo[$key][0] . " ";
                    if($histo[$key][0] == $donnees['id']){
                      $existe = true;
                      echo "true" . $donnees['id_message'] . " | ";
                      if($key < $donnees['id_message']){
                        echo " nouveau plus grand ";
                        unset($histo[$key]);
                        $id = intval($donnees['id_message']);
                        $histo[$id]=array($donnees['id'], $donnees['prenom'] . " " . $donnees['nom']);
                      }
                    }
                  }
                  echo " | " . $donnees['id'] . " </br>";
                  if($existe == false){
                    echo "existe pas";
                    $id = intval($donnees['id_message']);
                    $histo[$id]=array($donnees['id'], $donnees['prenom'] . " " . $donnees['nom']);
                  }
                  /*foreach($histo as $key => $val){
                    if( isSet($val[0]) && $val[0] == $donnees['id'] ){
                      if($key<$donnees['id_message']){
                        unset($histo[$key]);
                        $id = intval($donnees['id_message']);
                        $histo[$id]=array($donnees['id'], $donnees['prenom'] . " " . $donnees['nom']);
                      }
                    }
                  }*/
                }

                

                if(isset($_SESSION['nv_conv'])){
                  for($i = max(array_keys($histo)); $i>=array_shift(array_keys($histo)); $i--){
                      if($histo[$i][0] == $_SESSION['nv_conv']){
                        $_SESSION['amis_conv'] = $_SESSION['nv_conv'];
                        $nouv_conv = false;
                      }
                      else {
                        $_SESSION['amis_conv'] = $_SESSION['nv_conv'];
                      }
                  }

                  if($nouv_conv == true){
                    $id_nouveau = $_SESSION['nv_conv'];
                    $reponse = $bdd->query("SELECT profil.nom, profil.prenom
                                            FROM profil
                                            WHERE id=$id_nouveau");
                    $donnees = $reponse->fetch();
                    ?>
                      <a class="histo_perso_href" href="scripts/php/messenger.php?amis=<?php echo $_SESSION['nv_conv']?>">
                        <div class="histo_perso_selection">
                          <?php
                            echo $donnees['prenom'] . " " . $donnees['nom'];
                          ?>
                        </div>
                      </a>
                    <?php
                  }
                  unset($_SESSION['nv_conv']);
                }


                for($i = max(array_keys($histo)) + 1; $i>=array_shift(array_keys($histo)); $i--){

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
                        ?>
                        </div>
                      </a>
                    <?php
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
                                <p>".$donnees['message']."</p>
                              </div>";
                      }
                      else{
                        echo "<div class=\"bulle-ami\">
                                <p>".$donnees['message']."</p>
                              </div>";
                      }
                    }
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
