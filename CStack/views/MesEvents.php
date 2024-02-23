<?php
require('./dbconfig.php');
// Requête SQL pour récupérer les événements auxquels l'utilisateur est inscrit
$sql = "SELECT e.Titre, e.Description, e.Date, e.Heure, e.Statut, e.ImagePath, e.EventID, er.InscriptionID
        FROM events e
        INNER JOIN eventregistrations er ON e.EventID = er.EventID
        WHERE er.UserID = '$UserID'";
$result = $conn->query($sql);
?>

<?php
// Vérifier si des événements ont été trouvés
if ($result->num_rows > 0) {
    echo "<h2>Événements auxquels vous êtes inscrit :</h2>";
    echo "<div class='DisplayEvents'>";
    // Afficher les événements
    while ($row = $result->fetch_assoc()) {
        $imgpath=$row['ImagePath'];
        echo "<div class='event'>";
        echo "<img src='" . substr($imgpath, 3) . "' alt='Image de l\'événement' style='width: 250px'>";
        echo "<h2>" . $row['Titre'] . "</h2>";
        echo "<p><strong>Description:</strong></p><br><p> " . $row['Description'] . "</p><br>";
        echo "<p><strong>Date:</strong></p><br><p> " . $row['Date'] . " à " . $row['Heure'] . "</p><br>";
        echo "<p class='vert' ><span class='material-symbols-outlined'>check_circle</span>  Vous êtes inscrit !</p>";
        echo "<form method='post' action='./controllers/eventadminController.php'>";
        echo "<input type='hidden' name='InscriptionID' value='" . $row['InscriptionID'] . "'>";
        echo "<input type='hidden' name='eventID' value='" . $row['EventID'] . "'>";
        echo "<input type='hidden' name='Role' value='" . $Role . "'>";
        echo "<input type='hidden' name='userID' value='" . $UserID . "'>";
        echo "<button type='submit' name='desinscription' value='Se désinscrire'>Se désinscrire</button>";
        echo "</form>";
        echo "</div>";
    }
    echo "</div>";
} else {
    echo "<p>Vous n'êtes inscrit à aucun événement pour le moment.</p>";
}

// Fermer la connexion à la base de données
$conn->close();
?>
