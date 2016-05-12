<?php
  if (isset($_GET['where']) AND $_GET['where']=="creation"){
    echo "<div class='alert alert-success' role='alert'>
    merci d''avoir crée votre profil
    </div> ";
  }
  if (isset($_GET['message_error']) AND $_GET['message_error']=="suppressionImpossible"){
    echo "<div class='alert alert-danger' role='alert'>
    Vous ne pouvez supprimer ce quizz
    </div> ";
  }
  if (isset($_GET['message_error']) AND $_GET['message_error']=="droitRequis"){
    echo "<div class='alert alert-danger' role='alert'>
    Vous ne pouvez pas modifier ce quizz
    </div> ";
  }
  if (isset($_GET['message_error']) AND $_GET['message_error']=="canNotAnswer"){
    echo "<div class='alert alert-danger' role='alert'>
    Vous ne pouvez pas répondre à ce quizz
    </div> ";
  }
  ?>
