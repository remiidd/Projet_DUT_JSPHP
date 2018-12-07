<?php
  session_start();

  if(isset($_SESSION['idcon'])){
    $moi=$_SESSION['idcon'];
    ?>
      <!DOCTYPE html>
      <html lang="en" dir="ltr">
        <head>
          <meta charset="utf-8">
          <title>Invitation</title>
          <?php include 'scripts/html/head.html'; ?>
        </head>
        <body>
          <?php include 'bar_navigation/nonco.php'?>
          <div class="content">
            <?php
              try{
                $bdd = new PDO('mysql:host=lulipa.server.r-heberg.fr;dbname=derayalois;port=3306;charset=utf8', 'derayalois', 'testdebrayalois');
              }
              catch (Exception $e){
                    die('Erreur : ' . $e->getMessage());
              }
              $reponse = $bdd->query("SELECT * FROM `profil` LEFT JOIN amis ON profil.id=amis.id_amis WHERE amis.id=19 AND amis.statut=\"demande\"");

              while($donnees=$reponse->fetch()){
                ?>
                <div class="rech_user">
                  <div class="rech_div_img">
                    <img src="<?php
                      if ($donnees['photo_profil']!=NULL) {
                        echo $donnees['photo_profil'] ;
                      }
                      /*else {
                        echo "src/media/default_profil_picture.jpg";
                      }*/
                    ?>" class="rech_img">
                  </div>
                  <div class="rech_info">
                    <a class="rech_nom" href="profil.php?id=<?php echo $donnees['id'] ?>"><?php  echo $donnees['nom'] . " " . $donnees['prenom']?></a>
                    <?php
                      if($stamis == true){
                        ?>
                        <form class="" action="scripts/php/valider_amis.php?id=<?php echo $_SESSION['idcon'];?>&id_amis=<?php  echo $donnees['id'];?>" method="post">
                          <input type="submit" name="Ajouter" value="Confirmer la demande">
                        </form>
                        <?php
                      }
                    ?>


                  </div>

                </div>
                <?php
              }
            ?>
        </body>
      </html>
    <?php
  }
  else {
    header("Location: accueil");
    exit();
  }
?>
