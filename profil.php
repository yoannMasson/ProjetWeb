<?php
if (isset($_GET['where']) AND $_GET['where']=="creation"){ //On vient de la création de profil
  if( !isset($_POST['mail']) or $_POST['mail'] == "" or !isset($_POST['mdp1']) or $_POST['mdp1']== "" or !isset($_POST['mdp2']) or $_POST['mdp2']== ""){
          header('Location: CreationCompte.php?message_error=notFull');
    }else{
      if( $_POST['mdp2']!=$_POST['mdp1']){
        header('Location: CreationCompte.php?message_error=pbPass');
      }else{
        try{
          $mail = trim(htmlentities(htmlspecialchars($_POST['mail'])));
          $mdp = password_hash(trim(htmlentities(htmlspecialchars($_POST['mdp1']))),PASSWORD_DEFAULT);
          $nom = trim(htmlentities(htmlspecialchars($_POST['nom'])));
          $prenom = trim(htmlentities(htmlspecialchars($_POST['prenom'])));
          $bdd = new PDO('mysql:host=localhost;dbname=projetweb;charset=utf8', 'root', 'polyweb');
        }
        catch(Exception $e)
        {
          die('Erreur : '.$e->getMessage());
        }
        $req = $bdd->prepare('INSERT INTO users(mail, mdp, nom, prenom,nbQuizzDelete) VALUES(:mail, :mdp, :nom, :prenom,0)');
        $req->execute(array(
  	       'mail' => $mail,
  	       'mdp' => $mdp,
  	       'nom' => $nom,
  	       'prenom' => $prenom,
  	));
    }
  }
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
    </div> ";} ?>

</body>
</html>
