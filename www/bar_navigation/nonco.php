<?php
  session_start();
  if (isset($_SESSION['idcon'])){
    ?>
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="navbar-brand">
          <a href="index.php" >BananaBook</a>
        </div>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>


        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <div class="navbar-nav mr-auto"></div>
          <div class="navbar-nav my-2 my-lg-0">
            <form method="post" action="../scripts/php/deconnexion.php">
              <input id="cobout" type="submit" value="Déconnexion"/>
            </form>
          </div>
        </div>
      </nav>
    <?php
  }
  else{
    ?>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="navbar-brand">
        <a href="index.php" >BananaBook</a>
      </div>

      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>


      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <div class="navbar-nav mr-auto"></div>
        <div class="navbar-nav my-2 my-lg-0">
          <form method="post" action="connexion.php">
            <input id="cobout" type="submit" value="Connexion"/>
          </form>
        </div>
      </div>
    </nav>
    <?php
  }
?>
