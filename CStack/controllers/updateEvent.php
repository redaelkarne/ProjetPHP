<?php
require('../dbconfig.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['eventID'], $_POST['titre'], $_POST['description'], $_POST['date'], $_POST['heure'], $_POST['categorie'])) {
        // Vérifier la connexion
        if ($conn->connect_error) {
            die("La connexion a échoué : " . $conn->connect_error);
        }

        $eventID = $_POST['eventID'];
        $titre = $_POST['titre'];
        $description = $_POST['description'];
        $date = $_POST['date'];
        $heure = $_POST['heure'];
        $categorie = $_POST['categorie'];
        $ImagePath = $_POST['ImagePath'];
        $statut = 'Actif'; // Supposons que vous voulez aussi pouvoir modifier le statut

        $uploadOk = 0;
        $targetFile = ""; // Initialiser le chemin du fichier

        // Vérifier si une nouvelle image a été téléchargée
        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            $targetDirectory = "./assets/img/";
            $targetFile = $targetDirectory . basename($_FILES['image']['name']);
            $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

            if (getimagesize($_FILES['image']['tmp_name']) === false) {
                echo "Le fichier n'est pas une image.";
                $uploadOk = 0;
            }

            // Si l'image est OK, tenter de la télécharger
            if ($uploadOk == 1 && !move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
                echo "Désolé, une erreur s'est produite lors du téléchargement de votre fichier.";
                exit;
            }
        }

        // Préparer la requête SQL pour la mise à jour de l'événement
        // Si une nouvelle image a été téléchargée, inclure également le chemin de l'image dans la mise à jour
        $sql = "UPDATE events SET Titre = ?, Description = ?, Date = ?, Heure = ?, Categorie = ?, Statut = ?" . ($uploadOk == 1 ? ", ImagePath = ?" : "") . " WHERE EventID = ?";

        $stmt = $conn->prepare($sql);

        if ($uploadOk == 1) {
            $stmt->bind_param("sssssssi", $titre, $description, $date, $heure, $categorie, $statut, $targetFile, $eventID);
        } else {
            $stmt->bind_param("ssssssi", $titre, $description, $date, $heure, $categorie, $statut, $eventID);
        }

        // Exécuter la requête préparée
        if ($stmt->execute()) {
            echo "L'événement a été mis à jour avec succès.";
            header('Location: ../views/EventView.php?eventID=' . urlencode($eventID));
            exit();
        } else {
            echo "Erreur lors de la mise à jour de l'événement : " . $conn->error;
        }
    } else {
        echo "Veuillez remplir tous les champs obligatoires.";
    }
}
