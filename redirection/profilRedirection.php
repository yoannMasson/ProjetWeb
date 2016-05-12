<?php if (isset($_GET['where']) AND $_GET['where'] =="Creation"){ //On vient de la création de profil
  if( !isset($_POST['mail']) or $_POST['mail'] == "" or !isset($_POST['mdp1']) or $_POST['mdp1']== "" or !isset($_POST['mdp2']) or $_POST['mdp2']== ""){
      header('Location: CreationCompte.php?message_error=notFull');
      exit;
    }
    if( $_POST['mdp2'] != $_POST['mdp1']){
      header('Location: CreationCompte.php?message_error=pbPass');
      exit;
    }
    if(isInUsers($_POST['mail'])){
      header('Location: CreationCompte.php?message_error=wrongUsers');
      exit;
    }
    try{
      insertInUsers($_POST['mail'],$_POST['mdp1'],$_POST['nom'],$_POST['prenom']);
    }
    catch(Exception $e)
    {
      die('Erreur : '.$e->getMessage());
    }
    setcookie('mail', $_POST['mail'], time() + 365*24*3600, null, null, false, true);
    setcookie('mdp', crypte($_POST['mdp']), time() + 365*24*3600, null, null, false, true);
    header('Location: profil.php');
    exit;

  }elseif (isset($_GET['where']) AND $_GET['where']=="Connection"){//On vient de la page connection
    if(!isset($_POST['mail']) or !isset($_POST['mdp'])){
      header('Location: Connection.php?message_error=infoRequise');
      exit;
    }else{
    setcookie('mail', $_POST['mail'], time() + 365*24*3600);
    setcookie('mdp', crypte($_POST['mdp']), time() + 365*24*3600);
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

if(!isset($_COOKIE['mail']) or !isset($_COOKIE['mdp'])){ //Dans tous les cas, il faut être connecté pour accéder à son profil
  header('Location: Connection.php?message_error=connectionRequise');
}elseif (!canConnect()) {
  header('Location: Connection.php?message_error=infosErronees');
  exit;
}
?>
