<?php
// Paramètres de connexion à la base de données
$host = "localhost";
$dbname = "shoesport";
$username = "root";
$password = "";

try {
    // Connexion à la base de données en utilisant PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "";
} catch(PDOException $e) {
    echo "Erreur de connexion à la base de données: " . $e->getMessage();
}
?>


