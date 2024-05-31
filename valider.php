<?php
require_once('db.php'); // Inclut le fichier de connexion à la base de données
require_once('header.php'); // Inclut le fichier d'en-tête

// Vérifie si la taille a été sélectionnée dans le formulaire
if (isset($_POST['taille'])) {
    // Récupère la taille sélectionnée depuis le formulaire
    $pointure_selectionnee = $_POST['taille'];

    try {
        require_once('db.php'); // Inclut le fichier de connexion à la base de données

        // Commence une transaction pour garantir l'intégrité des données
        $pdo->beginTransaction();

        // Prépare la requête d'insertion en spécifiant les colonnes 'id_produit' et 'taille'
        $requete = $pdo->prepare("INSERT INTO pointures (id_produit, taille) VALUES (:id_produit, :taille)");

        // Récupère les ID des produits depuis la variable de session
        $product_ids = $_SESSION['product_ids'];

            // Parcourt les ID des produits et insère les ID des produits avec les tailles sélectionnées dans la table pointures
// Parcourt les ID des produits et insère les ID des produits avec les tailles sélectionnées dans la table pointures
foreach ($product_ids as $id_produit) {
    // Décrémente la quantité disponible pour le produit spécifique avec la taille sélectionnée
    $sql = "UPDATE pointures SET disponible = disponible - 1 WHERE id_produit = :id_produit AND taille = :taille";
    $stmtSoustraction = $pdo->prepare($sql);
    $stmtSoustraction->bindParam(':id_produit', $id_produit, PDO::PARAM_INT);
    $stmtSoustraction->bindParam(':taille', $pointure_selectionnee, PDO::PARAM_STR);
    $stmtSoustraction->execute();
}


        // Valide la transaction
        $pdo->commit();

        echo "C'est tout bon.";
    } catch (PDOException $e) {
        // En cas d'erreur, annule la transaction
        $pdo->rollBack();
        echo "Erreur lors de l'insertion des pointures dans la base de données : " . $e->getMessage();
    }
} else {
    echo "Veuillez sélectionner une taille.";
}



if (isset($_SESSION['utilisateur_id'])) {
    $utilisateur_id = $_SESSION['utilisateur_id'];

    try {
        $sqlSelectPanier = "SELECT produit.ID_PRODUIT, produit.Nom, produit.Prix, produit.Couleur, produit.Details, panier.quantite
                            FROM panier
                            JOIN produit ON panier.produit_id = produit.ID_PRODUIT
                            WHERE panier.utilisateur_id = :utilisateur_id";

        $stmtSelectPanier = $pdo->prepare($sqlSelectPanier);
        $stmtSelectPanier->bindParam(':utilisateur_id', $utilisateur_id, PDO::PARAM_INT);
        $stmtSelectPanier->execute();
        $products = $stmtSelectPanier->fetchAll(PDO::FETCH_ASSOC);

        if ($products) {
            // Affichage des images des produits dans le panier
            foreach ($products as $product) {
                $str = "<img src='imagesboutique/" . $product["ID_PRODUIT"] . ".jpeg' width='90' />";
                echo $str;
                
                echo "<img/>"; 
            }

            try {
                $sqlViderPanier = "DELETE FROM panier WHERE utilisateur_id = :utilisateur_id";
                $stmtViderPanier = $pdo->prepare($sqlViderPanier);
                $stmtViderPanier->bindParam(':utilisateur_id', $utilisateur_id, PDO::PARAM_INT);
                $stmtViderPanier->execute();
            
                echo 'La commande a été passée avec succès.';
            } catch (PDOException $e) {
                echo "Erreur lors de la suppression du panier : " . $e->getMessage();
            }
        } else {
            echo 'Le panier est vide.';
        }
    } catch (PDOException $e) {
        echo "Erreur de connexion à la base de données : " . $e->getMessage();
    }
} else {
    header("Location: form_connexion_inscription.php");
}
?>