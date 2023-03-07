<?php
$title = "Catalogue de cours";

include"partials/header.php";
require'request/catalogue.dao.php';

$cours = getCours();

function truncText(string $text, int $length): string {
    if (strlen($text) <= $length) return $text;
    else {
        $text = substr($text, 0, $length);
        $text .= "...";
        return $text;   
    }
}

?>

<div class="container-md mt-5">
    <div class="h-100 p-5 text-bg-info text-white rounded-3">
        <h1>Catalogue des cours</h1>
        <p class="h3">Bienvenue sur le site de cours en ligne</p>
        <a class="btn btn-outline-light btn-lg" href="ajout-cours.php">Ajouter un cours</a>
    </div>

    <?php
        if(isset($_GET['type']) && $_GET['type'] === 'suppression'){
            $coursNameToDelete = getCoursNameToDelete($_GET['idCours']);
            ?>
            <div class="container-md">
                <div class="alert alert-primary" role="alert">
                    <p>Voulez-vous vraiment supprimer  <strong><?= $coursNameToDelete ?></strong></p>
                    <a href="?delete<?= $_GET['idCours'] ?>" class="btn btn-outline-danger">Confirmer</a>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
       <?php } ?>

    <section class="d-flex justify-content-around my-5">
        <?php foreach ($cours as $cour): ?>
            <div class="card mx-auto" style="width: 18rem; height: 25rem;">
                <img src="assets/img/<?= $cour['image']?>" class="card-img-top" alt="<?= $cour['image'] ?>">
                <div class="card-body">
                    <h5 class="card-title"><?= $cour['libelle'] ?></h5>
                    <p class="card-text"><?= truncText($cour['description'],100) ?></p>
                    <?php 
                        $type = getCoursType($cour['idType'])
                    ?>
                    <span class="badge bg-primary"><?= $type['libelle'] ?></span>
                </div>
                <div class="card-footer mt-3 d-flex justify-content-around">
                    <form action="" method="GET">
                        <input type="hidden" name="idCours" value="<?= $cour['idCours'] ?>" />
                        <input type="hidden" name="type" value="modification">
                        <input type="submit" value="Modifier" class="btn btn-primary">
                    </form>
                    <form action="" method="GET">
                        <input type="hidden" name="idCours" value="<?= $cour['idCours'] ?>" />
                        <input type="hidden" name="type" value="suppression">
                        <input type="submit" value="Supprimer" class="btn btn-outline-danger">
                    </form>
                </div>
            </div>
       <?php endforeach; ?>
    </section>
</div>

<?php include 'partials/footer.php'; ?>