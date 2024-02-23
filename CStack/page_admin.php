<?php

session_start();
require('dbconfig.php');
require('models/getRole.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/ico" href="assets/img/BDE.ico">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="assets/css/pageadmin.css">
    <title>Accueil</title>
</head>

<body>
    <?php
    require('views/navbarView.php');
    ?>
    <div class="navigate">
        <div class="center">
            <button onclick="SwitchToEvents()"><span class="material-symbols-outlined">event</span>Events</button>
            <button onclick="SwitchToMesEvents()"><span class="material-symbols-outlined">event_available</span>Mes Events</button>
            <button onclick="SwitchToFavoris()"><span class="material-symbols-outlined">favorite</span>Favoris</button>
            <button onclick="SwitchToUsers()"><span class="material-symbols-outlined">group</span>Utilisateurs</button>
        </div>
    </div>
    <div id="Events" class="Events">
        <div class="title">
            <h2>Les Events</h2>
            <a href="views/CreateEventView.php"><span class="material-symbols-outlined">add</span>Nouvel Event</a>
        </div>
        <hr>
        <?php
        require('views/DisplayEvents.php');
        ?>
    </div>
    <div id="MesEvents" class="MesEvents">
        <h2>Mes Events</h2>
        <hr>
        <?php
        require('views/MesEvents.php');
        ?>
    </div>
    <div id="Favoris" class="Favoris">
        <h2>Mes Events Favoris</h2>
        <hr>
        <?php
        require('views/ListEnvies.php');
        ?>
    </div>
    <div id="Utilisateurs" class="Utilisateurs">
        <h2>Listes des Users</h2>
        <hr>
        <?php
        require('views/UsersView.php');
        ?>
    </div>
    <script>
        function SwitchToEvents() {
            document.getElementById('Events').style.display = 'block';
            document.getElementById('MesEvents').style.display = 'none';
            document.getElementById('Favoris').style.display = 'none';
            document.getElementById('Utilisateurs').style.display = 'none';
        }

        document.addEventListener('DOMContentLoaded', function() {
            SwitchToEvents();
        });

        function SwitchToMesEvents() {
            document.getElementById('Events').style.display = 'none';
            document.getElementById('MesEvents').style.display = 'block';
            document.getElementById('Favoris').style.display = 'none';
            document.getElementById('Utilisateurs').style.display = 'none';
        }

        function SwitchToFavoris() {
            document.getElementById('Events').style.display = 'none';
            document.getElementById('MesEvents').style.display = 'none';
            document.getElementById('Favoris').style.display = 'block';
            document.getElementById('Utilisateurs').style.display = 'none';
        }

        function SwitchToUsers() {
            document.getElementById('Events').style.display = 'none';
            document.getElementById('MesEvents').style.display = 'none';
            document.getElementById('Favoris').style.display = 'none';
            document.getElementById('Utilisateurs').style.display = 'block';
        }
    </script>
</body>