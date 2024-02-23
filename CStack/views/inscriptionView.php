<?php
require('../dbconfig.php');
require('../controllers/inscriptionController.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/inscription.css">
    <link rel="icon" type="image/ico" href="../assets/img/BDE.ico">
    <title>Inscription</title>
</head>

<body>
    <div class="main">
        <img class="logo" src="../assets/img/LOGO-BDE.png" alt="">
        <h2>Inscription</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="nom">Nom :</label>
            <input type="text" name="nom" required>

            <label for="prenom">Prénom:</label>
            <input type="text" name="Prenom" required>

            <label for="email">Email:</label>
            <input type="text" name="Email" required>

            <label for="mot_de_passe">Mot de passe :</label>
            <input type="password" name="mot_de_passe" id="mot_de_passe" required>
            <div id="password-strength"></div>

            <input id="submit" type="submit" value="S'inscrire">
        </form>
        <a href="../index.php">Revenir >> </a>
    </div>
    <img class="img" src="../assets/img/gallery24.jpg" alt="Le BDE ESGI est enfin la">
    <script>
        document.getElementById('mot_de_passe').addEventListener('input', function() {
            var password = document.getElementById('mot_de_passe').value;
            var strength = 0;

            // Check for length
            if (password.length >= 8) {
                strength += 1;
            }

            // Check for uppercase letters
            if (password.match(/[A-Z]/)) {
                strength += 1;
            }

            // Check for lowercase letters
            if (password.match(/[a-z]/)) {
                strength += 1;
            }

            // Check for numbers
            if (password.match(/[0-9]/)) {
                strength += 1;
            }

            // Check for special characters
            if (password.match(/[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/)) {
                strength += 1;
            }

            // Update password strength meter
            var strengthText = '';
            switch (strength) {
                case 0:
                case 1:
                    strengthText = 'Très faible';
                    break;
                case 2:
                    strengthText = 'Faible';
                    break;
                case 3:
                    strengthText = 'Moyen';
                    break;
                case 4:
                    strengthText = 'Fort';
                    break;
                case 5:
                    strengthText = 'Très fort';
                    break;
            }
            document.getElementById('password-strength').innerText = 'Force du mot de passe: ' + strengthText;
        });
    </script>
</body>

</html>