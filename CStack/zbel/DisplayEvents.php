<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './vendor/autoload.php';
require('dbconfig.php');
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
        echo "<div class='event'>";
        echo "<img src='" . $row['ImagePath'] . "' alt='Image de l\'événement'>";
        echo "<h2>" . $row['Titre'] . "</h2>";
        echo "<p><strong>Description:</strong> " . $row['Description'] . "</p>";
        echo "<p><strong>Date:</strong> " . $row['Date'] . " à " . $row['Heure'] . "</p>";
        echo "<p><strong>Catégorie:</strong> " . $row['Categorie'] . "</p>";
        // Récupération du nom et prénom du créateur de l'événement
        $creatorID = $row['CreateurID'];
        $creatorQuery = $conn->query("SELECT Nom, Prenom FROM Users WHERE UserID = '$creatorID'");
        if ($creatorQuery && $creator = $creatorQuery->fetch_assoc()) {
            echo "<p><strong>Créé par:</strong> " . $creator['Nom'] . " " . $creator['Prenom'] . "</p>";
        } else {
            echo "<p><strong>Créé par:</strong> Utilisateur non trouvé</p>";
        }
        echo "<p><strong>Nombre d'inscrits:</strong> " . $row['NombreInscrits'] . "</p>";
        echo "<p><strong>Statut:</strong> " . $row['Statut'] . "</p>";

        // Ajout d'un formulaire pour gérer les actions en fonction du rôle
        switch ($Role) {
            case 'Etudiant':
                echo "<div class='ligne'>";
                echo "<form method='post' action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "'>";
                echo "<input type='hidden' name='eventID' value='" . $row['EventID'] . "'>";
                echo "<input type='hidden' name='userID' value='" . $UserID . "'>";
                echo "<input type='hidden' name='Email' value='" . $mail . "'>";
                echo "<button type='submit' name='inscription' value='S'inscrire'>S'inscrire</button>";
                echo "</form>";
                echo "<form method='post' action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "'>";
                echo "<input type='hidden' name='eventID' value='" . $row['EventID'] . "'>";
                echo "<input type='hidden' name='userID' value='" . $UserID . "'>";
                echo "<button type='submit' name='favoris' value='Ajouter à mes favoris'>Ajouter à mes favoris</button>";
                echo "</form>";
                echo "</div>";
                break;
            case 'Membre BDE':
                echo "<div class='ligne'>";
                echo "<form method='post' action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "'>";
                echo "<input type='hidden' name='eventID' value='" . $row['EventID'] . "'>";
                echo "<input type='hidden' name='userID' value='" . $UserID . "'>";
                echo "<input type='hidden' name='Email' value='" . $mail . "'>";
                echo "<button type='submit' name='inscription' value='S'inscrire'>S'inscrire</button>";
                echo "</form>";
                echo "<form method='post' action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "'>";
                echo "<input type='hidden' name='eventID' value='" . $row['EventID'] . "'>";
                echo "<input type='hidden' name='userID' value='" . $UserID . "'>";
                echo "<button type='submit' name='favoris' value='Ajouter à mes favoris'>Ajouter à mes favoris</button>";
                echo "</form>";
                echo "<form method='post' action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "'>";
                echo "<input type='hidden' name='eventID' value='" . $row['EventID'] . "'>";
                echo "<input type='hidden' name='userID' value='" . $UserID . "'>";
                echo "<button type='submit' name='modifier' value='Modifier'>Modifier</button>";
                echo "</form>";
                echo "<form method='post' action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "'>";
                echo "<input type='hidden' name='eventID' value='" . $row['EventID'] . "'>";
                echo "<input type='hidden' name='userID' value='" . $UserID . "'>";
                echo "<button type='submit' name='supprimer' value='Supprimer'>Supprimer</button>";
                echo "</form>";
                echo "</div>";
                break;
            case 'Administrateur':
                echo "<div class='ligne'>";
                echo "<form method='post' action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "'>";
                echo "<input type='hidden' name='eventID' value='" . $row['EventID'] . "'>";
                echo "<input type='hidden' name='userID' value='" . $UserID . "'>";
                echo "<input type='hidden' name='Email' value='" . $mail . "'>";
                echo "<button type='submit' name='inscription' value='S inscrire'>S'inscrire</button>";
                echo "</form>";
                echo "<form method='post' action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "'>";
                echo "<input type='hidden' name='eventID' value='" . $row['EventID'] . "'>";
                echo "<input type='hidden' name='userID' value='" . $UserID . "'>";
                echo "<button type='submit' name='favoris' value='Ajouter à mes favoris'>Ajouter à mes favoris</button>";
                echo "</form>";
                echo "<form method='post' action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "'>";
                echo "<input type='hidden' name='eventID' value='" . $row['EventID'] . "'>";
                echo "<input type='hidden' name='userID' value='" . $UserID . "'>";
                echo "<button type='submit' name='modifier' value='Modifier'>Modifier</button>";
                echo "</form>";
                echo "<form method='post' action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "'>";
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
        echo "</div>";
    }
}
function sendEmail($to, $subject, $body) {
    // Prepare PHPMailer
    $Email = $_POST['Email'];
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'elkarnereda@gmail.com';
        $mail->Password   = 'aatp ktna wdnm pbsu';
        $mail->Port       = 587;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

        // Recipients
        $mail->setFrom('elkarnereda@gmail.com', 'Reda');
        $mail->addAddress($Email);

        // Content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $body;

        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

if (isset($_POST['inscription'])) {
    // Récupérer les informations de l'utilisateur et de l'événement
    $userID = $_POST['userID'];
    $eventID = $_POST['eventID'];
    $Email = $_POST['Email'];
    $DateInscription = date('Y-m-d H:i:s');

    // Exécuter la requête SQL d'insertion dans eventregistrations
    $sql = "INSERT INTO eventregistrations (UserID, EventID, DateInscription ) VALUES ('$userID', '$eventID','$DateInscription')";

    try {
        // Tentative d'insertion
        if ($conn->query($sql) === TRUE) {
            // Mise à jour de la colonne NombreInscrits dans la table events
            $update_sql = "UPDATE events SET NombreInscrits = NombreInscrits + 1 WHERE EventID = '$eventID'";
            if ($conn->query($update_sql) === TRUE) {
                echo "<script>alert('Vous venez de vous inscrire avec succès !');</script>";
                sendEmail('$Email', 'Confirmation ', 'Votre inscription a été confirmée avec succès !');
            } else {
                echo "<script>alert('Erreur lors de l\'incrémentation du nombre d\'inscrits... " . $conn->error . "');</script>";
            }
        }
    } catch (mysqli_sql_exception $e) {
        // Gestion de l'exception pour le cas où l'utilisateur est déjà inscrit
        if ($e->getCode() === 1062) {
            echo "<script>alert('Vous êtes déjà inscrit à cet événement !');</script>";
        } else {
            echo "<script>alert('Erreur lors de l\'inscription... " . $e->getMessage() . "');</script>";
        }
    }
}




if (isset($_POST['favoris'])) {
    $userID = $_POST['userID'];
    $eventID = $_POST['eventID'];

    // Exécuter la requête SQL d'insertion directement
    $sql = "INSERT INTO listeenvies (UserID, EventID) VALUES ('$userID', '$eventID')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Vous venez d'ajouter cet évenements à votre liste  !');</script>";
    } else {
        echo "<script>alert('Erreur de l'ajout au favoris...');</script> " . $conn->error;
    }
}



if (isset($_POST['modifier'])) {
    $userID = $_POST['userID'];
    $eventID = $_POST['eventID'];
}

// Traitement de la suppression d'un événement
if (isset($_POST['supprimer'])) {
    $eventID = $_POST['eventID'];

    // Suppression de l'événement
    $delete_sql = "DELETE FROM events WHERE EventID = '$eventID'";
    if ($conn->query($delete_sql) === TRUE) {
        echo "<script>alert('Événement supprimé avec succès');</script>";
    } else {
        echo "<script>alert('Erreur lors de la suppression de l\'événement...');</script>";
    }
}
