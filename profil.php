<?php
include_once('functionsDB/functionsDBUsers.php');
include_once('functionsDB/functionsDBQuizz.php');
include_once('redirection/profilRedirection.php');
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
  <?php include_once('functionsError/profilError.php');?>
  <section>
    <aside>
      <form method="post" action="profil.php?where=profilChange">
        <input type="texte" name="nom" placeholder="Changer votre nom">
        <input type="texte" name="prenom" placeholder="Changer votre prenom">
        <input type="submit"class="btn btn-sm btn-warning" value="Changer vos informations">
      </form>
        <form method="post" action="profil.php?where=profil">
          <p>
            <label for="follow">Qui désirez-vous suivre ?</label><input type="submit" value="ajouter"/></br>
            <select name="follow" id="follow">
              <?php $users = AllUsersInfoWithoutFollow();
              foreach ($users as $user) {
                echo '<option value="'.$user['mail'].'">'.$user['nom'].' '.$user['prenom'].'('.$user['mail'].')'.'</option>';
              }
             ?>
           </select>
         </p>
      </form>
      <div class="panel panel-success">
        <div class="panel-heading">
          <h3 class="panel-title">Profil que vous suivez</h3>
        </div>
        <div class="panel-body">
          <?php $users = AllUsersInfoWithFollow();
          foreach ($users as $user) { // Affichage des amis
            echo '<strong>'.$user['nom'].' '.$user['prenom'].'('.$user['mail'].')'.'</strong>'.'</br>';
            $quizz = lastQuizz($user['mail']);
            if(isset($quizz['idQuizz'])){
              echo '<a href="http://projetwebmasson.herokuapp.com/repondreQuizz.php?idQuizz='.$quizz['idQuizz'].'">Dernier quizz</a></br>';
            }else{
              echo "pas de quizz pour l'instant</br>";
            }

          }
         ?>
        </div>
      </div>
  </aside>

  <?php
      $donnees = UsersInfo();
      echo '<p>';
      echo '<strong>mail:</strong> '.$donnees['mail'].'</br>';
      echo '<strong>Nom:</strong> '.$donnees['nom'].'</br>';
      echo '<strong>Prenom: </strong>'.$donnees['prenom'].'</br>';
      echo '<strong>Nombre de quizz supprimés:</strong> '.$donnees['nbQuizzDelete'].'</br>';
      $nbQuizz = nbQuizz();
      echo '<strong>Nombre de quizz:</strong> '.$nbQuizz['nbQuizz'].'</br>';
      echo '</p>';

      include_once('functionsDB/functionsDBQuizz.php');
      $quizz = QuizzInfo();
      foreach ($quizz as $quizzInfo){
        $nbAnswer = nbAnswerId($quizzInfo['idQuizz']);
        $reponse = nbQuestion($quizzInfo['idQuizz']);
        echo '<p>';
        echo '<strong>Nom:</strong> '.$quizzInfo['nom'].'</br>';
        echo '<strong>Description:</strong> '.$quizzInfo['description'].'</br>';
        echo '<strong>Date du quizz:</strong> '.date('d-m-Y', $quizzInfo['date']).'</br>';
        echo '<strong>Nombre de questions:</strong> '.$reponse['nb'].'</br>';
        echo '<strong>Nombre total de personne ayant répondu:</strong> '.$nbAnswer['nb'].'</br>';
        echo '<strong>Lien à donner pour répondre au quizz:</strong> <a href="http://projetwebmasson.herokuapp.com/repondreQuizz.php?idQuizz='.$quizzInfo['idQuizz'].'">http://projetwebmasson.herokuapp.com/repondreQuizz.php?idQuizz='.$quizzInfo['idQuizz'].'</a></br>';
        echo '<a class="btn btn-info" href="quizz.php?idQuizz='.$quizzInfo['idQuizz'].'" role="button">Voir le quizz</a>';
        echo '<a class="btn btn-info btn-sm" href="affichageReponse.php?idQuizz='.$quizzInfo['idQuizz'].'" role="button">Voir les réponses</a>';
        echo '</p>';
      }
      echo '<a class="btn btn-success" href="creationQuizz.php" role="button">Créer un nouveau quizz</a>';
      echo '</section>';
      include('footer.php');?>
</body>
</html>
