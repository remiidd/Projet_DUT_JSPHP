<?php
try {
  $bdd = new PDO('mysql:host=lulipa.server.r-heberg.fr;dbname=derayalois;charset=utf8', 'derayalois', 'testdebrayalois');
} catch (\Exception $e) {
  die('Erreur :'.$e->getMessage());
}
//SELECT * FROM `posts` WHERE profil IN('1','19')
$req = $bdd->query('SELECT * FROM amis WHERE id=\''.$_SESSION["idcon"].'\'');
$add = $req->fetch();
$liste_amis = "\'".$add["id_amis"]."\'";
while($add = $req->fetch()) {
  $liste_amis = $liste_amis.",\'".$add["id_amis"]."\'";
}
echo $liste_amis;
$reponse = $bdd->query('SELECT *
                              FROM posts
                              WHERE profil=\'1\'
                              LIMIT 5');
while($feed = $reponse->fetch()) {
  $profil_feed = $bdd->query('SELECT * FROM profil WHERE id=\''.$feed["profil"].'\'');
  $data = $profil_feed->fetch();
  ?><div><hr>
    <h5><a class="no_deco_link" href="<?php echo "profil-".$feed["profil"]; ?>"><img class="pp_posts" src="<?php if($data["photo_profil"]!=null) { echo $data["photo_profil"]; } else { ?>src/media/default_profil_picture.jpg<?php } ?>" alt="Default profil cover"/><?php echo " ".$feed["nom_createur"]; ?></h5></a><p>
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
      <li class="elements_barre_posts"><a href="" onclick="liker_post(<?php echo $feed["id"].",".$_SESSION["idcon"]; ?>)"><?php echo $feed["nb_like"];?> Likes <i class="<?php if($okk){ echo "fas"; } else { echo "far"; } ?> fa-thumbs-up"></i></a></li>
      <li class="elements_barre_posts"><a href="posts.php?id=<?php echo $feed["id"]; ?>"><?php echo $feed["nb_com"];?> Commentaires <i class="far fa-comments"></i></a></li>
      <li class="elements_barre_posts"><a href="" onclick="share_post(<?php echo $feed["id"].",".$_SESSION["idcon"]; ?>)"><?php echo $feed["nb_share"];?> Shares <i class="fas fa-share"></i></a></li>
    </ul>
  </div><?php
} ?><hr>
<div>
  <h5><a class="no_deco_link" href="/accueil"><img class="pp_posts" src="src/media/sponso.gif" alt="Sponsophoto"/> Sponsorisé</h5></a><p>
    <br><p>publicité d'un annonceur</p>
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
</div><hr>
