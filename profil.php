<?php
include('functionsDB.php');
if (isset($_GET['where']) AND $_GET['where']=="creation"){ //On vient de la création de profil
  if( !isset($_POST['mail']) or $_POST['mail'] == "" or !isset($_POST['mdp1']) or $_POST['mdp1']== "" or !isset($_POST['mdp2']) or $_POST['mdp2']== ""){
          header('Location: CreationCompte.php?message_error=notFull');
    }else{
      if( $_POST['mdp2']!=$_POST['mdp1']){
        header('Location: CreationCompte.php?message_error=pbPass');
      }else{
        try{
          insertInUsers($_POST['mail'],$_POST['mdp1'],$_POST['nom'],$_POST['prenom']);
        }
        catch(Exception $e)
        {
          die('Erreur : '.$e->getMessage());
        }
    }
  }
}elseif (isset($_GET['where']) AND $_GET['where']=="connection"  AND isset($_POST['mail']) AND isset($_POST['mdp'])) {
  setcookie('mail', $_POST['mail'], time() + 365*24*3600, null, null, false, true);
  setcookie('mdp', crypte($_POST['mdp']), time() + 365*24*3600, null, null, false, true);
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
  <?php include('header.php'); ?>
  <h1>Bienvenue sur ce site</h1>
  <h2>Vous pouvez consulter votre profil sur cette page</h2>
  <?php
  if (isset($_GET['where']) AND $_GET['where']=="creation"){
    if(!isset($_POST['mail']) or !isset($_POST['mdp1']) or !isset($_POST['mdp2']) or !isset($_POST['nom']) or !isset($_POST['prenom'])){
      header("CreationCompte.php?message_error='notFull'");
    }
    echo "<div class='alert alert-success' role='alert'>
    <a href=''# class='alert-link'>merci d''avoir crée votre profil</a>
    </div> ";} ?>
<?php include('footer.php'); ?>
</body>
</html>
