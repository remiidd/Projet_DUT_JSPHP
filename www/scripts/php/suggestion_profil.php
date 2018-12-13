<?php
  echo "Voici une suggestion de profil à ajouter en amis pour profiter de l'experience bananabook";
  try {
    $bdd = new PDO('mysql:host=lulipa.server.r-heberg.fr;dbname=derayalois;charset=utf8', 'derayalois', 'testdebrayalois');
  } catch (\Exception $e) {
    die('Erreur :'.$e->getMessage());
  }
  $reponse = $bdd->query('SELECT profil,COUNT(*)
                          FROM posts
                          GROUP BY profil
                          ORDER BY COUNT(*) DESC
                          LIMIT 5');
?>
<div class="suggestion_prof">
  <div class="liste_profils">
    <?php while($idprofil = $reponse->fetch()){
      $req = $bdd->query('SELECT * FROM profil where id=\''.$idprofil["profil"].'\'');
      $profil = $req->fetch();
      $req2 = $bdd->query('SELECT statut FROM amis WHERE id_amis=\''.$_SESSION["idcon"].'\' AND id=\''.$profil["id"].'\'');
      $isfriend = $req2->fetch();
      $stamis = false;
      if(($isfriend["statut"]!=null)||$isfriend["statut"]!="bloque"){
        $stamis = true;
      }
      ?>
      <div class="profil_suggestion"><a href="profil-<?php echo $profil["id"]; ?>" class="no_deco_link modif_infos_boutons"><img src="../../<?php if($profil["photo_profil"]!="") { echo $profil["photo_profil"]; } else { echo "src/media/default_profil_picture.jpg"; } ?>" class="photo_profil_suggestion" alt="">
        <p><?php echo $profil["prenom"]." ".$profil["nom"]; ?></p></a>
        <?php
          if($stamis == true){
            ?>
            <form class="" action="scripts/php/supprimer_amis.php?id=<?php echo $_SESSION['idcon'];?>&id_amis=<?php  echo $donnees['id'];?>" method="post">
              <input class="button_result_rech" type="submit" name="Ajouter" value="Supprimer">
            </form>
            <?php
          }
          else {
            ?>
            <form class="" action="scripts/php/ajouter_amis.php?id=<?php echo $_SESSION['idcon'];?>&id_amis=<?php  echo $donnees['id'];?>" method="post">
              <input class="button_result_rech" type="submit" name="Ajouter" value="Ajouter">
            </form>
            <?php
          }
        ?>
      </div>
    <?php } ?>
    <div class="profil_suggestion"><a href="profil-69" class="no_deco_link modif_infos_boutons"><img src="../../src/media/profils/69-pp.gif" class="photo_profil_suggestion" alt="">
      <p>La Banane Officielle</p></a></div>
  </div>
</div>
