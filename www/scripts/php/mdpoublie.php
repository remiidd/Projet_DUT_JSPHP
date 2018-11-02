<?php
  echo 'mail';
  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\Exception;

  /* Exception class. */
  require '../../PHPMailer/src/Exception.php';

  /* The main PHPMailer class. */
  require '../../PHPMailer/src/PHPMailer.php';

  /* SMTP class, needed if you want to use SMTP. */
  require '../../PHPMailer/src/SMTP.php';

  $email = new PHPMailer(TRUE);
  $email->isSMTP();
  $email->SMTPAuth = true;
  $email->SMTPSecure = 'ssl';
  $email->Host = 'smtp.gmail.com';
  $email->Port = '300';
  $email->isHTML();
  $email->Username = 'bananabook.contact@gmail.com';
  $email->Password = 'mailbanana';
  $email->SetFrom('no-reply@bananabook.com');
  $email->Subject = 'mail';
  $email->Body = 'test';
  $email->addAddress('aloisguitton@orange.fr');

  if(!($email->Send())) {
		echo 'Mail error: '.$email->ErrorInfo;
	} else {
		echo 'true';
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
