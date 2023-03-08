<?php

$title = "Catalogue de cours";

include 'partials/header.php';
require 'request/ressources.dao.php';

$ressources = getRessources();
$types = getTypes();
// Fonction permettant de tronquer le texte
function truncate($text, $ending = '...')
{
    if (strlen($text) > 50) {
        return substr($text, 0, 50) . $ending;
    }
    return $text;
}
?>
<div class="container-md mt-5">
    <div class="h-100 p-5 text-bg-info text-white rounded-3">
        <h1>Catalogue des ressources</h1>
        <p class="h3">Bienvenue sur le site de cours en ligne</p>
    </div>
</div>


<!-- READ ALL TYPE WITH BTN TO DELETE TYPE AND BTN TO MODIFY -->
<?php foreach ($ressources as $ressource) : ?>
            <div class="col-md-4 mt-5">
                <?php
                if(!isset($_GET['type']) || $_GET['type'] != 'modification' || $_GET['idRessource'] != $ressource['idRessource'])
                {?>
                    <div class="card mx-auto" style="width: 18rem;height: 30rem">
                        <div class="card-body">
                            <h5 class="card-title"><?= $ressource['libelle'] ?></h5>
                            <a href="<?= $ressource['lien'] ?>"><?= $ressource['libelle'] ?></a>
                            <p class="card-text"><?= truncate($ressource['description']) ?></p>
                            <p class="card-text"><?= $ressource['date'] ?></p>
                            <?php
                            $type = getSingleType($ressource['idType']);
                            ?>
                            <span class="badge bg-primary"><?= $type['libelle'] ?></span>
                        </div>
                        <!-- <div class="card-footer mt-3 d-flex justify-content-around">
                            <form action="" method="GET">
                                <input type="hidden" name="idRessource" value="<?= $ressource['idRessource'] ?>" />
                                <input type="hidden" name="type" value="modification" />
                                <input type="submit" value="Modifier" class="btn btn-primary" />
                            </form>
                            <form action="" method="GET">
                                <input type="hidden" name="idRessouce" value="<?= $ressource['idRessource'] ?>" />
                                <input type="hidden" name="type" value="suppression" />
                                <input type="submit" value="Supprimer" class="btn btn-outline-danger" />
                            </form>
                        </div> -->
                    </div>
                <?php }else{?>
                    <form class="card mx-auto" style="width: 22rem;height: 40rem" action="" method="POST" >
                        <input type="hidden" name="type" value="modificationEtape2">
                        <input type="hidden" name="idRessource" value="<?= $ressource['idRessource'] ?>">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="nomRessource">Nom de la ressource :</label>
                                <input type="text" name="nomRessource" value="<?= $ressource['libelle'] ?>" id="nomRessource" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="lienRessource">Lien de la ressource :</label>
                                <input type="text" name="lienRessource" value="<?= $ressource['libelle'] ?>" id="lienRessource" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="descRessource">Description de la ressource :</label>
                                <textarea name="descRessource" id="descRessource" class="form-control"><?= $ressource['description'] ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="idType">Type de la ressource :</label>
                                <select name="idType" id="idType" class="form-control">
                                    <?php foreach ($types as $type) : ?>
                                        <option value="<?= $type['idType'] ?>" <?= ($type['idType'] == $ressource['idType']) ? "selected" : "" ?>>
                                            <?=  $type['libelle'] ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </form>
                <?php }
                ?>

            </div>
        <?php endforeach; ?>

<?php include 'partials/footer.php'; ?>