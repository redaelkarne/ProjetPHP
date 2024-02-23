<?php
require('../controllers/connexionController.php')
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/ico" href="../assets/img/BDE.ico">
    <link rel="stylesheet" href="../assets/css/connexion.css">
    <title>Connexion</title>
</head>

<body>
    <div class="main">
        <img class="logo" src="../assets/img/LOGO-BDE.png" alt="">
        <h2>Connexion</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="email_connexion">Email :</label><br>
            <input type="text" name="email_connexion" required><br>

            <label for="mot_de_passe_connexion">Mot de passe :</label><br>
            <input type="password" name="mot_de_passe_connexion" required><br>

            <input id="submit" type="submit" value="Se connecter">
        </form>
        <a href="../index.php">Revenir >> </a>
    </div>
    <img class="img" src="../assets/img/gallery24.jpg" alt="Le BDE ESGI est enfin la">
</body>

</html>
<?php
$conn->close();
?>