<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Post de <?php echo $data["prenom"];?></title>
  <link rel="icon" href="src/img/banana.ico" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.2/css/all.css" integrity="sha384-/rXc/GQVaYpyDdyxK+ecHPVYJSN9bmVFBvjA/9eOB+pb3F2w2N6fc5qB9Ew5yIns" crossorigin="anonymous">
  <!--Fin des fichiers bootstrap-->
  <link rel="stylesheet" href="css/styles.css"/>
</head>
  <body>
    <?php
    try {
      $bdd = new PDO('mysql:host=lulipa.server.r-heberg.fr;dbname=derayalois;charset=utf8', 'derayalois', 'testdebrayalois');
    } catch (\Exception $e) {
      die('Erreur :'.$e->getMessage());
    }
      $reponse = $bdd->query('SELECT * FROM posts WHERE id=\''.$_GET['id'].'\'');
      $feed = $reponse->fetch();
      if($feed["contenu"]==null) {
        header('Location: accueil');
      } else {
        ?>
        <script>
          window.parent.document.title = 'Post de <?php echo $feed["nom_createur"]; ?>'
        </script>
        <?php
      }
      $reponse = $bdd->query('SELECT * FROM profil WHERE id=\''.$feed['profil'].'\'');
      $profil = $reponse->fetch();
    ?>
    <?php include 'bar_navigation/nonco.php' ?>
    <?php if(isset($_POST["textarea_posts"])){
      $url_refresh = "Location:posts.php?id=".$_GET["id"];
      header($url_refresh);
    } ?>
    <div class="content">
      <div class="wrapp">
        <h5><img class="pp_posts_max" src="<?php if($profil["photo_profil"]!=null) {
                                          echo $profil["photo_profil"]; }
                                          else { ?>src/media/default_profil_picture.jpg<?php } ?>" alt="Default profil picture"/>
            <a class="no_deco_link" href="<?php echo "profil.php?id=".$feed["profil"]; ?>">
              <?php echo " ".$feed["nom_createur"]; ?>
        </a></h5>
        <i><?php $d_publi = new DateTime($feed["date_publication"]); echo "Publié le ".$d_publi->format("d/m/Y");?></i>
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
          echo "<br />".$feed["contenu"];
        } ?></p><?php if($_SESSION["idcon"]!=""){ ?><br/>
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
      <?php } ?>
        <hr>
        <p>Commentaires</p>
        <?php if($_SESSION["idcon"]!=""){ ?>
          <div class="envoyer_post">
            <form class="form_envoyer_post" method="POST">
              <textarea id="areapost" name="textarea_posts" rows="2" cols="70" placeholder="Commentez ce post"></textarea><br/>
              <p id="nb_caract_string"><i id="nb_caract">0</i> / 100 caractères maximum <input id="inscriBout" type="submit" name="bouton_posts" value="Bananez !"/></p>
            </form>
            <script src="scripts/js/caractere_max_com.js"></script>
          </div><?php
            if(isset($_POST["textarea_posts"])) {
              $message = htmlentities($_POST["textarea_posts"]);
              $reponse = $bdd->query('SELECT * FROM profil WHERE id=\''.$_SESSION["idcon"].'\'');
              $profil_sender = $reponse->fetch();
              $req = $bdd->prepare('INSERT INTO commentaire(id, id_post, text_com, nom_createur, id_profil)
                                    VALUES(NULL, :idpost,  :contenu, :createur, :id_profil)');
              $req->execute(array(
                'idpost' => $_GET["id"],
                'contenu' => $message,
                'createur' => $profil_sender["prenom"]." ".$profil_sender["nom"],
                'id_profil' => $_SESSION["idcon"]
              ));
              $req2 = $bdd->query('UPDATE posts SET nb_com=nb_com+1 WHERE id=\''.$_GET["id"].'\'');
              $url_refresh = "Location:posts.php?id=".$_GET["id"];
              header($url_refresh);
          }
        } ?>
          <hr>
          <div id="message">
          <?php
          $rep = $bdd->query('SELECT * FROM commentaire WHERE id_post=\''.$_GET["id"].'\'');
          while($com = $rep->fetch()){
            $req = $bdd->query('SELECT * FROM profil WHERE id=\''.$com["id_profil"].'\'');
            $profil_du_com = $req->fetch();
             ?>
             <div>
               <?php echo $com["nom_createur"]." commente : ".$com["text_com"];?>
             </div><br/>
            <?php
          }
           ?>
         </div>
        </div>
      </div>
    <script src="scripts/js/comments.js"></script>
    <script src="scripts/js/req.js"></script>
  </body>
</html>
