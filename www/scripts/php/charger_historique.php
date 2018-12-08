<?php
  session_start();
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
    foreach($histo as $key => $val){
      if( isSet($val[0]) && $val[0] == $donnees['id'] ){
        if($key<$donnees['id_message']){
          unset($histo[$key]);
          $id = intval($donnees['id_message']);
          $histo[$id]=array($donnees['id'], $donnees['prenom'] . " " . $donnees['nom']);
        }
      }
    }
  }
  for($i = array_pop(array_keys($histo)); $i>=array_shift(array_keys($histo)); $i--){
    if(isset($histo[$i])){
      $mess .= '<a class="histo_perso_href" href="scripts/php/messenger.php?amis='.$histo[$i][0].'">';

      if(isset($_SESSION['amis_conv'])){
        if($histo[$i][0] == $_SESSION['amis_conv']){

            $mess.= '<div class="histo_perso_selection">';

        }
        else{

            $mess.='<div class="histo_perso" href="scripts/php/messenger.php?amis='.$histo[$i][0].'">';

        }
      }
      else {

            $mess.='<div class="histo_perso" href="scripts/php/messenger.php?amis='.$histo[$i][0].'">';

      }

      $mess.=$histo[$i][1];

      $mess.='</div></a>';
    }

  }
  echo $mess;

?>