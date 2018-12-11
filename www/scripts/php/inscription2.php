<?php
  session_start();

  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\Exception;

  require '../../PHPMailer-master/src/Exception.php';

  require '../../PHPMailer-master/src/PHPMailer.php';

  require '../../PHPMailer-master/src/SMTP.php';

  $_SESSION['errorext'] = false;
  $existpp = false;
  $existcover = false;
  $extensions_valides = array( 'jpg' , 'jpeg' , 'gif' , 'png' );

  if ($_FILES['pp']['name'] != "") {
    //si pp present
    $extension_uploadpp = strtolower(substr(strrchr($_FILES['pp']['name'], '.')  ,1)  );
    echo $_FILES['pp']['name'];
    if (!(in_array($extension_uploadpp,$extensions_valides))){
      $_SESSION['errorext'] = true;
      header('Location:/inscription-suite');
      exit();
    }
    else {
      $existpp = true;
    }
  }

  if ($_FILES['cover']['name'] != "") {
    //si cover present
    $extension_uploadcover = strtolower(substr(strrchr($_FILES['cover']['name'], '.')  ,1)  );
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

    //envoie de mail ici
    $code = generateRandomString();

    $mail = new PHPMailer(TRUE);


    $mail->CharSet = 'UTF-8';
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'bananabook.contact@gmail.com';
    $mail->Password = 'mailbanana';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    $mail->setFrom('bananabook.contact@gmail.com', 'BananaBook');
    $mail->addAddress($email);

    $mail->isHTML(true);
    $mail->Subject = 'Validation de votre compte';
    $mail->Body    = "Bonjour $prenom, </br>
      Est-ce que tu aimes les bananes ? </br>
      Pour valider ton compter il suffit de bananer ce lien : </br>
      <a href=\"http://nunes.aloisguitton.com/valider_mon_compte-$code\">nunes.aloisguitton.com/valider_mon_compte-$code</a></br></br></br>
      <cite>Cet email a été envoyé automatiquement depuis <a href=\"http://nunes.aloisguitton.com\">BananaBook</a>. Ne pas répondre.</cite>";
    $mail->AltBody = "Bonjour $prenom,
      Est-ce que tu aimes les bananes ?
      Pour reinitialiser votre mot de passe, veuillez cliquer sur le lien ci-apres :
      nunes.aloisguitton.com/valider_mon_compte-$code<
      Cet email a ete envoye automatiquement depuis BananaBook. Ne pas repondre";

    if($mail->send()){
      echo 'Message has been sent';
    }
    else {
      echo 'Message could not be sent.';
      echo 'Mailer Error: ' . $mail->ErrorInfo;
    }

    //ajout de l'utilisateur en base de profil

    $req = $bdd->prepare('INSERT INTO `profil`(`id`, `verif_email`, `nom`, `prenom`, `email`, `password`, `numerotel`, `naissance`, `ville`, `sexe`, `photo_profil`, `photo_couv`)
      VALUES (:id, :verif_email, :nom, :prenom, :email, :password, :numerotel, :naissance, :ville, :sexe, :photo_profil, :photo_couv)');
    $req->execute(array(
      'id' => NULL,
      'verif_email' => $code,
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

    //ajout des images sur le serveur

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
          $targetForBddcover = "src/media/profils/" . $id . "-cover." . $extension_uploadcover;
          $bdd->exec("UPDATE `profil` SET `photo_couv` = '$targetForBddcover' WHERE `id` = $id");
        }
      }
    }
    $_SESSION["idcon"] = $id;
    header("Location:/profil-" . $id);
    exit();
  }

  function generateRandomString() {
    $caract = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $caract_long = strlen($caract);
    $randomString = '';
    for ($i = 0; $i < 20; $i++) {
        $randomString .= $caract[rand(0, $caract_long - 1)];
    }
    return md5($randomString);
  }
?>
