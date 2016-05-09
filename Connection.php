<html>
<head>
  <title>Connection</title>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <link rel="stylesheet" href="bootstrap/css/bootstrap.css"/>
</head>
<body>
  <?php
    include('header.php');
    if (isset($_GET['message_error']) AND $_GET['message_error']=="infosErronees") {
      echo "<div class='alert alert-danger' role='alert'>
      <a href=''# class='alert-link'>Désolé, ce compte et/ou ce mot de passe n'existent pas</a>
      </div> ";
    }elseif(isset($_GET['message_error']) AND $_GET['message_error']=="infoRequise") {
      echo "<div class='alert alert-danger' role='alert'>
      <a href=''# class='alert-link'>Merci de bien vouloir remplir tous les champs</a>
      </div> "; }
      elseif(isset($_GET['message_error']) AND $_GET['message_error']=="connectionRequise") {
        echo "<div class='alert alert-danger' role='alert'>
        <a href=''# class='alert-link'>Vous devez être connecter pour accéder à la page précédente</a>
        </div> "; }
     ?>
  <h2>Vous pouvez connecter ici</h2>

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
