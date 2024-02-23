<?php
session_start();
require('../controllers/eventsControllers.php');
require('../models/getRole.php');

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/createevent.css">
    <title>Créer un nouvel événement</title>
</head>

<body>
    <?php
    require('navbarView.php')
    ?>
    <div class="container">
        <h1>Créer un nouvel événement</h1>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
            <label for="image">Image de l'event :</label>
            <input type="file" name="image" required><br>

            <label for="titre">Titre :</label>
            <input type="text" name="titre" required><br>

            <label for="description">Description :</label><br>
            <textarea name="description" rows="5" cols="40" required></textarea><br>

            <label for="date">Date :</label>
            <input type="date" name="date" required><br>

            <label for="heure">Heure :</label>
            <input type="time" name="heure" required><br>

            <label for="categorie">Catégorie :</label>
            <select name="categorie" id="categorie" required>
                <option value="">Sélectionnez une catégorie</option>
                <option value="Soirée">Soirée</option>
                <option value="Ventes">Ventes</option>
                <option value="Collectes">Collectes</option>
                <option value="Concours">Concours</option>
                <option value="Sport">Sport</option>
            </select>

            <label for="createur">Nom Créateur :</label>
            <input type="text" name="createur" required><br>

            <input type="submit" value="Créer">
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