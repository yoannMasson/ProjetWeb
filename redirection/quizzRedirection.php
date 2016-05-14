<?php
if(!isset($_GET['idQuizz'])){
  header('Location: profil.php');
  exit;
}
if (!canConnect()){
  header('Location: Connexion.php?message_error=connectionRequise');
  exit;
}if (!belongsTo($_GET['idQuizz'])){
  header('Location: profil.php?message_error=droitRequis');
  exit;
}
if(isset($_POST['texte']) and $_POST['texte'] != ""){
  try{
    insertInQuestion($_POST['texte'],$_GET['idQuizz']);
  }
  catch(Exception $e)
  {
    die('Erreur : '.$e->getMessage());
  }
}

?>
