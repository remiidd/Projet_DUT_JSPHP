<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <title>Post de </title>
  </head>
  <body>
    <?php
    try {
      $bdd = new PDO('mysql:host=lulipa.server.r-heberg.fr;dbname=derayalois;charset=utf8', 'derayalois', 'testdebrayalois');
    } catch (\Exception $e) {
      die('Erreur :'.$e->getMessage());
    }
      $reponse = $bdd->query('SELECT * FROM posts WHERE id=\''.$_GET['id'].'\'');
      $data = $reponse->fetch();
      if($data["contenu"]==null) {
        header('Location:index.php');
      } else {
        ?>
        <script>
          window.parent.document.title = 'Post de <?php echo $data["nom_createur"]; ?>'
        </script>
        <?php
      }
    ?>
    <?php include 'bar_navigation/nonco.php' ?>
    <div class="content">
      <h5>Nom</h5>
      <i>Date de publication</i>
      <p>Contenu</p>
      <hr>
      <p>Commentaires</p>
    </div>



  </body>
</html>
