<?php
include CHEMIN_MODELE . 'utilisateur.php';

$tab_utilisateur = lister_utilisateur_dans_bdd();

include CHEMIN_VUE . 'formulaire_creation_evenement.php';
?>
