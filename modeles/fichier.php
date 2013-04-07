<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


function lister_fichier_dans_bdd() {
    /** on instancie une nouvelle connexion a la base de donnees via la classe PDO2 */
    $pdo = PDO2::getInstance();

    /** on prepare notre requete avec les valeurs passes en parametre */
    $requete = $pdo->prepare("SELECT * FROM fichier");

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

function ajouter_fichier_dans_bdd($nom, $extension,$dossier_id) {
    $pdo = PDO2::getInstance();
    $requete = $pdo->prepare("INSERT INTO `fichier`(`nom`, `type_fichier`,`dossier_id`) 
        VALUES (:nom, :extension,:dossier_id);");

    $requete->bindValue(':nom', $nom);
    $requete->bindValue(':extension', $extension);
    $requete->bindValue(':dossier_id', $dossier_id);
    
    if ($requete->execute()) {
        /** si l'insertion c'est bien passe la methode retourne le dernier id du fichier inseré; */
       
        return $pdo->lastInsertId();
    }
    /** sinon elle retourne une erreur */
    return $requete->errorInfo();
}
?>
