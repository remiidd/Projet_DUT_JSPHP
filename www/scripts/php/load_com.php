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

    while($com = $rep->fetch()){
      

      $mess .= "<div>
        <p>".$com["nom_createur"]." commentes : ".$com["text_com"]."</p>
        </div>";
    }
  }

  echo $mess;
 ?>
