<?php
  if(isset($_GET['code'])){

    $id = ""

    try{
      $bdd = new PDO('mysql:host=lulipa.server.r-heberg.fr;dbname=derayalois;port=3306;charset=utf8', 'derayalois', 'testdebrayalois');
    }
    catch (Exception $e){
          die('Erreur : ' . $e->getMessage());
    }

    $reponse = $bdd->query('SELECT * FROM mdpoublie');

    while ($donnees = $reponse->fetch())
    {
      if ($donnees['chaine_id'] == $_GET['code']) {
        $id = $donnees['id'];
      }
    }

    echo "id : " . $id;

    if ($id != "") {
      // chaine connu
      include("../html/resetmdp.php");
    }
    else {
      //chaine non-reconnue
      header("Location: ../../index.php");
      exit();
    }

  }
  else {
    header("Location: ../../index.php");
    exit();
  }

?>
