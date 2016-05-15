<?php


  function insertInUsers($mail,$mdp,$nom,$prenom){//Ajoute un utilisateur
    include('secure/config.php');
    $mail = trim(htmlentities(htmlspecialchars($mail)));
    $mdp = crypte((trim(htmlentities(htmlspecialchars($mdp)))));
    $nom = trim(htmlentities(htmlspecialchars($nom)));
    $prenom = trim(htmlentities(htmlspecialchars($prenom)));
    try{
      $bdd = new PDO('mysql:host='.$hote.';dbname='.$dbName.';charset=utf8',$loginEcriture,$passEcriture);
    }
    catch(Exception $e){
      return $e;
    }
    $req = $bdd->prepare('INSERT INTO users(mail, mdp, nom, prenom,nbQuizzDelete) VALUES(:mail, :mdp, :nom, :prenom,0)');
    $req->execute(array(
       ':mail' => $mail,
       ':mdp' => $mdp,
       ':nom' => $nom,
       ':prenom' => $prenom,
     ));
  }


  function isInUsers($mail){//Vérifie si l'utilisateur est déjà dans la base
    include('secure/config.php');
    $mail = trim(htmlentities(htmlspecialchars($mail)));
    try{
      $bdd = new PDO('mysql:host='.$hote.';dbname='.$dbName.';charset=utf8',$loginLecture,$passLecture);
    }
    catch(Exception $e){
      return $e;
    }
    $req = $bdd->prepare('SELECT mail from users where mail = :mail');
    $req->execute(array(
       ':mail' => $mail,
     ));
     return $req->fetch();
   }

function canConnect(){//Vérifie si l'utilisateur peut se connecter avec les informations présentes dans le cookie
  if(!isset($_COOKIE['mail']) or !isset($_COOKIE['mdp'])){
    return false;
  }else{
    include('secure/config.php');
      try{
        $bd = new PDO('mysql:host='.$hote.';dbname='.$dbName.';charset=utf8',$loginLecture,$passLecture);
        $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      }
      catch(Exception $e){
        return $e;
      }
      $req = $bd->prepare("SELECT * FROM users u WHERE u.mail = :mail AND mdp = :mdp");
      $req->execute(array(':mail' => $_COOKIE['mail'], ':mdp' => $_COOKIE['mdp']));
      return $req->fetch();
  }
}


function crypte($mdp){//Crypte un mot de passe
  return (md5("!^#!=".$mdp));
}

  function UsersInfo(){//Renvoie les informations de l'utilisateur, nécéssite d'être connecté
  if (canConnect()){
    include('secure/config.php');
      try{
        $bd = new PDO('mysql:host='.$hote.';dbname='.$dbName.';charset=utf8',$loginLecture,$passLecture);
        $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      }
      catch(Exception $e){
        return $e;
      }
      $req = $bd->prepare("SELECT u.mail,u.nom,prenom,nbQuizzDelete FROM users u WHERE u.mail = :mail ");
      $req->execute(array(':mail' => $_COOKIE['mail']));
      return $req->fetch();
    }
  }

  function AllUsersInfoWithoutFollow(){//Renvoie les informations de tous les utilisateurs que l'on ne suit pas, nécéssite d'être connecté
  if (canConnect()){
    include('secure/config.php');
      try{
        $bd = new PDO('mysql:host='.$hote.';dbname='.$dbName.';charset=utf8',$loginLecture,$passLecture);
        $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      }
      catch(Exception $e){
        return $e;
      }
      $req = $bd->prepare("SELECT u.mail,u.nom,prenom FROM users u WHERE u.mail != :mail
                          and u.mail not in (SELECT u2.mail FROM users u2, follow f WHERE f.mail2 = u2.mail and f.mail1=:mail)");
      $req->execute(array(':mail' => $_COOKIE['mail']));
      return $req;
    }
  }

  function AllUsersInfoWithFollow(){//Renvoie les informations de tous les utilisateurs que l'on suit, nécéssite d'être connecté
  if (canConnect()){
    include('secure/config.php');
      try{
        $bd = new PDO('mysql:host='.$hote.';dbname='.$dbName.';charset=utf8',$loginLecture,$passLecture);
        $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      }
      catch(Exception $e){
        return $e;
      }
      $req = $bd->prepare("SELECT u.mail,u.nom,prenom FROM users u,follow f WHERE u.mail != :mail  and f.mail1 = :mail and f.mail2=u.mail");
      $req->execute(array(':mail' => $_COOKIE['mail']));
      return $req;
    }
  }

  function nbQuizz(){//Renvoie le nombre de quizz de l'utilisateur, nécéssite d'être connecté
    if (canConnect()){
      include('secure/config.php');
        try{
          $bd = new PDO('mysql:host='.$hote.';dbname='.$dbName.';charset=utf8',$loginLecture,$passLecture);
          $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(Exception $e){
          return $e;
        }
        $req = $bd->prepare("SELECT count(*) as nbQuizz FROM quizz q WHERE q.mail = :mail ");
        $req->execute(array(':mail' => $_COOKIE['mail']));
        return $req->fetch();
    }
  }

  function lastQuizz($idQuizz){//Renvoie le dernier quizz d'un utilisateur
    if (canConnect()){
      include('secure/config.php');
        try{
          $bd = new PDO('mysql:host='.$hote.';dbname='.$dbName.';charset=utf8',$loginLecture,$passLecture);
          $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(Exception $e){
          return $e;
        }
        $req = $bd->prepare("SELECT * FROM quizz q WHERE q.mail = :mail order by date desc limit 1");
        $req->execute(array(':mail' => $idQuizz));
        return $req->fetch();
    }
  }

  function insertInFollow($mail){//Ajoute un follow dans la base, nécéssite d'être connecté
    if(canConnect() and isInUsers($mail) and !alreadyFollow($mail)){
      include('secure/config.php');
        try{
          $bd = new PDO('mysql:host='.$hote.';dbname='.$dbName.';charset=utf8',$loginEcriture,$passEcriture);
          $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(Exception $e){
          return $e;
        }
        $req = $bd->prepare("Insert into follow(mail1,mail2) values (:mail1,:mail2)");
        $req->execute(array(':mail1' => $_COOKIE['mail'],
                            ':mail2'=> $mail));
    }
  }

  function alreadyFollow($mail){
    include('secure/config.php');
    $mail = trim(htmlentities(htmlspecialchars($mail)));
    try{
      $bdd = new PDO('mysql:host='.$hote.';dbname='.$dbName.';charset=utf8',$loginLecture,$passLecture);
    }
    catch(Exception $e){
      return $e;
    }
    $req = $bdd->prepare('SELECT * from follow where follow.mail1 = :mail1 and follow.mail2 = :mail2');
    $req->execute(array(
       ':mail1' => $_COOKIE['mail'],
       ':mail2' => $mail
     ));
     return $req->fetch();
  }

  function isValidEmail($email){ //Vérifie si une adresse e-mail est valide
      return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
  }

  function updateName($name){//Change le nom, ncéssite d'être connecté
    if(canConnect()){
      include('secure/config.php');
        try{
          $bd = new PDO('mysql:host='.$hote.';dbname='.$dbName.';charset=utf8',$loginEcriture,$passEcriture);
          $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(Exception $e){
          return $e;
        }
        $req = $bd->prepare("update users set nom = :nom where mail = :mail");
        $req->execute(array(':mail' => $_COOKIE['mail'],
                            ':nom'=> $name));
    }
  }

  function updateFirstName($firstName){//Change le prénom, nécéssite d'être connecté
    if(canConnect()){
      include('secure/config.php');
        try{
          $bd = new PDO('mysql:host='.$hote.';dbname='.$dbName.';charset=utf8',$loginEcriture,$passEcriture);
          $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(Exception $e){
          return $e;
        }
        $req = $bd->prepare("update users set prenom = :prenom where mail = :mail");
        $req->execute(array(':mail' => $_COOKIE['mail'],
                            ':prenom'=> $firstName));
    }
  }
 ?>
