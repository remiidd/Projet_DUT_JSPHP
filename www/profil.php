<?php session_start(); ?>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <title>Profil de <?php echo $data["prenom"];?></title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <!--Fin des fichiers bootstrap-->
    <script src="scripts/js/liker_post.js"></script>
    <link rel="stylesheet" href="css/styles.css"/>
  </head>
  <body>
    <?php
    try {
      $bdd = new PDO('mysql:host=lulipa.server.r-heberg.fr;dbname=derayalois;charset=utf8', 'derayalois', 'testdebrayalois');
    } catch (\Exception $e) {
      die('Erreur :'.$e->getMessage());
    }
      $reponse = $bdd->query('SELECT * FROM profil WHERE id=\''.$_GET['id'].'\'');
      $data = $reponse->fetch();
      if($data["prenom"]==null) {
        header('Location:index.php');
      } else {
        ?>
        <script>
          window.parent.document.title = 'Profil de <?php echo $data["prenom"]; ?>'
        </script>
        <?php
      }
    ?>
    <?php include 'bar_navigation/nonco.php'?>
    <!-- CONTENU DANS CETTE DIV -->
    <div class="content">
      <div class="wrapp">
        <div id="presentation">
          <div class="cover" style="background-repeat: no-repeat;background-size: cover;background-position: center center;background-image:url(<?php if($data["photo_couv"]!=null) { echo $data["photo_couv"]; } else { ?>src/media/default_profil_cover.jpg<?php } ?>);"></div>
          <div class="pp"><img class="profilpicture" src="<?php if($data["photo_profil"]!=null) { echo $data["photo_profil"]; } else { ?>src/media/default_profil_picture.jpg<?php } ?>" alt="Default profil picture"/></div>
          <h1 class="name"><?php echo $data["prenom"]." ".$data["nom"]; ?></h1>
        </div>
        <div id="infos">
          <p>Habite à <strong><?php echo $data["ville"]; ?></strong></p>
          <p>Agé de <strong><?php $today = new DateTime();$naissance = new DateTime($data["naissance"]);echo $today->diff($naissance)->format("%Y");?></strong> ans</p>
          <?php if(($today->format("%m%d"))==($naissance->format("%m%d"))) { ?><p>Bon anniversaire !</p><?php } ?>

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
                    echo "Raconte moi ta vie";
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
        } else {?> </div> <?php}
            if(isset($_POST["textarea_posts"])) {
              $message = htmlentities($_POST["textarea_posts"]);

              $today = new DateTime();
              $req = $bdd->prepare('INSERT INTO posts(id, nom_createur, date_publication, contenu, photo, profil, nb_com, nb_like, nb_share) VALUES(NULL, :noms, CURRENT_DATE(), :contenu, :photo, :profil,\'0\',\'0\',\'0\')');
              $req->execute(array(
                'noms' => $data["prenom"]." ".$data["nom"],
                'contenu' => $message,
                'photo' => "",
                'profil' => $_GET["id"]
              ));
              $url_refresh = "Location:profil.php?id=".$_GET["id"];
              header($url_refresh);
          ?>
        </div><?php } ?>
        <div class="feed_profil">
          <?php $reponse = $bdd->query('SELECT * FROM posts WHERE profil=\''.$_GET['id'].'\' ORDER BY id DESC');
          while($feed = $reponse->fetch()) {
            ?><div><hr>
              <h5><img class="pp_posts" src="<?php if($data["photo_profil"]!=null) { echo $data["photo_profil"]; } else { ?>src/media/default_profil_cover.jpg<?php } ?>" alt="Default profil cover"/><?php echo " ".$feed["nom_createur"]; ?></h5><p><i><?php $d_publi = new DateTime($feed["date_publication"]); echo "Le ".$d_publi->format("d/m/Y") ?></i></p><br><p><?php echo $feed["contenu"]; ?></p><br>
              <ul class="barre_posts">
                <li class="elements_barre_posts"><a href="" onclick="liker_post(<?php echo $feed["id"].",".$_SESSION["idcon"]; ?>)"><?php echo $feed["nb_like"];?> Likes </a></li>
                <li class="elements_barre_posts"><a href="posts.php?id=<?php echo $feed["id"]; ?>"><?php echo $feed["nb_com"];?> Commentaires </a></li>
                <li class="elements_barre_posts"><?php echo $feed["nb_share"];?> Shares </li>
              </ul>
            </div><?php
          } ?><hr>
        </div>
      </div>
    </div>
    <?php $reponse->closeCursor(); ?>
  </body>
</html>
