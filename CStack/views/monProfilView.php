<?php
session_start();
require('../dbconfig.php');
require('../models/getInfoUser.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/ico" href="../assets/img/BDE.ico">
    <link rel="stylesheet" href="../assets/css/monprofil.css">
    <title>Mon Profil</title>
</head>

<body>
    <?php
    require('navbarView.php')
    ?>
    <div class="main">
        <h1>Votre Profil</h1>
        <form action="profil.php" method="POST">
            <div class="flex">
                <label for="mdp">Role : <?php echo $Role; ?></label>
            </div>

            <label for="prenom">Prénom :</label>
            <input type="text" id="prenom" name="prenom" value="<?php echo $row['Prenom']; ?>" required readonly>

            <label for="nom">Nom :</label>
            <input type="text" id="nom" name="nom" value="<?php echo $row['Nom']; ?>" required readonly>

            <label for="mail">Email :</label>
            <input type="email" id="mail" name="mail" value="<?php echo $row['Email']; ?>" required readonly>

            <label for="mdp">Mot de passe :</label>
            <input type="password" id="mdp" name="mdp" value="<?php echo $row['MotDePasse']; ?>" required readonly>

            <label for="MailVerif">Mail Verifié : </label>
            <input type="text" id="MailVerif" name="MailVerif" value="<?php echo $row['StatutEmailVerifie']; ?>" required readonly>

            <!-- Ajoutez un champ caché pour indiquer à quel utilisateur les données appartiennent -->
            <input type="hidden" name="user_id" value="<?php echo $row['UserID']; ?>">

            <!-- Vous pouvez ajouter un bouton pour permettre aux utilisateurs de retourner à la page précédente -->
        </form>
        <?php
        switch ($Role) {
            case 'Administrateur':
                echo "<a href='../page_admin.php'>Revenir >></a>";
                break;
            case 'Etudiant':
                echo "<a href='../page_etudiant.php'>Revenir >></a>";
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