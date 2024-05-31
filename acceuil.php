
<?php require_once ('db.php')?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Accueil</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            height: 100vh;
            background-color: #000;
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }
        header {
            z-index: 10; /* Assure que le header est au-dessus de la vidéo */
            width: 100%;
            padding: 5px;
            color: #fff; /* Couleur du texte */
        }
        .video-container {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 0; /* Assure que la vidéo est en arrière-plan */
        }
        .video-container video {
            position: absolute;
            top: 50%;
            left: 50%;
            width: 100%;
            height: 100%;
            object-fit: cover;
            transform: translate(-50%, -50%);
        }
        .text-overlay {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 20; /* Assure que le texte est au-dessus de la vidéo */
            color: #fff; /* Couleur du texte */
            text-align: center;
            padding: 20px;
            border-radius: 10px;
        }
    </style>
</head>
<body>
    <header>
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
    color: white;
    text-align: center;
    padding: 10px; /* Réduction du padding pour réduire la hauteur des éléments */
    text-decoration: none;
    height: 100%; /* Ajustement pour remplir la hauteur de la barre de navigation */
    box-sizing: border-box; 
}

/* Changement de couleur au survol des liens */
.navbar li a:hover {
    text-decoration: underline;
}


/* Style pour l'icône du panier */
.imagepanier {
    float: right;
    margin-right: 10px;
    width: 40px; /* Réduction de la taille pour l'icône du panier */
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

    </header>
    <div class="video-container">
        <video autoplay muted loop>
            <source src="videoacc.mp4" type="video/mp4">
            Votre navigateur ne supporte pas la lecture de vidéos.
        </video>
    </div>
    <div class="text-overlay">
        <h2>Bienvenue sur Shoesport</h2>
    </div>
</body>
</html>
