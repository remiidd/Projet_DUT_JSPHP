<?php
  session_start();

  $extensions_valides = array( 'jpg' , 'jpeg' , 'gif' , 'png' );
  $extension_upload = strtolower(  substr(  strrchr($_FILES['pp']['name'], '.')  ,1)  );

  if ( in_array($extension_upload,$extensions_valides) ){
    $nom = $_SESSION['nom'];
    $prenom = $_SESSION['prenom'];
    $email = $_SESSION['email'];
    $num = $_POST['tel'];
    $naissance = $_SESSION['naissance'];
    $ville = $_POST['ville'];
    $password = $_SESSION['password'];
    /*
    try{
      $bdd = new PDO('mysql:host=lulipa.server.r-heberg.fr;dbname=derayalois;port=3306;charset=utf8', 'derayalois', 'testdebrayalois');
    }
    catch (Exception $e){
          die('Erreur : ' . $e->getMessage());
    }

    $req = $bdd->prepare('INSERT INTO `profil`(`id`, `nom`, `prenom`, `email`, `password`, `numerotel`, `naissance`, `ville`, `photo_profil`, `photo_couv`)
      VALUES (:id, :nom, :prenom, :email, :password, :numerotel, :naissance, :ville, :photo_profil, :photo_couv)');
    $req->execute(array(
      'id' => NULL,
      'nom' => $nom,
      'prenom' => $prenom,
      'email' => $email,
      'password' => $password,
      'numerotel' => $num,
      'naissance' => $naissance,
      'ville' => $ville,
      'photo_profil' => "",
      'photo_couv' => ""
    ));*/

    try{
      $bdd1 = new PDO('mysql:host=lulipa.server.r-heberg.fr;dbname=derayalois;port=3306;charset=utf8', 'derayalois', 'testdebrayalois');
    }
    catch (Exception $e){
          die('Erreur : ' . $e->getMessage());
    }

    $reponse = $bdd1->query("SELECT * FROM profil WHERE `email`='$email'");
    $donnees = $reponse->fetch();

    $id = $donnees['id'];

    $target_dir = "../../src/media/profils/";
    $target_file =  $target_dir . $id . "-pp." . $extension_upload;
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    $resultat = move_uploaded_file($_FILES['pp']['tmp_name'], $target_file);
    if ($resultat) echo "Transfert réussi pp";
  } else {
    header('Location:../../inscription2.php');
    exit();
  }



?>
