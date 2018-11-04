<?php
  /*use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\Exception;

  require '../../PHPMailer-master/src/Exception.php';

  require '../../PHPMailer-master/src/PHPMailer.php';

  require '../../PHPMailer-master/src/SMTP.php';

  $mail = new PHPMailer(TRUE);
  try{
    $mail->SMTPDebug = 2;
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'bananabook.contact@gmail.com';
    $mail->Password = 'mailbanana';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    $mail->setFrom('bananabook.contact@gmail.com', 'BananaBook');
    $mail->addAddress('pro@debrayremi.fr');

    $mail->isHTML(true);
    $mail->Subject = 'Vive les bananes';
    $mail->Body    = 'Bonjour Rémi, </br>
      Est-ce que tu aimes les bananes ? </br></br></br>
      <cite>Cet email a ete envoye automatiquement depuis <a href="nunes.aloisguitton.com">BananaBook</a>. Ne pas repondre </cite>';
    $mail->AltBody = 'Bonjour Rémi, Est-ce que tu aimes les bananes ?
      Cet email a ete envoye automatiquement depuis BananaBook. Ne pas repondre';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
}
*/

  echo "avt boucle";
  $email = $_POST['email'];

  echo $email;

  try{
    $bdd = new PDO('mysql:host=lulipa.server.r-heberg.fr;dbname=derayalois;port=3306;charset=utf8', 'derayalois', 'testdebrayalois');
  }
  catch (Exception $e){
        die('Erreur : ' . $e->getMessage());
  }
  /*
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
