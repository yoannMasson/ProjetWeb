<?php
if(!canConnect()){
  header('Location: Connection.php?message_error=connectionRequise');
  exit;
}elseif (!isset($_GET['idQuizz']) or !isInQuizz($_GET['idQuizz'])) {
  header('Location: profil.php');
  exit;
}
if(belongsTo($_GET['idQuizz'])){
  header('Location: profil.php?message_error=canNotAnswer');
  exit;
} ?>
