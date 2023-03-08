<?php
$title = "AJout d'un cours";

include 'partials/header.php';
require 'request/catalogue.dao.php';

$types = getTypes();
?>

<?php
// AJOUT
if (isset($_POST['libelle'])) {
    try{
        $success = addTypeCours($_POST['libelle']);
        if ($success) { ?>
            <div class="container-md">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <p>L'ajout du type de cours s'est bien déroulée</p>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        <?php } else { ?>
            <div class="container-md">
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <p>L'ajout du type de cours ne s'est pas bien déroulée</p>
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
        <h1>Création d'un type de cours</h1>
        <p class="h3">Bienvenue sur la page d'ajout d'un type de cours</p>
        <a class="btn btn-outline-light btn-lg" href="index.php">Retourner à l'accueil</a>
    </div>
    <div class="mt-5 w-75 mx-auto">
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="libelle">Type du cours : </label>
                <input class="form-control mt-3" type="text" name="libelle" id="libelle" placeholder="Saisir le type du cours">
            </div>
            <input type="submit" value="Enregistrer" class="btn btn-primary btn-lg mt-5">
        </form>
    </div>
</div>

<?php
include 'partials/footer.php';
?>