<?php

include CHEMIN_MODELE . 'personne.php';
include CHEMIN_MODELE . 'theme.php';
include CHEMIN_MODELE . 'fournisseur.php';
include CHEMIN_MODELE . 'utilisateur.php';
include CHEMIN_MODELE . 'dossier.php';

$tab_theme = lister_theme_dans_bdd();
$tab_dossier = selectionner_utilisateur_du_dossier_dans_bdd($_SESSION['id']);

$lignes_tableau = array();

// on récupère les informations tous les dossiers

foreach ($tab_dossier as &$dossier) {
    $personne = selectionner_personne_dans_bdd($dossier->personne_id);
    $theme = selectionner_theme_dans_bdd($dossier->theme_id);
    $fournisseur = selectionner_fournisseur_dans_bdd($dossier->fournisseur_id);
    $user = selectionner_utilisateur_dans_bdd($dossier->user_id);
    
    $ligne = array(
        'id_dossier' => $dossier->dossier_id,
        'n_dossier' => $dossier->dossier_ref,
        'nom' => $personne['nom'],
        'prenom' => $personne['prenom'],
        'telephone' => $personne['tel_fixe'],
        'mail' => $personne['mail'],
        'theme' => $theme['nom'],
        'fournisseur' => $fournisseur['nom'],
        'user' => $user['ident'],
        'date' => $dossier->date_creation_d,
        'cloture' => $dossier->cloture,
    );

    array_push($lignes_tableau, $ligne);
}

// On filtre les dossiers

foreach ($lignes_tableau as $key => $ligne) {
    if (!empty($_GET['choix_numero_dossier']) && $_GET['choix_numero_dossier'] != $ligne['n_dossier']) {
        unset($lignes_tableau[$key]);
    }
    if (!empty($_GET['choix_nom']) && $_GET['choix_nom'] != $ligne['nom']) {
        unset($lignes_tableau[$key]);
    }
    if (!empty($_GET['choix_prenom']) && $_GET['choix_prenom'] != $ligne['prenom']) {
        unset($lignes_tableau[$key]);
    }
    if (!empty($_GET['choix_telephone']) && $_GET['choix_telephone'] != $ligne['telephone']) {
        unset($lignes_tableau[$key]);
    }
    if (!empty($_GET['choix_mail']) && $_GET['choix_mail'] != $ligne['mail']) {
        unset($lignes_tableau[$key]);
    }
    if (!empty($_GET['choix_theme']) && $_GET['choix_theme'] != $ligne['theme']) {
        unset($lignes_tableau[$key]);
    }
    if (!empty($_GET['choix_fournisseur']) && $_GET['choix_fournisseur'] != $ligne['fournisseur']) {
        unset($lignes_tableau[$key]);
    }

    $date_creation = substr($ligne['date'], 6, 4) . substr($ligne['date'], 3, 2) . substr($ligne['date'], 0, 2);

    if (!empty($_GET['choix_date_debut'])) {
        $date_debut = substr($_GET['choix_date_debut'], 6, 4) . substr($_GET['choix_date_debut'], 3, 2) . substr($_GET['choix_date_debut'], 0, 2);
        if ($date_creation <= $date_debut) {
            unset($lignes_tableau[$key]);
        }
    }
    if (!empty($_GET['choix_date_fin'])) {
        $date_fin = substr($_GET['choix_date_fin'], 6, 4) . substr($_GET['choix_date_fin'], 3, 2) . substr($_GET['choix_date_fin'], 0, 2);
        if ($date_creation >= $date_fin) {
            unset($lignes_tableau[$key]);
        }
    }
}

// On récupère les données de DATALIST >> les réfenrences de dossier

$all_dossier = lister_dossier_dans_bdd();
$datalist_dossier_ref = array();
$i = 0;
foreach ($all_dossier as &$dossier) {
    if (!in_array($dossier->dossier_ref, $datalist_dossier_ref)) {
        $datalist_dossier_ref[$i] = $dossier->dossier_ref;
        $i = $i + 1;
    }
}

// On récupère les données de DATALIST >> les noms de personnes

$all_personne = lister_personne_dans_bdd();
$datalist_nom = array();
$i = 0;
foreach ($all_personne as &$personne) {
    if (!in_array($personne->nom, $datalist_nom)) {
        $datalist_nom[$i] = $personne->nom;
        $i = $i + 1;
    }
}

// On récupère les données de DATALIST >> les prénoms de personnes

$datalist_prenom = array();
$i = 0;
foreach ($all_personne as &$personne) {
    if (!in_array($personne->prenom, $datalist_prenom)) {
        $datalist_prenom[$i] = $personne->prenom;
        $i = $i + 1;
    }
}

// On récupère les données de DATALIST >> les numero de tel

$datalist_tel = array();
$i = 0;
foreach ($all_personne as &$personne) {
    if (!in_array($personne->tel_port, $datalist_prenom)) {
        $datalist_tel[$i] = $personne->tel_port;
        $i = $i + 1;
    }
}

// On récupère les données de DATALIST >> les adresses mail

$datalist_mail = array();
$i = 0;
foreach ($all_personne as &$personne) {
    if (!in_array($personne->mail, $datalist_mail)) {
        $datalist_mail[$i] = $personne->mail;
        $i = $i + 1;
    }
}

// On récupère les données de DATALIST >> les adresses mail

$datalist_mail = array();
$i = 0;
foreach ($all_personne as &$personne) {
    if (!in_array($personne->mail, $datalist_mail)) {
        $datalist_mail[$i] = $personne->mail;
        $i = $i + 1;
    }
}

include CHEMIN_VUE . 'vue_suivi.php';
?>