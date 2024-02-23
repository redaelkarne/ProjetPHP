<?php

session_start();
require('../dbconfig.php');
require('../models/getInfoEvent.php');
require('../models/getRole.php');
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/ico" href="../assets/img/BDE.ico">
    <link rel="stylesheet" href="../assets/css/event.css">
    <title><?= htmlspecialchars($row['Titre']) ?></title>
</head>

<body>
    <?php
    require('navbarView.php')
    ?>
    <div class="EventView">
        <div class="event-container">
            <h1><?= htmlspecialchars($row['Titre']) ?></h1>
            <div class="ImageCenter">
            <img src="<?= htmlspecialchars($row['ImagePath']) ?>" alt="Image de l'événement" style="max-width: 600px; height: auto; text-align:center;">
            </div>
            <p><strong>Description :</strong> <?= nl2br(htmlspecialchars($row['Description'])) ?></p>
            <p><strong>Date :</strong> <?= htmlspecialchars($row['Date']) ?></p>
            <p><strong>Heure :</strong> <?= htmlspecialchars($row['Heure']) ?></p>
            <p><strong>Catégorie :</strong> <?= htmlspecialchars($row['Categorie']) ?></p>
            <p><strong>Nombre d'inscrits :</strong> <?= htmlspecialchars($row['NombreInscrits']) ?></p>
            <p><strong>Statut :</strong> <?= htmlspecialchars($row['Statut']) ?></p>
            <?php
            // Récupération du nom et prénom du créateur de l'événement
            $creatorID = $row['CreateurID'];
            $creatorQuery = $conn->query("SELECT Nom, Prenom FROM Users WHERE UserID = '$creatorID'");
            if ($creatorQuery && $creator = $creatorQuery->fetch_assoc()) {
                echo "<p><strong>Créé par:</strong> " . $creator['Nom'] . " " . $creator['Prenom'] . "</p>";
            } else {
                echo "<p><strong>Créé par:</strong> Utilisateur non trouvé</p>";
            }
            ?>
            <?php
            switch ($Role) {
                case 'Etudiant':
                    echo "<div class='ligne'>";
                    echo "<form method='post' action='../controllers/eventadminController.php'>";
                    echo "<input type='hidden' name='eventID' value='" . $row['EventID'] . "'>";
                    echo "<input type='hidden' name='userID' value='" . $UserID . "'>";
                    echo "<input type='hidden' name='Email' value='" . $mail . "'>";
                    echo "<button type='submit' name='inscription' value='S'inscrire'>S'inscrire</button>";
                    echo "</form>";
                    echo "<form method='post' action='../controllers/eventadminController.php'>";
                    echo "<input type='hidden' name='eventID' value='" . $row['EventID'] . "'>";
                    echo "<input type='hidden' name='userID' value='" . $UserID . "'>";
                    echo "<button type='submit' name='favoris' value='Ajouter à mes favoris'>Ajouter à mes favoris</button>";
                    echo "</form>";
                    echo "</div>";
                    echo "<a href='../page_etudiant.php'>Revenir >></a>";
                    break;
                case 'Membre BDE':
                    echo "<div class='ligne'>";
                    echo "<form method='post'action='../controllers/eventadminController.php'>";
                    echo "<input type='hidden' name='eventID' value='" . $row['EventID'] . "'>";
                    echo "<input type='hidden' name='userID' value='" . $UserID . "'>";
                    echo "<input type='hidden' name='Email' value='" . $mail . "'>";
                    echo "<button type='submit' name='inscription' value='S'inscrire'>S'inscrire</button>";
                    echo "</form>";
                    echo "<form method='post' action='../controllers/eventadminController.php'>";
                    echo "<input type='hidden' name='eventID' value='" . $row['EventID'] . "'>";
                    echo "<input type='hidden' name='userID' value='" . $UserID . "'>";
                    echo "<button type='submit' name='favoris' value='Ajouter à mes favoris'>Ajouter à mes favoris</button>";
                    echo "</form>";
                    echo "<form method='post' action='modifEventView.php'>";
                    echo "<input type='hidden' name='eventID' value='" . $row['EventID'] . "'>";
                    echo "<input type='hidden' name='userID' value='" . $UserID . "'>";
                    echo "<button type='submit' name='modifier' value='Modifier'>Modifier</button>";
                    echo "</form>";
                    echo "<form method='post' action='../controllers/eventadminController.php'>";
                    echo "<input type='hidden' name='eventID' value='" . $row['EventID'] . "'>";
                    echo "<input type='hidden' name='userID' value='" . $UserID . "'>";
                    echo "<button type='submit' name='supprimer' value='Supprimer'>Supprimer</button>";
                    echo "</form>";
                    // Bouton pour afficher/masquer les inscriptions
                    $eventId = $row['EventID'];
                    $toggleKey = "toggle_$eventId";

                    // Vérification et basculement de l'état d'affichage des participants
                    if (isset($_POST['toggle']) && $_POST['eventID'] == $eventId) {
                        $_SESSION[$toggleKey] = !isset($_SESSION[$toggleKey]) ? true : !$_SESSION[$toggleKey];
                    }

                    echo "<form method='post'>";
                    echo "<input type='hidden' name='eventID' value='" . $eventId . "'>";
                    echo "<button type='submit' name='toggle'>" . (isset($_SESSION[$toggleKey]) && $_SESSION[$toggleKey] ? "Masquer" : "Voir") . " Les Inscriptions</button>";
                    echo "</form>";
                    echo "</div>";
                    echo "<a href='../page_admin.php'>Revenir >></a>";

                    // Affichage conditionnel des participants
                    if (isset($_SESSION[$toggleKey]) && $_SESSION[$toggleKey]) {
                        $sqlParticipants = "SELECT Users.Nom, Users.Prenom FROM eventregistrations JOIN Users ON eventregistrations.UserID = Users.UserID WHERE eventregistrations.EventID = '$eventId'";
                        $resultParticipants = $conn->query($sqlParticipants);

                        if ($resultParticipants->num_rows > 0) {
                            echo "<div class='participants'><h3>Liste des Pariticpants</h3><ul>";
                            while ($participant = $resultParticipants->fetch_assoc()) {
                                echo "<li>" . htmlspecialchars($participant['Nom']) . " " . htmlspecialchars($participant['Prenom']) . "</li>";
                            }
                            echo "</ul></div>";
                        } else {
                            echo "<p>Aucun participant trouvé.</p>";
                        }
                    }
                    echo "</div>";
                    break;
                case 'Administrateur':
                    echo "<div class='ligne'>";
                    echo "<form method='post' action='../controllers/eventadminController.php'>";
                    echo "<input type='hidden' name='eventID' value='" . $row['EventID'] . "'>";
                    echo "<input type='hidden' name='userID' value='" . $UserID . "'>";
                    echo "<input type='hidden' name='Email' value='" . $mail . "'>";
                    echo "<button type='submit' name='inscription' value='S inscrire'>S'inscrire</button>";
                    echo "</form>";
                    echo "<form method='post' action ='../controllers/eventadminController.php'>";
                    echo "<input type='hidden' name='eventID' value='" . $row['EventID'] . "'>";
                    echo "<input type='hidden' name='userID' value='" . $UserID . "'>";
                    echo "<button type='submit' name='favoris' value='Ajouter à mes favoris'>Ajouter à mes favoris</button>";
                    echo "</form>";
                    echo "<form method='post' action='modifEventView.php'>";
                    echo "<input type='hidden' name='eventID' value='" . $row['EventID'] . "'>";
                    echo "<input type='hidden' name='userID' value='" . $UserID . "'>";
                    echo "<button type='submit' name='modifier' value='Modifier'>Modifier</button>";
                    echo "</form>";
                    echo "<form method='post' action='../controllers/eventadminController.php'>";
                    echo "<input type='hidden' name='eventID' value='" . $row['EventID'] . "'>";
                    echo "<input type='hidden' name='userID' value='" . $UserID . "'>";
                    echo "<button type='submit' name='supprimer' value='Supprimer'>Supprimer</button>";
                    echo "</form>";
                    // Bouton pour afficher/masquer les inscriptions
                    $eventId = $row['EventID'];
                    $toggleKey = "toggle_$eventId";

                    // Vérification et basculement de l'état d'affichage des participants
                    if (isset($_POST['toggle']) && $_POST['eventID'] == $eventId) {
                        $_SESSION[$toggleKey] = !isset($_SESSION[$toggleKey]) ? true : !$_SESSION[$toggleKey];
                    }

                    echo "<form method='post'>";
                    echo "<input type='hidden' name='eventID' value='" . $eventId . "'>";
                    echo "<button type='submit' name='toggle'>" . (isset($_SESSION[$toggleKey]) && $_SESSION[$toggleKey] ? "Masquer" : "Voir") . " Les Inscriptions</button>";
                    echo "</form>";
                    echo "</div>";
                    echo "<a href='../page_admin.php'>Revenir >></a>";

                    // Affichage conditionnel des participants
                    if (isset($_SESSION[$toggleKey]) && $_SESSION[$toggleKey]) {
                        $sqlParticipants = "SELECT Users.Nom, Users.Prenom FROM eventregistrations JOIN Users ON eventregistrations.UserID = Users.UserID WHERE eventregistrations.EventID = '$eventId'";
                        $resultParticipants = $conn->query($sqlParticipants);

                        if ($resultParticipants->num_rows > 0) {
                            echo "<div class='participants'><h3>Liste des Pariticpants</h3><ul>";
                            while ($participant = $resultParticipants->fetch_assoc()) {
                                echo "<li>" . htmlspecialchars($participant['Nom']) . " " . htmlspecialchars($participant['Prenom']) . "</li>";
                            }
                            echo "</ul></div>";
                        } else {
                            echo "<p>Aucun participant trouvé.</p>";
                        }
                    }
            }
            ?>
        </div>
    </div>
</body>
</html>

