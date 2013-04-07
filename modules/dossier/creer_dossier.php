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
$tab_evenement = lister_evenement_dans_bdd();
$tab_fichier = lister_fichier_dans_bdd();


// Choix du nouvel ID du dossier
unset($_SESSION['dossier_ref']);
$count_id = generation_reference();
$date = date('Y');
$ref = sprintf("%04d", $count_id);
$_SESSION['dossier_ref'] = $date . "" . $ref + 1;

if ($_GET["ajout"] == "site"){
    
    ajouter_site_dans_bdd($_POST['url'],$_POST['name'], $_SESSION['dossier_ref']);
}

else if ($_GET["ajout"] == "evenement"){
    ajouter_evenement_dans_bdd(
            $_POST['date'],
            $_POST['mode'],
            $_POST['comment'],
            $_POST['liste_utilisateur'],
            $_SESSION['dossier_ref']);
}

else if ($_GET["ajout"] == "fichiers"){
    //if(isset($_FILES['fichier']))
    { 
        //On devra vérifier l'extension && la taille
        //
        //
        // taille maximum (en octets)
        $taille_maxi = 5000000; //5Mo deuxieme verification par sécurité
        //Taille du fichier
        $taille = filesize($_FILES['fichier']['tmp_name']);
        //On fait un tableau contenant les extensions autorisées.
        $extensions = array('.png', '.gif', '.jpg', '.jpeg', '.pdf','.xls','.xlsx','.doc', '.docx','.txt');
        $dossier = 'uploads/';
        $fichier = basename($_FILES['fichier']['name']);
        // récupère la partie de la chaine à partir du dernier . pour connaître l'extension.
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
    }
}
else if($_GET["suppr"] === "fichier"){
     /** On veut utiliser le modele du dossier (~/modeles/fichier.php) */
  

    /** supprimer_fichier_dans_bdd() est defini dans ~/modeles/fichier.php */
    $id_supp_fichier = supprimer_fichier_dans_bdd($_GET['id']);

    /** Si la base de donnees a bien voulu ajouter le dossier (pas de doublons) */
    if ($id_supp_fichier == true) {

        /** On transforme la chaine en entier */
        $id_supp_fichier = (int) $id_supp_fichier;

        /** Affichage de la confirmation de suppression */
        //header('location: accueil.php?module=administration&action=gestion_administration&sup_utilisateur=ok');
    } 
      
       
}


include CHEMIN_VUE . 'formulaire_creation_dossier.php';
?>