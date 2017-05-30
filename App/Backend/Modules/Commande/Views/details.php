
<h2><?= isset($title) ? $title : 'Détails de la commande' ?></h2>

<div class='row col-lg-12 col-md-12 col-sm-12 col-xs-12'>
    <table id="example" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
        <thead>
        <tr>
            <th class="bg-primary" style="text-align:center;">N° Commande</th>
            <th class="bg-primary" style="text-align:center;">Montant</th>
            <th class="bg-primary" style="text-align:center;">Date Commande</th>
            <th class="bg-primary" style="text-align:center;">Date Livraison</th>
            <th class="bg-primary" style="text-align:center;">Client</th>
            <th class="bg-primary" style="text-align:center;">Pseudo</th>
            <th class="bg-primary" style="text-align:center;">Actions</th>
        </tr>
        </thead>
        <?php
        foreach ($listeCommandes as $commande) {
            echo '<tr>
                    <td style="text-align:center; vertical-align:middle; padding:1px;">
                        <a href="/tinysweets2/admin/details_commande-'.$commande->id_commande.'">' .$commande->id. '</a>
                    </td>
                    <td style="text-align:center; vertical-align:middle; padding:1px;">' .$commande->montant. ' €</td>
                    <td style="text-align:center; vertical-align:middle; padding:1px;">' .$commande->dateCommande. '</td>
                    <td style="text-align:center; vertical-align:middle; padding:1px;">' .$commande->dateLivraison. '</td>
                    <td style="text-align:center; vertical-align:middle; padding:1px;">' .$commande->id_client. '</td>
                    <td style="text-align:center; vertical-align:middle; width:120px; padding:1px;">
                        <button type="button" name="modifier" value="modifier">
                            <a href="/tinysweets2/admin/commande-update-'.$commande->id_commande.'">       
                                <span class="glyphicon glyphicon glyphicon-pencil" aria-hidden="true"></span>
                            </a>
                        </button>
                        <button type="button" name="supprimer" value="supprimer">
                            <a href="/tinysweets2/admin/commande-delete-'.$commande->id_commande.'">
                                <span class="glyphicon glyphicon glyphicon-trash" aria-hidden="true"></span>
                            </a>
                        </button>
                    </td>
            </tr>'. "\n";
        }
        ?>
    </table>


</div>