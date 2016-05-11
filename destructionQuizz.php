<?php
include_once('functionsDB/functionsDBUsers.php');
include_once('functionsDB/functionsDBQuizz.php');

if (!canConnect()) {
  header('Location: Connection.php?message_error=connectionRequise');
  exit;
}
if(!isset($_GET['idQuizz']) or !belongsTo($_GET['idQuizz'])){
  header('Location: profil.php?message_error=suppressionImpossible');
  exit;
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>destructionQuizz</title>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <link rel="stylesheet" href="bootstrap/css/bootstrap.css"/>
</head>
<body>
  <?php include('header.php');
  echo "<h2>Suppresion du quizz</h2>";
  deleteQuizz($_GET['idQuizz']);
  include('footer.php');?>
  <p>Le quizz est supprimé</p>
  <a class="btn btn-info" href="profil.php" role="button">Retourner au profil</a>
</body>
</html>
