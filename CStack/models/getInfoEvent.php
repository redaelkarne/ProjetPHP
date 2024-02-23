<?php

// Vérifiez si eventID est fourni via POST ou GET et affectez-le à $EventID
if (isset($_POST['eventID'])) {
    $EventID = $_POST['eventID'];
} elseif (isset($_GET['eventID'])) {
    $EventID = $_GET['eventID'];
} else {
    echo "L'Event ID n'est pas spécifié.";
    exit;
}

// Exécuter une requête SQL pour obtenir les informations de l'événement
$sql = "SELECT * FROM events WHERE EventID = ?";
if ($stmt = $conn->prepare($sql)) {
    $stmt->bind_param("i", $EventID); // 'i' indique que la variable est de type entier
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        // L'événement n'existe pas, vous pouvez gérer cela en conséquence
        echo "L'Event ID n'existe pas.";
        exit;
    }

    $stmt->close();
} else {
    // Gérer l'erreur de préparation
    echo "Erreur de préparation de la requête : " . $conn->error;
}

