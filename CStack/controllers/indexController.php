<?php


$Role= "";

// Vérifie si l'utilisateur a soumis le formulaire de connexion
if (isset($_POST["submit_connexion"])) {
    header("Location: views/connexionView.php");
    exit();
}

// Vérifie si l'utilisateur a soumis le formulaire d'inscription
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit_inscription"])) {
    header("Location: views/inscriptionView.php");
    exit();
}
