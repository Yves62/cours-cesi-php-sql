<?php
require'config/db.php';

/**
 * Permet de recuperer les cours en base de données
 */
function getCours(){
    $dbh = getConnexion();
    $req = "SELECT * FROM cours";
    return $dbh->query($req)->fetchAll();
}

function getTypes(){
    $dbh = getConnexion();
    $req = "SELECT * FROM type";
    return $dbh->query($req)->fetchAll();
}

function getCoursType($idType){
    $dbh = getConnexion();
    $req2 = "SELECT libelle FROM type WHERE idType = :idType";
    $stmt = $dbh->prepare($req2);
    // ON bind la value en parametre pour securiser la requete
    $stmt->bindValue(":idType", $idType, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch();
}

function getCoursNameToDelete($idCours){
    $dbh = getConnexion();
    $req = 'SELECT CONCAT(idCours, " : ", libelle) AS monCours FROM cours WHERE idCours = :idCours ';
    $stmt = $dbh->prepare($req);
    $stmt->bindValue(":idCours", $idCours, PDO::PARAM_INT);
    $stmt->execute();
    $res = $stmt->fetch();
    return $res['monCours'];
}

function deleteCours($idCours){
    $dbh = getConnexion();
    $req = "DELETE FROM cours WHERE idCours = :idCours";
    $stmt = $dbh->prepare($req);
    $stmt->bindValue(":idCours", $idCours, PDO::PARAM_INT);
    return $stmt->execute(); // renvoie un boolean
}

function getTypeNameToDelete($idType){
    $dbh = getConnexion();
    $req = 'SELECT CONCAT(idType, " : ", libelle) AS monType FROM type WHERE idType = :idType ';
    $stmt = $dbh->prepare($req);
    $stmt->bindValue(":idType", $idType, PDO::PARAM_INT);
    $stmt->execute();
    $res = $stmt->fetch();
    if ($res) return $res['monType'];
}

function deleteType($idType){
    $dbh = getConnexion();
    $req = "DELETE FROM type WHERE idType = :idType";
    $stmt = $dbh->prepare($req);
    $stmt->bindValue(":idType", $idType, PDO::PARAM_INT);
    return $stmt->execute(); // renvoie un boolean
}

function updateCours($idCours,$libelle,$description, $idType, $nomImage){
    $dbh = getConnexion();
    $req = "UPDATE cours SET libelle = :libelle, description = :description, idType = :idType";
    if($nomImage != ""){
        $req .= ", image = :image";
    }
    $req .= ' WHERE idCours = :idCours';
    $stmt = $dbh->prepare($req);
    $stmt->bindValue(":idCours", $idCours, PDO::PARAM_INT);
    $stmt->bindValue(":libelle", $libelle, PDO::PARAM_STR);
    $stmt->bindValue(":description", $description, PDO::PARAM_STR);
    $stmt->bindValue(":idType", $idType, PDO::PARAM_INT);
    if($nomImage != ""){
        $stmt->bindValue(":image", $nomImage, PDO::PARAM_STR);
    }
    return $stmt->execute(); // renvoie un boolean
}

function addCours($libelle,$description, $idType,$image){
    $dbh = getConnexion();
    $req = "INSERT INTO cours(libelle,description,idType,image) VALUES (:libelle, :description, :idType, :image )";
    $stmt = $dbh->prepare($req);
    $stmt->bindValue(":libelle", $libelle, PDO::PARAM_STR);
    $stmt->bindValue(":description", $description, PDO::PARAM_STR);
    $stmt->bindValue(":idType", $idType, PDO::PARAM_INT);
    $stmt->bindValue(":image", $image, PDO::PARAM_STR);
    return $stmt->execute(); // renvoie un boolean
}

function addTypeCours($libelle){
    $dbh = getConnexion();
    $req = "INSERT INTO type(libelle) VALUES (:libelle)";
    $stmt = $dbh->prepare($req);
    $stmt->bindValue(":libelle", $libelle, PDO::PARAM_STR);
    return $stmt->execute(); // renvoie un boolean
}

function getImageToDelete($idCours){
    $dbh = getConnexion();
    $req = "SELECT image FROM cours WHERE idCours = :idCours";
    $stmt = $dbh->prepare($req);
    $stmt->bindValue(":idCours", $idCours, PDO::PARAM_INT);
    $stmt->execute();
    $res= $stmt->fetch();
    return $res['image'];
}