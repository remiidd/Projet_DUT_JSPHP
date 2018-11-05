<?php

  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\Exception;

  require '../../PHPMailer-master/src/Exception.php';

  require '../../PHPMailer-master/src/PHPMailer.php';

  require '../../PHPMailer-master/src/SMTP.php';

  if (isset($_POST['email'])) {
    $email = $_POST['email'];
    $mailok = "";

    try{
      $bdd = new PDO('mysql:host=lulipa.server.r-heberg.fr;dbname=derayalois;port=3306;charset=utf8', 'derayalois', 'testdebrayalois');
    }
    catch (Exception $e){
          die('Erreur : ' . $e->getMessage());
    }

    //variables
    $reponse = $bdd->query('SELECT * FROM profil');

    //test si mail == OK
    while ($donnees = $reponse->fetch())
    {
      if ($donnees['email'] == $email) {
        $mailok = $donnees['email'];
        $code = $donnees['password'];
        $prenom = $donnees['prenom'];
        echo $donnees['id'] . " " . $mailok . " " . $code;
      }
    }

    if ($mailok != "") {

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
      $mail->addAddress($mailok);

      $mail->isHTML(true);
      $mail->Subject = 'Reinitialisation de votre mot de passe';
      $mail->Body    = "Bonjour $prenom, </br>
        Est-ce que tu aimes les bananes ? </br>
        Pour réinitialiser votre mot de passe, veuillez cliquer sur le lien ci-dessous : </br>
        <a href=\"http://nunes.aloisguitton.com/scripts/php/mdpoublie.php?code=$code\">nunes.aloisguitton.comscripts/php/mdpoublie.php?code=$code</a></br></br></br>
        <cite>Cet email a été envoyé automatiquement depuis <a href=\"http://nunes.aloisguitton.com\">BananaBook</a>. Ne pas répondre.</cite>";
      $mail->AltBody = "Bonjour $prenom,
        Est-ce que tu aimes les bananes ?
        Pour reinitialiser votre mot de passe, veuillez cliquer sur le lien ci-apres :
        nunes.aloisguitton.comscripts/php/mdpoublie.php?code=$code<
        Cet email a ete envoye automatiquement depuis BananaBook. Ne pas repondre";

      if($mail->send()){
        echo 'Message has been sent';
      }
      else {
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
      }

      header("Location:../../index.php");
      exit();

    }
    else {
      echo "Aucun utilisateur trouvé";
    }

  } else {
    header("Location:../../mdpoublie.php");
    exit();
  }





?>
