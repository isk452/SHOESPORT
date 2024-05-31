<!DOCTYPE html>
<html lang="en">
        <meta charset="UTF-8">
<head>
    <?php require_once('header.php'); ?>
    <?php require_once('db.php'); ?>
    <link rel="stylesheet" href="css/produitdetails.css">
    <meta charset="UTF-8">
    <title>détails</title>
    <style>
        body {
    font-family: Arial, sans-serif;
    font-size: 14px;
    line-height: 1.6;
    color: #333;
    margin: 0;
    padding: 0;
}

h2 {
    font-size: 20px;
    font-weight: bold;
    margin-bottom: 20px;
}

.product-details {
    display: flex;
    justify-content: center;
    align-items: flex-start;
}

.product-et {
    margin-right: 20px;
}

.imageproduit {
    width: 200px;
    height: 200px;
    object-fit: cover;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.product-details p {
    font-size: 14px;
    margin-bottom: 10px;
}
a 
{
    text-decoration: none;
}
    </style>
</head>
<body>
<?php
    try {
        //CONNEXION
        $sql = "SELECT * FROM `produit` WHERE ID_PRODUIT = :ID_PRODUIT";
        $stmt = $pdo->prepare($sql);

        if (isset($_GET['id']) && is_numeric($_GET['id'])) {
            $id_produit = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT); // 
            $stmt->bindParam(':ID_PRODUIT', $id_produit, PDO::PARAM_INT); // Lier le paramètre en tant qu'entier
            $stmt->execute();
            $produit = $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            echo "ID du produit non défini ou invalide.";

            exit();
        }
    } catch (PDOException $e) {
        echo "Erreur de connexion à la base de données: " . $e->getMessage();
    }
?>
<main class="info">
    <h2><?php echo isset($produit['Nom']) ? htmlspecialchars($produit['Nom']) : ''; ?></h2>
    <section class="product-details">
        <div class="product-et">
            <?php
            if ($produit && is_array($produit)) {
                $image_produit = isset($produit['ID_PRODUIT']) ? filter_var($produit['ID_PRODUIT'], FILTER_SANITIZE_NUMBER_INT) : '';
                echo '<img class="imageproduit" src="imagesboutique/' . $image_produit . '.jpeg" alt="' . (isset($produit['Nom']) ? htmlspecialchars($produit['Nom']) : '') . '">';
                echo '<p>' . (isset($produit['Details']) ? ($produit['Details']) : '') . '</p>';
                echo '<p>' . (isset($produit['Prix']) ? htmlspecialchars($produit['Prix']) . '€' : '') . '</p>';
            }
            ?>


        <?php
      if (isset($_SESSION['utilisateur_id'])) {
        // L'utilisateur est connecté
        if (isset($_GET['id']) && is_numeric($_GET['id'])) {
            $id_produit_panier = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT); // 
            echo '<a href="ajoutpanier.php?id=' . $id_produit_panier . '" onclick="return confirm(\'Produit ajouté au panier\')">Ajouter au panier</a>';
        } else {
            echo 'Le produit n\'est pas défini ou l\'ID est invalide'; 
        }
    } else {
        // L'utilisateur n'est pas connecté
        // Rediriger l'utilisateur vers la page de connexion ou d'inscription
        echo '<a href="form_connexion_inscription.php">Connectez-vous pour ajouter au panier</a>';
    }
    
        ?>
                </div>
    </section>
</main>



    </section>
</main>
</body>
</html>
