
<h2><?= isset($title) ? $title : 'Liste des avis' ?></h2>
<br />
<br />

<div class='row col-lg-12 col-md-12 col-sm-12 col-xs-12'>
    <table id="example2" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th class="bg-primary" style="text-align:center;">Id_avis</th>
                <th class="bg-primary" style="text-align:center;">Pseudo client</th>
                <th class="bg-primary" style="text-align:center;">Nom gateau</th>
                <th class="bg-primary" style="text-align:center;">Commentaire</th>
                <th class="bg-primary" style="text-align:center;">Note</th>
                <th class="bg-primary" style="text-align:center;">Date</th>
                <th class="bg-primary" style="text-align:center;">Actions</th>
            </tr>
        </thead>
        <?php
            foreach ($listeAvis as $avis) {
                echo '<tr>
                        <td style="text-align:center; vertical-align:middle; padding:1px;">' .$avis->id_avis. '</td>';
                        foreach ($listeClients as $client) {
                            if ($avis->id_client === $client->id_client) {
                                echo '<td style="text-align:center; vertical-align:middle; padding:1px;">'.$client->pseudo.'</td>';
                            }
                        }
                        if (is_null($avis->id_client)) {
                            echo '<td style="text-align:center; vertical-align:middle; padding:1px;">Client inexistant</td>';
                        }
                        foreach ($listeGateaux as $gateau) {
                            if ($avis->id_gateau === $gateau->id_gateau) {
                                echo '<td style="text-align:center; vertical-align:middle; padding:1px;">'.$gateau->nom.'</td>';
                            }
                        }
                        if (is_null($avis->id_gateau)) {
                            echo '<td style="text-align:center; vertical-align:middle; padding:1px;">Gateau inexistant</td>';
                        }

                        echo '<td style="text-align:center; vertical-align:middle; padding:1px;">' .$avis->commentaire. '</td>
                        <td style="text-align:center; vertical-align:middle; padding:1px;">' .$avis->note. '</td>
                        <td style="text-align:center; vertical-align:middle; padding:1px;">' .$avis->dateAvis. '</td>
                        <td style="text-align:center; vertical-align:middle; width:120px; padding:1px;">
                              <a href="/tinysweets2/admin/avis-delete-'.$avis->id_avis.'">
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