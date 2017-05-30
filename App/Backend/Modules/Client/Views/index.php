<!-- La vue se contente de parcourir le tableau de news pour en afficher les données-->

<h2><?= isset($title) ? $title : 'Liste des clients' ?></h2>
<br />
<div class='row col-lg-10 col-md-10 col-sm-12 col-xs-12' style='padding-bottom:20px;'>
    <a href="/tinysweets2/admin/client-insert">
        <button type="button" name="Creer" class="btn btn-primary btn-md">Ajouter un nouveau client</button>
    </a>
</div>
<div class='row col-lg-12 col-md-12 col-sm-12 col-xs-12'>
    <table id="example" class='display table table-responsive table-striped table-bordered table-hover table-condensed'>
        <thead>
            <tr>
                <th class="bg-primary" style="text-align:center;">Pseudo</th>
                <th class="bg-primary" style="text-align:center;">Nom</th>
                <th class="bg-primary" style="text-align:center;">Prenom</th>
                <th class="bg-primary" style="text-align:center;">Email</th>
                <th class="bg-primary" style="text-align:center;">Genre</th>
                <th class="bg-primary" style="text-align:center;">Adresse</th>
                <th class="bg-primary" style="text-align:center;">Newsletter</th>
                <th class="bg-primary" style="text-align:center;">Actions</th>
            </tr>
        </thead>
        <?php
            foreach ($listeClients as $client) {
                echo '<tr>
                        <td style="text-align:center; vertical-align:middle; padding:1px;">' .$client->pseudo. '</td>
                        <td style="text-align:center; vertical-align:middle; padding:1px;">' .$client->nom. '</td>
                        <td style="text-align:center; vertical-align:middle; padding:1px;">' .$client->prenom. '</td>
                        <td style="text-align:center; vertical-align:middle; padding:1px;">' .$client->email. '</td>
                        <td style="text-align:center; vertical-align:middle; padding:1px;">' .$client->genre. '</td>
                        <td style="text-align:center; vertical-align:middle; padding:1px;">' .$client->adresse. '<br/>' .$client->cp. ' ' .$client->ville. '</td>
                        <td style="text-align:center; vertical-align:middle; padding:1px;">' .$client->newsletter. '</td>
                        <td style=\'text-align:center; vertical-align:middle; width:120px; padding:1px;\'>
                            <a href="/tinysweets2/admin/client-update-'.$client->id_client.'">
                            <button type="button" name="modifier" value="modifier">
                            <span class="glyphicon glyphicon glyphicon-pencil" aria-hidden="true"> </span>
                            </button>
                            </a>
                            <a href="/tinysweets2/admin/client-delete-'.$client->id_client.'">
                            <button type="button" name="supprimer" value="supprimer">
                            <span class="glyphicon glyphicon glyphicon-trash" aria-hidden="true"> </span>
                            </button>
                            </a>
                        </td>
                </tr>'. "\n";
            }
        ?>
    </table>
</div>

<!--<div class='row col-lg-12 col-md-12 col-sm-12 col-xs-12'>
    <a href="/admin/client-insert.html">
        <button type="button" name="Creer">Créer un nouveau client</button>
    </a>

</div>-->