<?php
  session_start();

  function str_to_noaccent($str)
  {
      $url = $str;
      $url = preg_replace('#Ç#', 'C', $url);
      $url = preg_replace('#ç#', 'c', $url);
      $url = preg_replace('#è|é|ê|ë#', 'e', $url);
      $url = preg_replace('#È|É|Ê|Ë#', 'E', $url);
      $url = preg_replace('#à|á|â|ã|ä|å#', 'a', $url);
      $url = preg_replace('#@|À|Á|Â|Ã|Ä|Å#', 'A', $url);
      $url = preg_replace('#ì|í|î|ï#', 'i', $url);
      $url = preg_replace('#Ì|Í|Î|Ï#', 'I', $url);
      $url = preg_replace('#ð|ò|ó|ô|õ|ö#', 'o', $url);
      $url = preg_replace('#Ò|Ó|Ô|Õ|Ö#', 'O', $url);
      $url = preg_replace('#ù|ú|û|ü#', 'u', $url);
      $url = preg_replace('#Ù|Ú|Û|Ü#', 'U', $url);
      $url = preg_replace('#ý|ÿ#', 'y', $url);
      $url = preg_replace('#Ý#', 'Y', $url);

      return ($url);
  }

  if(isset($_SESSION['idcon'])){
    $useracc = str_replace(' ','',$_GET['recherche']);
    $tofind = "é";
		$replac = "e";
		$user = str_to_noaccent("éééééééééé");

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
            <h1>Recherche <?php echo $useracc . "           " . $user ?></h1>
            <?php
              try{
                $bdd = new PDO('mysql:host=lulipa.server.r-heberg.fr;dbname=derayalois;port=3306;charset=utf8', 'derayalois', 'testdebrayalois');
              }
              catch (Exception $e){
                    die('Erreur : ' . $e->getMessage());
              }
              $reponse = $bdd->query('SELECT nom, prenom FROM profil');

              while ($donnees = $reponse->fetch())
              {
                $couple1 = strtolower(strtr(
                  str_replace(' ', '', $donnees['nom'] . $donnees['prenom']),
                  'ï',
                  'i'
                ));
                $couple2 = strtolower(strtr(
                  str_replace(' ', '', $donnees['prenom'] . $donnees['nom']),
                  '@ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ',
                  'aAAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy'
                ));
                echo $couple1 . " " . $couple2;

                if(preg_match("#$user#i", "$couple1") || preg_match("#$user#i", "$couple2")){
                  echo "trouvé";
                }
              }
            ?>
          </div>
        </body>
      </html>
    <?php
  }
  else {
    header("Location:index.php");
    exit();
  }
?>
