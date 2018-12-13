<?php
  echo "Voici une suggestion de profil à ajouter en amis pour profiter de l'experience bananabook";
  try {
    $bdd = new PDO('mysql:host=lulipa.server.r-heberg.fr;dbname=derayalois;charset=utf8', 'derayalois', 'testdebrayalois');
  } catch (\Exception $e) {
    die('Erreur :'.$e->getMessage());
  }
  $reponse = $bdd->query('SELECT profil,COUNT(*)
                          FROM posts
                          GROUP BY profil
                          ORDER BY COUNT(*) DESC
                          LIMIT 5');
?>
<div class="suggestion_prof">
  <ul class="liste_profils">
    <?php while($idprofil = $reponse->fetch()){
      $req = $bdd->query('SELECT * FROM profil where id=\''.$idprofil["profil"].'\'');
      $profil = $req->fetch();
      ?>
      <li><?php echo $profil["prenom"]." ".$profil["nom"]; ?></li>
    <?php } ?>
    <li>La Banane Officielle</li>
  </ul>
</div>
