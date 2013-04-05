<?php

/**
 * @file      fournisseur.php
 * @author    Jocelyn SIMON
 * @version   1.0
 * @date      18 fevrier 2013
 * @brief     Definit les methodes du module fournisseur.
 *
 * @details    Ce fichier permet de concentrer les methodes du module fournisseur.
 */

/**
 * @brief      methode de selection des fournisseurs dans la base de donnees
 * 
 * @return    un tableau de fournisseurs 
 * 
 */
function lister_fournisseur_dans_bdd() {
    /** on instancie une nouvelle connexion a la base de donnees via la classe PDO2 */
    $pdo = PDO2::getInstance();

    /** on prepare notre requete avec les valeurs passes en parametre */
    $requete = $pdo->prepare("SELECT * FROM fournisseur");

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
 * @brief      methode de selection des fournisseurs dans la base de donn�es
 * 
 * @param	   $id_fournisseur Integer Identifiant du fournisseur
 * @return     un tableau de donnees d'un fournisseur 
 * 
 */
function selectionner_fournisseur_dans_bdd($id_fournisseur) {
    /** on instancie une nouvelle connexion a la base de donnees via la classe PDO2 */
    $pdo = PDO2::getInstance();

    /** on prepare notre requete avec les valeurs passes en parametre */
    $requete = $pdo->prepare("SELECT * FROM fournisseur WHERE fournisseur_id = :id_fournisseur");

    $requete->bindValue(':id_fournisseur', $id_fournisseur);

    /** j'execute cette requete */
    $requete->execute();

    if ($result = $requete->fetch(PDO::FETCH_ASSOC)) {

        $requete->closeCursor();
        return $result;
    }

    /** je retourne un tableau d'objet theme */
    return $tab;
}

/**
 * @brief      methode de suppression des fournisseurs dans la base de donnees
 * 
 * @param	   $id_user Integer Identifiant du fournisseur
 * 
 */
function supprimer_fournisseur_dans_bdd($id_fournisseur) {
    /** on instancie une nouvelle connexion a la base de donnees via la classe PDO2 */
    $pdo = PDO2::getInstance();

    /** on prépare notre requete avec les valeurs passés en parametre */
    $requete = $pdo->prepare("DELETE FROM fournisseur where fournisseur_id = :id_fournisseur");

    $requete->bindValue(':id_fournisseur', $id_fournisseur);
    $requete->execute();

    if ($result = $requete->fetch(PDO::FETCH_ASSOC)) {

        print_r($result);
        $requete->closeCursor();
        return $result;
    }
    return $requete->errorInfo();
}

?>