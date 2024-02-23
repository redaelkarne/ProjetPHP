<?php
$UserID = $_SESSION["UserID"];
// Exécuter une requête SQL pour obtenir les informations de l'utilisateur
$sql = "SELECT * FROM users WHERE UserID = '$UserID'";
$result = $conn->query($sql);


// Vérifier si l'utilisateur existe
if ($result->num_rows > 0) {
    $row1 = $result->fetch_assoc();
    $Nom = $row1['Nom'];
    $Prenom = $row1['Prenom'];
    $mdp = $row1["MotDePasse"];
    $mail = $row1["Email"];
    $Role = $row1["Role"];
} else {
    // L'utilisateur n'existe pas, vous pouvez gérer cela en conséquence
    echo "L'utilisateur n'existe pas.";
    $Role = "";
    exit;
}