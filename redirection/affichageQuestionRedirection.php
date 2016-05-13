<?php
if(canConnect()){
  if(!isset($_GET['idQuizz']) or !isInQuizz($_GET['idQuizz'])){//Il faut que idQuizz soit set, gare aux petits malins...
      header('Location: affichageQuizz.php');
      exit;
  }
}else{
  header('Location: Connection.php?message_error=connectionRequise');
}


?>
