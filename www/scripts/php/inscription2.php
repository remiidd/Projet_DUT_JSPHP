<?php
  session_start();

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

  //echo $email;

  //variables
  $reponse = $bdd1->query("SELECT * FROM profil WHERE `email`='$email'");
  $donnees = $reponse->fetch();

  echo $donnees['id'];

  $target_dir = "../../src/media/";
  $target_file =  $target_dir . basename($_FILES["pp"]["name"]);
  $uploadOk = 1;
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
  // Check if image file is a actual image or fake image
  $resultat = move_uploaded_file($_FILES['pp']['tmp_name'], $target_file);
  if ($resultat) echo "Transfert réussi";

?>
