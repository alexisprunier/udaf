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
include CHEMIN_MODELE . 'utilisateur.php';

$tab_personne = lister_personne_dans_bdd();
$tab_fournisseur = lister_fournisseur_dans_bdd();
$tab_theme = lister_theme_dans_bdd();
$tab_sstheme = lister_sstheme_dans_bdd();
$tab_site = lister_site_dans_bdd();
$tab_evenement = lister_evenement_dans_bdd();
$tab_user = lister_utilisateur_dans_bdd();

// Choix du nouvel ID du dossier
unset($_SESSION['dossier_ref']);
$dossier_max = selectionner_dossier_max_id_dans_bdd();
$_SESSION['dossier_ref'] = $dossier_max[0]->dossier_ref+1;

if ($_GET["ajout"] == "site"){
    ajouter_site_dans_bdd($_POST['url'], $_POST['name'], $_SESSION['dossier_ref']);
    header('Location: /accueil.php?module=dossier&action=creer_dossier');
}

if ($_GET["ajout"] == "evenement"){
    ajouter_evenement_dans_bdd(
            $_POST['date'],
            $_POST['mode'],
            $_POST['commentaire_event'],
            $_POST['liste_utilisateur'],
            $_SESSION['dossier_ref']);
    header('Location: /accueil.php?module=dossier&action=creer_dossier');
}

if ($_GET["ajout"] == "dossier"){
    
    // Personne    
    $sexe = $_POST['sexe'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $adr_postale = $_POST['adresse'];
    $code_postal = $_POST['codepostal'];
    $ville = $_POST['ville'];
    $mail = $_POST['mail'];
    $tel_fixe = $_POST['telephone'];
    $tel_port = $_POST['mobile'];

    // Fournisseur
    $nom_f = $_POST['nom_f'];
    $prenom_f = $_POST['prenom_f'];
    $raison_f = $_POST['raison_sociale_f'];
    $adr_postale_f = $_POST['adresse_f'];
    $code_postal_f = $_POST['codepostal_f'];
    $ville_f = $_POST['ville_f'];
    $mail_f = $_POST['mail_f'];
    $tel_f = $_POST['telephone_f'];
    $commentaire_f = mysql_escape_string($_POST['commentaire_f']); //mysql_escape_string : prevenir injection sql
    
    // Traitement Dossier
    $reference = $_SESSION['dossier_ref'];
    $problematique = mysql_escape_string($_POST['txt_problematique']); //mysql_escape_string : prevenir injection sql
    $cloture = $_POST['list_cloture'] == 'encours' ? 0 : 1;
    $raison_cloture = $_POST['list_cloture'];
    $comment_cloture = $_POST['comment_cloture'];
    $date_cloture = $_POST['date_cloture'];
    $dossier_physique = $_POST['check_physique'];
    $createur_dossier = $_POST['liste_user'];
    $theme = $_POST['theme'];
    $sstheme = $_POST['soustheme'];
    
    $date_crea_p = date("d/m/Y");
    $date_crea_d = date("d/m/Y");
    $date_crea_f = date("d/m/Y");

    /** ajouter_personne_dans_bdd() et ajouter_fournisseur_dans_bdd() sont defini dans ~/modeles/dossier.php */
    $id_personne = ajouter_personne_dans_bdd($date_crea_p, $nom, $prenom, $sexe, $adr_postale, $code_postal, $ville, $tel_fixe, $tel_port, $mail);
    $id_fournisseur = ajouter_fournisseur_dans_bdd($date_crea_f, $nom_f, $prenom_f, $raison_f, $adr_postale_f, $code_postal_f, $ville_f, $tel_f, $mail_f, $commentaire_f);
    
    /** Personne et fournisseur ajoutee, je cree le dossier, ajouter_dossier_dans_bdd() est defini dans ~/modeles/dossier.php */
    $id_dossier = ajouter_dossier_dans_bdd($reference, $date_crea_d, $problematique, $cloture, $raison_cloture, $comment_cloture, $date_cloture, $dossier_physique, $createur_dossier, $theme, $sstheme, $id_fournisseur, $id_personne);
    
    /** Si la base de donnees a bien voulu ajouter le dossier (pas de doublons) */
    if ($id_personne == true && $id_dossier == true && $id_fournisseur == true) {

        /** On transforme la chaine en entier */
        $id_personne = (int) $id_personne;
        $id_dossier = (int) $id_dossier;
        $id_fournisseur = (int) $id_fournisseur;
        
        /** Destruction des sessions car dossier crée
        unset($_SESSION['dossier_ref']);
        unset($_SESSION['sexe']);
        unset($_SESSION["nom_p"]);
        unset($_SESSION["prenom_p"]);
        unset($_SESSION["adresse_p"]);
        unset($_SESSION["cp_p"]);
        unset($_SESSION["ville_p"]);
        unset($_SESSION["mail_p"]);
        unset($_SESSION["fix_p"]);
        unset($_SESSION["mobil_p"]);
        unset($_SESSION["nom_f"]);
        unset($_SESSION["prenom_f"]);
        unset($_SESSION["raison_sociale_f"]);
        unset($_SESSION["adresse_f"]);
        unset($_SESSION["codepostal_f"]);
        unset($_SESSION["ville_f"]);
        unset($_SESSION["mail_f"]);
        unset($_SESSION["telephone_f"]);
        unset($_SESSION["commentaire_f"]);
        unset($_SESSION["problematique"]);**/

        /** Affichage de la confirmation d'insertion */
        //header('location: accueil.php?module=dossier&action=creer_dossier');
    } else/** Gestion des doublons */ {
        /** Changement de nom de variable (plus lisible) */
        $erreur = & $id_dossier;

        /** On verifie que l'erreur concerne bien un doublon */
        if (23000 == $erreur[0])/** Le code d'erreur 23000 siginife "doublon" dans le standard ANSI SQL */ {
            preg_match("`Duplicate entry '(.+)' for key \d+`is", $erreur[2], $valeur_probleme);
            $valeur_probleme = $valeur_probleme[1];
            $erreurs_dossier[] = "Erreur ajout SQL : doublon non identifie present dans la base de donnees.";
        } else {
            $erreurs_dossier[] = sprintf("Erreur ajout SQL : cas non traite (SQLSTATE = %d).", $erreur[0]);
        }
    }
}

include CHEMIN_VUE . 'formulaire_creation_dossier.php';
?>