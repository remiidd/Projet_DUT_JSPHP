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
		$user = str_to_noaccent(str_replace(' ','',$_GET['recherche']));

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
                $couple1 = str_to_noaccent(str_replace(' ', '', $donnees['nom'] . $donnees['prenom']));
                $couple2 = str_to_noaccent(str_replace(' ', '', $donnees['prenom'] . $donnees['nom']));
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
