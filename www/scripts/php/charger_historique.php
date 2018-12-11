<?php
  session_start();
  $moi = $_SESSION['idcon'];
  $nouv_conv = true;
  $mess="";
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

        $mess.='<a class="histo_perso_href" href="scripts/php/messenger.php?amis='. $_SESSION['nv_conv'] .'">
            <div class="histo_perso_selection">'.
                $donnees['prenom'] . " " . $donnees['nom'] .'
            </div>
          </a>';
      }
    }

    if(isset($histo)){
      echo min(array_keys($histo));
      for($i = max(array_keys($histo)) + 1; $i>=0; $i--){
        if(isset($histo[$i])){
          $mess.='<a class="histo_perso_href" href="scripts/php/messenger.php?amis='.$histo[$i][0].'">';
          if(isset($_SESSION['amis_conv'])){
            if($histo[$i][0] == $_SESSION['amis_conv']){
                $mess.='<div class="histo_perso_selection">';
            }
            else{
                $mess.='<div class="histo_perso" href="scripts/php/messenger.php?amis='. $histo[$i][0] .'">';
            }
          }
          else {
              $mess.='<div class="histo_perso" href="scripts/php/messenger.php?amis=' . $histo[$i][0] . '">';
          }
            $mess.=$histo[$i][1];
            $moi = $_SESSION['idcon'];
            $lui = $histo[$i][0];
            $reponse = $bdd->query("SELECT COUNT(*) as notif
                                    FROM message
                                    WHERE id_exp=$lui AND id_dest=$moi AND vu=0");
            $donnees = $reponse->fetch();
            if($donnees['notif']!= 0){
              $mess .='<span class="notification_count">'.$donnees['notif'].'</span>';
            }
            $mess.='</div></a>';
        }
      }
    }

    echo $mess;
  ?>
