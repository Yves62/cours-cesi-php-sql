<?php
$title = "AJout d'une ressource";

include 'partials/header.php';
require 'request/ressources.dao.php';

$types = getTypes();
?>

<?php
// AJOUT
if (isset($_POST['libelle'], $_POST['lien'], $_POST['description'], $_POST['idType'])) {
    try{
        $success = addRessouces($_POST['libelle'],$_POST['lien'], $_POST['description'], $_POST['idType']);
        if ($success) { ?>
            <div class="container-md">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <p>L'ajout de la ressource s'est bien déroulée</p>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        <?php } else { ?>
            <div class="container-md">
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <p>L'ajout de la ressouce ne s'est pas bien déroulée</p>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
    <?php  }
    } catch(Exception $e){
        echo $e->getMessage();
    }
}
?>

<div class="container-md mt-5">
    <div class="h-100 p-5 text-bg-info text-white rounded-3">
        <h1>Création d'un cours</h1>
        <p class="h3">Bienvenue sur la page d'ajout de ressources</p>
        <a class="btn btn-outline-light btn-lg" href="index.php">Retourner à l'accueil</a>
    </div>
    <div class="mt-5 w-75 mx-auto">
        <form action="" method="POST">
            <div class="form-group">
                <label for="libelle">Nom de la ressource : </label>
                <input class="form-control mt-3" type="text" name="libelle" id="libelle" placeholder="Saisir le nom de la ressource">
            </div>
            <div class="form-group">
                <label for="lien">Lien de la ressource : </label>
                <input class="form-control mt-3" type="text" name="lien" id="lien" placeholder="Saisir le lien de la ressource">
            </div>
            <div class="form-group mt-3">
                <label for="description">Description de la ressource : </label>
                <textarea class="form-control mt-3" name="description" id="description"></textarea>
            </div>
            <div class="form-group">
                <label for="idType">Type de la ressource :</label>
                <select name="idType" id="idType" class="form-control">
                    <?php foreach ($types as $type) : ?>
                        <option value="<?= $type['idType'] ?>">
                            <?= $type['libelle'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <input type="submit" value="Enregistrer" class="btn btn-primary btn-lg mt-5">
        </form>
    </div>
</div>

<?php
include 'partials/footer.php';
?>