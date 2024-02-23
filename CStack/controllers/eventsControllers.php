<?php

require('../dbconfig.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['titre'], $_POST['description'], $_POST['date'], $_POST['heure'], $_POST['categorie'], $_POST['createur'])) {
        // Vérifier la connexion
        if ($conn->connect_error) {
            die("La connexion a échoué : " . $conn->connect_error);
        }

        $titre = $_POST['titre'];
        $description = $_POST['description'];
        $date = $_POST['date'];
        $heure = $_POST['heure'];
        $categorie = $_POST['categorie'];
        $nomcreateur = $_POST['createur'];
        $statut = 'Actif';

        if (!isset($_FILES['image']) || $_FILES['image']['error'] != 0) {
            echo "Erreur lors du téléchargement de l'image. Veuillez réessayer.";
            exit;
        }

        $targetDirectory = "../assets/img/";
        $targetFile = $targetDirectory . basename($_FILES['image']['name']);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        if (getimagesize($_FILES['image']['tmp_name']) === false) {
            echo "Le fichier n'est pas une image.";
            $uploadOk = 0;
        }

        if ($uploadOk == 0) {
            echo "Désolé, votre fichier n'a pas été téléchargé.";
        } else {
            if (!move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
                echo "Désolé, une erreur s'est produite lors du téléchargement de votre fichier.";
                exit;
            }
        }

        // Exécuter une requête SQL pour obtenir les informations de l'utilisateur
        $sql = "SELECT * FROM users WHERE Nom = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $nomcreateur);
        $stmt->execute();
        $result = $stmt->get_result();

        // Vérifier si l'utilisateur existe
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $createur = $row['UserID'];
        } else {
            // L'utilisateur n'existe pas, vous pouvez gérer cela en conséquence
            echo "L'utilisateur n'existe pas.";
            exit;
        }

        // Préparer la requête SQL pour l'insertion de l'événement avec le chemin de l'image
        $sql = "INSERT INTO Events (Titre, Description, Date, Heure, Categorie, CreateurID, Statut, ImagePath) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssss", $titre, $description, $date, $heure, $categorie, $createur, $statut, $targetFile);

        // Exécuter la requête préparée
        if ($stmt->execute()) {
            echo "<script>alert('L\'événement a été créé avec succès.');</script>";
        } else {
            echo "Erreur lors de la création de l'événement : " . $conn->error;
        }
    } else {
        echo "Veuillez remplir tous les champs obligatoires et inclure une image.";
    }
}
?>