
<h2><?= isset($title) ? $title : 'Liste des tailles' ?></h2>
<br />
<div class='row col-lg-10 col-md-10 col-sm-12 col-xs-12' style='padding-bottom:20px;'>
    <a href="/tinysweets2/admin/taille-insert">
        <button type="button" name="Creer" class="btn btn-primary btn-md">Ajouter une taille</button>
    </a>
</div>

<div class='row col-lg-12 col-md-12 col-sm-12 col-xs-12'>
    <table id="example2" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th class="bg-primary" style="text-align:center;">Id_taille</th>
                <th class="bg-primary" style="text-align:center;">Nom</th>
                <th class="bg-primary" style="text-align:center;">Prix</th>
                <th class="bg-primary" style="text-align:center;">Description</th>
                <th class="bg-primary" style="text-align:center;">Actions</th>
            </tr>
        </thead>
        <?php
            foreach ($listeTaille as $taille) {
                echo '<tr>
                        <td style="text-align:center; vertical-align:middle; padding:1px;">' .$taille->id_taille. '</td>
                        <td style="text-align:center; vertical-align:middle; padding:1px;">' .$taille->nom. '</td>
                        <td style="text-align:center; vertical-align:middle; padding:1px;">' .$taille->prix. ' €</td>
                        <td style="text-align:center; vertical-align:middle; padding:1px;">' .$taille->description. '</td>
                        <td style="text-align:center; vertical-align:middle; width:120px; padding:1px;">
                            <a href="/tinysweets2/admin/taille-update-'.$taille->id_taille.'">       
                                <button type="button" name="modifier" value="modifier">
                                    <span class="glyphicon glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                </button>
                            </a>
                            <a href="/tinysweets2/admin/taille-delete-'.$taille->id_taille.'">
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