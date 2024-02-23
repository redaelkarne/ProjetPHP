<?php
// Include PHPMailer
require('dbconfig.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './vendor/autoload.php';



$current_date = date('Y-m-d');
$five_days_later = date('Y-m-d', strtotime('+5 days'));


$sql = "SELECT * FROM events WHERE Date BETWEEN '$current_date' AND '$five_days_later'";
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
    $event_date = $row['Date'];
    $participants = $row['NombreInscrits'];
    $Titre = $row['Titre'];


    if (date('Y-m-d', strtotime($event_date)) == date('Y-m-d', strtotime('+1 day'))) {
        sendEmail('elkarnereda@gmail.com', 'Event Reminder', "L'événement " . $Titre . " est demain");
    }


    if (date('Y-m-d', strtotime($event_date)) == date('Y-m-d', strtotime('+5 days')) && $participants == 0) {
        sendEmail('elkarnereda@gmail.com', 'Event Reminder', "L'événement " . $Titre . " est dans 5 jours et il n'y a aucun participant");
    }
}

function sendEmail($to, $subject, $body) {
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
        $mail->addAddress($to);

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
?>