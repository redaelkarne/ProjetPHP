<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des données du formulaire
    $nom = $_POST["nom"];
    $Prenom = $_POST["Prenom"];
    $mot_de_passe = $_POST["mot_de_passe"];
    $Email = $_POST["Email"];
    $role = 'Etudiant' ;
    $StatutEmailVerifie = 0;
    $dateInscription = date('Y-m-d H:i:s');

    // Préparation et exécution de la requête SQL pour insérer l'utilisateur dans la table Utilisateurs
$sql = "INSERT INTO users (Nom, Prenom, Email, MotDePasse, Role, StatutEmailVerifie, DateInscription) VALUES (?, ?, ?, ?, ?, ?, ?)";

// Préparation de la requête
$stmt = $conn->prepare($sql);

// Vérification de la préparation de la requête
if ($stmt) {
    // Liaison des valeurs aux paramètres de la requête
    $stmt->bind_param("sssssss", $nom, $Prenom, $Email, $mot_de_passe, $role, $StatutEmailVerifie, $dateInscription);

    // Exécution de la requête
    if ($stmt->execute()) {
        echo "Inscription réussie !";
        header("Location: ../views/connexionView.php");
        exit; // Terminer le script après la redirection
    } else {
        echo "Erreur lors de l'inscription : " . $stmt->error;
    }

    // Fermeture du statement
    $stmt->close();
} else {
    // Gérer l'échec de la préparation de la requête
    echo "Erreur lors de la préparation de la requête : " . $conn->error;
}

}

// Fermer la connexion à la base de données
$conn->close();