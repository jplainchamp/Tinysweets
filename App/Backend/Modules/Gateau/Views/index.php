
<h2><?= isset($title) ? $title : 'Liste des gâteaux' ?></h2>
<br />
<div class='row col-lg-10 col-md-10 col-sm-12 col-xs-12' style='padding-bottom:20px;'>
    <a href="/tinysweets2/admin/gateau-insert">
        <button type="button" name="Creer" class="btn btn-primary btn-md">Ajouter un nouveau gâteau</button>
    </a>
</div>

<div class='row col-lg-12 col-md-12 col-sm-12 col-xs-12'>
    <table id="example" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th class="bg-primary" style="text-align:center;">Nom</th>
                <th class="bg-primary" style="text-align:center;">Prix</th>
                <th class="bg-primary" style="text-align:center;">Description</th>
                <th class="bg-primary" style="text-align:center;">Photo</th>
                <th class="bg-primary" style="text-align:center;">Catégorie</th>
                <th class="bg-primary" style="text-align:center;">Promotion</th>
                <th class="bg-primary" style="text-align:center;">Actions</th>
            </tr>
        </thead>
        <?php
            foreach ($listeGateaux as $gateau) {
                echo '<tr>
                        <td style="text-align:center; vertical-align:middle; padding:1px;">' .$gateau->nom. '</td>
                        <td style="text-align:center; vertical-align:middle; padding:1px;">' .$gateau->prix. ' €</td>
                        <td style="text-align:center; vertical-align:middle; padding:1px;">' .$gateau->description. '</td>
                        <td style="width:10%; height:10%; padding:5px;">
                            <img src="' . $gateau->photo . '" alt="photo" width="150px" height="150px" />
                        </td>
                        <td style="text-align:center; vertical-align:middle; padding:1px;">' .$gateau->id_categorie. '</td>
                            <td style="text-align:center; vertical-align:middle; padding:1px;">' .$gateau->id_promo. '</td><td style="text-align:center; vertical-align:middle; width:120px; padding:1px;">
                            <a href="/tinysweets2/admin/gateau-update-'.$gateau->id_gateau.'">       
                                <button type="button" name="modifier" value="modifier">
                                    <span class="glyphicon glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                </button>
                            </a>
                            <a href="/tinysweets2/admin/gateau-delete-'.$gateau->id_gateau.'">
                                <button type="button" name="supprimer" value="supprimer">
                                    <span class="glyphicon glyphicon glyphicon-trash" aria-hidden="true"></span>
                                </button>
                            </a>
                        </td>
                </tr>'. "\n";
            }
            ?>
    </table>


</div>