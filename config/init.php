<?php

// Inclusion du fichier de configuration (qui d�finit des constantes)
include 'config/config.php';

// Utilisation et d�marrage des sessions
session_start();


// Inclusion de Pdo2, potentiellement utile partout
include CHEMIN_LIB.'pdo2.php';

// V�rifie si l'utilisateur est connect�   
function utilisateur_est_connecte() {
 
	return !empty($_SESSION['id']);
}

 






