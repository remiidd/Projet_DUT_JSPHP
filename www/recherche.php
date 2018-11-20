<?php
  session_start();
  if(isset($_SESSION['idcon'])){
    $user = strtolower(strtr(
    str_replace(' ','',$_GET['recherche']),
    '@ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ',
    'aAAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy'));

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
            <h1>Recherche <?php echo $user ?></h1>
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
                  '@ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ',
                  'aAAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy'
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
