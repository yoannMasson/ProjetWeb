<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container">
    <a href="profil.php" class="elementHeader">Profil</a>
    <a href="CreationCompte.php" class="elementHeader">Créer un compte</a>
    <?php
    include('functionsDB.php');
     if(isset($_COOKIE['mail']) and isset($_COOKIE['mdp']) and canConnect($_COOKIE['mail'],$_COOKIE['mdp'])){
      echo '<a href="Deconnection.php"class="elementHeader">Se deconnecter</a>';
    }else{
      echo '<a href="Connection.php"class="elementHeader">Connection</a>';
    } ?>
  </div>
</nav>
