<?php
  session_start();
  function str_to_noaccent($str)
  {
      $str = preg_replace('#Ç#', 'C', $str);
      $str = preg_replace('#ç#', 'c', $str);
      $str = preg_replace('#è|é|ê|ë#', 'e', $str);
      $str = preg_replace('#È|É|Ê|Ë#', 'E', $str);
      $str = preg_replace('#à|á|â|ã|ä|å#', 'a', $str);
      $str = preg_replace('#@|À|Á|Â|Ã|Ä|Å#', 'A', $str);
      $str = preg_replace('#ì|í|î|ï#', 'i', $str);
      $str = preg_replace('#Ì|Í|Î|Ï#', 'I', $str);
      $str = preg_replace('#ð|ò|ó|ô|õ|ö#', 'o', $str);
      $str = preg_replace('#Ò|Ó|Ô|Õ|Ö#', 'O', $str);
      $str = preg_replace('#ù|ú|û|ü#', 'u', $str);
      $str = preg_replace('#Ù|Ú|Û|Ü#', 'U', $str);
      $str = preg_replace('#ý|ÿ#', 'y', $str);
      $str = preg_replace('#Ý#', 'Y', $str);

      return ($str);
  }

  if(isset($_SESSION['idcon'])){
		$user = strtolower(str_to_noaccent(str_replace(' ','',$_GET['recherche'])));
    $trouve = false;
    ?>
      <!DOCTYPE html>
      <html lang="en" dir="ltr">
        <head>
          <meta charset="utf-8">
          <title>Recherche</title>
          <?php include 'scripts/html/head.html'; ?>
        </head>
        <body>
          <?php include 'bar_navigation/nonco.php'?>
          <div class="content">
            <h1>Recherche</h1>
            <?php
              try{
                $bdd = new PDO('mysql:host=lulipa.server.r-heberg.fr;dbname=derayalois;port=3306;charset=utf8', 'derayalois', 'testdebrayalois');
              }
              catch (Exception $e){
                    die('Erreur : ' . $e->getMessage());
              }
              $reponse = $bdd->query('SELECT nom, prenom, id, photo_profil FROM profil');

              while ($donnees = $reponse->fetch())
              {
                $couple1 = strtolower(str_to_noaccent(str_replace(' ', '', $donnees['nom'] . $donnees['prenom'])));
                $couple2 = strtolower(str_to_noaccent(str_replace(' ', '', $donnees['prenom'] . $donnees['nom'])));
                if(preg_match("#$user#i", "$couple1") || preg_match("#$user#i", "$couple2")){
                  $trouve = true;
                  ?>
                    <div class="rech_user">
                      <img src="<?php echo $donnees['photo_profil'] ?>" class="rech_img">
                      <div class="rech_info">
                        <a href="profil.php?id=<?php echo $donnees['id'] ?>"><?php  echo $donnees['nom'] . " " . $donnees['prenom']?></a>
                      </div>
                    </div>
                  <?php
                }
              }
              if($trouve == false){
                echo "Aucun utilisateur trouvé";
              }
            ?>
          </div>
        </body>
        <script type="text/javascript">
          console.log('ici');
          var img = document.getElementsByClassName("rech_img");
          var taille = document.body.clientWidth / 10;
          for (i = 0; i < img.length; i++) {
            img[i].style.width = taille + "px";
            img[i].style.height = taille + "px";
          }
        </script>
      </html>
    <?php
  }
  else {
    header("Location:index.php");
    exit();
  }
?>
