<?php

/**
 * @file      visualiser_utilisateur.php
 * @author    Jocelyn SIMON
 * @version   1.0
 * @date      16 octobre 2012
 * @brief     Contr�leur de la page visualisation d'un utilisateur.
 *
 * @details    Ce fichier est la partie controleur de la vue vue_voir_utilisateur.php.
 */
/** Validation des champs suivant les regles en utilisant les donnees du tableau $_GET */
if (isset($_GET["act"]) && $_GET["act"] == "modif_user") {
    /** On veut utiliser le modele du materiel (~/modeles/materiel.php) */
    include CHEMIN_MODELE . 'utilisateur.php';

    if ($_POST['user_pass'] == $_POST['user_repass']) {
        $pass = mysql_real_escape_string($_POST['user_pass']);
        if ($_POST['user_admin'] == true) {
            $admin = 1;
        } else {
            $admin = 0;
        }

        /** modifier_materiel() est defini dans ~/modeles/materiel.php */
        $id_modif_user = modifier_utilisateur_dans_bdd($_GET['id'], $_POST['user_ident'], $_POST['user_nom'], $_POST['user_prenom'], $pass, $admin);

        /** Si la base de donn�es a bien voulu ajouter le materiel (pas de doublons) */
        if ($id_modif_user == true) {
            /** Affichage de la confirmation d'insertion */
            header('location: accueil.php?module=administration&action=gestion_administration&upd_user=ok');
        } else/** Gestion des doublons */ {
            /** Changement de nom de variable (plus lisible) */
            $erreur = & $id_materiel;

            /** On v�rifie que l'erreur concerne bien un doublon */
            if (23000 == $erreur[0])/** Le code d'erreur 23000 siginife "doublon" dans le standard ANSI SQL */ {
                preg_match("`Duplicate entry '(.+)' for key \d+`is", $erreur[2], $valeur_probleme);
                $valeur_probleme = $valeur_probleme[1];
                $erreurs_utilisateur[] = "Erreur ajout SQL : doublon non identifi� pr�sent dans la base de donn�es.";
            } else {
                $erreurs_utilisateur[] = sprintf("Erreur ajout SQL : cas non trait� (SQLSTATE = %d).", $erreur[0]);
            }

        }
    } else {
         header('location: accueil.php?module=administration&action=gestion_administration&erreur=differentmdp');
        
    }
    
    /** On reaffiche le formulaire materiel */
    include CHEMIN_VUE . 'vue_voir_utilisateur.php';

} else {
    /** On veut utiliser le mod�le des utilisateurs (~/modules/utilisateur.php) */
    include CHEMIN_MODELE . 'utilisateur.php';

    /** selectionner_utilisateur_dans_bdd() est d�fini dans ~/modules/utilisateur.php */
    $id_select_utilisateur = selectionner_utilisateur_dans_bdd($_GET['id']);

    /** on teste la taille de notre tableau pour savoir si on a un utilisateur */
    if (sizeof($id_select_utilisateur) != 0) {
        include CHEMIN_VUE . 'vue_voir_utilisateur.php';
    } else {
        /** si on n'a aucun materiel on appel la page "aucun_contenu.php" */
        include CHEMIN_VUE_GLOBALE . 'aucun_contenu.php';
    }
}
?>

