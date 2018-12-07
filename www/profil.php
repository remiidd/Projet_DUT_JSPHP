<?php session_start(); ?>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <title>Profil de <?php echo $data["prenom"];?></title>
    <link rel="icon" href="src/img/banana.ico" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.2/css/all.css" integrity="sha384-/rXc/GQVaYpyDdyxK+ecHPVYJSN9bmVFBvjA/9eOB+pb3F2w2N6fc5qB9Ew5yIns" crossorigin="anonymous">
    <!--Fin des fichiers bootstrap-->
    <link rel="stylesheet" href="css/styles.css"/>
  </head>
  <body>
    <?php include 'bar_navigation/nonco.php' ?>
    <?php
    try {
      $bdd = new PDO('mysql:host=lulipa.server.r-heberg.fr;dbname=derayalois;charset=utf8', 'derayalois', 'testdebrayalois');
    } catch (\Exception $e) {
      die('Erreur :'.$e->getMessage());
    }
      $reponse = $bdd->query('SELECT * FROM profil WHERE id=\''.$_GET['id'].'\'');
      $data = $reponse->fetch();
      if($data["prenom"]==null) {
        header('Location: accueil');
      } else {
        ?>
        <script>
          window.parent.document.title = 'Profil de <?php echo $data["prenom"]; ?>'
        </script>
        <?php
      }
    ?>

    <!-- CONTENU DANS CETTE DIV -->
    <div class="content">
      <div class="wrapp">
        <div id="presentation">
          <div class="cover" style="background-repeat: no-repeat;background-size: cover;background-position: center center;background-image:url(<?php if($data["photo_couv"]!=null) { echo $data["photo_couv"]; } else { ?>src/media/default_profil_cover.jpg<?php } ?>);"></div>
          <div class="pp"><img class="profilpicture" src="<?php if($data["photo_profil"]!=null) { echo $data["photo_profil"]; } else { ?>src/media/default_profil_picture.jpg<?php } ?>" alt="Default profil picture"/></div>
          <h1 class="name"><?php echo $data["prenom"]." ".$data["nom"]; ?></h1>
        </div>
        <div id="infos">
          <?php
          $rep = $bdd->query('SELECT *
                              FROM emploi
                              WHERE profil=\''.$_GET['id'].'\'
                              ORDER BY id DESC');
          $emploi = $rep->fetch();
          $rep = $bdd->query('SELECT *
                              FROM etude
                              WHERE profil=\''.$_GET['id'].'\'
                              ORDER BY id DESC');
          $etude = $rep->fetch(); ?>
          <table id="tableau_infos_perso">
            <tr>
              <td><?php if($data["ville"]!=""){ ?><p>Habite à <strong><?php echo $data["ville"]; ?></strong> <a href="https://www.google.fr/maps/place/<?php echo $data["ville"];?>" class="no_deco_link modif_infos_boutons"><i class="fas fa-map-marker-alt"></i></a></p><?php } ?></td>
              <td><?php if($emploi["travail"]!=""){ ?><p>Travail à <strong><?php echo $emploi["travail"];?></strong><?php } ?></td>
            </tr>
            <tr>
              <td><p>Agé de <strong><?php $today = new DateTime();$naissance = new DateTime($data["naissance"]);echo $today->diff($naissance)->format("%Y");?></strong> ans</p>
              <?php if(($today->format("%m%d"))==($naissance->format("%m%d"))) { ?><p>Bon anniversaire !</p><?php } ?></td>
              <td><?php if($etude["etablissement"]!=""){ ?><p>Etudie à <strong><?php echo $etude["etablissement"]; ?></strong></p><?php } ?></td>
            </tr>
          </table>
        <?php if($_SESSION["idcon"]==$_GET["id"]){ ?>
          <p><a href="settings.php?id=<?php echo $_SESSION["idcon"]; ?>">Modifier vos informations personnelles</a></p>
          </div>
          <div class="envoyer_post">
            <form class="form_envoyer_post" method="POST">
              <textarea id="areapost" name="textarea_posts" rows="8" cols="130" placeholder="<?php
                $var = rand(0,5);
                switch ($var) {
                  case 0:
                    echo "Ecrivez ce qui vous passe par la tête...";
                    break;
                  case 1:
                    echo "Expliquez pourquoi pensez vous que la bananne est la star du rayon fruits et légumes ?";
                    break;
                  case 2:
                    echo "Décrivez ici votre journée";
                    break;
                  case 3:
                    echo "Comment s'est passé votre weekend ?";
                    break;
                  case 4:
                    echo "Quel est votre film préféré ?";
                    break;
                  case 5:
                    echo "Raconte moi ta vie !";
                    break;
                  default:
                    echo "Ecrivez ce qui vous passe par la tête...";
                    break;
                }

              ?>"></textarea><br/>
              <p id="nb_caract_string"><i id="nb_caract">0</i> / 500 caractères maximum</p><input id="inscriBout" type="submit" name="bouton_posts" value="Bananez !"/>
            </form>
            <script src="scripts/js/caractere_max.js"></script>
          <?php
        } else {?> </div> <?php }
            if(isset($_POST["textarea_posts"])) {
              $message = htmlentities($_POST["textarea_posts"]);

              $today = new DateTime();
              $req = $bdd->prepare('INSERT INTO posts(id, nom_createur, date_publication, contenu, photo, profil, nb_com, nb_like, nb_share)
                                    VALUES(NULL, :noms, CURRENT_DATE(), :contenu, :photo, :profil,\'0\',\'0\',\'0\')');
              $req->execute(array(
                'noms' => $data["prenom"]." ".$data["nom"],
                'contenu' => $message,
                'photo' => "",
                'profil' => $_GET["id"]
              ));
              $url_refresh = "Location:profil".$_GET["id"];
              header($url_refresh);
          ?>
        </div><?php } ?>
        <div class="feed_profil">
          <?php $reponse = $bdd->query('SELECT *
                                        FROM posts
                                        WHERE profil=\''.$_GET['id'].'\'
                                        ORDER BY id DESC');
          while($feed = $reponse->fetch()) {
            ?><div><hr>
              <h5><a class="no_deco_link" href="<?php echo "profil-".$feed["profil"]; ?>"><img class="pp_posts" src="<?php if($data["photo_profil"]!=null) { echo $data["photo_profil"]; } else { ?>src/media/default_profil_picture.jpg<?php } ?>" alt="Default profil cover"/><?php echo " ".$feed["nom_createur"]; ?></h5></a><p>
                <i><?php $d_publi = new DateTime($feed["date_publication"]); echo "Le ".$d_publi->format("d/m/Y") ?></i></p><br>
                <p><?php
                $contenu = explode(".",$feed["contenu"]);
                if($contenu[0]==md5("share")){
                  ?>
                    <div class="partage"><!-- ICI C4EST PARIS -->
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
                    </div><!-- ICI C4EST PARIS -->
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
        </div>
      </div>
    </div>
    <?php $reponse->closeCursor(); ?>
    <script src="scripts/js/req.js"></script>
  </body>
</html>
