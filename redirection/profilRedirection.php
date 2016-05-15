<?php
 if (isset($_GET['where']) AND $_GET['where']=="Connection"){//On vient de la page connection
    if(!isset($_POST['mail']) or !isset($_POST['mdp'])){
      header('Location: Connexion.php?message_error=infoRequise');
      exit;
    }else{
    setcookie('mail', $_POST['mail'], time() + 2*3600);
    setcookie('mdp', crypte($_POST['mdp']), time() + 2*3600);
    }
    header('Location: profil.php');
    exit;
  }elseif (isset($_POST['nomQuizz']) and isset($_POST['description'])) {//On vient de la création de Quizz
    if(!isInQuizzUsers($_POST['nomQuizz'])){
      insertInQuizz($_POST['nomQuizz'],$_POST['description']);
    }else{
      $quizzDejaCree = true;
    }
  }

if (isset($_GET['where']) AND $_GET['where'] =="profil"){ //On vient de rajouter un ami
  if (isset($_POST['follow']) and isInUsers($_POST['follow'])){
    insertInFollow($_POST['follow']);
  }
}

if (isset($_GET['where']) AND $_GET['where'] =="profilChange"){//On vient de changer ses informations
  if (isset($_POST['nom']) and $_POST['nom'] != "" ){
    updateName($_POST['nom']);
  }
  if(isset($_POST['prenom'])  and $_POST['prenom'] != "" ){
    updateFirstName($_POST['prenom']);
  }
}

if(!isset($_COOKIE['mail']) or !isset($_COOKIE['mdp'])){ //Dans tous les cas, il faut être connecté pour accéder à son profil
  header('Location: Connexion.php?message_error=connectionRequise');
}elseif (!canConnect()) {
  header('Location: Connexion.php?message_error=infosErronees');
  exit;
}


?>
