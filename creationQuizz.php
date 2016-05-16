<?php
include_once('functionsDB/functionsDBUsers.php');
include_once('functionsDB/functionsDBQuizz.php');
include_once('redirection/creationQuizzRedirection.php');
  ?>

<!DOCTYPE html>
<html>
<head>
  <title>Création de quizz</title>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <link rel="stylesheet" href="bootstrap/css/bootstrap.css"/>
</head>
<body>
  <?php include('header.php'); ?>
  <h2>Vous pouvez ici créer un quizz</h2>

  <form method="post" action="profil.php">
    <div class="input-group">
      <span class="input-group-addon" id="basic-addon3">Nom</span>
      <input type="text" class="form-control" name="nomQuizz" placeholder="nom" id="nomQuizz" >
    </div>

    <div class="input-group">
      <span class="input-group-addon" id="basic-addon3">Description</span>
      <input type="textarea" class="form-control" name="description" placeholder="Description du quizz" id="description" >
    </div>

    <input type="submit" value="Valider" />

  </form>

<?php include('footer.php'); ?>
</body>
</html>
