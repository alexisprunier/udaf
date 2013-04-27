<?php

/**
 * @file      evenement.php
 * @author    Anthony HIVERT
 * @version   1.0
 * @date      18 fevrier 2013
 * @brief     Definit les methodes du module evenement.
 *
 * @details    Ce fichier permet de concentrer les methodes du module evenement.
 */

/**
 * @brief      methode de selection des evenements dans la base de donnees
 * 
 * @return    un tableau d'evenements
 * 
 */
function lister_evenement_dans_bdd() {
    /** on instancie une nouvelle connexion a la base de donnees via la classe PDO2 */
    $pdo = PDO2::getInstance();

    /** on prepare notre requete avec les valeurs passes en parametre */
    $requete = $pdo->prepare("SELECT * FROM evenement");

    /** j'execute cette requète */
    $requete->execute();
    /** j'initialise un tableau */
    $tab = array();

    /** pour chaque resultat retourné je l'ajoute dans mon tableau */
    while ($result = $requete->fetch(PDO::FETCH_OBJ)) {

        array_push($tab, $result);
    }

    $requete->closeCursor();

    /** je retourne un tableau d'objet news */
    return $tab;
}

/**
 * @brief      Permet l'ajout d'un site dans la base de donn&eacute;es
 * 
 * @param	$lien				varchar lien du site
 * @param	$dossier_id			varchar dossier lie au site
 * @return   True en cas de succes, False en cas d'echec
 */
function ajouter_evenement_dans_bdd($date, $mode_contact, $comm_event, $user_id, $dossier_id) {
    $pdo = PDO2::getInstance();

    $requete = $pdo->prepare("INSERT INTO evenement SET
				date_event = :date,
				mode_contact = :mode_contact,
				traite = :traite,
				comm_event = :comm_event,
				user_id = :user_id,
				dossier_id = :dossier_id;");

    $requete->bindValue(':date', $date);
    $requete->bindValue(':mode_contact', $mode_contact);
    $requete->bindValue(':traite', 0);
    $requete->bindValue(':comm_event', $comm_event);
    $requete->bindValue(':user_id', $user_id);
    $requete->bindValue(':dossier_id', $dossier_id);

    if ($requete->execute()) {
        /** si l'insertion c'est bien passe la methode retourne le dernier id de l'utilisateur inser&eacute; */
        return $pdo->lastInsertId();
    }
    /** sinon elle retourne une erreur */
    return $requete->errorInfo();
}
function evenement_traite($evenement_id)
{
    $pdo = PDO2::getInstance();

    $requete = $pdo->prepare("UPDATE INTO evenement SET
                        traite = :traite                        
                                WHERE
                                evenement_id = :evenement_id");

    $requete->bindValue(':traite', 1);
    $requete->bindValue(':evenement_id', $evenement_id);
   

	$requete->execute();
         
        return $evenement_id;
        
   
}
function evenement_non_traite($evenement_id)
{
    $pdo = PDO2::getInstance();

    $requete = $pdo->prepare("INSERT INTO evenement SET
                        traite = :traite                        
                                WHERE
                                evenement_id = :evenement_id");

	$requete->bindValue(':traite', 0);
    $requete->bindValue(':evenement_id', $evenement_id);
   

	$result = $requete->execute();

	return $evenement_id;
}
?>