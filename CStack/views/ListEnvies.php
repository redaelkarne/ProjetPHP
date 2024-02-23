<?php
require('./dbconfig.php');

$UserID = $_SESSION["UserID"]; // Assurez-vous que $UserID est récupéré de la session ou d'une autre source fiable

// Traitement de la suppression d'un favori
if (isset($_POST['supprimerFavori'])) {
    $eventIDASupprimer = $_POST['eventID'];
    $sqlSuppression = "DELETE FROM ListeEnvies WHERE EventID = '$eventIDASupprimer' AND UserID = '$UserID'";

    if ($conn->query($sqlSuppression) === TRUE) {
        echo "<p>Événement retiré de vos favoris avec succès.</p>";
    } else {
        echo "<p>Erreur lors de la suppression de l'événement de vos favoris.</p>";
    }
}

// Requête SQL pour récupérer les événements ajoutés aux favoris par l'utilisateur
$sql = "SELECT e.Titre, e.Description, e.Date, e.Heure, e.Statut, e.ImagePath, e.EventID
        FROM events e
        INNER JOIN ListeEnvies le ON e.EventID = le.EventID
        WHERE le.UserID = '$UserID'";
$result = $conn->query($sql);

// Vérifier si des événements ont été trouvés
if ($result->num_rows > 0) {
    echo "<h2>Événements ajoutés à vos favoris :</h2>";
    echo "<div class='DisplayEvents'>";
    // Afficher les événements
    while ($row = $result->fetch_assoc()) {
        $imgpath=$row['ImagePath'];
        echo "<div class='event'>";
        echo "<img src='" . substr($imgpath, 3) . "' alt='Image de l\'événement' style='width: 250px'>";
        echo "<h2>" . $row['Titre'] . "</h2>";
        echo "<p><strong>Description:</strong></p><br><p> " . $row['Description'] . "</p><br>";
        echo "<p><strong>Date:</strong></p><br><p>" . $row['Date'] . " à " . $row['Heure'] . "</p><br>";

        // Formulaire de suppression
        echo "<form method='post'>";
        echo "<input type='hidden' name='eventID' value='" . $row['EventID'] . "'>";
        echo "<button type='submit' name='supprimerFavori'>Supprimer des favoris</button>";
        echo "</form>";
        echo "</div>";

    }
    echo "</div>";
} else {
    echo "<p>Aucun événement ajouté à vos favoris pour le moment.</p>";
}
?>
