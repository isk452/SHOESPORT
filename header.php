<?php
session_start();

require_once 'db.php'; // fichier de connexion à la base de données
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    
<style>
    
    /* Style de base pour la barre de navigation */
.navbar {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
    height: 60px; /* Hauteur réduite pour le header */
}

/* Style des éléments de la barre de navigation */
.navbar li {
    float: left;
    height: 100%; /* Ajustement pour remplir la hauteur de la barre de navigation */
}

.navbar li a {
    display: block;
    color: black;
    text-align: center;
    padding: 10px; /* Réduction du padding pour réduire la hauteur des éléments */
    text-decoration: none;
    height: 100%; /* Ajustement pour remplir la hauteur de la barre de navigation */
    box-sizing: border-box; /* Inclure le padding dans la hauteur et largeur */
}

/* Changement de couleur au survol des liens */
.navbar li a:hover {
    text-decoration: underline;
}


/* Style pour l'icône du panier */
.imagepanier {
    float: right;
    margin-right: 20px;
    width: 20px; /* Réduction de la taille pour l'icône du panier */
    height: auto;
    cursor: pointer;
}

/* Style pour les boutons */
.btn-primary, .btn-secondary {
    display: inline-block;
    padding: 8px 16px; /* Réduction du padding pour les boutons */
    margin: 5px; /* Réduction de la marge pour les boutons */
    font-size: 14px; /* Réduction de la taille de police pour les boutons */
    text-align: center;
    text-decoration: none;
    outline: none;
    border: none;
    border-radius: 8px;
    cursor: pointer;
}

</style>
</head>
<meta charset="UTF-8">
<body>
    <div class="head">
        <nav>
            <ul class="navbar">
                <li><a href="acceuil.php">Accueil</a></li>
                <li><a href="boutique.php">Boutique</a></li>
                <li><a href="messages.php">Réclamations</a></li>
                <li><a href="messagerie.php">Messagerie</a></li>
                <img src="imagesheader/logo.jpg" class="logo" alt="">
                <img class='imagepanier' src="image/panier.png" alt="" onclick="window.location.href = 'panier.php';">

                <?php
// Vérification de l'état de connexion de l'utilisateur
if (isset($_SESSION['utilisateur_id'])) {
    $id_utilisateur = $_SESSION['utilisateur_id'];
    echo '<button class="btn-primary" onclick="location.href=\'page_personnelle.php?id=' . $id_utilisateur . '\'">Accéder à ma page personnelle</button>';
} else {
    echo '<button class="btn-secondary" onclick="location.href=\'form_connexion_inscription.php\'">S\'identifier</button>';
}
?>

            </ul>
        </nav>
    </div>
</body>
</html>
