<?php
session_start(); // Démarrage de la session

$admin_username = "admin";
$admin_password = "ishak2301";

// Vérification des données soumises par le formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Vérification des informations d'identification de l'administrateur
    if ($username === $admin_username && $password === $admin_password) {
        // Définition de la variable de session pour indiquer que l'administrateur est connecté
        $_SESSION['admin_logged_in'] = true;
        
        // Redirection vers l'espace administrateur si les informations d'identification sont correctes
        header("Location: admin_space.php");
        exit();
    } else {
        // Redirection vers la page de connexion avec un message d'erreur si les informations d'identification sont incorrectes
        header("Location: admin.php?error=1");
        exit();
    }
}


