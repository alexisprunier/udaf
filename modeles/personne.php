<?php

/**
 * @file      personne.php
 * @author    Jocelyn SIMON
 * @version   1.0
 * @date      18 fevrier 2013
 * @brief     Definit les methodes du module personne.
 *
 * @details    Ce fichier permet de concentrer les methodes du module personne.
 */

/**
 * @brief      methode de selection des personnes dans la base de donnees
 * 
 * @return    un tableau de personnes
 * 
 */
function lister_personne_dans_bdd() {
    /** on instancie une nouvelle connexion a la base de données via la classe PDO2 */
    $pdo = PDO2::getInstance();

    /** on prépare notre requète avec les valeurs passés en paramêtre */
    $requete = $pdo->prepare("SELECT * FROM personne");

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
 * @brief      methode de selection des personnes dans la base de donn�es
 * 
 * @param	   $id_client Integer Identifiant de la personne
 * @return     un tableau de donn�es d'une personne 
 * 
 */
function selectionner_personne_dans_bdd($id_personne) {
    /** on instancie une nouvelle connexion a la base de donnees via la classe PDO2 */
    $pdo = PDO2::getInstance();

    /** on prepare notre requete avec les valeurs passes en parametre */
    $requete = $pdo->prepare("SELECT * FROM personne WHERE personne_id = :id_personne");

    $requete->bindValue(':id_personne', $id_personne);

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
 * @brief      methode de suppression des personnes dans la base de donnees
 * 
 * @param	   $id_user Integer Identifiant de la personne
 * 
 */
function supprimer_personne_dans_bdd($id_personne) {
    /** on instancie une nouvelle connexion a la base de donnees via la classe PDO2 */
    $pdo = PDO2::getInstance();

    /** on prépare notre requete avec les valeurs passés en parametre */
    $requete = $pdo->prepare("DELETE FROM personne where personne_id = :id_personne");

    $requete->bindValue(':id_personne', $id_personne);
    $requete->execute();

    if ($result = $requete->fetch(PDO::FETCH_ASSOC)) {

        print_r($result);
        $requete->closeCursor();
        return $result;
    }
    return $requete->errorInfo();
}

?>