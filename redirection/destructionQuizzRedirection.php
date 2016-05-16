<?php
if (!canConnect()) {
  header('Location: Connexion.php?message_error=connectionRequise');
  exit;
}
if(!isset($_GET['idQuizz']) or !belongsTo($_GET['idQuizz'])){
  header('Location: profil.php?message_error=suppressionImpossible');
  exit;
}
?>
