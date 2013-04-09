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
include CHEMIN_MODELE . 'fichier.php';


$tab_personne = lister_personne_dans_bdd();
$tab_fournisseur = lister_fournisseur_dans_bdd();
$tab_theme = lister_theme_dans_bdd();
$tab_sstheme = lister_sstheme_dans_bdd();
$tab_site = lister_site_dans_bdd();
$tab_fichier = lister_fichier_dans_bdd();
$tab_evenement = lister_evenement_dans_bdd();
$tab_user = lister_utilisateur_dans_bdd();


//Permet d'avoir un tableau contenant le identifiant de l'utilisateur en fonction de l'evenement
$tableau_evenement_user = array();

// on récupère les informations tous les dossiers
foreach ($tab_evenement as &$evenement) {
    
    $utilisateur = selectionner_utilisateur_dans_bdd($evenement->user_id);

    $ligne = array(
        'dossier_id' => $evenement->dossier_id,
        'date_evenement' => $evenement->date_event,
        'mode_contact' => $evenement->mode_contact,
        'utilisateur' => $utilisateur['ident'],
        'commentaire' => $evenement->comm_event,
        'traite' => $evenement->traite,
        
       
    );
//echo $ligne['traite'];
//On ajoute la ligne créé ($ligne) dans le tableau ($ligne_tableau)
    array_push($tableau_evenement_user, $ligne);
}


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

echo '<pre>'.print_r($_POST,true).'</pre>';

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

    }
}
if ($_GET["ajout"] == "fichiers"){
    //if(isset($_FILES['fichier']))
    //{ 
        //On devra v�rifier l'extension && la taille
        //
        //
        // taille maximum (en octets)
        $taille_maxi = 5000000; //5Mo deuxieme verification par s�curit�
        //Taille du fichier
        $taille = filesize($_FILES['fichier']['tmp_name']);
        //On fait un tableau contenant les extensions autoris�es.
        $extensions = array('.png', '.gif', '.jpg', '.jpeg', '.pdf','.xls','.xlsx','.doc', '.docx','.txt');
        mkdir("uploads/".$_SESSION['dossier_ref'].'/', 0777);
        $dossier = 'uploads/'.$_SESSION['dossier_ref'].'/';
        $fichier = basename($_FILES['fichier']['name']);
        // r�cup�re la partie de la chaine � partir du dernier . pour conna�tre l'extension.
        $extension = strrchr($_FILES['fichier']['name'], '.');
        //Ensuite on teste tout
    
        
         if((!in_array($extension, $extensions)) || ($taille>$taille_maxi)) //Si l'extension n'est pas dans le tableau
        {
            $erreur = 'Erreur lors du l\'envoi du fichier vérifier l\'extension du fichier (autorisé seulement : png, gif, jpg, jpeg, txt ou doc...)
                \n ou la taille (taille max : 5Mo)';
            echo $erreur;
        }
        else{
            
            $fichier = strtr($fichier,
                'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ',
                'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy'); 
            //On remplace les lettres accentutées par les non accentuées dans $fichier.
            //Et on récupère le résultat dans fichier

            //En dessous, il y a l'expression régulière qui remplace tout ce qui n'est pas une lettre non accentuées ou un chiffre
            //dans $fichier par un underscore "_" et qui place le résultat dans $fichier.
            $fichier = preg_replace('/([^.a-z0-9]+)/i', '_', $fichier);
            if(move_uploaded_file($_FILES['fichier']['tmp_name'], $dossier . $fichier)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
            {   
                $fichier = strstr($fichier,'.',true); //enleve l'extension du nom
                ajouter_fichier_dans_bdd($fichier, $extension, $_SESSION['dossier_ref']);
            }
            else //Sinon (la fonction renvoie FALSE).
            {
                 echo 'Echec de l\'upload !';
            }
        }
        header('Location: /accueil.php?module=dossier&action=creer_dossier');
}
if($_GET["suppr"] === "fichier"){
     /** On veut utiliser le modele du dossier (~/modeles/fichier.php) */
  
    $tab_fichier = selectionner_fichier_dans_bdd($_GET['id']);
    
    $nom_fic = $tab_fichier['nom'].$tab_fichier['type_fichier'];

    unlink("uploads/".$_SESSION['dossier_ref'].'/'.$nom_fic);
    /** supprimer_fichier_dans_bdd() est defini dans ~/modeles/fichier.php */
    $id_supp_fichier = supprimer_fichier_dans_bdd($_GET['id']);

    /** Si la suppression en bdd à réussis supprimer le fichier */
    if ($id_supp_fichier == true) {
        
        /** On transforme la chaine en entier */
        $id_supp_fichier = (int) $id_supp_fichier;
        
        /** Affichage de la confirmation de suppression */
        //header('location: accueil.php?module=administration&action=gestion_administration&sup_utilisateur=ok');
    } 
   header('Location: /accueil.php?module=dossier&action=creer_dossier');   
       
}
if($_GET["suppr"] === "site"){
     /** On veut utiliser le modele du dossier (~/modeles/fichier.php) */
  

    /** supprimer_fichier_dans_bdd() est defini dans ~/modeles/fichier.php */
    $id_supp_site = supprimer_site_dans_bdd($_GET['id']);

    /** Si la base de donnees a bien voulu ajouter le dossier (pas de doublons) */
    if ($id_supp_site == true) {

        /** On transforme la chaine en entier */
        $id_supp_site = (int) $id_supp_site;

        /** Affichage de la confirmation de suppression */
        //header('location: accueil.php?module=administration&action=gestion_administration&sup_utilisateur=ok');
    } 
   header('Location: /accueil.php?module=dossier&action=creer_dossier');   
       
}


include CHEMIN_VUE . 'formulaire_creation_dossier.php';
?>