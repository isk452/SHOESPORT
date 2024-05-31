<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Espace Admin - Gestion des Tables</title>
    <style>
        body {
            max-width 800px;
        }
        table {
            width: 80%;
            border-collapse: collapse;
            margin: 20px auto;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .button-container {
            text-align: center;
            margin-top: 20px;
        }
        .button {
            padding: 10px 20px;
            margin: 0 10px;
            cursor: pointer;
        }
        .sql-form {
            margin-top: 20px;
            text-align: center;
        }
        .sql-input {
            width: 80%;
            padding: 8px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <h2>Liste des Tables de la Base de Données "shoesport"</h2>
    <?php
    session_start(); // Démarrage de la session

    // Vérification de l'état de connexion de l'administrateur
    if (!isset($_SESSION['admin_logged_in']) || !$_SESSION['admin_logged_in']) {
        // Redirection vers la page de connexion si l'administrateur n'est pas connecté
        header("Location: admin.php");
        exit();
    }
    // Fonction pour afficher les données d'une table
    function afficherTable($conn, $tableName) {
        $sql = "SELECT * FROM $tableName";
        $result = $conn->query($sql);
    
        if ($result->num_rows > 0) {
            // Affichage des noms des colonnes
            echo "<h3>Contenu de la table '$tableName'</h3>";
            echo "<table><tr>";
            $columns = array_keys($result->fetch_assoc());
            foreach ($columns as $column) {
                echo "<th>$column</th>";
            }
            echo "</tr>";
    
            // Affichage des données
            $result->data_seek(0); // Réinitialiser le pointeur de données
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                foreach ($row as $value) {
                    echo "<td>$value</td>";
                }
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<p>Aucune entrée trouvée dans la table '$tableName'.</p>";
        }
    }
    
    // Connexion à la base de données
    $servername = "localhost";
    $username = "ishakad";
    $password = "ishak2301";
    $dbname = "shoesport";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Vérification de la connexion
    if ($conn->connect_error) {
        die("Erreur de connexion à la base de données : " . $conn->connect_error);
    }

    // Récupération de la liste des tables
    $sql = "SHOW TABLES";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Affichage des noms des tables avec des boutons pour effectuer des opérations
        while ($row = $result->fetch_row()) {
            $tableName = $row[0];
            echo "<h3>$tableName</h3>";
            afficherTable($conn, $tableName);
        }
    } else {
        echo "Aucune table trouvée dans la base de données.";
    }

    // Fermeture de la connexion à la base de données
    $conn->close();
    ?>


    <form action="logout.php" method="post">
    <input type="submit" value="Déconnexion">
</form>
</body>
</html>

