<?php
/**
 * @file      creer_dossier.php
 * @author    Alexis PRUNIER
 * @version   1.0
 * @date      30 janvier 2012
 * @brief     Controleur de la page d'ajout d'un dossier.
 *
 * @details    Ce fichier est la partie controleur de la vue formulaire_creation_dossier.php.
 */
include CHEMIN_MODELE . 'dossier.php';
include CHEMIN_MODELE . 'personne.php';
include CHEMIN_MODELE . 'fournisseur.php';
include CHEMIN_MODELE . 'theme.php';
include CHEMIN_MODELE . 'sstheme.php';
include CHEMIN_MODELE . 'site.php';
include CHEMIN_MODELE . 'evenement.php';

$tab_personne = lister_personne_dans_bdd();
$tab_fournisseur = lister_fournisseur_dans_bdd();
$tab_theme = lister_theme_dans_bdd();
$tab_sstheme = lister_sstheme_dans_bdd();
$tab_site = lister_site_dans_bdd();
$tab_evenement = lister_evenement_dans_bdd();

// Choix du nouvel ID du dossier
unset($_SESSION['dossier_ref']);
$count_id = generation_reference();
$date = date('Y');
$ref = sprintf("%04d", $count_id);
$_SESSION['dossier_ref'] = $date . "" . $ref + 1;

if ($_GET["ajout"] == "site"){
    ajouter_site_dans_bdd($_POST['lien'], $_SESSION['dossier_ref']);
}

if ($_GET["ajout"] == "evenement"){
    ajouter_evenement_dans_bdd(
            $_POST['date'],
            $_POST['mode'],
            $_POST['comment'],
            $_POST['liste_utilisateur'],
            $_SESSION['dossier_ref']);
}



include CHEMIN_VUE . 'formulaire_creation_dossier.php';
?>