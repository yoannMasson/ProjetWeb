<!DOCTYPE html>
<html>
<head>
  <title>Création de compte</title>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <link rel="stylesheet" href="bootstrap/css/bootstrap.css"/>
</head>
<body>
  <h1>Bienvenue sur ce site</h1>
  <h2>Vous pouvez créer votre compte avec le formulaire ci-dessous</h2>
  <?php
  
  ?>
  <form method="post" action="CreationCompte.php">

    <div class="input-group">
      <span class="input-group-addon" id="basic-addon3">Mail</span>
      <input type="text" class="form-control" name="mail" placeholder="e-mail" id="mailCreation" >
    </div>

    <div class="input-group">
      <span class="input-group-addon" id="basic-addon3">Mot de passe</span>
      <input type="password" class="form-control" name="mdp1" placeholder="mot de passe" id="mailCreation" >
    </div>

    <div class="input-group">
      <span class="input-group-addon" id="basic-addon3">Confirmation mot de passe</span>
      <input type="password" class="form-control" name="mdp2" placeholder="confirmation" id="mailCreation" >
    </div>

    <div class="input-group">
      <span class="input-group-addon" id="basic-addon3">Nom</span>
      <input type="text" class="form-control" name="nom" placeholder="nom" id="mailCreation" >
    </div>

    <div class="input-group">
      <span class="input-group-addon" id="basic-addon3">Prénom</span>
      <input type="text" class="form-control" name="prenom" placeholder="prenom" id="mailCreation" >
    </div>

    <input type="submit" value="Valider" />

  </form>

<?php include('footer.php'); ?>
</body>
</html>
