<?php
  echo 'mail';

  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\Exception;


  /* Exception class. */
  require '../../PHPMailer-master/src/Exception.php';

  /* The main PHPMailer class. */
  require '../../PHPMailer-master/src/PHPMailer.php';

  /* SMTP class, needed if you want to use SMTP. */
  require '../../PHPMailer-master/src/SMTP.php';

  echo 'ici';

  $mail = new PHPMailer(TRUE);
  try{
    $mail->SMTPDebug = 2;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'bananabook.contact@gmail.com';                 // SMTP username
    $mail->Password = 'mailbanana';                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('bananabook.contact@gmail.com', 'BananaBook');
    $mail->addAddress('aloisguitton@orange.fr');     // Add a recipient

    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Vive les bananes';
    $mail->Body    = 'Bonjour rRémi, </br>
      Est-ce que tu aimes les bananes ? </br></br></br>
      <cite>Cet email a été envoyé automatiquement depuis <a href="nunes.aloisguitton.com">BananaBook</a>. Ne pas répondre </cite>';
    $mail->AltBody = 'Bonjour rRémi, Est-ce que tu aimes les bananes ?
      Cet email a été envoyé automatiquement depuis BananaBook. Ne pas répondre';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
}

  /*$email = $_POST['email'];

  try{
    $bdd = new PDO('mysql:host=lulipa.server.r-heberg.fr;dbname=derayalois;port=3306;charset=utf8', 'derayalois', 'testdebrayalois');
  }
  catch (Exception $e){
        die('Erreur : ' . $e->getMessage());
  }

  //variables
  $reponse = $bdd->query('SELECT * FROM profil');

  //test si id == OK
  while ($donnees = $reponse->fetch())
  {
    if($donnees['email'] == $email){
      $id = $donnees['id'];
      $code = $donnees['password'];
      echo $id . "   " . $email . "   " . $code:
    }
    else {
      echo "pas d'utilisateur trouvé";
    }
  }*/
?>
