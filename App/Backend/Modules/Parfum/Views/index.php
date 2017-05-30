
<h2><?= isset($title) ? $title : 'Liste des parfums' ?></h2>
<br />
<div class='row col-lg-10 col-md-10 col-sm-12 col-xs-12' style='padding-bottom:20px;'>
    <a href="/tinysweets2/admin/parfum-insert">
        <button type="button" name="Creer" class="btn btn-primary btn-md">Ajouter un parfum</button>
    </a>
</div>

<div class='row col-lg-12 col-md-12 col-sm-12 col-xs-12'>
    <table id="example2" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th class="bg-primary" style="text-align:center;">Id_parfum</th>
                <th class="bg-primary" style="text-align:center;">Nom</th>
                <th class="bg-primary" style="text-align:center;">Prix</th>
                <th class="bg-primary" style="text-align:center;">Actions</th>
            </tr>
        </thead>
        <?php
            foreach ($listeParfum as $parfum) {
                echo '<tr>
                        <td style="text-align:center; vertical-align:middle; padding:1px;">' .$parfum->id_parfum. '</td>
                        <td style="text-align:center; vertical-align:middle; padding:1px;">' .$parfum->nom. '</td>
                        <td style="text-align:center; vertical-align:middle; padding:1px;">' .$parfum->prix. ' €</td>
                        <td style="text-align:center; vertical-align:middle; width:120px; padding:1px;">
                            <a href="/tinysweets2/admin/parfum-update-'.$parfum->id_parfum.'">       
                                <button type="button" name="modifier" value="modifier">
                                    <span class="glyphicon glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                </button>
                            </a>
                            <a href="/tinysweets2/admin/parfum-delete-'.$parfum->id_parfum.'">
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