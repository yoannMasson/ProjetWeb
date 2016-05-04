<html>
<head>
  <title>Connection</title>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <link rel="stylesheet" href="bootstrap/css/bootstrap.css"/>
</head>
<body>
  <?php include('header.php'); ?>
  <h2>Vous pouvez créer votre compte avec le formulaire ci-dessous</h2>

    <form method="post" action="profil.php?where=connection">

      <div class="input-group">
        <span class="input-group-addon" id="basic-addon3">Mail</span>
        <input type="text" class="form-control" name="mail" placeholder="e-mail" id="mailCreation" >
      </div>

      <div class="input-group">
        <span class="input-group-addon" id="basic-addon3">Mot de passe</span>
        <input type="password" class="form-control" name="mdp" placeholder="mot de passe" id="mailCreation" >
      </div>

      <input type="submit" value="Valider" />
    </form>

    <?php include('footer.php'); ?>
</body>
</html>
