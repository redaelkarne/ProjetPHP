<?php

require('models/getUsers.php');
// Vérifie si la requête a réussi
if (!$result) {
    echo "Erreur lors de la récupération des utilisateurs : " . $conn->error;
} else {
    // Début du tableau
    echo "<table id='myUsers'>";
    echo "<tr><th>Nom Prénom</th><th>Email</th><th>Role</th><th>Statut Email Verifié</th><th>Action</th></tr>";
    
    // Affichage des utilisateurs dans le tableau
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['Nom'] ." ". $row['Prenom'] ."</td>";
        echo "<td>" . $row['Email'] . "</td>";
        echo "<td>" . $row['Role'] . "</td>";
        echo "<td>" . $row['StatutEmailVerifie'] . "</td>";
        // Ajout des boutons pour supprimer ou modifier les utilisateurs
        echo "<td>";
        echo "<form method='post' action=''>";
        echo "<input type='hidden' name='UserID' value='" . $row['UserID'] . "'>";
        echo "<button type='submit' name='supprimer_utilisateur'><span class='material-symbols-outlined'>delete</span></button>";
        echo "</form>";
        echo "<form method='post' action='views/modifUserView.php'>";
        echo "<input type='hidden' name='UserID' value='" . $row['UserID'] . "'>";
        echo "<button type='submit' name='modifier_utilisateur'><span class='material-symbols-outlined'>edit</span></button>";
        echo "</form>";
        echo "</td>";
        echo "</tr>";
    }

    // Fin du tableau
    echo "</table>";
}

require('controllers/UserController.php')


?>
