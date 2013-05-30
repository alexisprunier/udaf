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
 * @brief      Permet l'ajout d'une personne dans la base de donnees
 * 
 * @param	$sex				integer sexe
 * @param	$nom				string nom du client
 * @param	$prenom				string prenom du client
 * @param	$adr_postale		string adresse du client
 * @param	$cp					integer code postal du client
 * @param	$ville				string lieu de vie du client
 * @param	$mail				string mail du client
 * @param	$tel_fixe			integer telephone du client
 * @param	$tel_port			integer portable du client
 * @return   True en cas de succes, False en cas d'echec
 */
function ajouter_personne_dans_bdd($date_crea_p, $nom, $prenom, $sexe, $adr_postale, $code_postal, $ville, $tel_fixe, $tel_port, $mail) {
    $pdo = PDO2::getInstance();

    $requete = $pdo->prepare("INSERT INTO personne SET
            date_creation_p = :date_creation_p,
            nom = :nom,
            prenom = :prenom,
            sexe = :sexe,
            adr_postale = :adr_postale,
            code_postal = :code_postal,
            ville = :ville,
            tel_fixe = :tel_fixe,
            tel_port = :tel_port,
            mail = :mail");

    $requete->bindValue(':date_creation_p', $date_crea_p);
    $requete->bindValue(':nom', $nom);
    $requete->bindValue(':prenom', $prenom);
    $requete->bindValue(':sexe', $sexe);
    $requete->bindValue(':adr_postale', $adr_postale);
    $requete->bindValue(':code_postal', $code_postal);
    $requete->bindValue(':ville', $ville);
    $requete->bindValue(':tel_fixe', $tel_fixe);
    $requete->bindValue(':tel_port', $tel_port);
    $requete->bindValue(':mail', $mail);

    if ($requete->execute()) {
        /** si l'insertion c'est bien passe la methode retourne le dernier id de la news inseree */
        return $pdo->lastInsertId();
    }
    /** sinon elle retourne une erreur */
    return $requete->errorInfo();
}
/**
 * @brief      methode de selection de la personne du dossier dans la base de donn�es
 * 
 * @param	   $id_personne Integer Identifiant du client
 * @return     un tableau de donn�es d'un client 
 * 
 */
function selectionner_personne_du_dossier_dans_bdd($personne_id) {
    /** on instancie une nouvelle connexion a la base de donnees via la classe PDO2 */
    $pdo = PDO2::getInstance();

    /** on prepare notre requete avec les valeurs pass�s en parametre */
    $requete = $pdo->prepare("SELECT * FROM dossier WHERE personne_id = :personne_id");

    $requete->bindValue(':personne_id', $personne_id);

    /** j'execute cette requete */
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
function modifier_personne_dans_bdd($personne_id, $date_crea_p, $nom, $prenom, $sexe, $adr_postale, $code_postal, $ville, $tel_fixe, $tel_port, $mail) {
    $pdo = PDO2::getInstance();

    $requete = $pdo->prepare("UPDATE personne SET
            date_creation_p = :date_creation_p,
            nom = :nom,
            prenom = :prenom,
            sexe = :sexe,
            adr_postale = :adr_postale,
            code_postal = :code_postal,
            ville = :ville,
            tel_fixe = :tel_fixe,
            tel_port = :tel_port,
            mail = :mail
                WHERE personne_id = :personne_id");

    $requete->bindValue(':date_creation_p', $date_crea_p);
    $requete->bindValue(':nom', $nom);
    $requete->bindValue(':prenom', $prenom);
    $requete->bindValue(':sexe', $sexe);
    $requete->bindValue(':adr_postale', $adr_postale);
    $requete->bindValue(':code_postal', $code_postal);
    $requete->bindValue(':ville', $ville);
    $requete->bindValue(':tel_fixe', $tel_fixe);
    $requete->bindValue(':tel_port', $tel_port);
    $requete->bindValue(':mail', $mail);
    $requete->bindValue(':personne_id', $personne_id);

    if ($requete->execute()) {
        /** si l'insertion c'est bien passe la methode retourne le dernier id de la news inseree */
        return $personne_id;
    }
    /** sinon elle retourne une erreur */
    return $requete->errorInfo();
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
function selectionner_personne_dans_bdd_nom($nom, $prenom) {
    /** on instancie une nouvelle connexion a la base de donnees via la classe PDO2 */
    $pdo = PDO2::getInstance();

    /** on prepare notre requete avec les valeurs passes en parametre */
    $requete = $pdo->prepare("SELECT * FROM personne WHERE nom = :nom AND prenom = :prenom");

    $requete->bindValue(':nom', $nom);
    $requete->bindValue(':prenom', $prenom);

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