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

  $email = new PHPMailer(TRUE);
  try{
    $email->SMTPDebug = 2;
    $email->isSMTP();
    $email->SMTPAuth = true;
    $email->SMTPSecure = 'tls';
    $email->Host = 'smtp.gmail.com';
    $email->Port = '587';
    $email->isHTML();
    $email->Username = 'bananabook.contact@gmail.com';
    $email->Password = 'mailbanana';
    $email->SetFrom('no-reply@bananabook.com');
    $email->Subject = 'mail';
    $email->Body = 'test';
    $email->addAddress('aloisguitton@orange.fr');

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
