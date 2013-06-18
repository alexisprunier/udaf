<?php
//Suppression des fichier pdf (dossier)
if($dossier = opendir('libs/pdf/export'))
{
    while(false !== ($fichier = readdir($dossier)))
        {
             if($fichier != '.' && $fichier != '..' && $fichier != 'dossier_vierge.pdf')
            {
                 unlink('libs/pdf/export/' . $fichier);
            }
        }
}
      
/**
 * @file      gestion_administration.php
 * @author    Jocelyn SIMON
 * @version   1.0
 * @date      3 mars 2013
 * @brief     Controleur de la page de gestion des utilisateurs par l'administrateur.
 *
 * @details    Ce fichier est la partie controleur de la vue afficher_administration.php.
 */
/** Validation des champs suivant les regles en utilisant les donnees du tableau $_GET */
if (isset($_GET["act"]) && $_GET["act"] == "ajout_user") {
    /** On veut utiliser le modele du dossier (~/modeles/utilisateur.php) */
    include CHEMIN_MODELE . 'utilisateur.php';

    // Champs    
    $ident = $_POST['id'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];

    if ($_POST['pass'] == $_POST['repass']) {
        $pass = mysql_real_escape_string($_POST['pass']);
        
        if ($_POST['administrator'] == true) {
            $administrateur = 1;
        } else {
            $administrateur = 0;
        }

        /** ajouter_utilisateur_dans_bdd() est defini dans ~/modeles/utilisateur.php */
        $id_utilisateur = ajouter_utilisateur_dans_bdd($ident, $nom, $prenom, $pass, $administrateur);
        
        /** Si la base de donnees a bien voulu ajouter le dossier (pas de doublons) */
        if (is_int($id_utilisateur)) {

            /** On transforme la chaine en entier */
            $id_utilisateur = (int) $id_utilisateur;

            /** Affichage de la confirmation d'insertion */
            
            header('location: accueil.php?module=administration&action=gestion_administration&ajout_utilisateur=ok');
        } else/** Gestion des doublons */ {
            header('location: accueil.php?module=administration&action=gestion_administration&erreur=doubleident');
        }
    } else {
        header('location: accueil.php?module=administration&action=gestion_administration&erreur=differentmdp');
    }

    /** On reaffiche le formulaire dossier */
    include CHEMIN_VUE . 'afficher_administration.php';
    
} else if (isset($_GET["act"]) && $_GET["act"] == "supp_user") {
    /** On veut utiliser le modele du dossier (~/modeles/utilisateur.php) */
    include CHEMIN_MODELE . 'utilisateur.php';

    /** ajouter_utilisateur_dans_bdd() est defini dans ~/modeles/utilisateur.php */
    $id_supp_utilisateur = supprimer_utilisateur_dans_bdd($_GET['id']);

    echo $id_supp_utilisateur;

    /** Si la base de donnees a bien voulu ajouter le dossier (pas de doublons) */
    if ($id_supp_utilisateur == true) {

        /** On transforme la chaine en entier */
        $id_supp_utilisateur = (int) $id_supp_utilisateur;

        /** Affichage de la confirmation d'insertion */
        header('location: accueil.php?module=administration&action=gestion_administration&sup_utilisateur=ok');
    } else/** Gestion des doublons */ {
        /** Changement de nom de variable (plus lisible) */
        $erreur = & $id_supp_utilisateur;

        /** On verifie que l'erreur concerne bien un doublon */
        if (23000 == $erreur[0])/** Le code d'erreur 23000 siginife "doublon" dans le standard ANSI SQL */ {
            preg_match("`Duplicate entry '(.+)' for key \d+`is", $erreur[2], $valeur_probleme);
            $valeur_probleme = $valeur_probleme[1];
            $erreurs_supp_user[] = "Erreur ajout SQL : doublon non identifie present dans la base de donnees.";
        } else {
            $erreurs_supp_user[] = sprintf("Erreur ajout SQL : cas non traite (SQLSTATE = %d).", $erreur[0]);
        }

        /** On reaffiche le formulaire dossier */
        include CHEMIN_VUE . 'vue_formulaire_admin.php';
    }
} else if (isset($_GET["act"]) && $_GET["act"] == "supp_perso") {
    /** On veut utiliser le modele du personne (~/modeles/personne.php) */
    include CHEMIN_MODELE . 'personne.php';

    /** supprimer_personne_dans_bdd() est defini dans ~/modeles/personne.php */
    $id_supp_personne = supprimer_personne_dans_bdd($_GET['id']);

    echo $id_supp_personne;

    /** Si la base de donnees a bien voulu ajouter le dossier (pas de doublons) */
    if ($id_supp_personne == true) {

        /** On transforme la chaine en entier */
        $id_supp_personne = (int) $id_supp_personne;

        /** Affichage de la confirmation d'insertion */
        header('location: accueil.php?module=administration&action=gestion_administration&sup_personne=ok');
    } else/** Gestion des doublons */ {
        /** Changement de nom de variable (plus lisible) */
        $erreur = & $id_supp_personne;

        /** On verifie que l'erreur concerne bien un doublon */
        if (23000 == $erreur[0])/** Le code d'erreur 23000 siginife "doublon" dans le standard ANSI SQL */ {
            preg_match("`Duplicate entry '(.+)' for key \d+`is", $erreur[2], $valeur_probleme);
            $valeur_probleme = $valeur_probleme[1];
            $erreurs_supp_perso[] = "Erreur ajout SQL : doublon non identifie present dans la base de donnees.";
        } else {
            $erreurs_supp_perso[] = sprintf("Erreur ajout SQL : cas non traite (SQLSTATE = %d).", $erreur[0]);
        }

        /** On reaffiche le formulaire dossier */
        include CHEMIN_VUE . 'vue_formulaire_admin.php';
    }
} else if (isset($_GET["act"]) && $_GET["act"] == "supp_dossier") {
    /** On veut utiliser le modele du dossier (~/modeles/dossier.php) */
    include CHEMIN_MODELE . 'dossier.php';
    include CHEMIN_MODELE . 'personne.php';
    include CHEMIN_MODELE . 'fichier.php';
    
   /** supprimer_dossier_dans_bdd() est defini dans ~/modeles/dossier.php */
    $id_supp_dossier = supprimer_dossier_dans_bdd($_GET['id']);


    /** Si la base de donnees a bien voulu ajouter le dossier (pas de doublons) */
    if ($id_supp_dossier == true) {

        /** On transforme la chaine en entier */
        $id_supp_dossier = (int) $id_supp_dossier;

        /** Affichage de la confirmation d'insertion */
        header('location: accueil.php?module=administration&action=gestion_administration&sup_dossier=ok');
    } else/** Gestion des doublons */ {
        /** Changement de nom de variable (plus lisible) */
        $erreur = & $id_supp_dossier;

        /** On verifie que l'erreur concerne bien un doublon */
        if (23000 == $erreur[0])/** Le code d'erreur 23000 siginife "doublon" dans le standard ANSI SQL */ {
            preg_match("`Duplicate entry '(.+)' for key \d+`is", $erreur[2], $valeur_probleme);
            $valeur_probleme = $valeur_probleme[1];
            $erreurs_supp_dossier[] = "Erreur ajout SQL : doublon non identifie present dans la base de donnees.";
        } else {
            $erreurs_supp_dossier[] = sprintf("Erreur ajout SQL : cas non traite (SQLSTATE = %d).", $erreur[0]);
        }

        /** On reaffiche le formulaire dossier */
        include CHEMIN_VUE . 'vue_formulaire_admin.php';
    }
} else if (isset($_GET["act"]) && $_GET["act"] == "supp_fournisseur") {
    /** On veut utiliser le modele du fournisseur (~/modeles/fournisseur.php) */
    include CHEMIN_MODELE . 'fournisseur.php';

    /** supprimer_fournisseur_dans_bdd() est defini dans ~/modeles/fournisseur.php */
    $id_supp_fournisseur = supprimer_fournisseur_dans_bdd($_GET['id']);

    echo $id_supp_fournisseur;

    /** Si la base de donnees a bien voulu ajouter le dossier (pas de doublons) */
    if ($id_supp_fournisseur == true) {

        /** On transforme la chaine en entier */
        $id_supp_fournisseur = (int) $id_supp_fournisseur;

        /** Affichage de la confirmation d'insertion */
        header('location: accueil.php?module=administration&action=gestion_administration&sup_fournisseur=ok');
    } else/** Gestion des doublons */ {
        /** Changement de nom de variable (plus lisible) */
        $erreur = & $id_supp_fournisseur;

        /** On verifie que l'erreur concerne bien un doublon */
        if (23000 == $erreur[0])/** Le code d'erreur 23000 siginife "doublon" dans le standard ANSI SQL */ {
            preg_match("`Duplicate entry '(.+)' for key \d+`is", $erreur[2], $valeur_probleme);
            $valeur_probleme = $valeur_probleme[1];
            $erreurs_supp_fournisseur[] = "Erreur ajout SQL : doublon non identifie present dans la base de donnees.";
        } else {
            $erreurs_supp_fournisseur[] = sprintf("Erreur ajout SQL : cas non traite (SQLSTATE = %d).", $erreur[0]);
        }

        /** On reaffiche le formulaire dossier */
        include CHEMIN_VUE . 'vue_formulaire_admin.php';
    }
} else {    
    /** On veut utiliser le modele utilisateur (~/modeles/utilisateur.php) */
    include CHEMIN_MODELE . 'utilisateur.php';
    $liste_utilisateur = lister_utilisateur_dans_bdd();
    
    /** On veut utiliser le modele fournisseur (~/modeles/fournisseur.php) */
    include CHEMIN_MODELE . 'fournisseur.php';
    $liste_fournisseur = lister_fournisseur_dans_bdd();
    
    /** On veut utiliser le modele personne (~/modeles/personne.php) */
    include CHEMIN_MODELE . 'personne.php';

      /** On veut utiliser le modele dossier (~/modeles/dossier.php) */
        include CHEMIN_MODELE . 'dossier.php';
        $liste_dossier = lister_dossier_dans_bdd();
        //Script suppression des dossiers de plus de 5 ans
        
        $date_cloture = new DateTime();
        $date_jour = new DateTime("now");
        foreach ($liste_dossier as &$dossier) {
        
        if($dossier->date_cloture != null)
        {
            $date_cloture = $date_cloture->createFromFormat("j/m/Y",$dossier->date_cloture);          
            $age_dossier = $date_cloture->diff($date_jour, TRUE);
            if($age_dossier->format('%a days') >= 1827) // 1827 correspond aux nombre de jours dans 5 ans
                
                supprimer_dossier_dans_bdd($dossier->dossier_ref);
        }
       
    }
        $liste_personne = lister_personne_dans_bdd();
    
    $lignes_tableau = array();

    // on récupère les informations tous les dossiers
    foreach ($liste_dossier as &$dossier) {

        $personne = selectionner_personne_dans_bdd($dossier->personne_id);
      
        $ligne = array(
            'date_creation' => $dossier->date_creation_d,
            'dossier_ref' => $dossier->dossier_ref,
            'personne_nom' => $personne['nom'],
            'personne_prenom' => $personne['prenom'],
        );
     //On ajoute la ligne créé ($ligne) dans le tableau ($ligne_tableau)
        array_push($lignes_tableau, $ligne);
    }
    /** On affiche a nouveau le formulaire dossier */
    include CHEMIN_VUE . 'vue_formulaire_admin.php';
}
?>