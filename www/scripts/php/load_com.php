<?php
  session_start();
  $mess = "";
  if(isset($_GET['id'])){//VERIF
    $moi = $_SESSION['idcon'];
    $post = $_GET['id'];
    try{
      $bdd = new PDO('mysql:host=lulipa.server.r-heberg.fr;dbname=derayalois;port=3306;charset=utf8', 'derayalois', 'testdebrayalois');
    }
    catch (Exception $e){
          die('Erreur : ' . $e->getMessage());
    }
    $reponse = $bdd->query('SELECT * FROM commentaire
                            WHERE id_post=\''.$post.'\'');

    while($com = $reponse->fetch()){
      $req = $bdd->query('SELECT * FROM profil WHERE id=\''.$com["id_profil"].'\'');
      $profil_du_com = $req->fetch();

      $mess .= "<div>
        <p>".$com["nom_createur"]." commente : ".$com["text_com"]."</p>
        </div>";
    }
  }

  echo $mess;
 ?>
