<!-- Affichage Liste produits -->
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <h3 class="bg-danger col-lg-offset-2 col-md-offset-2 col-lg-8 col-md-8 col-sm-10 col-xs-12"><?= isset($title) ? $title : 'Nos gâteaux' ?></h3>
</div>

<br />

<?php

echo '<div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">';
foreach ($listeGateaux as $gateau) {
echo'<div class="fiche col-lg-4 col-md-4 col-sm-6 col-xs-9 text-center">
    <div class="caption">
		<div class="thumbnail">
			  <h4>'.ucfirst($gateau->nom).'</h4>
				<img src="'.$gateau->photo.'" alt="photo" width="150px" height="150px"/>';
                    foreach ($listePromo as $promo) {
                        if($promo->id_promo === $gateau->id_promo){
                            echo '<label class="control-label"> Prix : </label><span> '.$gateau->prix.' € </span>';
                            if($promo->reduction > 0){ echo '<span class="reduc"> - Promotion: - '.$promo->reduction.'€ </span>';}
                        }
                    }
                    if($promo->reduction == 0){ echo '<br/>';}
                    if($user->isAuthenticated()) {
                      echo '<br /><p><a href="'.ROOTADDRESS.'/fiche-'.$gateau->id_gateau.'" class="btn btn-md btn-primary">Détails</a>';
                    } else {
                       echo '<br /><p><a href="'.ROOTADDRESS.'/admin/connexion" class="btn btn-md btn-primary">Se connecter</a>';
                        echo '<br /><span> pour voir la fiche du gâteau</span>';
                    }
                    echo'</p>
			</div>
        </div>
    </div>';
}
echo '</div>';