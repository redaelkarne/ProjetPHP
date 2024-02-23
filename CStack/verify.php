<?php
require('dbconfig.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './vendor/autoload.php';
// Get the token from the URL
$token = $_GET["token"];

// Update StatutEmailVerifie to 1 for the user with this token
$sql = "UPDATE users SET StatutEmailVerifie = 1 WHERE token = '$token'";
$update_result = $conn->query($sql);

echo "Email verifié avec succès. Vous pouvez maintenant vous connecter.";
if ($update_result) {
    // Prepare PHPMailer
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
        $mail->addAddress('elkarnereda@gmail.com'); // Replace with the admin's email

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Verification Email';
        $mail->Body    = 'Un Email a ete verifié avec succès.';

        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
$conn->close();
?>