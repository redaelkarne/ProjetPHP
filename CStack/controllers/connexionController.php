<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';
require('../dbconfig.php');
$conn->set_charset("utf8");

// Initialiser les variables de connexion
$email_connexion = $mot_de_passe_connexion = "";
$erreur_connexion = "";

// Traitement du formulaire de connexion
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des données du formulaire

    $email_connexion = $_POST["email_connexion"];
    $mot_de_passe_connexion = $_POST["mot_de_passe_connexion"];

    // Requête SQL pour sélectionner l'utilisateur basé sur l'email
    $sql = "SELECT UserID , Nom, MotDePasse, Role , StatutEmailVerifie FROM users WHERE Email = '$email_connexion'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if ($mot_de_passe_connexion == $row["MotDePasse"]) {
            if ($row['StatutEmailVerifie'] == 0) {
                // User's email is not verified, send verification email
                $token = bin2hex(random_bytes(50)); // Generate a random token

                // Store the token in the database
                $sql = $conn->prepare("UPDATE users SET token = ? WHERE UserID = ?");
                $sql->bind_param("si", $token, $row['UserID']);
                $debugSql = str_replace('?', '%s', "UPDATE users SET token = ? WHERE UserID = ?");
                $debugSql = sprintf($debugSql, $token, $row['UserID']);
                echo $debugSql;
                $sql->execute();

                // Send verification email
                $verificationLink = "http://localhost/tests/ChallengeStack//verify.php?token=$token";

                $mail = new PHPMailer(true);

                try {
                    //Server settings
                    $mail->isSMTP();
                    $mail->Host       = 'smtp.gmail.com';
                    $mail->SMTPAuth   = true;
                    $mail->Username   = 'elkarnereda@gmail.com';
                    $mail->Password   = 'aatp ktna wdnm pbsu';
                    $mail->Port       = 587;
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                   

                    //Recipients
                    $mail->setFrom('elkarnereda@gmail.com', 'Reda');
                    $mail->addAddress($email_connexion);

                    //Content
                    $mail->isHTML(true);
                    $mail->Subject = 'Email Verification';
                    $mail->Body = "Clique ce <a href='$verificationLink'>lien</a> pour verifier votre e-mail.";

                    $mail->send();
                    echo 'Message has been sent';
                } catch (Exception $e) {
                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }

            } else {
                // User's email is verified, log them in
                $_SESSION["UserID"] = $row["UserID"];

                // Redirection en fonction du rôle
                if ($row["Role"] == "Administrateur") {
                    header("Location: ../page_admin.php");
                    exit();
                } elseif ($row["Role"] == "Etudiant") {
                    header("Location: ../page_etudiant.php");
                    exit();
                } elseif ($row["Role"] == "Membre BDE") {
                    header("Location: ../page_membre.php");
                    exit();
                }
            }
        } else {
            echo "Mot de passe incorrect.";
        }
    } else {
        echo  "Aucun utilisateur trouvé avec cet identifiant.";
    }
}
?>