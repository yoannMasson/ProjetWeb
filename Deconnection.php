<html>
<head>
  <title>Deconnection</title>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <link rel="stylesheet" href="bootstrap/css/bootstrap.css"/>
</head>
<body>
  <?php
  setcookie('mail', NULL, -1);
  setcookie('mdp', NULL, -1);
  include('header.php');
  include('footer.php'); ?>
  <h2>Vous êtes deconnecté</h2>
</body>
</html>
