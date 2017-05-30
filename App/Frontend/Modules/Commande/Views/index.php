<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <h3 class="bg-danger col-lg-offset-2 col-md-offset-2 col-lg-8 col-md-8 col-sm-10 col-xs-12"><?= isset($title) ? $title : 'Votre panier' ?></h3>
</div>

<br />

<?php

if(!$user->isAuthenticated()) {
    $user->setFlash('Vous devez vous connecter avant d\'accéder à votre panier !!', 'danger', 'ko');
    $httpResponse->redirect(ROOTADDRESS.'/admin/connexion');
exit();
}

/*#######################################################################################################################################
        Affichage des valeurs du panier dans un tableau
########################################################################################################################################*/
if(empty($_SESSION['panier']['produits'])) {
echo "<div class='col-lg-offset-4 col-md-offset-4 col-lg-8 col-md-8 col-sm-12 col-xs-12'>Votre panier est vide";
    echo "<a href='".ROOTADDRESS."/liste_gateaux'> Retour aux offres</a></div>";
} else {
echo "<div class='panier col-lg-12 col-md-12 col-sm-12 col-xs-12'>";
    echo "<table class='table table-responsive table-striped table-bordered table-hover table-condensed'>
        <tr>";
            echo '<th class="info">Gateau</th>';
            echo '<th class="info">Taille</th>';
            echo '<th class="info">Parfum</th>';
            echo '<th class="info">Promo</th>';
            echo '<th class="info">Quantite</th>';
            echo '<th class="info">Retirer</th>';
            echo '<th class="info">Prix HT</th>';
            echo '</tr>';
            foreach ($_SESSION['panier']['produits'] as $key => $produit) {
                $quantite = $produit['quantite'];
                echo '<tr>';
                    echo '<td>' . $produit['gateau']->nom . ' (+' . $produit['gateau']->prix . ' €)<br />
                    <img src="' . $produit['gateau']->photo . '" alt="photo" width="75px" height="50px" /></td>';
                    echo '<td>' . $produit['taille']->nom . ' (+' . $produit['taille']->prix . ' €)</td>';
                    echo '<td>' . $produit['parfum']->nom . ' (+' . $produit['parfum']->prix . ' €)</td>';
                    echo '<td>  - ' . $produit['promo']->reduction . ' € </td>';
                    echo '<td>
                        <a href="'.ROOTADDRESS.'/panier-deleteItem-'.$key.'"><span class="glyphicon glyphicon-minus"></span></a>  ' . $quantite . '  
                        <a href="'.ROOTADDRESS.'/panier-addItem-'.$key.'"><span class="glyphicon glyphicon-plus"></span></a></td>';

                    echo "<td id='panier'><a href='".ROOTADDRESS."/panier-deleteItemAll-" . $key . "'>
                        <button type='button' name='supprimer' value='supprimer'>
                            <span class='glyphicon glyphicon glyphicon-trash' aria-hidden='true'></span>
                        </button>
                    </a></td>";

                if ($produit['promo']->reduction > 1 && $produit['promo']->id_promo == $produit['gateau']->id_promo) {
                    echo '<td> (' . $produit['gateau']->prix . '+' . $produit['taille']->prix . '+' . $produit['parfum']->prix . ' - <i class="i">' . $produit['promo']->reduction . '</i> ) x ' . $quantite . ' = ' . (($produit['gateau']->prix + $produit['taille']->prix + $produit['parfum']->prix - $produit['promo']->reduction) * $quantite) . ' €</td>';
                } else {
                    echo '<td> (' . $produit['gateau']->prix . '+' . $produit['taille']->prix . '+' . $produit['parfum']->prix . ') x ' . $quantite . ' = ' . (($produit['gateau']->prix + $produit['taille']->prix + $produit['parfum']->prix) * $quantite) . ' €</td>';
                }
                echo '</tr>';
            }
            echo '<tr>';
            echo '<td id="totalttc" colspan="6"> Prix Total HT :</td>';
            echo '<td id="montantttc" colspan="3">'; echo sprintf('%.2f', ($_SESSION['panier']['total'])); echo ' €</td>';
            echo '</tr>';
            echo '<tr>';
            echo '<td id="totalttc" colspan="6"> Prix Total TTC avec TVA 5.5%:</td>';
            echo '<td id="montantttc" colspan="3">'; echo sprintf('%.2f', ($_SESSION['panier']['total'])* 1.055); echo ' €</td>';
            echo '</tr>';
            echo '</table></div><br />';

    /*#######################################################################################################################################
            checkbox CVG + code promo
    ########################################################################################################################################*/
    echo '<div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <form class="form-horizontal" action="/tinysweets/validation" method="POST" role="form"><br />
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="form-group col-lg-5 col-md-5 col-sm-12 col-xs-12">
                    <span>J\'accepte les conditions générales de vente (<a href="'.ROOTADDRESS.'/cgv">voir</a>)</span>
                    <input type="checkbox" name="cvg" value="cvg" checked="checked" required>
                </div>
                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                   <p class="alert-danger" >La préparation de la commande sera effectuée à la réception d\'un chèque d\'accompte correspondant à 30% de la commande. C\'est à dire ';
                    echo '<strong>'.sprintf('%.2f', ($_SESSION['panier']['total'])* 0.3).' €</strong>';
                    echo '</p>
                    <p>Toute les commandes doivent être effectués une semaine à l\'avance, veuillez sélectionner une date de livraison.</p>
                    <div class="input-group">
                        <input id="dateLivraison" name="dateLivraison" class="form-control" value="" type="text" required>
                    </div>
                </div>
            </div>      
            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4">
                <button class="btn btn-primary btn-block" type="submit" name="payer">Payer</button>
            </div>
             <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4">
                <a href="'.ROOTADDRESS.'/panier-delete" class="btn btn-warning btn-block" type="submit">Vider panier</a>
            </div>
        </form>
    </div>
    <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <hr>
         <div>
            <p>Toutes les commandes doivent être enlever en boutique, aucune livraison n\'est possible pour le moment.</p>
            <p>Tous nos articles sont calculés avec le taux de TVA à 5,5%.</p>
            <p> Le chèque doit être envoyé à l\'adresse suivante:
            TINYSWEETS - 5 avenue Nicolas About, 78180 Montigny-le-Bretonneux, FRANCE</p>
        </div>
    </div>';
}


