<?php
// Démarrer la session si ce n'est pas déjà fait
session_start();

// Détruire toutes les variables de session
$_SESSION = array();

// Détruire la session
session_destroy();

// Rediriger vers la page de connexion après la déconnexion
header("Location: admin.php");
exit();
?>
