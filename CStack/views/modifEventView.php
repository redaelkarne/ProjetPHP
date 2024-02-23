<?php

session_start();
require('../dbconfig.php');
require('../models/getInfoEvent.php');
require('../models/getRole.php');
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Modifier l'événement</title>
    <link rel="stylesheet" href="../assets/css/createevent.css">
</head>

<body>
    <?php require('navbarView.php') ?>
    <div class="container">
        <h1>Modifier l'événement</h1>
        <form method="post" action="../controllers/updateEvent.php" enctype="multipart/form-data"> <!-- Assume updateEvent.php gère la mise à jour -->
            <input type="hidden" name="eventID" value="<?php echo $row['EventID']; ?>">
            <input type="hidden" name="ImagePath" value="<?php echo $row['ImagePath']; ?>"> <!-- Pour passer l'ID lors de la soumission -->

            <label for="image">Image de l'event :</label>
            <input type="file" name="image"><br>

            <label for="titre">Titre :</label>
            <input type="text" name="titre" value="<?php echo $row['Titre']; ?>" required><br>

            <label for="description">Description :</label><br>
            <textarea name="description" rows="5" cols="40" required><?php echo $row['Description']; ?></textarea><br>

            <label for="date">Date :</label>
            <input type="date" name="date" value="<?php echo $row['Date']; ?>" required><br>

            <label for="heure">Heure :</label>
            <input type="time" name="heure" value="<?php echo $row['Heure']; ?>" required><br>

            <label for="categorie">Catégorie :</label>
            <input type="text" name="categorie" value="<?php echo $row['Categorie']; ?>" required><br>

            <label for="createur">Nom Créateur :</label>
            <input type="text" name="createur" value="<?php echo $row['CreateurID']; ?>" required><br>

            <label for="statut">Statut :</label>
            <select name="statut" required>
                <option value="Actif" <?= $row['Statut'] == 'Actif' ? 'selected' : '' ?>>Actif</option>
                <option value="Annulé" <?= $row['Statut'] == 'Annulé' ? 'selected' : '' ?>>Annulé</option>
                <option value="Passé" <?= $row['Statut'] == 'Passé' ? 'selected' : '' ?>>Passé</option>
            </select><br>


            <input type="submit" value="Mettre à jour">
        </form>
        <?php
        switch ($Role) {
            case 'Administrateur':
                echo "<a href='../page_admin.php'>Revenir >></a>";
                break;
            case 'Membre BDE':
                echo "<a href='../page_membre.php'>Revenir >></a>";
                break;
            default:
                break;
        }
        ?>
    </div>
</body>

</html>