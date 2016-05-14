<html>
<head>
  <title>Connection</title>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <link rel="stylesheet" href="bootstrap/css/bootstrap.css"/>
</head>
<body>
  <?php
    include_once('header.php');
    include_once('functionsError/connectionError.php');
     ?>
  <h2>Vous pouvez connecter ici</h2>


    <form class="form-horizontal" method="post" action="profil.php?where=Connection">
      <div class="form-group">
        <div class="input-group">
          <span class="input-group-addon" id="basic-addon3">mail</span>
          <input type="text" class="form-control" name="mail" placeholder="e-mail" id="mailCreation" >
        </div>

        <div class="input-group">
          <span class="input-group-addon" id="basic-addon3">Mot de passe</span>
          <input type="password" class="form-control" name="mdp" placeholder="mot de passe" id="mailCreation" >
        </div>
      </div>
      <input type="submit" value="Valider" />
    </form>

    <a class="btn btn-info btn-sm" href="creationCompte.php" role="button">Créer un compte</a>
    <?php include('footer.php'); ?>
</body>
</html>
