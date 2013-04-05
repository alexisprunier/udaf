<?php

// Inclusion du fichier de configuration (qui définit des constantes)
include 'config/config.php';

// Utilisation et démarrage des sessions
session_start();


// Inclusion de Pdo2, potentiellement utile partout
include CHEMIN_LIB.'pdo2.php';

// Vérifie si l'utilisateur est connecté   
function utilisateur_est_connecte() {
 
	return !empty($_SESSION['id']);
}

 






