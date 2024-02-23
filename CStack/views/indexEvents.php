<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './vendor/autoload.php';
require('./dbconfig.php');
// Assurez-vous que la connexion à la base de données est établie
if ($conn->connect_error) {
    die("La connexion à la base de données a échoué : " . $conn->connect_error);
}

// Récupération de tous les événements
$result = $conn->query("SELECT * FROM events ");

/// Vérifie si la requête a réussi
if (!$result) {
    echo "Erreur lors de la récupération des événements : " . $conn->error;
} else {
    // Affichage des événements
    while ($row = $result->fetch_assoc()) {
        $imgpath = $row['ImagePath'];
        echo "<div class='swiper-slide'>";
        echo "<div class='event'>";
        echo "<img src='" . substr($imgpath, 1) . "' alt='Image de l\'événement' style='max-height: 60vh;'>";
        echo "<div class='descriptif'>";
        echo "<h2>" . $row['Titre'] . "</h2>";
        echo "<p><strong>Date:</strong></p><br><p> " . $row['Date'] . " à " . $row['Heure'] . "</p>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
    }
}


$conn->close();
