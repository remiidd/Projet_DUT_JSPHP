<?php
  session_start();

  $_SESSION['errorext'] = false;
  $existpp = false;
  $existcover = false;
  $extensions_valides = array( 'jpg' , 'jpeg' , 'gif' , 'png' );

  if ($_FILES['pp']['name'] != "") {
    //si pp present
    $extension_uploadpp = strtolower(  substr(  strrchr($_FILES['pp']['name'], '.')  ,1)  );
    echo $_FILES['pp']['name'];
    if (!(in_array($extension_uploadpp,$extensions_valides))){
      $_SESSION['errorext'] = true;
      echo "pp";
      header('Location:/inscription-suite');
      exit();
    }
    else {
      $existpp = true;
    }
  }

  if ($_FILES['cover']['name'] != "") {
    //si cover present
    $extension_uploadcover = strtolower(  substr(  strrchr($_FILES['cover']['name'], '.')  ,1)  );
    if (!(in_array($extension_uploadcover,$extensions_valides))){
      $_SESSION['errorext'] = true;
      header('Location:/inscription-suite');
      exit();
    }
    else {
      $existcover = true;
    }
  }

  if($_SESSION['errorext'] == false){
    $nom = $_SESSION['nom'];
    $prenom = $_SESSION['prenom'];
    $email = $_SESSION['email'];
    $sexe = $_SESSION['sexe'];
    $num = $_POST['tel'];
    $naissance = $_SESSION['naissance'];
    $ville = $_POST['ville'];
    $password = $_SESSION['password'];

    try{
      $bdd = new PDO('mysql:host=lulipa.server.r-heberg.fr;dbname=derayalois;port=3306;charset=utf8', 'derayalois', 'testdebrayalois');
    }
    catch (Exception $e){
          die('Erreur : ' . $e->getMessage());
    }

    $req = $bdd->prepare('INSERT INTO `profil`(`id`, `nom`, `prenom`, `email`, `password`, `numerotel`, `naissance`, `ville`, `sexe`, `photo_profil`, `photo_couv`)
      VALUES (:id, :nom, :prenom, :email, :password, :numerotel, :naissance, :ville, :sexe, :photo_profil, :photo_couv)');
    $req->execute(array(
      'id' => NULL,
      'nom' => $nom,
      'prenom' => $prenom,
      'email' => $email,
      'password' => $password,
      'numerotel' => $num,
      'naissance' => $naissance,
      'ville' => $ville,
      'sexe' => $sexe,
      'photo_profil' => "",
      'photo_couv' => ""
    ));

    $reponse = $bdd->query("SELECT * FROM profil WHERE `email`='$email'");
    $donnees = $reponse->fetch();

    $id = $donnees['id'];

    if($existpp || $existcover){
      $target_dir = "../../src/media/profils/";

      if ($existpp) {
        $target_file =  $target_dir . $id . "-pp." . $extension_uploadpp;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        $resultat = move_uploaded_file($_FILES['pp']['tmp_name'], $target_file);
        if ($resultat){
          $targetForBddpp = "src/media/profils/" . $id . "-pp." . $extension_uploadpp;
          $bdd->exec("UPDATE `profil` SET `photo_profil` = '$targetForBddpp' WHERE `id` = $id");
        }

      }

      if ($existcover) {
        $target_file =  $target_dir . $id . "-cover." . $extension_uploadcover;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        $resultat = move_uploaded_file($_FILES['cover']['tmp_name'], $target_file);
        if ($resultat){
          $targetForBddcover = "src/media/profils/" . $id . "-cover." . $extension_uploadpp;
          $bdd->exec("UPDATE `profil` SET `photo_couv` = '$targetForBddcover' WHERE `id` = $id");
        }
      }
    }
    $_SESSION["idcon"] = $id;
    header("Location:/profil-" . $id);
    exit();
  }
?>
