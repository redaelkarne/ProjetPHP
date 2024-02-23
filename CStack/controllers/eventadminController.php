<?php

session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';
require('../dbconfig.php');
function sendEmail($to, $subject, $body)
{
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
            $update_sql = "UPDATE events SET NombreInscrits = NombreInscrits + 1 WHERE EventID = $eventID";
            if ($conn->query($update_sql) === TRUE) {

                header('Location: ../views/EventView.php?eventID=' . urlencode($eventID));
                echo "<script>alert('Vous venez de vous inscrire avec succès !');</script>";
                sendEmail('$Email', 'Confirmation ', 'Votre inscription a été confirmée avec succès !');
                exit(); // Assurez-vous de toujours appeler exit() après une redirection pour arrêter l'exécution du script.
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

if (isset($_POST['desinscription'])) {
    // Récupérer l'ID de l'inscription à retirer
    $inscriptionID = $_POST['InscriptionID'];
    $eventID = $_POST['eventID'];
    $Role = $_POST['Role']; // Nécessaire pour la mise à jour du nombre d'inscrits

    // Préparer la requête SQL pour supprimer l'inscription
    $sql = "DELETE FROM eventregistrations WHERE InscriptionID = ?";

    try {
        // Préparation de la requête
        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            throw new Exception("Erreur lors de la préparation de la requête : " . $conn->error);
        }

        // Lier le paramètre et exécuter la requête
        $stmt->bind_param("i", $inscriptionID);
        $stmt->execute();

        // Vérifier si l'inscription a bien été supprimée
        if ($stmt->affected_rows > 0) {
            // Mise à jour de la colonne NombreInscrits dans la table events
            $update_sql = "UPDATE events SET NombreInscrits = NombreInscrits - 1 WHERE EventID = ?";
            $update_stmt = $conn->prepare($update_sql);
            if ($update_stmt === false) {
                throw new Exception("Erreur lors de la mise à jour du nombre d'inscrits : " . $conn->error);
            }
            $update_stmt->bind_param("i", $eventID);
            $update_stmt->execute();

            if ($update_stmt->affected_rows == 0) {
                throw new Exception("Aucune mise à jour effectuée. Vérifiez l'EventID.");
            }

            // Redirection en fonction du rôle de l'utilisateur
            switch ($Role) {
                case 'Administrateur':
                    header('Location: ../page_admin.php');
                    break;
                case 'Etudiant':
                    header('Location: ../page_etudiant.php');
                    break;
                case 'Membre BDE':
                    header('Location: ../page_membre.php');
                    break;
                default:
                    // Si le rôle n'est pas reconnu, redirige vers la page principale ou une page d'erreur
                    header('Location: ../error_page.php');
                    break;
            }
            exit();
        } else {
            echo "<script>alert('Aucune inscription correspondante trouvée.');</script>";
        }
    } catch (Exception $e) {
        // Gestion des erreurs
        echo "<script>alert('Erreur lors de la désinscription : " . $e->getMessage() . "');</script>";
    }
}


if (isset($_POST['favoris'])) {
    $userID = $_POST['userID'];
    $eventID = $_POST['eventID'];

    // Exécuter la requête SQL d'insertion directement
    $sql = "INSERT INTO listeenvies (UserID, EventID) VALUES ('$userID', '$eventID')";

    if ($conn->query($sql) === TRUE) {
        echo "'Vous venez d'ajouter cet évenements à votre liste  !'";

        header('Location: ../views/EventView.php?eventID=' . urlencode($eventID));
        exit(); // Assurez-vous de toujours appeler exit() après une redirection pour arrêter l'exécution du script.
    } else {
        echo "<script>alert('Erreur de l'ajout au favoris...');</script> " . $conn->error;
    }
}

// Traitement de la suppression d'un événement
if (isset($_POST['supprimer'])) {
    $eventID = $_POST['eventID'];

    require('../models/getRole.php');

    // Suppression de l'événement
    $delete_sql = "DELETE FROM events WHERE EventID = '$eventID'";
    if ($conn->query($delete_sql) === TRUE) {
        echo "<script>alert('Événement supprimé avec succès');</script>";
        switch ($Role) {
            case 'Administrateur':
                header('Location: ../page_admin.php');
                exit();
                break;
            case 'Membre BDE':
                header('Location: ../page_membre.php');
                exit();
                break;
            default:
                break;
        }
    } else {
        echo "<script>alert('Erreur lors de la suppression de l\'événement...');</script>";
    }
}
