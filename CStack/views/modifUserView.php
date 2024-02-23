<?php
require('../dbconfig.php');
require('../models/getInfoUserPost.php');

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/modifieruser.css">
    <title>Modifier Profil Utilisateur</title>
</head>

<body>
    <?php
    require('navbarView.php')
    ?>
    <div class="main">
        <h1>Modifier Profil Utilisateur</h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <input type="hidden" name="UserID" value="<?php echo $row['UserID']; ?>">

            <label for="prenom">Prénom :</label>
            <input type="text" id="prenom" name="prenom" value="<?php echo $row['Prenom']; ?>" required><br>

            <label for="nom">Nom :</label>
            <input type="text" id="nom" name="nom" value="<?php echo $row['Nom']; ?>" required><br>

            <label for="mail">Email :</label>
            <input type="email" id="mail" name="mail" value="<?php echo $row['Email']; ?>" required><br>

            <label for="mdp">Mot de passe :</label>
            <input type="password" id="mdp" name="mdp" value="<?php echo $row['MotDePasse']; ?>" required><br>

            <label for="role">Role :</label>
            <select id="role" name="role">
                <option value="Etudiant" <?php echo ($row['Role'] == 'Etudiant') ? 'selected' : ''; ?>>Etudiant</option>
                <option value="Administrateur" <?php echo ($row['Role'] == 'Administrateur') ? 'selected' : ''; ?>>Administrateur</option>
                <option value="Membre BDE" <?php echo ($row['Role'] == 'Membre BDE') ? 'selected' : ''; ?>>Membre BDE</option>
            </select><br>

            <input type="submit" name="update" value="Mettre à jour"><br>
            <a href='../page_admin.php'>Revenir >></a>
        </form>
    </div>
</body>

</html>

<?php

require('../controllers/UserController.php');

?>