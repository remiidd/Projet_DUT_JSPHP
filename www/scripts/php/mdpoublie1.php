<?php
  /*
*/

  $email = $_POST['email'];

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

  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\Exception;

  require '../../PHPMailer-master/src/Exception.php';

  require '../../PHPMailer-master/src/PHPMailer.php';

  require '../../PHPMailer-master/src/SMTP.php';

  $mail = new PHPMailer(TRUE);

  try{
    $mail->CharSet = 'UTF-8';
    $mail->SMTPDebug = 2;
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
      Pour reinitialiser votre mot de passe, veuillez cliquer sur le lien ci-dessous : </br>
      <a href=\"http://nunes.aloisguitton.com/scripts/php/mdpoublie.php?code=$code\">nunes.aloisguitton.comscripts/php/mdpoublie.php?code=$code</a></br></br></br>
      <cite>Cet email a ete envoye automatiquement depuis <a href=\"http://nunes.aloisguitton.com\">BananaBook</a>. Ne pas repondre </cite>";
    $mail->AltBody = 'Bonjour Rémi, Est-ce que tu aimes les bananes ?
      Cet email a ete envoye automatiquement depuis BananaBook. Ne pas repondre';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
}
?>
