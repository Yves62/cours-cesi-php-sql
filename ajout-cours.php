<?php
$title = "AJout d'un cours";

include 'partials/header.php';
require 'request/catalogue.dao.php';

$types = getTypes();
?>

<?php
// AJOUT
if (isset($_POST['libelle'], $_POST['description'], $_POST['idType'])) {
    $success = addCours($_POST['libelle'], $_POST['description'], $_POST['idType'], "php.jpg");
    if ($success) { ?>
        <div class="container-md">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <p>L'ajout s'est bien déroulée</p>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    <?php } else { ?>
        <div class="container-md">
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <p>L'ajout ne s'est pas bien déroulée</p>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
<?php  }
}
?>

<div class="container-md mt-5">
    <div class="h-100 p-5 text-bg-info text-white rounded-3">
        <h1>Création d'un cours</h1>
        <p class="h3">Bienvenue sur la page d'ajout de cours</p>
        <a class="btn btn-outline-light btn-lg" href="index.php">Retourner à l'accueil</a>
    </div>
    <div class="mt-5 w-75 mx-auto">
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="libelle">Nom du cours : </label>
                <input class="form-control mt-3" type="text" name="libelle" id="libelle" placeholder="Saisir le nom du cours">
            </div>
            <div class="form-group mt-3">
                <label for="description">Description du cours : </label>
                <textarea class="form-control mt-3" name="description" id="description"></textarea>
            </div>
            <div class="form-group">
                <label for="idType">Type du cours :</label>
                <select name="idType" id="idType" class="form-control">
                    <?php foreach ($types as $type) : ?>
                        <option value="<?= $type['idType'] ?>">
                            <?= $type['libelle'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group mt-3">
                <label for="image">Image du cours :</label>
                <input type="file" name="image" id="image" class="form-control-file mt-3">
            </div>
            <input type="submit" value="Enregistrer" class="btn btn-primary btn-lg mt-5">
        </form>
    </div>
</div>

<?php
include 'partials/footer.php';
?>