<?php if(!(canConnect())){
header('Location: Connexion.php?message_error=connectionRequise');
exit;
}
?>
