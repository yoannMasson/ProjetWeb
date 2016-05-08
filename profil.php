<?php
include('header.php');
if (isset($_GET['where']) AND $_GET['where']=="creation"){ //On vient de la création de profil
  if( !isset($_POST['mail']) or $_POST['mail'] == "" or !isset($_POST['mdp1']) or $_POST['mdp1']== "" or !isset($_POST['mdp2']) or $_POST['mdp2']== ""){
        header('Location: CreationCompte.php?message_error=notFull');
    }
    if( $_POST['mdp2']!=$_POST['mdp1']){
      header('Location: CreationCompte.php?message_error=pbPass');
    }
    if(isInUsers($_POST['mail'])){
      header('Location: CreationCompte.php?message_error=wrongUsers');
    }
    try{
      insertInUsers($_POST['mail'],$_POST['mdp1'],$_POST['nom'],$_POST['prenom']);
    }
    catch(Exception $e)
    {
      die('Erreur : '.$e->getMessage());
    }
  }elseif (isset($_GET['where']) AND $_GET['where']=="connection"){//On vient de la page connection
    if(!isset($_POST['mail']) or !isset($_POST['mdp'])){
      header('Location: Connection.php?message_error=infoRequise');
    }else{
    setcookie('mail', $_POST['mail'], time() + 365*24*3600, null, null, false, true);
    setcookie('mdp', crypte($_POST['mdp']), time() + 365*24*3600, null, null, false, true);
  }
}
if(!isset($_COOKIE['mail']) or !isset($_COOKIE['mail']) or !canConnect($_COOKIE['mail'],$_COOKIE['mdp'])){
    header('Location: Connection.php?message_error=connectionRequise');
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Profil</title>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <link rel="stylesheet" href="bootstrap/css/bootstrap.css"/>
</head>
<body>
  <h1>Bienvenue sur ce site</h1>
  <h2>Vous pouvez consulter votre profil sur cette page</h2>
  <?php
  if (isset($_GET['where']) AND $_GET['where']=="creation"){
    if(!isset($_POST['mail']) or !isset($_POST['mdp1']) or !isset($_POST['mdp2']) or !isset($_POST['nom']) or !isset($_POST['prenom'])){
      header("CreationCompte.php?message_error='notFull'");
    }
    echo "<div class='alert alert-success' role='alert'>
    <a href=''# class='alert-link'>merci d''avoir crée votre profil</a>
    </div> ";}
    try{ //Afichage des informations du profil
      $bd = new PDO('mysql:host=mysql-projetwebmasson.alwaysdata.net;dbname=projetwebmasson_projetweb;charset=utf8', '122471_ecriture', 'polyweb');
      $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(Exception $e){
      echo $e;
    }
    $req = $bd->prepare("SELECT u.nom,prenom,nbQuizzDelete FROM users u WHERE u.mail = :mail ");
    $req->execute(array(':mail' => $_COOKIE['mail']));
    echo 'Adresse e-mail: '.htmlentities(htmlspecialchars(trim($_COOKIE['mail'])));
    echo '<p>';
    while ($donnees = $req->fetch())
    {
      echo 'Nom: '.$donnees['nom'].'</br>';
      echo 'Prenom: '.$donnees['prenom'].'</br>';
      echo 'Nombre de quizz supprimés: '.$donnees['nbQuizzDelete'].'</br>';
    }
    $req = $bd->prepare("SELECT count(*) as nbQuizz FROM quizz q WHERE q.mail = :mail ");
    $req->execute(array(':mail' => $_COOKIE['mail']));
    while ($donnees = $req->fetch())
    {
      echo 'Nombre de quizz: '.$donnees['nbQuizz'].'</br>';
    }

    echo '</p>';
    $req->closeCursor();
 include('footer.php'); ?>
</body>
</html>
