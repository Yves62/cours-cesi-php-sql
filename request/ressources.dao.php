<?php
require'config/db.php';

/**
 * Permet de recuperer les cours en base de données
 */
function getRessources(){
    $dbh = getConnexion();
    $req = "SELECT * FROM ressources";
    return $dbh->query($req)->fetchAll();
}

function getTypes(){
    $dbh = getConnexion();
    $req = "SELECT * FROM type";
    return $dbh->query($req)->fetchAll();
}

function getSingleType($idType){
    $dbh = getConnexion();
    $req2 = "SELECT libelle FROM type WHERE idType = :idType";
    $stmt = $dbh->prepare($req2);
    // ON bind la value en parametre pour securiser la requete
    $stmt->bindValue(":idType", $idType, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch();
}

function updateRessouces($idRessource,$libelle,$lien,$description,$idType){
    $dbh = getConnexion();
    $req = "UPDATE ressources SET  libelle = :libelle, lien = :lien, description = :description, idType = :idType WHERE idRessource = :idRessource";
    $stmt = $dbh->prepare($req);
    $stmt->bindValue(":idRessource", $idRessource, PDO::PARAM_INT);
    $stmt->bindValue(":libelle", $libelle, PDO::PARAM_STR);
    $stmt->bindValue(":lien", $lien, PDO::PARAM_STR);
    $stmt->bindValue(":description", $description, PDO::PARAM_STR);
    $stmt->bindValue(":idType", $idType, PDO::PARAM_INT);
    return $stmt->execute(); // renvoie un boolean
}

function addRessouces($libelle,$lien,$description,$idType){
    $dbh = getConnexion();
    $req = "INSERT INTO ressources(libelle, lien, description,idType) VALUES ( :libelle, :lien, :description, :idType)";
    $stmt = $dbh->prepare($req);
    $stmt->bindValue(":libelle", $libelle, PDO::PARAM_STR);
    $stmt->bindValue(":lien", $lien, PDO::PARAM_STR);
    $stmt->bindValue(":description", $description, PDO::PARAM_STR);
    $stmt->bindValue(":idType", $idType, PDO::PARAM_INT);
    return $stmt->execute(); // renvoie un boolean
}

function getRessourceNameToDelete($idRessource){
    $dbh = getConnexion();
    $req = 'SELECT CONCAT(idRessource, " : ", libelle) AS maRessource FROM ressources WHERE idRessource = :idRessource ';
    $stmt = $dbh->prepare($req);
    $stmt->bindValue(":idRessource", $idRessource, PDO::PARAM_INT);
    $stmt->execute();
    $res = $stmt->fetch();
    if($res) return $res['maRessource'];
}

function deleteRessouce($idRessource){
    $dbh = getConnexion();
    $req = "DELETE FROM ressources WHERE idRessource = :idRessource";
    $stmt = $dbh->prepare($req);
    $stmt->bindValue(":idRessource", $idRessource, PDO::PARAM_INT);
    return $stmt->execute(); // renvoie un boolean
}