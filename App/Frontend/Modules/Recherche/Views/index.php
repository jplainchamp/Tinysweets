<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <h3 class="bg-danger col-lg-offset-2 col-md-offset-2 col-lg-8 col-md-8 col-sm-10 col-xs-12"><?= isset($title) ? $title : 'Recherche' ?></h3>
</div>

<div class="container">
    <form class="form-horizontal" role="form" action="" method="POST">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="col-lg-5 col-md-5 col-sm-7 col-xs-7">
                <label class="control-label col-lg-offset-2 col-lg-4 col-md-4 col-sm-6 col-xs-6" for="categorie">Catégorie :</label>
                <select class="form-control" id="categorie" name="idCategorie" style="width:auto;">';
                   <?php foreach ($listeCategories as $categorie) {
                        echo '<option value="'.$categorie->id_categorie.'">'.$categorie->nom.'</option>';
                    }
                   ?>
                    </select>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-5 col-xs-5">
                <button class="btn btn-md btn-primary btn-block" type="submit" name="submit">Rechercher</button>
            </div>
        </div>
    </form>
    <br />
</div>
<div class="container" id="bordure">
    <?php
    if($_POST && $_POST['idCategorie'] != '') {
        echo '<div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">';
        foreach ($listeGateaux as $gateau) {
            echo '<div class="fiche col-lg-4 col-md-4 col-sm-6 col-xs-9 text-center">
                <div class="caption">
                    <div class="thumbnail">
                        <h4>' . ucfirst($gateau->nom) . '</h4>';
            foreach ($listeCategories as $categorie) {
                if ($categorie->id_categorie == $gateau->id_categorie) echo '<p><strong>Catégorie :</strong> ' . $categorie->nom . '</p>';
            }
            echo '<img src="' . $gateau->photo . '" alt="photo" width="150px" height="150px"/>';
            foreach ($listePromo as $promo) {
                if ($promo->id_promo === $gateau->id_promo) {
                    echo '<label class="control-label"> Prix : </label><span> ' . $gateau->prix . ' € </span>';
                    if ($promo->reduction > 0) {
                        echo '<span class="reduc"> - Promotion: - ' . $promo->reduction . '€ </span>';
                    }
                }
            }
            if ($promo->reduction == 0) {
                echo '<br/>';
            }
            if ($user->isAuthenticated()) {
                echo '<br /><p><a href="/tinysweets/fiche-' . $gateau->id_gateau . '" class="btn btn-md btn-primary">Détails</a>';
            } else {
                echo '<br /><p><a href="/tinysweets/admin/connexion" class="btn btn-md btn-primary">Se connecter</a>';
                echo '<br /><span> pour voir la fiche du gâteau</span>';
            }
            echo '</p>
                        </div>
                    </div>
                </div>';
        }
        echo '</div>';
    }
    ?>
</div>