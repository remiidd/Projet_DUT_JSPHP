<?php
session_start();
if(!isset($_SESSION["feedd"])){
  $_SESSION["feedd"] = 0;
  $_SESSION["stop_pub"] = false;
} else {
  $off = $_SESSION["feedd"];
  $_SESSION["feedd"] = $_SESSION["feedd"] + 5;
  $_SESSION["stop_pub"] = false;
}
try {
  $bdd = new PDO('mysql:host=lulipa.server.r-heberg.fr;dbname=derayalois;charset=utf8', 'derayalois', 'testdebrayalois');
} catch (\Exception $e) {
  die('Erreur :'.$e->getMessage());
}
$req = $bdd->query('SELECT * FROM amis WHERE statut=\'amis\' AND id=\''.$_SESSION["idcon"].'\'');
$add = $req->fetch();
$liste_amis = "'".$add["id_amis"]."'";
while($add = $req->fetch()) {
  $liste_amis = $liste_amis.",'".$add["id_amis"]."'";
}
$nb_post = $bdd->query('SELECT COUNT(*)
                        FROM posts
                        WHERE profil IN ('.$liste_amis.')');
$nb_post = $nb_post->fetch();
if($nb_post["COUNT(*)"]<4) {
  $url_header = "Location: feed.php?feed=100";
  header($url_header);
}
if($off>$nb_post["COUNT(*)"]){ //suggestion de profils
    echo "Voici une suggestion de profil à ajouter en amis pour profiter de l'experience bananabook";
    $reponse = $bdd->query('SELECT profil,COUNT(*)
                            FROM posts
                            GROUP BY profil
                            ORDER BY COUNT(*) DESC
                            LIMIT 5');
  ?>
  <div class="suggestion_prof">
    <div class="liste_profils">
      <?php while($idprofil = $reponse->fetch()){
        $req5 = $bdd->query('SELECT * FROM profil where id=\''.$idprofil["profil"].'\'');
        $profil = $req5->fetch();
        $req6 = $bdd->query('SELECT statut FROM amis WHERE id_amis=\''.$_SESSION["idcon"].'\' AND id=\''.$profil["id"].'\'');
        $isfriend = $req6->fetch();
        $stamis = false;
        if(($isfriend["statut"]!=null)&&($isfriend["statut"]!="bloque")){
          $stamis = true;
        }
        ?>
        <div class="profil_suggestion"><a href="profil-<?php echo $profil["id"]; ?>" class="no_deco_link modif_infos_boutons"><img src="../../<?php if($profil["photo_profil"]!="") { echo $profil["photo_profil"]; } else { echo "src/media/default_profil_picture.jpg"; } ?>" class="photo_profil_suggestion" alt="">
          <p><?php echo $profil["prenom"]." ".$profil["nom"]; ?></p></a>
          <?php
            if($stamis == true){
              ?>
              <form class="" action="scripts/php/supprimer_amis.php?id=<?php echo $_SESSION['idcon'];?>&id_amis=<?php  echo $profil['id'];?>" method="post">
                <input class="button_result_rech" type="submit" name="Ajouter" value="Supprimer">
              </form>
              <?php
            }
            else {
              ?>
              <form class="" action="scripts/php/ajouter_amis.php?id=<?php echo $_SESSION['idcon'];?>&id_amis=<?php  echo $profil['id'];?>" method="post">
                <input class="button_result_rech" type="submit" name="Ajouter" value="Ajouter">
              </form>
              <?php
            }
          ?>
        </div>
      <?php } ?>
      <div class="profil_suggestion"><a href="profil-69" class="no_deco_link modif_infos_boutons"><img src="../../src/media/profils/69-pp.gif" class="photo_profil_suggestion" alt="">
        <p>La Banane Officielle</p></a>
        <?php $req2 = $bdd->query('SELECT statut FROM amis WHERE id_amis=\''.$_SESSION["idcon"].'\' AND id=69');
        $isfriend = $req2->fetch();
        $stamis = false;
        if(($isfriend["statut"]!=null)&&($isfriend["statut"]!="bloque")){
          $stamis = true;
        }
        ?>
          <?php
            if($stamis == true){
              ?>
              <form class="" action="scripts/php/supprimer_amis.php?id=<?php echo $_SESSION['idcon'];?>&id_amis=69" method="post">
                <input class="button_result_rech" type="submit" name="Ajouter" value="Supprimer">
              </form>
              <?php
            }
            else {
              ?>
              <form class="" action="scripts/php/ajouter_amis.php?id=<?php echo $_SESSION['idcon'];?>&id_amis=69" method="post">
                <input class="button_result_rech" type="submit" name="Ajouter" value="Ajouter">
              </form>
              <?php
            }
          ?>
      </div>
    </div>
  </div>
<?php //fin suggestion de profil
  $_SESSION["feedd"] = 0;
  $_SESSION["stop_pub"] = true;
}
$reponse = $bdd->query('SELECT *
                        FROM posts
                        WHERE profil IN ('.$liste_amis.')
                        ORDER BY id DESC
                        LIMIT 5
                        OFFSET '.$off.'');
while($feed = $reponse->fetch()) {
  $profil_feed = $bdd->query('SELECT * FROM profil WHERE id=\''.$feed["profil"].'\'');
  $data = $profil_feed->fetch();
  ?><div class="un_post"><hr>
    <h5><a class="no_deco_link" href="<?php echo "profil-".$feed["profil"]; ?>"><img class="pp_posts" src="<?php if($data["photo_profil"]!=null) { echo $data["photo_profil"]; } else { ?>src/media/default_profil_picture.jpg<?php } ?>" alt="Default profil cover"/><?php echo " ".$feed["nom_createur"]; ?></a></h5><p>
      <i><?php $d_publi = new DateTime($feed["date_publication"]); echo "Le ".$d_publi->format("d/m/Y") ?></i></p><br>
      <p><?php
      $contenu = explode(".",$feed["contenu"]);
      if($contenu[0]==md5("share")){
        ?>
          <div class="partage">
            <?php
              $res = $bdd->query('SELECT * FROM posts WHERE id=\''.$contenu[1].'\'');
              $post_share = $res->fetch();
              $res = $bdd->query('SELECT * FROM profil WHERE id=\''.$post_share["profil"].'\'');
              $profil_share = $res->fetch();
            ?>
            <div><hr>
              <h5><a class="no_deco_link" href="<?php echo "profil-".$post_share["profil"]; ?>"><img class="pp_posts" src="<?php if($profil_share["photo_profil"]!=null) { echo $profil_share["photo_profil"]; } else { ?>src/media/default_profil_picture.jpg<?php } ?>" alt="Default profil cover"/><?php echo " ".$post_share["nom_createur"]; ?></h5></a><p>
                <i><?php $d_publi = new DateTime($post_share["date_publication"]); echo "Le ".$d_publi->format("d/m/Y") ?></i></p><br>
                <p><?php
                $contenu2 = explode(".",$post_share["contenu"]);
                if($contenu2[0]==md5("share")){
                  ?>
                    <div class="partage">
                      <?php
                        $req = $bdd->query('SELECT * FROM posts WHERE id=\''.$contenu2[1].'\'');
                        $post_share2 = $req->fetch();
                        $req = $bdd->query('SELECT * FROM profil WHERE id=\''.$post_share2["profil"].'\'');
                        $profil_share2 = $req->fetch();
                      ?>
                      <h5><a class="no_deco_link" href="<?php echo "profil-".$post_share2["profil"]; ?>"><img class="pp_posts" src="<?php if($profil_share2["photo_profil"]!=null) { echo $profil_share2["photo_profil"]; } else { ?>src/media/default_profil_picture.jpg<?php } ?>" alt="Default profil cover"/><?php echo " ".$post_share2["nom_createur"]; ?></h5></a><p>
                        <i><?php $d_publi = new DateTime($post_share2["date_publication"]); echo "Le ".$d_publi->format("d/m/Y") ?></i></p><br>
                      <a href="<?php echo "posts.php?id=".$contenu2[1]; ?>">Liens vers la publication de <?php echo $post_share2["nom_createur"]; ?></a>
                    </div>
                  <?php
                } else {
                  echo $post_share["contenu"];
                } ?></p><br>
            </div>
          </div>
        <?php
      } else {
        echo $feed["contenu"];
      } ?></p><br>
    <ul class="barre_posts">
      <?php
      $okk = false;
      $result = $bdd->query('SELECT * FROM like_table WHERE profil_like=\''.$_SESSION["idcon"].'\' AND id_post=\''.$feed["id"].'\'');
      if($result->fetch()){$okk=true;}
      ?>
      <li class="elements_barre_posts"><a id="<?php echo $feed["id"]; ?>like" class="bouton_like"><?php echo $feed["nb_like"];?> Likes <i class="<?php if($okk){ echo "fas"; } else { echo "far"; } ?> fa-thumbs-up"></i></a></li>
      <li class="elements_barre_posts"><a href="posts.php?id=<?php echo $feed["id"]; ?>"><?php echo $feed["nb_com"];?> Commentaires <i class="far fa-comments"></i></a></li>
      <li class="elements_barre_posts"><a id="<?php echo $feed["id"]; ?>shar" class="bouton_share"><?php echo $feed["nb_share"];?> Shares <i class="fas fa-share"></i></a></li>
    </ul>
  </div><?php
} if($_SESSION["stop_pub"]==false){ ?><hr>
<div>
  <h5><a class="no_deco_link" href="/accueil"><img class="pp_posts" src="src/media/sponso.gif" alt="Sponsophoto"/> Sponsorisé</h5></a><p>
    <br><img class="pub" src="src/media/banane_pub.jpg" alt="publicite banane"/>
    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <!-- pub feed -->
    <ins class="adsbygoogle"
         style="display:block"
         data-ad-client="ca-pub-2486327099541957"
         data-ad-slot="8857745645"
         data-ad-format="auto"
         data-full-width-responsive="true"></ins>
    <script>
    (adsbygoogle = window.adsbygoogle || []).push({});
    </script>
</div><?php } ?>
