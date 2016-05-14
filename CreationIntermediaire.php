<?php
include_once('functionsDB/functionsDBUsers.php');
if (isset($_GET['where']) AND $_GET['where'] =="Creation"){ //On vient de la création de profil
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
      if(isValidEmail($_POST['mail'])){
        insertInUsers($_POST['mail'],$_POST['mdp1'],$_POST['nom'],$_POST['prenom']);
      }else{
        header('Location: CreationCompte.php?message_error=wrongEmail');
        exit;
      }

    }
    catch(Exception $e)
    {
      die('Erreur : '.$e->getMessage());
    }
    setcookie('mail', $_POST['mail'], time() + 2*3600, null, null, false, true);
    setcookie('mdp', crypte($_POST['mdp1']), time() + 2*3600, null, null, false, true);
    header('Location: profil.php?where=creation');
    exit;

  }?>
