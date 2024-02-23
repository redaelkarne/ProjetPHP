<?php

$UserID = $_POST['UserID'];
// Exécuter une requête SQL pour obtenir les informations de l'utilisateur
$sql = "SELECT * FROM users WHERE UserID = '$UserID'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $Role = $row["Role"];
    $Nom = $row["Nom"];
} else {
    // L'utilisateur n'existe pas, vous pouvez gérer cela en conséquence
    echo "L'utilisateur n'existe pas.";
    $Role = "";
    exit;
}