<?php
require_once('header.php');
require_once('db.php');?>

<head>
    <link rel="stylesheet" href="css/messagerie.css">
    <style>
        body {
    background-image: url("image/.jpg");
    background-repeat: no-repeat; /* Empêche la répétition de l'image */
    background-size: cover;
}
    </style>
</head>

<?php
if (!isset($_SESSION['utilisateur_id'])) {
    header("Location: form_connexion_inscription.php");
    exit();
}

$sql = "SELECT * FROM messages WHERE utilisateur_id = :utilisateur_id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':utilisateur_id', $_SESSION['utilisateur_id']);
$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="css/message">
    <meta charset="UTF-8">
    <title>Messages de l'utilisateur</title>
</head>
<body>
    <h1>Messagerie</h1>

    <?php
    if (count($results) > 0) {
        ?>
       <table border="1">
    <tbody>
        <?php
        foreach ($results as $row) {
echo "<tr>";
echo "<td style='background-color: #d1ad93;'><p>Message envoyé</p></td>";
echo "<td style='background-color: #d1ad93;'><p>Etat de la demande</p></td>";
echo "<td style='background-color: #d1ad93;'><p>Message reçu</p></td>";

echo "</tr>";
echo "<tr>";
echo "<td ><p class='message-vers-vendeur'>" . $row['messagesversvendeur'] . "</p></td>";
echo "<td ><p class='Etat de la demande'>" . $row['etat_probleme'] . "</p></td>";
echo "<td ><p class='message-vers-client'>" . ($row['messageversclient'] ? $row['messageversclient'] : '<span class="empty-message">En attente</span>') . "</p></td>";
echo "</tr>";


        }
        ?>
    </tbody>
</table>
    <?php
    } else {
        echo "<p>Messagerie vide</p>";
    }
    ?>
</body>
</html>
