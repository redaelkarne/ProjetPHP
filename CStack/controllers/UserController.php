<?php

// Vérification si on est en train de mettre à jour les données
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    $UserID = $_POST['UserID'];
    $Prenom = $_POST['prenom'];
    $Nom = $_POST['nom'];
    $Email = $_POST['mail'];
    $MotDePasse = $_POST['mdp']; // Pensez à sécuriser le mot de passe
    $Role = $_POST['role'];

    // Mise à jour des informations dans la base de données
    $sqlUpdate = "UPDATE users SET Prenom=?, Nom=?, Email=?, MotDePasse=?, Role=? WHERE UserID=?";
    $stmt = $conn->prepare($sqlUpdate);
    $stmt->bind_param("sssssi", $Prenom, $Nom, $Email, $MotDePasse, $Role, $UserID);

    if ($stmt->execute()) {
        $message = "Informations de l'utilisateur mises à jour avec succès.";
    } else {
        $message = "Erreur lors de la mise à jour : " . $conn->error;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['supprimer_utilisateur'])) {
    $UserID = $_POST['UserID'];

    // Préparer la requête de suppression
    $sql = "DELETE FROM users WHERE UserID = ?";
    $stmt = $conn->prepare($sql);
    
    // Lier le paramètre UserID et exécuter la requête
    $stmt->bind_param("i", $UserID);
    if ($stmt->execute()) {
        echo "<p>L'utilisateur a été supprimé avec succès.</p>";
    } else {
        echo "<p>Erreur lors de la suppression de l'utilisateur : " . $conn->error . "</p>";
    }
    $stmt->close();

}