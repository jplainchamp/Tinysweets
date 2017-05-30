
<h2><?= isset($title) ? $title : 'Liste des promotions' ?></h2>
<br />
<div class='row col-lg-10 col-md-10 col-sm-12 col-xs-12' style='padding-bottom:20px;'>
    <a href="/tinysweets2/admin/promo-insert">
        <button type="button" name="Creer" class="btn btn-primary btn-md">Ajouter une promotion</button>
    </a>
</div>

<div class='row col-lg-12 col-md-12 col-sm-12 col-xs-12'>
    <table id="example2" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th class="bg-primary" style="text-align:center;">Id_promo</th>
                <th class="bg-primary" style="text-align:center;">Code promo</th>
                <th class="bg-primary" style="text-align:center;">Reduction</th>
                <th class="bg-primary" style="text-align:center;">Actions</th>
            </tr>
        </thead>
        <?php
            foreach ($listePromo as $promo) {
                echo '<tr>
                        <td style="text-align:center; vertical-align:middle; padding:1px;">' .$promo->id_promo. '</td>
                        <td style="text-align:center; vertical-align:middle; padding:1px;">' .$promo->code_promo. '</td>
                        <td style="text-align:center; vertical-align:middle; padding:1px;">' .$promo->reduction. ' €</td>
                        <td style="text-align:center; vertical-align:middle; width:120px; padding:1px;">
                            <a href="/tinysweets2/admin/promo-update-'.$promo->id_promo.'">       
                                <button type="button" name="modifier" value="modifier">
                                    <span class="glyphicon glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                </button>
                            </a>
                            <a href="/tinysweets2/admin/promo-delete-'.$promo->id_promo.'">
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