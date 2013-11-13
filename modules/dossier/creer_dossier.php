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
include CHEMIN_MODELE . 'fichier.php';
include CHEMIN_MODELE . 'personne.php';
include CHEMIN_MODELE . 'fournisseur.php';
include CHEMIN_MODELE . 'theme.php';
include CHEMIN_MODELE . 'sstheme.php';
include CHEMIN_MODELE . 'siteweb.php';
include CHEMIN_MODELE . 'evenement.php';
include CHEMIN_MODELE . 'utilisateur.php';
include CHEMIN_MODELE . 'dossier.php';



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
        'id_evenement' => $evenement->evenement_id,
        
       
    );

//On ajoute la ligne créé ($ligne) dans le tableau ($ligne_tableau)
    array_push($tableau_evenement_user, $ligne);
}


if ($_GET["ajout"] == "site"){
    ajouter_site_dans_bdd($_POST['url'], $_POST['name'], $_SESSION['dossier_ref']);
   
    $path = "Location: /accueil.php?module=dossier&action=creer_dossier&id=". $_GET['id'] . '&from=site';
    header($path);
}

if ($_GET["ajout"] == "evenement" || $_GET["modifier"] == "evenement"){
    if(isset($_GET['ajout'])) 
        ajouter_evenement_dans_bdd(
                $_POST['date'],
                $_POST['mode'],
                $_POST['commentaire_event'],
                $_POST['liste_utilisateur'],
                $_GET['id']);
    else if(isset($_GET['modifier'])) 
        modifier_evenement_dans_bdd(
                $_POST['date'],
                $_POST['mode'],
                $_POST['commentaire_event'],
                $_POST['liste_utilisateur'],
                $_GET['event']);
    
    $path = "Location: /accueil.php?module=dossier&action=creer_dossier&id=". $_GET['id'] . '&from=event';
    header($path);
}

if ($_GET["ajout"] == "dossier" || $_GET["modifier"] == "dossier" ){
    // Choix du nouvel ID du dossier si l'on arrive sur la page creer dossier sans vouloir effectuer un ajout
    if(!isset($_GET['modifier'])) 
    { 
        unset($_SESSION['dossier_ref']);
        $dossier_max = selectionner_dossier_max_id_dans_bdd();
        $annee_en_cours = date("Y");
        if($dossier_max[0]==0) $_SESSION['dossier_ref']= $annee_en_cours . "0001";
        else $_SESSION['dossier_ref'] = $dossier_max[0]->dossier_ref+1;
    }    
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
    $commentaire_f = htmlspecialchars(stripslashes($_POST['commentaire_f']));

    // Traitement Dossier
    $reference = $_SESSION['dossier_ref'];
    $problematique = htmlspecialchars(stripslashes($_POST['txt_problematique']));   
    $cloture = $_POST['list_cloture'] == 'En cours' ? 0 : 1;
    $raison_cloture = $_POST['list_cloture'];
    $comment_cloture = $_POST['comment_cloture'];
    $date_cloture = $_POST['date_cloture'];
    $dossier_physique = $_POST['check_physique'] == 'on' ? 1 : 0;
    
     
    $createur_dossier = $_POST['list_users'];
   
    $theme = $_POST['theme'];
    $sstheme = $_POST['soustheme'];
    
    $date_crea_p = date("d/m/Y");
    $date_crea_d = date("d/m/Y");
    $date_crea_f = date("d/m/Y");
    
    
    if (isset ($_GET['modifier'])) //on met a jour en BDD 
    {
        
        $dossier_select = selectionner_dossier_dans_bdd($reference);
        if($nom != "" && prenom !="")
        {
            $tab_same_personne = selectionner_personne_dans_bdd_nom($nom, $prenom);
            $tab_same_fournisseur = selectionner_fournisseur_dans_bdd_nom($nom_f, $prenom_f, $raison_f);
            

            if(count($tab_same_personne)==0) //si la personne n'existe pas en BDD donc besoin de l'ajouter
                $id_personne = ajouter_personne_dans_bdd($date_crea_p, $nom, $prenom, $sexe, $adr_postale, $code_postal, $ville, $tel_fixe, $tel_port, $mail);
            else
            {
                $id_personne = $tab_same_personne[0]->personne_id;
                $id_personne = modifier_personne_dans_bdd($id_personne, $date_crea_p, $nom, $prenom, $sexe, $adr_postale, $code_postal, $ville, $tel_fixe, $tel_port, $mail);
                
            }
            
            if(count($tab_same_fournisseur)==0)
                $id_fournisseur = ajouter_fournisseur_dans_bdd($date_crea_f, $nom_f, $prenom_f, $raison_f, $adr_postale_f, $code_postal_f, $ville_f, $tel_f, $mail_f, $commentaire_f);
            else
            {
                $id_fournisseur = $tab_same_fournisseur[0]->fournisseur_id;
                $id_fournisseur = modifier_fournisseur_dans_bdd($id_fournisseur, $date_crea_f, $nom_f, $prenom_f, $raison_f, $adr_postale_f, $code_postal_f, $ville_f, $tel_f, $mail_f, $commentaire_f);
               
            }
            $id_dossier = modifier_dossier_dans_bdd($reference, $date_crea_d, $problematique, $cloture, $raison_cloture, $comment_cloture, $date_cloture, $dossier_physique, $createur_dossier, $theme, $sstheme, $id_fournisseur, $id_personne);
           
        }
        $path = 'Location: /accueil.php?module=dossier&action=creer_dossier&id=' . $reference . '&info=maj';
     }
     else
     {        
        $id_dossier = ajouter_dossier_dans_bdd($reference, date("d/m/Y"), "", 0, "En cours", "", "", 0, $_SESSION['id'], 0, 0, 0, 0);        
        $path = 'Location: /accueil.php?module=dossier&action=creer_dossier&id=' . $reference;
     }
         
       
    
        /** Personne et fournisseur ajoutee, je cree le dossier, ajouter_dossier_dans_bdd() est defini dans ~/modeles/dossier.php */

    
   

   
    
       
    header($path);
}
if ($_GET["ajout"] == "fichiers"){
    //if(isset($_FILES['fichier']))
    //{ 
        //On devra v�rifier l'extension && la taille
        //
        //
        // taille maximum (en octets)
        $taille_maxi = (int) 5000000; //5Mo deuxieme verification par s�curit�
        //Taille du fichier
        $taille = filesize($_FILES['fichier']['tmp_name']);
        
        //On fait un tableau contenant les extensions autoris�es.
        $extensions = array('.png', '.gif', '.jpg', '.jpeg', '.pdf','.xls','.xlsx','.doc', '.docx','.txt', '.zip');
        mkdir("uploads/".$_SESSION['dossier_ref'].'/', 0777);
        $dossier = 'uploads/'.$_SESSION['dossier_ref'].'/';
        $fichier = basename($_FILES['fichier']['name']);
        if(strlen($fichier)<50)
        {
            // r�cup�re la partie de la chaine � partir du dernier . pour conna�tre l'extension.
            $extension = strrchr($_FILES['fichier']['name'], '.');
            $type_fichier = strtoupper(substr($extension, 1));

           
            if($taille>$taille_maxi) $path = 'Location: /accueil.php?module=dossier&action=creer_dossier&id=' . $_SESSION['dossier_ref'] . '&erreur=taille';


            if((!in_array($extension, $extensions))) //Si l'extension n'est pas dans le tableau
            {
                $erreur = 'Erreur lors du l\'envoi du fichier vérifier l\'extension du fichier (autorisé seulement : png, gif, jpg, jpeg, txt ou doc...)
                    \n ou la taille (taille max : 5Mo)';
                $path = 'Location: /accueil.php?module=dossier&action=creer_dossier&id=' . $_SESSION['dossier_ref'] . '&erreur=extension';
                
            }
            else{

                $fichier = htmlentities($fichier, ENT_NOQUOTES, 'utf-8');
    
                $fichier = preg_replace('#&([A-za-z])(?:acute|cedil|circ|grave|orn|ring|slash|th|tilde|uml);#', '\1', $fichier);
                $fichier = preg_replace('#&([A-za-z]{2})(?:lig);#', '\1', $fichier); // pour les ligatures e.g. '&oelig;'
                $fichier = preg_replace('#&[^;]+;#', '', $fichier); // supprime les autres caractères
                if(move_uploaded_file($_FILES['fichier']['tmp_name'], $dossier . utf8_decode($fichier))) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
                {   

                    ajouter_fichier_dans_bdd($fichier, $type_fichier, $_SESSION['dossier_ref']);
                     $path = 'Location: /accueil.php?module=dossier&action=creer_dossier&id=' . $_SESSION['dossier_ref'] . '&from=file';
                }
                else //Sinon (la fonction renvoie FALSE).
                {
                    $path = 'Location: /accueil.php?module=dossier&action=creer_dossier&id=' . $_SESSION['dossier_ref'] . '&from=file&erreur=upload';
                }
            }
           
         
        }
        else $path = 'Location: /accueil.php?module=dossier&action=creer_dossier&id=' . $_SESSION['dossier_ref'] . '&from=file&erreur=nom';

        
    header($path);
}
if($_GET["suppr"] == "fichier"){
     /** On veut utiliser le modele du dossier (~/modeles/fichier.php) */
  
    $tab_fichier = selectionner_fichier_dans_bdd($_GET['id']);
    
    

    
    /** supprimer_fichier_dans_bdd() est defini dans ~/modeles/fichier.php */
    $id_supp_fichier = supprimer_fichier_dans_bdd($_GET['id']);

    /** Si la suppression en bdd à réussis supprimer le fichier */
    if ($id_supp_fichier == true) {
        
        /** On transforme la chaine en entier */
        //$id_supp_fichier = (int) $id_supp_fichier;
        
        /** Affichage de la confirmation de suppression */
        //header('location: accueil.php?module=administration&action=gestion_administration&sup_utilisateur=ok');
    }
   $path = 'Location: /accueil.php?module=dossier&action=creer_dossier&id=' . $tab_fichier['dossier_id'];
   header($path);   
       
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
   $path = 'Location: /accueil.php?module=dossier&action=creer_dossier&id=' . $_SESSION['dossier_ref'];
   header($path);   
       
}
if(isset($_GET['id']))
{
   
    $dossier_select = selectionner_dossier_dans_bdd($_GET['id']);
    $fournisseur = selectionner_fournisseur_dans_bdd($dossier_select['fournisseur_id']);
    $client = selectionner_personne_dans_bdd($dossier_select['personne_id']);
    $utilisateur = selectionner_utilisateur_dans_bdd($dossier_select['user_id']);
    $theme = selectionner_theme_dans_bdd($dossier_select['theme_id']);
    $sstheme = selectionner_sstheme_dans_bdd($dossier_select['soustheme_id']);
    $_SESSION['dossier_ref'] = $_GET['id'];

}
if(isset($_GET['traite']))
{
    if($_GET['traite'] === "true"){
        evenement_traite($_GET['id_event']);
    }
    else evenement_non_traite($_GET['id_event']); 
}

include CHEMIN_LIB . 'pdf/scripts/Generation_dossier.php';
include CHEMIN_VUE . 'formulaire_creation_dossier.php';
?>