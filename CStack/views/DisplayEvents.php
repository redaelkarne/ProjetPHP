<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './vendor/autoload.php';
require('./dbconfig.php');
// Assurez-vous que la connexion à la base de données est établie
if ($conn->connect_error) {
    die("La connexion à la base de données a échoué : " . $conn->connect_error);
}

$date = $_POST['date'] ?? null; // replace with the date you want to filter by
$category = $_POST['category'] ?? null; // replace with the category you want to filter by

if ($date && $category) {
    // If both date and category are provided, filter by both
    $stmt = $conn->prepare("SELECT * FROM events WHERE Date = ? AND Categorie = ?");
    $stmt->bind_param("ss", $date, $category);
} elseif ($date) {
    // If only date is provided, filter by date
    $stmt = $conn->prepare("SELECT * FROM events WHERE Date = ?");
    $stmt->bind_param("s", $date);
} elseif ($category) {
    // If only category is provided, filter by category
    $stmt = $conn->prepare("SELECT * FROM events WHERE Categorie = ?");
    $stmt->bind_param("s", $category);
} else {
    // If no filter is provided, select all events
    $stmt = $conn->prepare("SELECT * FROM events");
}
$stmt->execute();
$result = $stmt->get_result();

?>

<!-- HTML form for filtering -->
<form method="POST" action="">
    <input type="date" name="date">
    <select name="category">
        <option value="">Select category</option>
        <option value="Soirée">Soirée</option>
        <option value="Ventes">Ventes</option>
        <option value="Concours">Concours</option>
        <option value="Collecte">Collecte</option>
        <option value="Sport">Sport</option>
    </select>
    <input type="submit" value="Filter">
</form>

<div class="DisplayEvents">
<?php

/// Vérifie si la requête a réussi
if (!$result) {
    echo "Erreur lors de la récupération des événements : " . $conn->error;
} else {
    // Affichage des événements
    while ($row = $result->fetch_assoc()) {
        $imgpath=$row['ImagePath'];
        echo "<div class='event'>";
        echo "<img src='" . substr($imgpath, 1) . "' alt='Image de l événement' style='width: 250px'>";
        echo "<h2>" . $row['Titre'] . "</h2>";
        echo "<p><strong>Description:</strong></p><br><p> " . $row['Description'] . "</p><br>";
        echo "<p><strong>Date:</strong></p><br><p> " . $row['Date'] . " à " . $row['Heure'] . "</p><br>";

        // Ajout d'un formulaire pour gérer les actions en fonction du rôle
// Ajout d'un formulaire pour gérer les actions en fonction du rôle
switch ($Role) {
    case 'Etudiant':
        echo "<div class='ligne'>";
        echo "<form method='post' action='views/EventView.php'>";
        echo "<input type='hidden' name='eventID' value='" . $row['EventID'] . "'>";
        echo "<button type='submit' name='' value='Plus d infos'>Plus d'infos</button>";
        echo "</form>";
        echo "</div>";
        break;
    case 'Membre BDE':
        echo "<div class='ligne'>";
        echo "<form method='post' action='views/EventView.php'>";
        echo "<input type='hidden' name='eventID' value='" . $row['EventID'] . "'>";
        echo "<button type='submit' name='' value='Plus d infos'>Plus d'infos</button>";
        echo "</form>";
        echo "</div>";
        break;
    case 'Administrateur':
        echo "<div class='ligne'>";
        echo "<form method='post' action='views/EventView.php'>";
        echo "<input type='hidden' name='eventID' value='" . $row['EventID'] . "'>";
        echo "<button type='submit' name='' value='Plus d infos'>Plus d'infos</button>";
        echo "</form>";
        echo "</div>";
}
echo "</div>";
}
}
?>

</div>

