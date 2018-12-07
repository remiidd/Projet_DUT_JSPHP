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
          <script src="scripts/js/invitation.js" charset="utf-8"></script>
          <?php include 'scripts/html/head.html'; ?>
        </head>
        <body onresize="resize_img()" onload="resize_img()">
          <?php include 'bar_navigation/nonco.php';?>
          <div class="content">
            <?php
              try{
                $bdd = new PDO('mysql:host=lulipa.server.r-heberg.fr;dbname=derayalois;port=3306;charset=utf8', 'derayalois', 'testdebrayalois');
              }
              catch (Exception $e){
                    die('Erreur : ' . $e->getMessage());
              }
              $reponse = $bdd->query("SELECT profil.id, profil.nom, profil.prenom FROM `profil` LEFT JOIN amis ON profil.id=amis.id_amis WHERE amis.id=$moi AND amis.statut=\"demande\"");

              while($donnees=$reponse->fetch()){
                echo $donnees['id'];
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
                    <form class="" action="scripts/php/accepter_amis.php?id=<?php echo $_SESSION['idcon'];?>&id_amis=<?php  echo $donnees['id'];?>" method="post">
                      <input type="submit" name="Accepter" value="Accepter la demande">
                    </form>
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
