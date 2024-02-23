<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/navbar.css">
    <link rel="stylesheet" href="../assets/css/navbar.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <title>navbar</title>
</head>

<body>
    <navbar>
        <div class="right">
            <img src="./assets/img/LOGO-BDE.png" alt="" style="width:60px; height:auto;">
            <img src="../assets/img/LOGO-BDE.png" alt="" style="width:60px; height:auto;">
        </div>
        <div class="left">
            <button id="users" class="user">
                <span class="material-symbols-outlined">account_circle</span>
                <?php echo $Nom . " (" . $Role . ")"; ?>
                <span class="material-symbols-outlined">expand_more</span>
                <div id="menuderoulant" class="menu-deroulant">
                    <a href="views/monProfilView.php">Mon profil</a>
                    <hr>
                    <a href="./controllers/deconnexionController.php">Déconnexion</a>
                </div>
            </button>
        </div>


    </navbar>

    <script>
        function afficherDateDuJour() {
            var date = new Date();
            var options = {
                day: 'numeric',
                month: 'long',
                year: 'numeric'
            };
            var dateDuJour = date.toLocaleDateString('fr-FR', options);

            document.getElementById('dateDuJour').textContent = dateDuJour;
        }

        window.onload = afficherDateDuJour;

        function toggleDropdownMenu() {
            var element = document.getElementById('menuderoulant');

            if (element.style.display === "flex") {
                element.style.display = "none";
            } else {
                element.style.display = "flex";
            }
        }

        var btnuser = document.getElementById('users');

        // Ajouter l'écouteur d'événements
        btnuser.addEventListener('click', toggleDropdownMenu);
    </script>
</body>

</html>